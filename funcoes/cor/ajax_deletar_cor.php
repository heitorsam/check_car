<?php

    include '../../conexao.php';

    //RECEBENDO VARIAVEL

    $var_cor = $_POST['cd_cores'];

    $cons_delete = "DELETE 
                    FROM portal_check_car.COR cor
                    WHERE cor.CD_COR = $var_cor";

    $res_cons_delete = oci_parse($conn_ora, $cons_delete);
             $valida = oci_execute($res_cons_delete);

                       
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
