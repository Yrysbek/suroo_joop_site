<?php
/**
 * Suroo_joop controller
 */
class Suroojoop extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index()
    {
        $session = Session::getInstance();
        $mdl_bolum = load_model('bolum');
        $mdl_oi = load_model('online_user');

        $this->view->data['is_admin'] = false;
        if(isset($session->user_id))
        {
            $this->view->data['user_id'] = $session->user_id;
            $this->view->data['username'] = $session->username;
            if($session->is_admin == 1)
                $this->view->data['is_admin'] = true;
        }

        //ou - online users
        $this->view->bolumdor = $mdl_bolum->get_for_select();
        $this->view->data['ou_count'] = $mdl_oi->update_and_get_ou();
        $this->view->data['language'] = isset($session->langugage)? $session->langugage : 'kg';
        $this->view->load('suroo_joop/index');
    }

    function bolumdor_form()
    {
        $mdl_bolum = load_model('bolum');
        $this->view->bolumdor = $mdl_bolum->get_for_select();
        $this->view->load('suroo_joop/bolumdor_form', false);
    }

    function create_bolum()
    {
        $mdl_bolum = load_model('bolum');
        if($mdl_bolum->create())
        {
            echo 'ok';
        }
    }

    function delete_suroo_joop()
    {
        $mdl_sj = load_model('suroo_joop');

        if($mdl_sj->delete(intval($_POST['id'])))
        {
            echo 'ok';
        }
    }

    function delete_bolum()
    {
        $mdl_bolum = load_model('bolum');
        if($mdl_bolum->delete(intval($_POST['id'])))
        {
            echo 'ok';
        }
    }

    function edit_bolum()
    {
        $mdl_bolum = load_model('bolum');
        if($mdl_bolum->update(intval($_POST['bolum_id'])))
            echo 'ok';
    }

    function edit_suroo_joop_form()
    {
        $mdl_bolum = load_model('bolum');
        $mdl_sj = load_model('suroo_joop');

        $this->view->data = $mdl_sj->read(intval($_POST['id']));
        $this->view->bolumdor = $mdl_bolum->get_for_select();
        $this->view->load('suroo_joop/edit_form', false);
    }

    function edit_suroo()
    {
        $session = Session::getInstance();
        $mdl_sj = load_model('suroo_joop');

        $_POST['suroo'] = (preg_replace('[\n\r]', '', $_POST['suroo']));
        $_POST['joop'] = (preg_replace('[\n\r]', '', $_POST['joop']));
        $_POST['admin_user'] = $session->username;
        if($mdl_sj->update(intval($_POST['id'])))
            echo "ok";
    }

    function create_suroo_joop_form()
    {
        $mdl_bolum = load_model('bolum');
        $this->view->bolumdor = $mdl_bolum->get_for_select();
        $this->view->load('suroo_joop/create_form', false);
    }

    function create_suroo()
    {
        $session = Session::getInstance();
        $mdl_sj = load_model('suroo_joop');

        $_POST['suroo'] = (preg_replace('[\n\r]', '', $_POST['suroo']));
        $_POST['joop'] = (preg_replace('[\n\r]', '', $_POST['joop']));
        $_POST['admin_user'] = $session->username;
        if($mdl_sj->create())
            echo "ok";
    }

    function list_of_suroo_joop()
    {
        $session = Session::getInstance();
        $mdl_oi = load_model('online_user');

        $this->view->data['is_admin'] = false;
        if(isset($session->user_id))
        {
            if($session->is_admin == 1)
                $this->view->data['is_admin'] = true;
        }
        $show_all = false;
        if(isset($_POST['show_all']))
        {
            $show_all = intval($_POST['show_all']);
        }
        $search_by_word = '';
        if(isset($_POST['word']))
        {
            $words = explode(',', $_POST['word']);
            foreach ($words as $index=>$word){
                $words[$index] = trim($word);
            }
        }
        $search_by_bolum = '';
        if(isset($_POST['bolum']))
        {
            $search_by_bolum = $_POST['bolum'];
        }
        $mdl_sj = load_model('suroo_joop');
        $this->view->data['ou_count'] = $mdl_oi->update_and_get_ou();
        $this->view->data['suroo_joops'] = $mdl_sj->list_of_suroo_joop($words, intval($search_by_bolum), $show_all);
        $this->view->data['language'] = isset($session->langugage)? $session->langugage : 'kg';
        if(count($this->view->data['suroo_joops']))
        {
            $this->view->load('suroo_joop/one_suroo_joop', false);
        }
        else
        {
            $this->view->load('suroo_joop/no_suroo_joop', false);
        }
    }
}