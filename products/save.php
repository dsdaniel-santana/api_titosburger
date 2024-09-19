<?php
require_once("../controller/controllerProducts.php");
require_once("../model/modelProdutcts.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lê os dados JSON da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica se a leitura dos dados JSON foi bem-sucedida
    if ($data && is_array($data)) {
        $controllerProducutes = new controllerProducts();
        $save = $controllerProducutes->save($data);

        if ($save) {
            $msg = array("msg" => "Product has been created");
            echo json_encode($msg);
        } else {
            $msg = array("msg" => "Error, product not created");
            echo json_encode($msg);
        }
    } else {
        $msg = array("msg" => "Invalid JSON data");
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}
?>
