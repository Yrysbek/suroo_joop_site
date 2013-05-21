<?php
/* * some test bgn *

$calendar = new Calendar();

class Calendar
{
    private $day_in_months;
    public $day_names = array('Monday', 'Tuesday', 'Wednesday','Thursday', 'Friday', 'Saturday', 'Sunday');

    function __construct()
    {
        $this->day_in_months = cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));
        $this->header();
        $this->body();
    }

    public function header()
    {
        echo "<table style='text-align: center' border='1'><thead><tr>";
        foreach ($this->day_names as $index=>$day)
        {
            echo "<td>{$day}</td>";
        }
        echo "</tr></thead>";
    }

    public function body()
    {
        echo "<tbody>";
        $first_weekday_of_this_month  = date('w',mktime(0, 0, 0, date("m")  , 1, date("Y")));

        $day = 1;
        for($cell = 1; $cell <= $this->day_in_months+$first_weekday_of_this_month-1; $cell++)
        {
            if($cell >= $first_weekday_of_this_month)
            {
                echo "<td>{$day}</td>";
                $day++;
            }
            else
            {
                echo "<td></td>";
            }
            if($cell%7 == 0)
                echo "<tr>";
        }
        echo "</tbody>";
    }
}
die;
 some test end * */
/**
 * set timezone to Asia/Bishkek
 */
date_default_timezone_set('Asia/Bishkek');
/**
 * Load Library Method
 * @param $lib_name
 */
function load_lib($lib_name)
{
    require_once "libs/{$lib_name}.php";
}

/**
 * Load Model Method
 * @param $model_name
 * @param bool $model
 * @return mixed
 */
function load_model($model_name, &$model = false)
{
    if(file_exists("models/mdl_$model_name.php"))
    {
        require_once ("models/mdl_$model_name.php");
        $mdl = "mdl_$model_name";
        if (class_exists('mdl_'.$model_name))
        {
            $model = new $mdl();
            return $model;
        }
        else
        {
            exit ("<div style='border:solid 1px gray;padding:10px'>Model <b>$model_name</b> doesn't exist</div>");
        }
    }
    else
    {
        exit ("<div style='border:solid 1px gray;padding:10px'>File of model <b>$model_name</b> doesn't exist</div>");
    }
}

/**
 * I used this instead __autoload()
 */
$libs = array('Bootstrap', 'View', 'Controller', 'Db', 'Crud_Model', 'Log', 'Session');
foreach ($libs as $lib)
{
    load_lib($lib);
}

$app = new Bootstrap();