<?php

include '../../conexao.php';

//RECEBENDO VARIAVEL
$var_veiculo = $_POST['cd_veiculo'];

//INICIANDO DELETE
$cons_delete = "DELETE 
                FROM portal_check_car.VEICULO vei
                WHERE vei.CD_VEICULO = $var_veiculo";
$res_delete = oci_parse($conn_ora, $cons_delete);
$valida =     oci_execute($res_delete);

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