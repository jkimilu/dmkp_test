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
    protected $date_format = 'datetime';

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

    /**
     * find override
     *
     * @param string $id
     * @return mixed
     */
    public function find($id='') {
        $this->where('deleted', 0);
        return parent::find($id);
    }

    /**
     * find_all_by override
     *
     * @param null $field
     * @param null $value
     * @param string $type
     * @return bool|mixed
     */
    public function find_all_by($field=NULL, $value=NULL, $type='and') {
        $this->where('deleted', 0);
        return parent::find_all_by($field, $value, $type);
    }

    /**
     * find_by override
     *
     * @param string $field
     * @param string $value
     * @param string $type
     * @return bool|mixed
     */
    public function find_by($field='', $value='', $type='and') {
        $this->where('deleted', 0);
        return parent::find_by($field, $value, $type);
    }

    /**
     * find_all override
     *
     * @return mixed
     */
    public function find_all() {
        $this->where('deleted', 0);
        return parent::find_all();
    }
}