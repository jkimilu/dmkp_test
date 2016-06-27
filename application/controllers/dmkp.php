<?php

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/20/16
 * Time: 6:06 PM
 */
class dmkp extends Base_Content_Controller
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * Landing controller
     */
    public function index() {
        $this->force_login();
        Template::render();
    }

    /**
     * Sends an email to the publishing team
     */

    public function send_email_to_publishing()
    {
        $this->load->library('user_agent');

        $post_vars = $this->input->post();

        if($post_vars)
        {
            $this->load->library('email');

            $this->email->from($post_vars['email_address'], $post_vars['full_names']);
            $this->email->to('info@bluedigital.co.ke');

            $this->email->subject($post_vars['subject']);
            $this->email->message($post_vars['body']);

            $this->email->send();
            $this->session->set_flashdata('email_sent', "Thank you {$post_vars['full_names']} for your email, we will respond to your query shortly");
        }

        if($this->agent->is_referral())
            redirect($this->agent->referrer());
    }

    /**
     * The "terms" page
     */
    public function copyright_notice()
    {
        $this->force_login();

        $this->set_user_meta_data();

        $email_sent = $this->session->flashdata('email_sent');

        if($email_sent)
            Template::set("global_alert", $email_sent);

        $content_container_view = $this->load->view('dmkp/copyright_notice', [
            'popup_helpers' => $this->popup_helpers,
        ], true);

        Template::set('content_view', $content_container_view);
        Template::render();
    }

    //--------------------------------------------------------------------

    /**
     * The "search" page
     */

    public function search()
    {
        $this->force_login();

        $this->set_user_meta_data();

        // Continue on with other functionality

        $this->load->library('dm_standards/content_utilities');

        $page = $this->uri->segment(3);
        $search_term = $this->input->get('search');

        $pagination_config = $this->pagination_config(
            array(
                'base_url' => site_url('dm_standards/search'),
                'total_rows' => $this->content_model->search_count($search_term),
            )
        );

        if(!$search_term)
        {
            redirect("/");
        }
        else
        {
            $content_search =
                $this->content_model->search($search_term, $pagination_config['per_page'], $page);

            if($content_search)
            {
                foreach($content_search as &$search_item)
                {
                    $search_item->link = site_url($this->content_utilities->get_link_to_section(
                        $search_item->content_section, $search_item->content_slug
                    ));

                    $search_item->brief_text = strip_tags(substr($search_item->main_content, 0, 500));

                    if(trim($search_item->brief_text) == '')
                    {
                        $search_item->brief_text = strip_tags(substr($search_item->chunk_content, 0, 500));
                    }
                }
            }

            $content_container_view = $this->load->view('dms_partials/search_results_page_layout',
                array(
                    'tree_navigation' => $this->dms_tree->get_dms_frontend_tree(lang('dms_tree')),
                    'language' => lang('dms_tree'),
                    'results' => $content_search,
                    'term' => $search_term,
                    'links' => $this->pagination->create_links(),
                    'pagination' => $this->pagination,
                ), true);

            Template::set('content_view', $content_container_view);
            Template::render();
        }
    }
}