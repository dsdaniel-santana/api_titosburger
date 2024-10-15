<?php
require_once("../controller/controllerUsers.php");
require_once("../model/modelUser.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = json_decode(file_get_contents("php://input"), true);

    
        $controllerUsers = new controllerUsers();
        $save = $controllerUsers->save($data);

    if($save){
        $msg = array("msg"=>"User created  with success");
        echo json_encode($msg);
    } else {
        $msg = array("ERRRO"=>"User not created  with success");
        echo json_encode($msg);

    }

    
    

} else {
    header("HTTP/1.1 405 Method Allwed");
}


?>