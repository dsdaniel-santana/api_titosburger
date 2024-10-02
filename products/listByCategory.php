<?php 

    require_once("../controller/controllerProducts.php");
    require_once("../model/modelProdutcts.php");
    

if($_SERVER["REQUEST_METHOD"] == "GET"){

    $id = $_GET["id_category"];

    $controllerProducts = new controllerProducts();
    $list = $controllerProducts->listByCategory($id);

    if($list){
        $msg = array("products" => [], "msg" =>$list);
        echo json_encode($msg);
    } else{
        $msg = array("products" => [], "msg" =>"Products not found");
        echo json_encode($msg);
    }
} else{
    header("HTTP/1.1 405 METHOD NOT ALOWED");
}
?>