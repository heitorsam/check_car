<?php

//CHAMANDO CONEXÃO
include '../../conexao.php';

//RECEBENDO VARIAVEIS 
$var_sequence = $_POST['sequence'];
$var_cd_item = $_POST['cd_item'];

//INICIANDO O DELETE 
$cons_delete ="DELETE 
               FROM portal_check_car.ITCHECKLIST itc
               WHERE itc.CD_CHECKLIST = '$var_sequence'
               AND itc.CD_ITEM_VEICULO = '$var_cd_item'";

$res_cons_delete  = oci_parse($conn_ora, $cons_delete);
                    oci_execute($res_cons_delete);




?>