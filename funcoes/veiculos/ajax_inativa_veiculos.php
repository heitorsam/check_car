<?php
 //CHAMANDO SESSION
 session_start();

 //RECEBENDO USUARIO DA SESSÃO 
 $usuario = $_SESSION['usuarioLogin'];

 //CONEXÃO  
 include '../../conexao.php';

 //RECEBENDO VARIAVEL 

 $veiculo = $_POST['cd_veiculo'];
 $status = $_POST['status'];

 if($status == 'I'){

    $cons_update_veiculo = "UPDATE portal_check_car.Veiculo vei
                         SET 
                         vei.TP_STATUS = 'A',
                         vei.CD_USUARIO_ULT_ALT = '$usuario',
                         vei.HR_ULT_ALT = SYSDATE
                         WHERE 
                         vei.CD_VEICULO = $veiculo"; 
    $res_cons_update = oci_parse($conn_ora,  $cons_update_veiculo);
    $valida =          oci_execute($res_cons_update);


 }else{

    $cons_update_veiculo = "UPDATE portal_check_car.Veiculo vei
                         SET 
                         vei.TP_STATUS = 'I',
                         vei.CD_USUARIO_ULT_ALT = '$usuario',
                         vei.HR_ULT_ALT = SYSDATE
                         WHERE 
                         vei.CD_VEICULO = $veiculo"; 

    $res_cons_update = oci_parse($conn_ora,  $cons_update_veiculo);
    $valida =          oci_execute($res_cons_update);

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