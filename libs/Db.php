<?php
/**
 * Db class
 */
Class Db{
/*
 * Database
 * connect
 * configuration
 *
 */
    private static  $db_host = 'localhost'; //mysql.hostinger.ru
    private static  $db_user = 'root'; //u789258995_ustaz
    private static $db_password = ''; //123u789258995_ustaz
    private static $conn;
    private static $db = 'u789258995_ustaz';

/**
 * @var result
 */
    public $result;
    
/*
 *  static object of Db
 */
    private static $instance;

    /**
     * Initialize instance of DB class
     * @return mixed
     */
    static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new self();
        }
        self::$conn = mysql_connect(self::$db_host, self::$db_user, self::$db_password);
        if (!self::$conn)
            self::errorMessage("Failed to connect to database server.");
        if (!mysql_select_db(self::$db, self::$conn))
            self::errorMessage("Failed to connect to database.");

        return self::$instance;
    }

    /**
     * Run SQL Query
     * @access	public
     * @param	string
     * @return	resource
     */
    function run_query($sql_str) {
        if (!$result = mysql_query($sql_str, self::$conn))
            $this->errorMessage($sql_str);
        $this->result = $result;
        return $result;
    }

    /**
     * Insert a row into DB
     * @access	public
     * @param	string
     * @param	array
     * @return	resource
     */
    function insert($table, $data) {
        foreach ($data as &$kk) {
            $kk = mysql_real_escape_string($kk);
        }
        $values = implode("','", $data);
        $fields = implode(',', array_keys($data));
        $query_str = "INSERT INTO {$table} ({$fields}) VALUES ('{$values}')";
        if (!$result = mysql_query($query_str, self::$conn))
            $this->errorMessage($query_str);
        return $result;
    }

    /**
     * Update a data in DB by $where needle
     * @access	public
     * @param	string
     * @param	array
     * @return	resource
     */
    function update($table, $data, $where) {
        $query_str = "
            UPDATE {$table} 
            SET ";
        foreach ($data as $key => $kk) {
            $val = mysql_real_escape_string($kk);
            $query_str .= "`{$table}`.`{$key}` = '{$val}', ";
        }
        $query_str = substr($query_str, 0, strlen($query_str) - 2);
        $query_str .= " WHERE $where";
        if (!$result = mysql_query($query_str, self::$conn))
            $this->errorMessage($query_str);
        return $result;
    }

    /**
     * Print message on error
     * @access	private
     * @param	string
     * @return	null
     */
    function errorMessage($message) {
        echo("Process couldn't be executed." . mysql_error() . " <br> " . $message);
        exit;
    }

    /**
     * Sanitize
     * @param $value
     * @return string
     */
    function sanitize($value) {
        return mysql_real_escape_string(htmlspecialchars($value));
    }

    /**
     * loadArray
     * Get from ran query array of elements
     */
    function loadArray($query)
    {
        if(!$this->result = $this->run_query($query))
            $this->error_message($query);

        $rows = array();
        if(mysql_num_rows($this->result))
        {
            while($row = mysql_fetch_assoc($this->result))
            {
                $rows[] = $row;
            }
            return $rows;
        }

        return false;

    }

}