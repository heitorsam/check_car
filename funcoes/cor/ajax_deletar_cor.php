<?php

    include '../../conexao.php';

    //RECEBENDO VARIAVEL

    $var_cor = $_POST['cd_cores'];

    $validacao = "SELECT CASE 
                            WHEN cor.CD_COR IN ( SELECT vei.CD_COR FROM portal_check_car.VEICULO vei WHERE vei.CD_COR = cor.CD_COR) 
                            THEN 1 ELSE 0 
                            END AS SN_VINCULO
                  FROM portal_check_car.COR cor
                  WHERE cor.CD_COR = $var_cor";

    $res_validacao = oci_parse($conn_ora, $validacao);
                     oci_execute($res_validacao);          
                     
    $row = oci_fetch_array($res_validacao);

    if($row['SN_VINCULO'] == '1'){

        echo '1';

    }else{

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

    }
    

?>
