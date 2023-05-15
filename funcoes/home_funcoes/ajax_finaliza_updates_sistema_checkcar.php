<?php

    session_start();

    include '../../conexao.php';

    //RECEBENDO VARIAVEIS
    $var_chamado = $_POST['global_chamados'];
    $status = $_POST['js_status'];
    $var_km = $_POST['js_km_retorno'];
    $usuario = $_SESSION['usuarioLogin'];

    $cons_update_sai_ret = "UPDATE
                            portal_check_car.SAI_RET_VEICULO srv
                        SET
                        srv.HR_RETORNO = SYSDATE,
                        srv.KM_RETORNO = '$var_km'
                        WHERE
                            srv.CD_CHAMADO_DESIGNADO = '$var_chamado'";
    $res_update_sai_ret = oci_parse($conn_ora, $cons_update_sai_ret);
                $valida = oci_execute($res_update_sai_ret);


     //VALIDACAO
     if (!$valida) {   
        
        $erro = oci_error($res_update_sai_ret);																							
        $msg_erro = htmlentities($erro['message']);
        //header("Location: $pag_login");
        //echo $erro;
        echo $msg_erro;

    }else{

        echo 'Sucesso';
        
    }


?>