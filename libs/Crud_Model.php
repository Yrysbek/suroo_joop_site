<?php
/**
 * CRUD Model
 * Main Model
 */
class Crud_Model
{
    var $idkey = '';
    var $table = '';
    var $add_rules = array();
    var $edit_rules = array();
    var $db;

    function __construct(){
        $this->db = db::getInstance();
    }

    /*
     * CRUD create new function
     */
    function create()
    {
        $_POST['created'] = date('Y-m-d H:i:s');
        $data = array();
        if (!empty($this->add_rules)) {
            foreach ($this->add_rules as $kk) {
                if (isset($_POST[$kk])) {
                    $data[$kk] = htmlspecialchars($_POST[$kk]);
                }
            }
            $this->db->insert($this->table, $data);
            return mysql_insert_id();
        } else {
            return false;
        }

    }


    /*
     * CRUD update by id function
     */
    function update($id)
    {
        $fields = array_keys($_POST);

        foreach ($this->edit_rules as $key => $field) {
            if (!in_array($field, $fields)) {
                unset($this->edit_rules[$key]);
            }
        }

        $data = array();
        if (!empty($this->edit_rules)) {
            foreach ($this->edit_rules as $kk) {
                $data[$kk] = $this->db->sanitize($_POST[$kk]);
            }

            $result = $this->db->update($this->table, $data, "{$this->table}.{$this->idkey} = '{$id}'");
            return $result;
        } else {
            return false;
        }
    }


    /*
     * CRUD delete by id function
     */
    function delete($id)
    {
        $sql_query = "DELETE
                      FROM     {$this->table}
                      WHERE    {$this->idkey}='$id'";
        $result = $this->db->run_query($sql_query);
        return $result;
    }

    /**
     * ReadById Method
     * @param $id
     * @return array
     */
    function read($id)
    {
        $db = db::getInstance();

        $query = "SELECT *
                  FROM {$this->table}
                  WHERE {$this->idkey} = $id";

        if(!$result = $db->run_query($query))
            $db->error_message($query);
        $rows = array();

        while($row = mysql_fetch_assoc($result))
        {
            $rows = $row;
        }
        return $rows;
    }
}
