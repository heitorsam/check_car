<?php

//CHAMANDO CONEXÃO
include '../../conexao.php';

//RECEBENDO VARIAVEIS
$cd_usuario = $_SESSION['cd_usuario'];

//DELETE
$cons_delete = "DELETE 
                FROM portal_check_car.USUARIO usu
                WHERE usu.CD_USUARIO = $cd_usuario ";

$res_delete = oci_parse($conn_ra, $cons_delete);
              oci_execute($res_delete);



?>