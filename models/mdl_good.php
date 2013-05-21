<?php
/**
 * Article model
 */
class mdl_good extends Crud_Model
{
    var $idkey = 'id';
    var $table = '__good';

    /**
     * onCreate fields
     */
    var $add_rules = array('name', 'description', 'type_id', 'image', 'image_title', 'price', 'total_count');

    /**
     * onEdit fields
     */
    var $edit_rules = array('name', 'description', 'type_id', 'image', 'image_title', 'price', 'total_count');

    /**
     * get all articles data
     * @return array
     */
    function list_of_good()
    {
        $db = db::getInstance();

        $query = "SELECT *
                  FROM {$this->table}";

        return $db->loadArray($query);
    }
}