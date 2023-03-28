<?php
//CHAMANDO SESSÃO
session_start();

//RECEBENDO USUARIO DA SESSÃO 
$usuario = $_SESSION['usuarioLogin'];

//CHAMANDO CONEXÃO
include '../../conexao.php';

//RECEBENDO VARIAVEIS MOBILE 
$cor_desk = $_POST['cor_desk'];
$modelo_desk = $_POST['mod_desk'];
$ano_desk = $_POST['ano_desk'];
$placa_desk = $_POST['placa_desk'];
$km_desk = $_POST['km_desk'];

//INSERT
$insert_veiculo = "INSERT INTO portal_check_car.VEICULO 
                    SELECT 
                    portal_check_car.SEQ_CD_VEICULO.NEXTVAL AS CD_VEICULO,
                    UPPER('$modelo_desk') AS DS_MODELO,
                    '$ano_desk' AS DS_ANO,
                    UPPER('$placa_desk') AS DS_PLACA,
                    '$cor_desk' AS CD_COR,
                    '$km_desk' AS KM,
                    'A' AS TP_STATUS,
                    '$usuario' AS CD_USUARIO_CADASTRO,
                    SYSDATE AS HR_CADASTRO,
                    NULL AS CD_USUARIO_ULT_ALT,
                    NULL AS HR_ULT_ALT
                    FROM DUAL";

$res_insert_veiculo = oci_parse($conn_ora, $insert_veiculo);
$valida = oci_execute($res_insert_veiculo);


?>