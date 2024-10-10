<?php
require_once("../controller/controllerUsers.php");
require_once("../model/modelUser.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $controllerUsers = new controllerUsers();
    $list = $controllerUsers->listAll();

    $result = array('user' => $list);
    echo json_encode($result);

} else {
    header("HTTP/1.1 405 Method Allowed");
}

?>