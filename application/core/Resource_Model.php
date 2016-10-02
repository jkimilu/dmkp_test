<?php

/**
 * Created by Ahmed Maawy
 * User: ultimateprogramer
 * Date: 6/21/16
 * Time: 4:48 PM
 */
class Resource_Model extends BaseDeleteSupportModel {
    const pageSize = 10;

    protected $baseUrl;
    protected $date_format = 'datetime';
    protected $resourceCategory = '';

    public function __construct($tableName, $baseUrl) {
        parent::__construct();

        $this->table_name = $tableName;
        $this->baseUrl = $baseUrl;
        $this->soft_deletes = TRUE;
        $this->load->model('Resource_Resources_Model');
    }

    /**
     * @param mixed $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Create a resource
     *
     * @param $object
     * @param $category
     * @return bool|mixed
     */
    public function createResource($object, $category) {
        $json = json_encode($object);
        return $this->insert(array(
            'fields' => $json,
            'category' => $category,
        ));
    }

    /**
     * Delete a resource
     *
     * @param $id
     * @return bool
     */
    public function deleteResource($id) {
        $this->Resource_Resources_Model->delete_where([
            'resource_id' => $id,
            'resource_category' => $this->resourceCategory,
        ]);
        return $this->delete($id);
    }

    /**
     * Update a resource
     *
     * @param $id
     * @param $object
     * @param $category
     * @return bool
     */
    public function updateResource($id, $object, $category) {
        $json = json_encode($object);
        return $this->update(array(
            'id' => $id,
        ),array(
            'fields' => $json,
            'category' => $category
        ));
    }

    /**
     * Sets the visibility of a resource item
     *
     * @param $id
     * @param bool $visible
     * @return bool
     */
    public function setVisible($id, $visible = true) {
        return $this->update(array(
            'id' => $id,
        ),array(
            'visible' => ($visible ? 1 : 0)
        ));
    }

    /**
     * Get paged resources and page links
     *
     * @param $currentPage
     * @param null $category
     * @param bool $visibleOnly
     * @param null $where
     * @return array
     */
    public function getPagedResources($uriSegment, $currentPage, $category = null, $visibleOnly = false, $where = null) {
        $this->load->library('pagination');

        $config = [];

        $config['base_url'] = $this->baseUrl;
        $config['total_rows'] = $this->count_all();
        $config['per_page'] = self::pageSize;

        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['prev_link'] = '&lt;';
        $config['next_link'] = '&gt;';

        $config['page_query_string'] = false;
        $config['use_page_numbers'] = true;
        $config['uri_segment'] = $uriSegment;

        $this->pagination->initialize($config);

        if($where != null) {
            $this->where($where);
        }

        if($visibleOnly) {
            $this->where('visible', 1);
        }

        if($category != null) {
            $this->where('category', $category);
        }

        $this->limit(self::pageSize, $currentPage * self::pageSize);

        $records = $this->find_all();

        if($records) {
            foreach($records as &$record) {
                $record->object = json_decode($record->fields);
            }
        }

        return array(
            'pagination' => $this->pagination->create_links(),
            'records' => $records,
        );
    }

    /**
     * Performs a search
     *
     * @param $searchTerm
     * @return array
     */
    public function search($searchTerm) {
        $results = [];

        $records = $this->find_all();

        if($records) {
            foreach($records as $record) {
                $object = json_decode($record->fields);
                if(isset($object->guidance_descriptors_title) && isset($object->guidance_descriptors_text)) {
                    if(stripos($object->guidance_descriptors_title, $searchTerm) !== FALSE ||
                        stripos($object->guidance_descriptors_text, $searchTerm) !== FALSE) {
                        $subObject = new stdClass();
                        $subObject->content_title = $object->guidance_descriptors_title;
                        $subObject->link = $this->baseUrl.'/index?id='.$record->id;
                        $subObject->brief_text = strip_tags(substr($object->guidance_descriptors_text, 0, 500));

                        $results[$record->id] = $subObject;
                    }
                }
            }
        }

        return $results;
    }
}