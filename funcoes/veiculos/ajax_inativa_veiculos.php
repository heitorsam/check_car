<?php

 //CONEXÃO  
 include '../../conexao.php';

 //RECEBENDO VARIAVEL 

 $veiculo = $_POST['cd_veiculo'];

 $cons_update_veiculo = "UPDATE portal_check_car.Veiculo vei
                         SET 
                         vei.TP_STATUS = 'I' 
                         WHERE 
                         vei.CD_VEICULO = $veiculo"; 
 $res_cons_update = oci_parse($conn_ora,  $cons_update_veiculo);
                    oci_execute($res_cons_update);
?>