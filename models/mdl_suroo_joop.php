<?php
/**
 * Article model
 */
class mdl_suroo_joop extends Crud_Model
{
    function __construct()
    {
        parent::__construct();
    }

    var $idkey = 'id';
    var $table = 'suroo_joop'; //table name on DB

    /**
     * onCreate fields
     */
    var $add_rules = array('created', 'suroo', 'joop', 'bolum_id', 'admin_user');

    /**
     * onEdit fields
     */
    var $edit_rules = array('suroo', 'joop', 'bolum_id', 'admin_user');

    /**
     * get all readed data
     * @return array
     */
    function list_of_suroo_joop($words = array(), $bolum = '', $show_all = false)
    {
        $session = Session::getInstance();
        $db = db::getInstance();

        $query = "SELECT sj.*, b.bolum
                  FROM {$this->table} sj
                  INNER JOIN bolum b ON b.id = sj.bolum_id
                  ";

        if(!empty($words))
        {
            $query .= "WHERE ";
            $i = 0;
            foreach ($words as $word)
            {
                if($i++ == 0)
                {
                    $query .= "(sj.suroo LIKE '%".$db->sanitize($word)."%'
                            OR
                            sj.joop LIKE '%".$db->sanitize($word)."%') ";
                }
                else
                {
                    $query .= " AND (sj.suroo LIKE '%".$db->sanitize($word)."%'
                            OR
                            sj.joop LIKE '%".$db->sanitize($word)."%')";
                }

            }
        }
        if($bolum != '' and $bolum != 'all')
        {
            $query .= " AND b.id = ".$db->sanitize($bolum)." ";
        }

        $query .= 'ORDER BY sj.id DESC ';
        if($show_all == 0)
            $query .= 'LIMIT 0,100';

        if(!$result = $db->run_query($query))
            $db->error_message($query);
        $rows = array();

        while($row = mysql_fetch_assoc($result))
        {
            if(!empty($words))
            {
                foreach ($words as $word)
                {
                    $row['suroo'] = preg_replace('/('.htmlspecialchars($word).')/ui', "<span style='background-color: #ffff00'>$1</span>", $row['suroo']);
                    $row['joop'] = preg_replace('/('.htmlspecialchars($word).')/ui', "<span style='background-color: #ffff00'>$1</span>", $row['joop']);
                }
            }

            $rows[] = $row;
        }
        return $rows;
    }
}