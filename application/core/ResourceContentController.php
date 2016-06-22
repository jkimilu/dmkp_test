<?php

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/22/16
 * Time: 7:49 AM
 */
class ResourceContentController extends Admin_Controller
{
    protected $resourceType = null;
    protected $contentCategories = array();
    protected $contentGrouping = array();
    protected $fields = array();

    protected $latestVersionEnabled = false;
    protected $gateKeeperEnabled = false;
    protected $contactPersonEnabled = false;

    protected $submitUrl = null;

    const fieldSpecGroup = 'group';
    const fieldSpecGuidanceDescriptors = 'guidance_descriptors';
    const fieldSpecLinksResources = 'links_and_resources';
    const fieldSpecVersion = 'version';
    const fieldSpecGateKeeper = 'gate_keeper';
    const fieldSpecKeyContactPerson = 'contact_person';

    public function __construct() {
        parent::__construct();
        $this->load->model('Contact_Persons_Model');
    }

    /**
     * Get contact persons
     */
    protected function getContactPersons() {
        $contactPersons = $this->contact_persons_model->find_all();
        $contactPersonsArray = [];

        foreach($contactPersons as $contactPerson) {
            $contactPersonsArray[$contactPerson->id] = $contactPerson->person;
        }

        return $contactPersonsArray;
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
     * Opens up a resource editor
     *
     * @param null $itemId
     */
    protected function showEditor($itemId = null) {
        $selectedCategories = [];
        $selectedGroups = [];
        $selectedGateKeepers = [];
        $selectedContactPersons = [];
        $guidanceDescriptorTitle = null;
        $guidanceDescriptorText = null;
        $latestVersion = null;
        
        if($itemId == null) {
            // Its a new item
        } else {
            // Edit existing item
        }

        return $this->load->view('resource_editors/editor', array(
            'submitUrl' => $this->submitUrl,
            'recordId' => $this->itemId,
            'latestVersionEnabled' => $this->latestVersionEnabled,
            'contactPersonEnabled' => $this->contactPersonEnabled,
            'gateKeeperEnabled' => $this->gateKeeperEnabled,
            'selectedCategories' => $selectedCategories,
            'categories' => $this->getCategories(),
            'selectedGroups' => $selectedGroups,
            'groups' => $this->getGroups(),
            'selectedContactPersons' => $selectedContactPersons,
            'contactPersons' => $this->getContactPersons(),
            'selectedGateKeepers' => $selectedGateKeepers,
            'gateKeepers' => $this->getGateKeepers(),
            'guidanceDescriptorTitle' => $guidanceDescriptorTitle,
            'guidanceDescriptorText' => $guidanceDescriptorText,
            'latestVersion' => $latestVersion,
        ), TRUE);
    }

    /**
     * Show resources for a resource and allow editing of links and resources
     *
     * @param $itemId
     */
    protected function showResourcesEditor($itemId) {
        // Show resources for a resource and allow editing of links and resources
    }

    /**
     * Saves an edited / inserted resource
     *
     * @param $object
     * @param null $itemId
     */
    protected function saveResource($object, $itemId = null) {
        if($itemId == null) {
            // Its a new item
        } else {
            // Edit existing item
        }
    }

    /**
     * Delete an existing resource
     *
     * @param $resourceId
     */
    protected function deleteResource($resourceId) {
        // Delete
    }

    /**
     * Upload resource for a resource item
     *
     * @param $itemId
     */
    protected function uploadResource($itemId) {
        // Do upload
    }

    /**
     * Add a link to an existing resource
     *
     * @param $itemId
     */
    protected function addLinkToResource($itemId) {
        // Add a link to an existing resource
    }

    /**
     * Remove from DB and from disk if required
     *
     * @param $resourceId
     * @param $itemId
     */
    protected function deleteUploadedResourceOrLink($resourceId, $itemId) {
        // Remove from DB and from disk if required
    }
}