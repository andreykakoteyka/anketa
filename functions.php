<?php 
    
//    function get_mysqli(){
//        $mysqli = new mysqli('localhost', 'u850348182_anket', 'uT53DUDS75ITiN', 'hse-anketa');
//        if($mysqli){
//            return $mysqli;
//        }
//        return null;
//    };

    function get_header(){
        include('header.php');
    };

    function get_footer(){
        include('footer.php');
    };

    function get_title(){
        echo "Анкета Выпускника";
    };


?>