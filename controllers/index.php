<?php
class Index extends Controller{
    function __construct(){
        parent::__construct();
    }

    /**
     * Index Index function
     */
    function index()
    {
        $session = Session::getInstance();
        $this->view->data['language'] = isset($session->langugage)? $session->langugage : 'kg';
        //$this->view->data = "index/index";
        //var_dump($this->view->data['language']); die;
        $this->view->load('index/index');
    }
    function load_galleria()
    {
        $session = Session::getInstance();
        $images = scandir('public/img/gallery_images/');
        foreach($images as $key=>$value)
        {
            if($value == '.')
            {
                unset($images[$key]);
            }
            elseif($value == '..')
            {
                unset($images[$key]);
            }
            else
            {
                switch (strtolower(pathinfo($value, PATHINFO_EXTENSION)))
                {
                    case 'jpg':
                    case 'jpeg':
                    case 'bmp':
                    case 'png':
                    case 'gif':
                    if(getimagesize('public/img/gallery_images/'.$value) != false)
                    {
                        $images[$key] = trim($value);
                    }
                    else
                    {
                        unset($images[$key]);
                    }
                        break;
                    default :

                        break;
                }
            }
        }
        $images = array
        (
            'http://www.youtube.com/watch?v=tMWr0HErXRs',
            'http://www.youtube.com/watch?v=wvsHCzNkQho',
            'http://www.youtube.com/watch?v=Du_cG56XDcw',
            'http://www.youtube.com/watch?v=fRoPDkECjNw',
            'http://www.youtube.com/watch?v=zm0fElVTd6Y',
            'http://www.youtube.com/watch?v=6MSs7ovibeA',
            'http://www.youtube.com/watch?v=iBkrbpA-pb0',
            'http://www.youtube.com/watch?v=OIh0Pck8om0',
            'http://www.youtube.com/watch?v=0GWisaUXlPE',
            'http://www.youtube.com/watch?v=yEq8vpW3_9I',
            'http://www.youtube.com/watch?v=SZWrDtJ6qEM',
            'http://www.youtube.com/watch?v=H-xW4TsZ5-g',
            'http://www.youtube.com/watch?v=1COm23O3hoI',
            'http://www.youtube.com/watch?v=Lr4o--fP6yw',
            'http://www.youtube.com/watch?v=21kYb6zIBCM',
            'http://www.youtube.com/watch?v=XjyozSf_kiM',
            'http://www.youtube.com/watch?v=kz4gyguH4Ws',
            'http://www.youtube.com/watch?v=4L7o8jz7SrU',
            'http://www.youtube.com/watch?v=KMv9RdftTtY',
            'http://www.youtube.com/watch?v=NApmZpn62XI',
            'http://www.youtube.com/watch?v=ZaVbIyovTE4',
            'http://www.youtube.com/watch?v=2L-vGYEGLn0',
            'http://www.youtube.com/watch?v=-SLm2ZQRuOI',
            'http://www.youtube.com/watch?v=MT2h4-eUbqo',
            'http://www.youtube.com/watch?v=vnWBI3igu_I',
            'http://www.youtube.com/watch?v=gUyBDxbW888',
            'http://www.youtube.com/watch?v=5Mt27QsvKE8',
            'http://www.youtube.com/watch?v=JAFLq-a3hCE',
            'http://www.youtube.com/watch?v=UqFnFGeHCvQ',
            'http://www.youtube.com/watch?v=IqUnUq_ANjo',
            'http://www.youtube.com/watch?v=G5M5zVrqbR4',
            'http://www.youtube.com/watch?v=R0HIA30c_Mc',
            'http://www.youtube.com/watch?v=1k6UFzpT_ks',
            'http://www.youtube.com/watch?v=gsXI6RlB3zY',
            'http://www.youtube.com/watch?v=IyjOUhg0gV0',
            'http://www.youtube.com/watch?v=a011vFc2NJo',
            'http://www.youtube.com/watch?v=dru0xkMZYhQ',
            'http://www.youtube.com/watch?v=Dm3h50tNZ2c',
            'http://www.youtube.com/watch?v=9TCMYEhq06c',
            'http://www.youtube.com/watch?v=icASi9Pjed8',
            'http://www.youtube.com/watch?v=nnBXTx5elj4',
            'http://www.youtube.com/watch?v=HwTiySLoy0A',
            'http://www.youtube.com/watch?v=Qdr6cUqVTUM',
            'http://www.youtube.com/watch?v=s-x6CVEbGcY',
            'http://www.youtube.com/watch?v=1-CgnDmNyaM',
            'http://www.youtube.com/watch?v=LkdhtWiL-X0',
            'http://www.youtube.com/watch?v=VQzZ7UtCP1Y',
            'http://www.youtube.com/watch?v=K2ZrTm_izLI',
            'http://www.youtube.com/watch?v=q5nL3yBCSG4',
            'http://www.youtube.com/watch?v=uu8Kan60LEc',
            'http://www.youtube.com/watch?v=n0Fz8wPJdls',
            'http://www.youtube.com/watch?v=U0TLlYRRQO8',
            'http://www.youtube.com/watch?v=lpMuXAHg388',
            'http://www.youtube.com/watch?v=vKkDFZ-6P-s',
            'http://www.youtube.com/watch?v=TCr1N-zhAQs',
            'http://www.youtube.com/watch?v=4DjXPadThhc',
            'http://www.youtube.com/watch?v=3y6GJ9Br9KU',
            'http://www.youtube.com/watch?v=pH8YAsG2yzo',
            'http://www.youtube.com/watch?v=p3kIYXvVX-E',
            'http://www.youtube.com/watch?v=GrsjXz97Xoc',
            'http://www.youtube.com/watch?v=Nhk1vlb_kV0',
            'http://www.youtube.com/watch?v=KFiLQ_eY64w',
            'http://www.youtube.com/watch?v=dzKAsssGHiw',
            ''
        );
        $this->view->data['images'] = $images;

        $this->view->data['language'] = isset($session->langugage)? $session->langugage : 'kg';
        $this->view->load('index/galleria', false);
    }
    function change_language()
    {
        $session = Session::getInstance();
        if($_POST['lang'])
        {
            switch ($_POST['lang'])
            {
                case 'kg';
                case 'ru':
                    $session->langugage = $_POST['lang'];
                    echo 'ok';
                    break;
                default:
                    echo 'undefined language';
                    break;
            }
        }
    }
}