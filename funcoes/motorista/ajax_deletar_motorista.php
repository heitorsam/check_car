<?php 

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_motorista = $_POST['cd_motorista'];

    //DELETE
    $delete = "DELETE 
               FROM portal_check_car.USUARIO usu
               WHERE usu.CD_USUARIO = $var_motorista";

    $res_delete = oci_parse($conn_ora, $delete);
        $valida = oci_execute($res_delete);

        
        
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