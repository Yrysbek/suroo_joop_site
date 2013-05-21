<?php
/**
 * View class
 */
class View{
    function __construct(){/***/}

    /**
     * Load Template method
     * @param $filename
     * @param bool $hf
     * hf is Header-Footer
     */
    function load($filename, $hf = true)
    {
        if($hf)
            require('views/header.php');

        if($hf)
            require('views/left_menu.php');

        require('views/'.$filename.'.php');

        if($hf)
            require('views/footer.php');
    }
}