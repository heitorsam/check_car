<?php 

//CHAMANDO CONEXÃO
include '../../conexao.php';

//RECEBENDO VALORES
$var_seq = $_POST['sequence'];
$var_tipo = $_POST['tipo'];
$var_obs_geral = $_POST['obs_geral'];


//REALIZANDO UPDATE 
echo $cons_up = "UPDATE portal_check_car.CHECKLIST ck
            SET ck.TP_CHECKLIST = '$var_tipo',
                ck.OBS_GERAL = '$var_obs_geral'
            WHERE ck.CD_CHECKLIST = $var_seq";
$res_up = oci_parse($conn_ora, $cons_up);
          oci_execute($res_up);
