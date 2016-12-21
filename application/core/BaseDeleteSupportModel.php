<?php

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/26/16
 * Time: 12:23 PM
 */
class BaseDeleteSupportModel extends MY_Model
{
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