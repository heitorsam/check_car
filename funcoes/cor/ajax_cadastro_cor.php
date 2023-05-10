<?php
//SESSION_START 
session_start();

//USUARIO DA SESSÃO
$usuario = $_SESSION['usuarioLogin'];

//CONEXÃO
include '../../conexao.php';

//RECEBENDO VARIAVEIS

$var_cor= $_POST['global_rgba'];
$var_nome =  $_POST['global_nome'];

$insert_cor = "INSERT INTO portal_check_car.COR
               SELECT 
               portal_check_car.SEQ_CD_COR.NEXTVAL AS CD_COR,
               UPPER('$var_nome') AS DS_COR,
               '$var_cor' AS DS_RGB,
               '$usuario' AS CD_USUARIO_CADASTRO,
                SYSDATE AS HR_CADASTRO,
                NULL AS CD_USUARIO_ULT_ALT,
                SYSDATE AS HR_ULT_ALT
                FROM DUAL";
                
$result = oci_parse($conn_ora, $insert_cor);
$valida = oci_execute($result);

                       
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