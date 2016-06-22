<?php

require_once __DIR__."/includes/ResourceDataModel.php";

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/22/16
 * Time: 7:49 AM
 */
class ResourceContentController extends Admin_Controller
{
    protected $resourceType = null;
    protected $contentGrouping = array();
    protected $fields = array();

    protected $latestVersionEnabled = false;
    protected $gateKeeperEnabled = false;
    protected $contactPersonEnabled = false;

    protected $resourceEditUrl = null;
    protected $resourceAddUrl = null;
    protected $resourceDeleteUrl = null;
    protected $submitUrl = null;

    protected $resourceModel = null;

    public function __construct() {
        parent::__construct();
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
        
        if($itemId != null) {
            // Editing an existing item
            $resource = $this->resourceModel->find($itemId);

            if($resource) {
                $object = json_decode($resource->fields);
                $selectedGroups[] = $object->{ResourceDataModel::$fieldSpecGroup};
                $selectedGateKeepers[] = $object->{ResourceDataModel::$fieldSpecGateKeeper};
                $selectedContactPersons[] = $object->{ResourceDataModel::$fieldSpecKeyContactPerson};
                $selectedCategories[] = $resource->category;
                $guidanceDescriptorTitle = $object->{ResourceDataModel::$fieldSpecGuidanceDescriptorsTitle};
                $guidanceDescriptorText = $object->{ResourceDataModel::$fieldSpecGuidanceDescriptorsText};
                $latestVersion = $object->{ResourceDataModel::$fieldSpecVersion};
            } else {
                show_404();
            }
        }

        return $this->load->view('resource_editors/editor', array(
            'submitUrl' => $this->submitUrl,
            'recordId' => $itemId,
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
     * Show a list of resources
     *
     * @param $model
     */
    protected function showResourcesList($model, $category) {
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

        return $this->load->view('resource_editors/list', array(
            'records' => $resources['records'],
            'pagination' => $resources['pagination'],
            'submitUrl' => $this->submitUrl,
            'latestVersionEnabled' => $this->latestVersionEnabled,
            'contactPersonEnabled' => $this->contactPersonEnabled,
            'gateKeeperEnabled' => $this->gateKeeperEnabled,
            'categories' => $this->getCategories(),
            'groups' => $this->getGroups(),
            'contactPersons' => $this->getContactPersons(),
            'gateKeepers' => $this->getGateKeepers(),
            'resourceEditUrl' => $this->resourceEditUrl,
            'resourceDeleteUrl' => $this->resourceDeleteUrl,
            'resourceAddUrl' => $this->resourceAddUrl,
        ), TRUE);
    }

    /**
     * Saves an edited / inserted resource
     *
     * @param $object
     * @param null $itemId
     * @return mixed
     */
    protected function saveResource($object, $itemId = null) {
        if($this->resourceModel != null) {
            $jsonObject = new stdClass();
            $jsonObject->{ResourceDataModel::$fieldSpecGroup} = $object->post('grouping', null);
            $jsonObject->{ResourceDataModel::$fieldSpecGuidanceDescriptorsTitle} = $object->post('guidance_descriptor_title', null);
            $jsonObject->{ResourceDataModel::$fieldSpecGuidanceDescriptorsText} = $object->post('guidance_descriptor_text', null);
            $jsonObject->{ResourceDataModel::$fieldSpecVersion} = $object->post('latest_version', null);
            $jsonObject->{ResourceDataModel::$fieldSpecKeyContactPerson} = $object->post('contact_person', null);
            $jsonObject->{ResourceDataModel::$fieldSpecGateKeeper} = $object->post('gate_keeper', null);

            if($itemId == null) {
                return $this->resourceModel->createResource($jsonObject, $object->post('category'));
            } else {
                return $this->resourceModel->updateResource($itemId, $jsonObject, $object->post('category'));
            }
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