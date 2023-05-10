<?php 
    //CHAMANDO SESSÃO
    session_start();

    //RECEBENDO USUARIO DA SESSÃO
    $usuario = $_SESSION['usuarioLogin'];

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_item = $_POST['global_item'];

    //EXECUTANDO INSERT

    $cons_insert = "INSERT INTO portal_check_car.item_veiculo
                    SELECT
                    portal_check_car.SEQ_CD_ITEM_VEICULO.NEXTVAL AS CD_ITEM_VEICULO,
                    'N' AS SN_PADRAO,
                    '$var_item' AS DS_ITEM_VEICULO,
                    '$usuario' AS CD_USUARIO_CADASTRO,
                    SYSDATE AS HR_CADASTRO,
                    NULL AS CD_USUARIO_ULT_ALT,
                    NULL AS HR_ULT_ALT
                    FROM DUAL";
    $res_insert =   oci_parse($conn_ora, $cons_insert);
    $valida =       oci_execute($res_insert);

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