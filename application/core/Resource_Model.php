<?php

/**
 * Created by Ahmed Maawy
 * User: ultimateprogramer
 * Date: 6/21/16
 * Time: 4:48 PM
 */
class Resource_Model extends MY_Model {
    const pageSize = 10;
    protected $baseUrl;

    public function __construct($tableName, $baseUrl) {
        parent::__construct();

        $this->table_name = $tableName;
        $this->baseUrl = $baseUrl;
        $this->soft_deletes = TRUE;
    }

    /**
     * Create a resource
     *
     * @param $object
     * @return bool|mixed
     */
    public function createResource($object) {
        $json = json_encode($object);
        return $this->insert(array(
            'fields' => $json,
        ));
    }

    /**
     * Delete a resource
     *
     * @param $id
     * @return bool
     */
    public function deleteResource($id) {
        return $this->delete($id);
    }

    /**
     * Update a resource
     *
     * @param $id
     * @param $object
     * @return bool
     */
    public function updateResource($id, $object) {
        $json = json_encode($object);
        return $this->update(array(
            'id' => $id,
        ),array(
            'fields' => $json,
        ));
    }

    /**
     * Get paged resources and page links
     *
     * @param $currentPage
     * @param null $category
     * @param null $where
     * @return array
     */
    public function getPagedResources($currentPage, $category = null, $where = null) {
        $this->load->library('pagination');

        $config = [];
        $config['base_url'] = $this->baseUrl;
        $config['total_rows'] = $this->count_all();
        $config['per_page'] = self::pageSize;
        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);

        if($where != null) {
            $this->where($where);
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
}