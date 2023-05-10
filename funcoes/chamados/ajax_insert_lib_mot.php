<?php

    //CHAMANDO SESSÃO
    session_start();

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_motorista = $_POST['js_motorista'];
    $var_os = $_POST['js_os'];
    $var_status = $_POST['js_tp_status'];
    $usuario = $_SESSION['usuarioLogin'];
    

    $cons_insert_chamado = "INSERT INTO portal_check_car.CHAMADOS_DESIGNADOS cd
                            SELECT 
                            portal_check_car.SEQ_CD_CHAMADO_DESIGNADO.NEXTVAL AS CD_CHAMADO_DESIGNADO,
                            '$var_motorista' AS CD_MOTORISTA,
                            '$var_os' AS CD_OS_MV,
                            '$var_status' AS TP_STATUS_CHAMADO,
                            '$usuario' AS CD_USUARIO_CADASTRO,
                            SYSDATE AS HR_CADASTRO,
                            NULL AS CD_USUARIO_ULT_ALT,
                            NULL AS HR_ULT_ALT
                            FROM DUAL";
    $res_insert_chamado = oci_parse($conn_ora, $cons_insert_chamado);
                          oci_execute($res_insert_chamado);




?>

