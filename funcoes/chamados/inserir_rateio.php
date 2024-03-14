<?php
session_start();

// Obtém o conteúdo do corpo da requisição POST
$postData = file_get_contents("php://input");

// Decodifica o JSON para um array associativo
$data = json_decode($postData, true);

// Verifica se os dados foram recebidos corretamente
if (!$data || !isset($data['dados'])) {
    // Se 'dados' não estiver definido, retorna uma mensagem de erro e encerra o script
    echo json_encode(array("success" => false, "message" => "Os dados não foram recebidos."));
    exit; // Encerra o script para evitar a execução adicional
}

//CHAMANDO CONEXÃO
include '../../conexao.php';

// Recuperando os dados enviados por POST
$dados = $data['dados'];

// Verifique se a soma das porcentagens é 100%
$totalPercent = 0;
foreach ($dados as $dado) {
    $totalPercent += $dado['porcentagem'];
}

// Verifica se a soma das porcentagens é igual a 100%
if ($totalPercent === 100) {
    // Preparando a query de inserção
    $query = "INSERT INTO portal_check_car.RATEIO (CD_OS, CD_SETOR, PORCENTAGEM, CD_USUARIO_CADASTRO, HR_CADASTRO) SELECT ";
    $values = array();
    foreach ($dados as $dado) {
        $values[] = $dado['cd_os'] . ", " . $dado['cd_setor'] . ", " . $dado['porcentagem'] . ", '" . $dado['cd_usuario_cadastro'] . "', SYSDATE FROM DUAL";
    }
    $query .= implode(" UNION ALL SELECT ", $values);

    // Executando a query de inserção
    $result = oci_parse($conn_ora, $query);
    oci_execute($result);

    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "A porcentagem total deve ser 100%."));
}
?>
