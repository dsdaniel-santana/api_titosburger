<?php
require_once("../controller/controllerCategories.php");
require_once("../model/modelCategories.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $data = json_decode(file_get_contents("php://input"), true);

    $controllerCategories = new controllerCategories();
    $save = $controllerCategories->save($data);

    if($save){
        $msg = array("msg" =>"Category created Successfully");
        echo json_encode($msg);
    }else{
        $msg = array("msg" =>"Error, category does noted created");
        echo json_encode($msg);
    }

} else{
    header("HTTP/1.1 405 Method Not Allowed");
}

?>