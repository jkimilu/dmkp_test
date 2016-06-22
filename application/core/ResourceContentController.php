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

    const fieldSpecGroup = 'group';
    const fieldSpecGuidanceDescriptors = 'guidance_descriptors';
    const fieldSpecLinksResources = 'links_and_resources';
    const fieldSpecVersion = 'version';
    const fieldSpecGateKeeper = 'gate_keeper';
    const fieldSpecKeyContactPerson = 'contact_person';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Opens up a resource editor
     *
     * @param null $itemId
     */
    protected function showEditor($itemId = null) {
        if($itemId == null) {
            // Its a new item
        } else {
            // Edit existing item
        }
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