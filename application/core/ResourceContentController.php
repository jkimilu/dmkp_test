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
    protected $resourceResourcesUrl = null;
    protected $submitUrl = null;
    protected $resourceSubmitUrl = null;
    protected $resourceResourceDeleteUrl = null;
    protected $homeScreenUrl;

    protected $resourceCategory = '';

    protected $resourceModel = null;

    protected $showActionFields = true;

    public function __construct() {
        parent::__construct();
        $this->load->model('contact_persons/Contact_Persons_Model');
        $this->load->model('Resource_Resources_Model');
        $this->load->helper('dmkp');
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
                $contactPersonsArray[$contactPerson->id] = $contactPerson->contact_person;
                $contactLinksArray[$contactPerson->id] = $contactPerson->contact_person_link;
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
     * @param $resourcesCategory
     * @param $model
     * @param $category
     * @return
     */
    protected function showResourcesList($resourcesCategory, $model, $category) {
        $resources = $model->getPagedResources($this->pagination->current_page(), $category);

        if($resources['records']) {
            foreach($resources['records'] as &$resource) {
                $resourceResources = $this->Resource_Resources_Model->find_all_by(array(
                    'resource_id' => $resource->id,
                    'resource_category' => $resourcesCategory,
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
            'resourceResourcesUrl' => $this->resourceResourcesUrl,
            'showActionFields' => $this->showActionFields,
        ), TRUE);
    }

    /**
     * Show resources belonging to a specific resource
     *
     * @param $resourceMainId
     * @return mixed
     */
    protected function showResourceResourcesList($resourceMainId) {

        $resources = $this->Resource_Resources_Model
            ->find_all_by(array(
                'resource_category' => $this->resourceCategory,
                'resource_id' => $resourceMainId,
            ));

        Template::set('extraJS', sureToDelete($resources));

        return $this->load->view('resource_editors/resource_list', array(
            'resources' => $resources,
            'resourceMainId' => $resourceMainId,
            'submitUrl' => $this->resourceSubmitUrl,
            'resourceDeleteUrl' => $this->resourceResourceDeleteUrl,
            'resourceCategory' => $this->resourceCategory,
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
        if($this->resourceModel != null) {
            $this->resourceModel->deleteResource($resourceId);
        }
    }

    /**
     * Add a link to an existing resource
     */
    protected function addOrEditResourceLink() {
        $id = $this->input->post('id', null);
        $category = $this->input->post('category', null);

        if($id != null && $category != null) {
            // Valid submit
            $resourceName = $this->input->post('resource_name', null);
            $resourceLink = $this->input->post('resource_link', null);

            if($resourceName != null && trim($resourceName) != '' &&
                $resourceLink != null && trim($resourceLink) != '') {
                if(intval($id) > 0) {
                    // Edit
                    $this->Resource_Resources_Model->update([
                        'id' => $id,
                    ],[
                        'resource_name' => $resourceName,
                        'resource_id' => $this->input->post('resource_id'),
                        'resource_url' => $resourceLink,
                        'resource_category' => $category,
                        'resource_type' => $this->input->post('resource_type'),
                    ]);
                } else {
                    // Insert
                    $this->Resource_Resources_Model->insert([
                        'resource_name' => $resourceName,
                        'resource_id' => $this->input->post('resource_id'),
                        'resource_url' => $resourceLink,
                        'resource_category' => $category,
                        'resource_type' => $this->input->post('resource_type'),
                    ]);
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Remove from DB and from disk if required
     *
     * @param $resourceId
     */
    protected function deleteLinkToResource($resourceId) {
        // Remove from DB and from disk if required
    }
}