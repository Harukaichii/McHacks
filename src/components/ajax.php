<?php    
    header('Content-Type: application/json');
	header("Access-Control-Allow-Origin: *");
    init();
    
    function init() {
        if(!isset($_SESSION['user']))
            echo json_encode(array("res" => false]), JSON_PRETTY_PRINT);
        else
            echo json_encode(array(["res" => true]), JSON_PRETTY_PRINT);
    }

