<?php
    namespace Controllers;

    class HomeController
    {
        public static function Index($message = "")
        {
            require_once(VIEWS_PATH."student-add.php");
        }        
    }
?>