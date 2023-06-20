<?php
//CHAMANDO SESSÃO
session_start();

//RECEBENDO USUARIO DA SESSÃO 
$usuario = $_SESSION['usuarioLogin'];

//CHAMANDO CONEXÃO
include '../../conexao.php';

//RECEBENDO VARIAVEIS MOBILE 
$cor_mob = $_POST['global_cores'];
$modelo_mob = $_POST['global_modelo'];
$ano_mob = $_POST['global_ano'];
$placa_mob = $_POST['global_placa'];
$km_mob = $_POST['global_km'];
$email = $_POST['global_email'];

//INSERT

$insert_veiculo = "INSERT INTO portal_check_car.VEICULO 
                    SELECT 
                    portal_check_car.SEQ_CD_VEICULO.NEXTVAL AS CD_VEICULO,
                    UPPER('$modelo_mob') AS DS_MODELO,
                    '$ano_mob' AS DS_ANO,
                    UPPER('$placa_mob') AS DS_PLACA,
                    '$cor_mob' AS CD_COR,
                    '$km_mob' AS KM,
                    'A' AS TP_STATUS,
                    '$usuario' AS CD_USUARIO_CADASTRO,
                    SYSDATE AS HR_CADASTRO,
                    NULL AS CD_USUARIO_ULT_ALT,
                    NULL AS HR_ULT_ALT,
                    '$email' AS EMAIL
                    FROM DUAL";

$res_insert_veiculo = oci_parse($conn_ora, $insert_veiculo);
$valida = oci_execute($res_insert_veiculo);

    //VALIDACAO
    if (!$valida) {   
    
        $erro = oci_error($res_insert_veiculo);																							
        $msg_erro = htmlentities($erro['message']);
        //header("Location: $pag_login");
        //echo $erro;
        echo $msg_erro;

    }else{

        echo 'Sucesso';
        
    }

?>