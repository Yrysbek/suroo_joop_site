<?php
/**
 * Authentication Library
 *
 * @package		Personals
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Maksat Mamytov, Samat Jorobekov
 */


class log
{
    protected static $instance;  // object instance

    private $password_error;

    private function __construct() { /* ... */ }

    private function __clone() { /* ... */ }

    public static function getInstance() {
        if ( is_null(self::$instance) ) {
            self::$instance = new log;
        }
        return self::$instance;
    }


    /**
     * Login
     *
     * @access	public
     * @return	array
     */
    function login()
    {
        $session = Session::getInstance();
        $username = $_POST['username'];
        $password = $_POST['password'];

        $auth = self::check_by_password($username,$password);

        if ($auth)
        {
            if ($auth['disabled'] == 0)
            {
                $session->username  = $username;
                $session->password  = md5($password);
                $session->logged    = md5($auth['keluar'].'antihack');
                $session->user_id   = $auth['id'];

                self::unset_password_error($username);
            }
        }
        else
        {
            $pe = $this->password_error++;

            if ($this->password_error >= 5)
            {
                $session->redirect = "/";
            }
            else
            {
                $session->redirect = "/";
            }

            if ($pe <= 5)
            {
                $session->redirect .= "/$username";
            }

            self::set_password_error($username);
        }

        return $auth;
    }

    function set_password_error($username)
    {
        $sql = "UPDATE users
                SET password_error = {$this->password_error}
                WHERE username = '$username'";

        $result = db::getInstance()->run_query($sql);
    }

    function unset_password_error($username)
    {
        $sql = "UPDATE users
                SET password_error = 0
                WHERE username = '$username'";

        $result = db::getInstance()->run_query($sql);
    }

    /**
     * Check Authentication
     *
     * Checks authentication, If it's not created, sends to enter.php
     *
     * @access	public
     * @param    string
     * @return	null
     */
    function check_authentication($redirect=FALSE)
    {
        $session = Session::getInstance();
        $username = $session->username;
        $password = $session->password;
        $logged = $session->logged;
        $auth = self::check($username, $logged);
        if (!$auth)
        {
            echo '<script>location.href="/admin";</script>';
        }
    }
    /**
     * Logout
     *
     * @access	public
     * @return	null
     */
    function logout()
    {
        $session = Session::getInstance();
        $community = $session->community;
        //$this->check_authentication();
        if (isset($session->real_nickname_id))
        {
            $nickname_id = $session->real_nickname_id;
        }
        else
        {
            $nickname_id = $session->nickname_id;
        }

        $sql = "UPDATE users
                SET password_error = '0', keluar = NOW()
                WHERE username = '{$session->username}'";

        $result = db::getInstance()->run_query($sql);
        $session->destroy();
        $session->community = $community;
    }
    /**
     * Check if is already authenticated
     *
     * Checks is user already authenticated
     * If it's true, sends to main page
     *
     * @access	public
     * @return	null
     */
    function is_already_authenticated()
    {
        /**
         * Checks is user already authenticated
         * If it's true, sends to main page
         */
        $session = Session::getInstance();
        $username = $session->username;
        $logged = $session->logged;
        if (self::check($username,$logged))
        {
            header("Location: /admin");
        }
    }
    function check($username, $logged, $nickname_id = false)
    {
        $sql_query = "SELECT * FROM users WHERE username='$username'";
        $result = db::getInstance()->run_query($sql_query);
        $row = mysql_fetch_assoc($result);

        if (!empty($row))
        {
            if (($row['username'] == $username) && (md5($row['keluar'].'antihack') == $logged))
            {
                return $row;
            }
        }
        return false;
    }
    function check_by_password($username, $password, $nickname_id = false)
    {
        $sql_query = "SELECT * FROM users WHERE username='$username'";
        $result = db::getInstance()->run_query($sql_query);
        $row = mysql_fetch_assoc($result);

        $session = Session::getInstance();
        if (!empty($row))
        {
            if (($row['username'] == $username) && (md5($password) == $row['password']))
            {
                $session->is_admin = $row['is_admin'];
                return $row;
            }
            else
            {
                $this->password_error = $row['password_error'];
            }
        }
        return false;
    }
}
?>