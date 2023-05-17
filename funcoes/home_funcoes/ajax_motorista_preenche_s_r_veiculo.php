<?php

    session_start();

    //INICIANDO A CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_veiculo = $_POST['js_veiculo'];
    $var_km = $_POST['js_km'];
    $var_chamado = $_POST['js_chamado'];
    $var_motorista = $_POST['js_motorista'];
    $usuario = $_SESSION['usuarioLogin'];

    //INICIANDO INSERT
    $cons_insert = "INSERT INTO portal_check_car.SAI_RET_VEICULO
                    SELECT
                    portal_check_car.SEQ_CD_SAI_RET.NEXTVAL AS CD_SAI_RET,
                    $var_chamado AS CD_CHAMADO_DESIGNADO,
                    $var_motorista AS CD_MOTORISTA,
                    $var_veiculo AS CD_VEICULO,
                    SYSDATE AS HR_SAIDA,
                    NULL AS HR_RETORNO,
                    '$var_km' AS KM_SAIDA,
                    NULL AS KM_RETORNO,
                    '$usuario' AS CD_USUARIO_CADASTRO,
                    SYSDATE AS HR_CADASTRO,
                    NULL AS CD_USUARIO_ULT_ALT,
                    NULL AS HR_ULT_ALT
                    FROM DUAL";
    $res_insert = oci_parse($conn_ora, $cons_insert);
    $valida =     oci_execute($res_insert);

                  
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