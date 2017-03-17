<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__)."/../../../libraries/mpdf/mpdf.php");

class PDF_Content
{
    private $ci;
    private $mpdf;

    private $appendix_index;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->mpdf = new mPDF();

        // Pointers for quick configurations
        $ci = &$this->ci;
        $mpdf = &$this->mpdf;

        // Initial config : CI
        $ci->load->model('dm_standards/content_model', 'cm');
        $ci->load->model('dm_standards/content_abbreviations_model', 'cam');
        $ci->load->model('dm_standards/content_definitions_model', 'cdm');
        $ci->load->library('dm_standards/dms_tree');
        $ci->load->library('dm_standards/content_utilities');

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

        $toc_content = $this->ci->load->view("dm_standards/content/partials/pdf_toc",
            array(
                'ems_tree' => $this->ci->ems_tree->get_ems_tree(),
                'language' => $language,
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
        $pdf_content = array();

        $current_index = 0;

        $language = lang('ems_tree');

        foreach($tree as $tree_item)
        {
            $tree_root = $tree_item[0];
            $tree_sub_root_items = $tree_item[1];

            if($tree_root == 'appendices')
                $this->appendix_index = $current_index;

            $pre_append = "<h2>{$language[$tree_root]}</h2><hr/><pagebreak />";

            foreach($tree_sub_root_items as $tree_sub_root_item)
            {
                $section_key = $tree_root;
                $content_item_key = $tree_sub_root_item;

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
                        'content_partials' => $content_partials,
                        'section_key' => $section_key,
                        'content_item_key' => $content_item_key,
                        'content_variables' => $content_variables,
                        'language' => $language,
                    ), true);

                $pdf_content[] = iconv("UTF-8", "UTF-8//IGNORE", $pre_append.$view);

                $current_index ++;

                $pre_append = "";
            }
        }

        $this->manual_html_inserts($pdf_content);

        foreach($pdf_content as $pdf_content_item)
            $this->mpdf->WriteHtml($pdf_content_item);

        $this->mpdf->Output();
    }
}
