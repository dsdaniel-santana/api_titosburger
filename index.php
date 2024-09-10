<?php
header("Content-type: application/json");
$mensagem = array('msg' => 'API Titos burger V1');

echo json_encode($mensagem);

?>