<?php

    //CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_plantao = $_POST['status'];
    $var_usu = $_POST['motorista'];

    //CONSULTA
    $cons_update = "UPDATE
                    portal_check_car.USUARIO usu
                    SET
                    usu.TP_PLANTAO = '$var_plantao'
                    WHERE
                    usu.CD_USUARIO = $var_usu";
    $res_update = oci_parse($conn_ora, $cons_update);
    $valida =     oci_execute($res_update);

                  
    //VALIDACAO
    if (!$valida) {   
    
    $erro = oci_error($res_insert_tb_terceiro);																							
    $msg_erro = htmlentities($erro['message']);
    //header("Location: $pag_login");
    //echo $erro;
    echo $msg_erro;

    }else{

        echo 'Sucesso';
        
    }

?>