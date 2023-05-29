<?php

    //CHAMANDO SESSÃO
    session_start();

    //USUARIO DA SESSÃO
    $usuario = $_SESSION['usuarioLogin'];

    //CONEXAO
    include '../../conexao.php';

    //RECEBENDO VARIAVEIS 
    $var_tipo = $_POST['tipo'];
    $var_veiculo = $_POST['veiculo'];
    $var_condutor = $_POST['condutor'];
    $var_sequence = $_POST['sequence'];

    if($var_tipo == 'S'){

        $var_tp_var_tipo = 'Z';

    }else{

        $var_tp_var_tipo = 'X';

    }
    
    //INICIANDO O INSERT
    $insert_checklist="INSERT INTO portal_check_car.CHECKLIST ck
                        SELECT 
                        $var_sequence AS CD_CHECKLIST,
                        '$var_tp_var_tipo' AS TP_CHECKLIST,
                        '$var_veiculo' AS CD_VEICULO,
                        NULL AS TP_PLANTAO,
                        NULL AS OBS_GERAL,
                        '$usuario' AS CD_USUARIO_CADASTRO,
                        SYSDATE AS HR_CADASTRO,
                        NULL AS CD_USUARIO_ULT_ALT,
                        NULL AS HR_ULT_ALT
                       FROM DUAL";
    $res_insert = oci_parse($conn_ora, $insert_checklist);
                  oci_execute($res_insert);



?>