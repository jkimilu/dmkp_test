<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__)."/../../../libraries/mpdf/mpdf.php");

class PDF_Content
{
    private $ci;
    private $mpdf;

    private $appendix_index;

    // Content titles
    private $contentEditedTitles;
    private $subContentEditedTitles;

    // Sub content functionality
    private $subContentEntries;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->mpdf = new mPDF();

        // Pointers for quick configurations
        $ci = &$this->ci;
        $mpdf = &$this->mpdf;

        // Initial config : CI
        $ci->load->model('ems/ems_content_model', 'cm');
        $ci->load->model('ems/sub_content_model', 'scm');
        $ci->load->model('ems/content_chunks_model', 'ccm');
        $ci->load->model('ems/content_popups_model', 'cpm');
        $ci->load->model('ems/content_abbreviations_model', 'cam');
        $ci->load->model('ems/content_definitions_model', 'cdm');
        $ci->load->library('ems/ems_tree');
        $ci->load->library('ems/ems_content_utilities', null, 'content_utilities');

        // Index of the appendix item
        $this->appendix_index = 0;
    }

    /**
     * Manual HTML inserts
     *
     * @param $pdf_content
     */
    private function manual_html_inserts(&$pdf_content)
    {
        $this->ci->lang->load("ems");
        $language = lang("ems_tree");

        $toc_content = $this->ci->load->view("ems/content/partials/pdf_toc",
            array(
                'ems_tree' => $this->ci->ems_tree->get_ems_tree(),
                'language' => $language,
                'titles' => $this->contentEditedTitles,
                'subTitles' => $this->subContentEditedTitles,
            ), true);

        $popups = $this->ci->cpm->order_by('title')->find_all();

        $popups_content = $this->ci->load->view("ems/content/partials/pdf_popups",
            array(
                'popups' => $popups,
            ), true);

        array_splice($pdf_content, $this->appendix_index, 0, array($popups_content));
        array_splice($pdf_content, 0, 0, array($toc_content));
    }

    /**
     * Prepare sub root items
     *
     * @param $treeRoot
     * @param $treeSubRootItem
     * @param $rootIndex
     * @param $rootSubIndex
     * @param $language
     * @param $preAppend
     * @return string
     */
    private function prepareTreeSubItem($treeRoot, $treeSubRootItem, $rootIndex,
                                        $rootSubIndex, $language, $preAppend) {
        $subTrees = $this->ci->ems_tree->get_ems_sub_trees();

        $section_key = $treeRoot;
        $content_item_key = $treeSubRootItem;

        // Root content entries
        $main_content = $this->ci->cm->get_content($section_key, $content_item_key);
        $content_chunks = $this->ci->ccm->get_content($section_key, $content_item_key);
        $content_variables = array();

        $content_variables['content'] = $main_content;
        $content_variables['partials'] = $this->ci->ems_tree->get_content_segments($section_key, $content_item_key);
        $content_variables['chunks'] = $content_chunks;

        $content_partials = $this->ci->content_utilities->get_partials($section_key, $content_item_key,
            $content_variables["content"], $content_variables["chunks"], lang("ems_tree"));

        $view = $this->ci->load->view("ems/content/partials/pdf_{$section_key}_layout",
            array(
                // Content variables
                'contentEditedTitles' => $this->contentEditedTitles,
                'content_partials' => $content_partials,
                'section_key' => $section_key,
                'content_item_key' => $content_item_key,
                'content_variables' => $content_variables,
                'language' => $language,
            ), true);

        // Add any sub content entries
        $subContent = $this->ci->scm->get_content_for_content_item($section_key, $content_item_key);

        foreach($subContent as $subContentItem) {
            $subView = $this->ci->load->view("ems/content/partials/pdf_{$section_key}_{$content_item_key}_layout",
                array(
                    // Content variables
                    'subContentEditedTitles' => $this->subContentEditedTitles,
                    'content_partials' => $content_partials,
                    'section_key' => $section_key,
                    'content_item_key' => $content_item_key,
                    'subContentItem' => $subContentItem,
                    'language' => $language,
                    'subTree' => $subTrees[$rootIndex][$rootSubIndex + 1],
                ), true);

            $view .= $subView;
        }

        $view .= "<pagebreak />";

        return iconv("UTF-8", "UTF-8//IGNORE", $preAppend.$view);
    }

    /**
     * Prepares a single tree item
     *
     * @param $treeItem
     * @param $rootIndex
     * @param $language
     * @return array|null
     */
    private function prepareTreeItem($treeItem, $rootIndex, $language) {
        $treeRoot = $treeItem[0];
        $treeSubRootItems = $treeItem[1];
        $rootSubIndex  = 0;

        $pdfContent = null;

        if($treeRoot == 'appendices')
            $this->appendix_index = $rootIndex;

        $this->contentEditedTitles = $this->ci->cm->get_all_edited_titles();
        $this->subContentEditedTitles = $this->ci->scm->get_all_edited_titles();

        $pageTitle = (isset($this->contentEditedTitles[$treeRoot]) ? $this->contentEditedTitles[$treeRoot] : $language[$treeRoot]);
        $preAppend = "<h2>{$pageTitle}</h2><hr/><pagebreak />";

        foreach($treeSubRootItems as $treeSubRootItem)
        {
            $pdfContent .= $this->prepareTreeSubItem($treeRoot, $treeSubRootItem,
                $rootIndex, $rootSubIndex, $language, $preAppend);

            $rootSubIndex ++;
            $preAppend = "";
        }

        return $pdfContent;
    }

    /**
     * Output HTML content
     */
    public function output_full_content_pdf()
    {
        $tree = $this->ci->ems_tree->get_ems_tree();

        $pdfContent = array();
        $rootIndex = 0;
        $language = lang('ems_tree');

        foreach($tree as $treeItem) {
            $pdfContent[] = $this->prepareTreeItem($treeItem, $rootIndex, $language);
            $rootIndex ++;
        }

        $this->manual_html_inserts($pdfContent);

        foreach($pdfContent as $pdf_content_item)
            $this->mpdf->WriteHtml($pdf_content_item);

        $this->mpdf->Output();
    }

    /**
     * Output single page PDF
     *
     * @param $sectionKey
     * @param $contentItemKey
     * @param $sectionId
     * @param $contentItemId
     */
    public function output_single_content_item_pdf($sectionKey, $contentItemKey, $sectionId, $contentItemId)
    {
        $language = lang('ems_tree');
        $pageTitle = (isset($this->contentEditedTitles[$contentItemKey]) ? $this->contentEditedTitles[$contentItemKey] : $language[$contentItemKey]);

        $preAppend = "<h2>{$pageTitle}</h2><hr/><pagebreak />";
        $pdfContent = $this->prepareTreeSubItem($sectionKey, $contentItemKey, $sectionId, $contentItemId, $language, $preAppend);

        $this->mpdf->WriteHtml($pdfContent);
        $this->mpdf->Output();
    }
}
