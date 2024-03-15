<?php
session_start();

// Obtém o conteúdo do corpo da requisição POST
$postData = file_get_contents("php://input");

// Decodifica o JSON para um array associativo
$data = json_decode($postData, true);

// Verifica se os dados foram recebidos corretamente
if (!$data || !isset($data['cd_os'])) {
    echo json_encode(array("success" => false, "message" => "Os dados não foram recebidos."));
    exit; 
}

//CHAMANDO CONEXÃO
include '../../conexao.php';

// Recuperando o cd_os enviado por POST
$cd_os = $data['cd_os'];

// Preparando a query de exclusão
$query = "DELETE FROM portal_check_car.RATEIO rt WHERE rt.CD_OS = :cd_os";

// Preparando a declaração
$stmt = oci_parse($conn_ora, $query);

// Associando o valor de cd_os à declaração
oci_bind_by_name($stmt, ':cd_os', $cd_os);

// Executando a query de exclusão
$result = oci_execute($stmt);

if ($result) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "Erro ao excluir os registros."));
}
?>
