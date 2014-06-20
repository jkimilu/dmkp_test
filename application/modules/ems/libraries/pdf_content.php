<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__)."/mpdf/mpdf.php");

class PDF_Content
{
    private $ci;
    private $mpdf;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->mpdf = new mPDF();

        // Pointers for quick configurations
        $ci = &$this->ci;
        $mpdf = &$this->mpdf;

        // Initial config : CI
        $ci->load->model('ems/content_model', 'cm');
        $ci->load->model('ems/content_chunks_model', 'ccm');
        $ci->load->model('ems/content_popups_model', 'cpm');
        $ci->load->model('ems/content_abbreviations_model', 'cam');
        $ci->load->model('ems/content_definitions_model', 'cdm');
        $ci->load->library('ems/ems_tree');
        $ci->load->library('ems/content_utilities');
    }

    public function output_full_content_pdf()
    {
        $tree = $this->ci->ems_tree->get_ems_tree();
        $pdf_content = array();

        foreach($tree as $tree_item)
        {
            $tree_root = $tree_item[0];
            $tree_sub_root_items = $tree_item[1];

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
                        'language' => lang('ems_tree'),
                    ), true);

                $pdf_content[] = iconv("UTF-8", "UTF-8//IGNORE", $view);
            }
        }

        foreach($pdf_content as $pdf_content_item)
            $this->mpdf->WriteHtml($pdf_content_item);

        $this->mpdf->Output();
    }
}
