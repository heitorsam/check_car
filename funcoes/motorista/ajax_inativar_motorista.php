<?php
 //CHAMANDO SESSION
 session_start();

 //RECEBENDO USUARIO DA SESSÃO 
$usuario = $_SESSION['usuarioLogin'];

 //CONEXÃO  
 include '../../conexao.php';

 //RECEBENDO VARIAVEL 

 $cd_usu = $_POST['cd_usuario'];
 $status = $_POST['status'];

 if($status == 'I'){

    $cons_update_usuario = "UPDATE portal_check_car.USUARIO usu
                         SET 
                         usu.TP_STATUS = 'A',
                         usu.CD_USUARIO_ULT_ALT = '$usuario',
                         usu.HR_ULT_ALT = SYSDATE
                         WHERE 
                         usu.CD_USUARIO = $cd_usu"; 
    $res_cons_update = oci_parse($conn_ora,  $cons_update_usuario);
         $valida =     oci_execute($res_cons_update);


 }else{

    $cons_update_usuario = "UPDATE portal_check_car.USUARIO usu
                         SET 
                         usu.TP_STATUS = 'I',
                         usu.CD_USUARIO_ULT_ALT = '$usuario',
                         usu.HR_ULT_ALT = SYSDATE
                         WHERE 
                         usu.CD_USUARIO = $cd_usu"; 
    $res_cons_update = oci_parse($conn_ora,  $cons_update_usuario);
           $valida =   oci_execute($res_cons_update);

 }

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