<?php
/**
 * Class admin for admin
 * create/edit/delete users
 */
class Admin extends Controller
{
    function index()
    {
        $session = Session::getInstance();
        if(isset($session->is_admin))
        {
            $this->view->data['username'] = $session->username;
            $this->view->load('admin/logged');
        }
        else
        {
            $this->view->load('admin/index');
        }
    }

    function login()
    {
        $session = Session::getInstance();
        if(!isset($session->is_admin))
        {
            if(!log::login())
            {
                $session->destroy();
                echo "<script>location.href='/admin'</script>";
            }
            $this->view->data['username'] = $session->username;
            $this->view->load('admin/logged');
        }
        else
        {
            $this->view->data['username'] = $session->username;
            $this->view->load('admin/logged');
        }
        /**
         * $session->username,
         * $session->password,
         * $session->logged,
         * $session->user_id,
         * $session->is_admin
         */
    }
    function logout()
    {
        $log = log::getInstance();
        $log->logout();
        echo "<script>location.href='/'</script>";
    }
}