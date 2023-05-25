<?php

    session_start();

    //INICIANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEIS
    $var_cd_veiculo = $_POST['cd_veiculo'];
    $var_litro_abastecimento = $_POST['litro_abastecimento'];
    $var_valor_abastecimento = $_POST['valor_abastecimento'];

    //USUARIO DA SESSÃO
    $usuario = $_SESSION['usuarioLogin'];

    //INICIANDO INSERT
    $cons_abastecimento = "INSERT INTO portal_check_car.ABASTECIMENTO
                           SELECT 
                           portal_check_car.SEQ_CD_ABASTECIMENTO.NEXTVAL AS CD_ABASTECIMENTO,
                           $var_cd_veiculo AS CD_VEICULO,     
                           '$var_litro_abastecimento' AS DS_LITROS,        
                           '$var_valor_abastecimento' AS DS_VALOR,        
                           '$usuario' AS CD_USUARIO_CADASTRO,  
                           SYSDATE AS HR_CADASTRO,          
                           NULL AS CD_USUARIO_ULT_ALT,   
                           NULL AS HR_ULT_ALT         
                           
                           FROM DUAL";
    $res_abastecimento = oci_parse($conn_ora, $cons_abastecimento);
               $valida = oci_execute($res_abastecimento);

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