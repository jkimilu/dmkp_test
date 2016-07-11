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
     * Output HTML content
     */
    public function output_full_content_pdf()
    {
        $tree = $this->ci->ems_tree->get_ems_tree();
        $subTrees = $this->ci->ems_tree->get_ems_sub_trees();
        $pdf_content = array();

        $current_index = 0;
        $rootIndex = 0;
        $rootSubIndex = 0;

        $language = lang('ems_tree');

        foreach($tree as $tree_item)
        {
            $tree_root = $tree_item[0];
            $tree_sub_root_items = $tree_item[1];

            if($tree_root == 'appendices')
                $this->appendix_index = $current_index;

            $this->contentEditedTitles = $this->ci->cm->get_all_edited_titles();
            $this->subContentEditedTitles = $this->ci->scm->get_all_edited_titles();

            $pageTitle = (isset($this->contentEditedTitles[$tree_root]) ? $this->contentEditedTitles[$tree_root] : $language[$tree_root]);
            $pre_append = "<h2>{$pageTitle}</h2><hr/><pagebreak />";

            foreach($tree_sub_root_items as $tree_sub_root_item)
            {
                $section_key = $tree_root;
                $content_item_key = $tree_sub_root_item;

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

                $pdf_content[] = iconv("UTF-8", "UTF-8//IGNORE", $pre_append.$view);

                $current_index ++;
                $rootSubIndex ++;

                $pre_append = "";
            }

            $rootSubIndex = 0;
            $rootIndex ++;
        }

        $this->manual_html_inserts($pdf_content);

        foreach($pdf_content as $pdf_content_item)
            $this->mpdf->WriteHtml($pdf_content_item);

        $this->mpdf->Output();
    }
}
