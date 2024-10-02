<?php
require_once("../controller/controllerProducts.php");
require_once("../model/modelProdutcts.php");

if($_SERVER ["REQUEST_METHOD"] == "DELETE"){

    $id = $_GET["id"];

    $controllerProducts = new controllerProducts();
    $delete  = $controllerProducts->delete($id);

    if($delete){
        $msg = array("msg" => "Product has been deleted successfully");
        echo json_encode($msg);
    } else{
        $msg = array("msg" => "Error, Product does not deleted");
        echo json_encode($msg);

    }


} else{
    header("HTTP/1.. 405 Method not Allowed");
}

?>