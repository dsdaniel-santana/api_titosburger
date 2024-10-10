<?php
require_once("../controller/controllerUsers.php");
require_once("../model/modelUser.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = json_decode(file_get_contents("php://input"), true);

    if(array_key_exists("user", $data)){
        $controllerUsers = new controllerUsers();
        $save = $controllerUsers->save($data);

    if($save){
        $msg = array("msg"=>"User created  with success");
        echo json_encode($msg);
    } else {
        $msg = array("ERRRO"=>"User not created  with success");
        echo json_encode($msg);

    }

    }else{
        header("HTTP/1.1 400 Bad Request");
        $msg = array("error" => "Param 'User' not Exists!");
        echo json_encode($msg);
    }

    

} else {
    header("HTTP/1.1 405 Method Allwed");
}


?>