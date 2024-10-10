<?php

require_once("../controller/controllerUsers.php");
require_once("../model/modelUser.php");

if($_SERVER["REQUEST_METHDO"]== "PUT"){

    $query = $_SERVER["QUERY_STRING"];
    parse_str($query, $params);

    $id = $params["id"];

    $data = json_decode(file_get_contents("php://input"), true);

    $controllerUsers = new controllerUsers();
    $update = $controllerUsers->update($id, $data);

    if($update){
        $msg = array("msg" => "User updated");
        echo json_encode($msg);
    } else{
        $msg = array("msg" => "Error User");
        echo json_encode($msg);
    }




}else{
    header("HTTP/1.1 405 Method Not Allowed");
}


?>