<?php

/**
 * Created by Ahmed Maawy
 * User: ultimateprogramer
 * Date: 6/23/16
 * Time: 7:25 AM
 */
class BaseResourceController extends Base_Content_Controller
{
    protected $showActionFields = false;

    protected $latestVersionEnabled = false;
    protected $contactPersonEnabled = true;
    protected $gateKeeperEnabled = false;

    public function __construct() {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->model('Contact_Persons_Model');
        $this->load->model('Resource_Resources_Model');
    }

    /**
     * Get contact persons
     */
    protected function getContactPersons() {
        $contactPersons = $this->Contact_Persons_Model->find_all();
        $contactPersonsArray = [];
        $contactLinksArray = [];

        if($contactPersons) {
            foreach($contactPersons as $contactPerson) {
                $contactPersonsArray[$contactPerson->id] = $contactPerson->person;
                $contactLinksArray[$contactPerson->id] = $contactPerson->link;
            }
        }

        return [
            'persons' => $contactPersonsArray,
            'links' => $contactLinksArray
        ];
    }

    /**
     * Get contact gate-keepers
     */
    protected function getGateKeepers() {
        return $this->getContactPersons();
    }

    /**
     * Override - Get categories
     *
     * @return array
     */
    protected function getCategories() {
        return [];
    }

    /**
     * Override: Get groups
     *
     * @return array
     */
    protected function getGroups() {
        return [
            'high_level_strategic_guidance' => 'High Level / Strategic Guidance',
            'key_policies' => 'Key Policies',
            'cross_cutting_principles_codes_of_conduct' => 'Cross-cutting Principles and Codes of Conduct'
        ];
    }

    /**
     * Show a list of resources
     *
     * @param $model
     */
    protected function showResourcesList($model, $category, $tableClass = null) {
        $resources = $model->getPagedResources($this->pagination->current_page(), $category);

        if($resources['records']) {
            foreach($resources['records'] as &$resource) {
                $resourceResources = $this->Resource_Resources_Model->find_all_by(array(
                    'resource_id' => $resource->id
                ));
                if(!$resourceResources) {
                    $resourceResources = [];
                }

                $resource->resources = $resourceResources;
            }
        }

        $viewVars = array(
            'records' => $resources['records'],
            'pagination' => $resources['pagination'],
            'submitUrl' => null,
            'latestVersionEnabled' => $this->latestVersionEnabled,
            'contactPersonEnabled' => $this->contactPersonEnabled,
            'gateKeeperEnabled' => $this->gateKeeperEnabled,
            'categories' => $this->getCategories(),
            'groups' => $this->getGroups(),
            'contactPersons' => $this->getContactPersons(),
            'gateKeepers' => $this->getGateKeepers(),
            'resourceEditUrl' => null,
            'resourceDeleteUrl' => null,
            'resourceAddUrl' => null,
            'showActionFields' => $this->showActionFields,
        );

        if($tableClass != null) {
            $viewVars['tableClass'] = $tableClass;
        }

        return $this->load->view('resource_editors/list', $viewVars, TRUE);
    }
}