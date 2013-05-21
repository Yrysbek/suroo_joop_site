<?php
/**
 * Article model
 */
class mdl_bolum extends Crud_Model
{
    function __construct()
    {
        parent::__construct();
    }

    var $idkey = 'id';
    var $table = 'bolum'; //table name on DB

    /**
     * onCreate fields
     */
    var $add_rules = array('bolum');

    /**
     * onEdit fields
     */
    var $edit_rules = array('bolum');

    /**
     * get all readed data
     * @return array
     */

    function get_for_select()
    {
        $db = db::getInstance();

        $query = "SELECT *
                  FROM bolum
                  ORDER BY bolum ASC
                  ";

        if(!$result = $db->run_query($query))
            $db->error_message($query);
        $rows = array();

        while($row = mysql_fetch_assoc($result))
        {
            $rows[] = $row;
        }
        return $rows;
    }
}