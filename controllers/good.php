<?php
/**
 * Goods controller
 */
class Good extends Controller{

    function index(){
        $array = array('clear', 'bag', 'new', 'camel');
        //echo json_encode($array);

        $mdl_good = load_model('good');
        $this->view->data['goods'] = $mdl_good->list_of_good();
        $this->view->load('good/index');
    }
     final function handleUpload()
     {
         load_lib('Uploader');

         $allowedExtensions = array("jpeg", "jpg", "bmp", "png");
         $sizeLimit = 2 * 1024 * 1024;

         if(getimagesize($_FILES['qqfile']['tmp_name']))
         {
             $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
             $result = $uploader->handleUpload('public/uploads/');
             chmod('public/uploads/', 0777);
             echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
         }
     }

    function create_good()
    {
        $mdl_good = load_model('good');

        foreach($_POST as $key=>$value)
        {
            $new_name = explode('good_',$key);
            if(isset($new_name[1]))
            {
                unset($_POST[$key]);
                $_POST[$new_name[1]] = $value;
            }
        }

        if($id = $mdl_good->create())
        {
            echo json_encode(array('created_id' => $id));
        }
    }

    function list_of_good()
    {
        $mdl_good = load_model('good');

        $this->view->data['goods'] = $mdl_good->list_of_good();
        $this->view->load('good/one_good', false);
    }
}