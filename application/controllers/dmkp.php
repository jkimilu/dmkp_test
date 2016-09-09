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

        $email_sent = $this->session->flashdata('email_sent');

        if($email_sent)
            Template::set("global_alert", $email_sent);

        $content_container_view = $this->load->view('dmkp/copyright_notice', [
            'popup_helpers' => $this->popup_helpers,
        ], true);

        Template::set('content_view', $content_container_view);
        Template::render();
    }

    /**
     * Handles the submit feedback form
     */
    public function submit_feedback() {
        $postVars = $this->input->post();

        if($postVars) {
            $urlWithIssue = $postVars['url_with_issue'];
            Template::redirect($urlWithIssue);
        } else {
            show_404();
        }
    }

    /**
     * Shows the need help landing page
     */
    public function need_help() {
        Template::render();
    }

    /**
     * The "search" page
     */
    public function search()
    {
        $this->force_login();

        $search_term = $this->input->get('search');
        $module = $this->input->get('module', null);
        $activeModule = $this->input->get('active_module', null);

        // Load module search libraries
        $this->load->library('ems/ems_search');
        $this->load->library('dm_standards/dm_standards_search');
        $this->load->library('dm_policies/dm_policies_search');
        $this->load->library('dm_preparedness/dm_preparedness_search');
        $this->load->library('capacity_building/capacity_building_search');

        // Populate search variables
        $content_search = array(
            'ems' => ($module == 'ems' || $module == null) ? $this->ems_search->search($search_term) : [],
            'dm_standards' => ($module == 'dm_standards' || $module == null) ?  $this->dm_standards_search->search($search_term) : [],
            'capacity_building' => ($module == 'capacity_building' || $module == null) ? $this->capacity_building_search->search($search_term) : [],
            'dm_policies' => ($module == 'dm_policies' || $module == null) ? $this->dm_policies_search->search($search_term) : [],
            'dm_preparedness' => ($module == 'dm_preparedness' || $module == null) ?  $this->dm_preparedness_search->search($search_term) : [],
        );

        $totalResults = count($content_search['ems']) +
            count($content_search['dm_standards']) + count($content_search['capacity_building']) +
            count($content_search['dm_policies']) + count($content_search['dm_preparedness']);

        // Feed in the content
        $content_container_view = $this->load->view('dmkp/search_results_page_layout',
            array(
                'results' => $content_search,
                'term' => $search_term,
                'module' => $module,
                'totalResults' => $totalResults,
                'activeModule' => $activeModule,
            ), true);

        Template::set('content_view', $content_container_view);
        Template::render();
    }
}