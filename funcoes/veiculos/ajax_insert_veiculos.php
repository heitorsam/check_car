<?php
//CHAMANDO SESSÃO
session_start();

//RECEBENDO USUARIO DA SESSÃO 
$usuario = $_SESSION['usuarioLogin'];

//CHAMANDO CONEXÃO
include '../../conexao.php';

//RECEBENDO VARIAVEIS MOBILE 
$cor_mob = $_POST['cor_mob'];
$modelo_mob = $_POST['mod_mob'];
$ano_mob = $_POST['ano_mob'];
$placa_mob = $_POST['pla_mob'];
$km_mob = $_POST['km_mob'];

//RECEBENDO VARIAVEIS DESKTOP
$cor_desk = $_POST['cor_desk'];
$modelo_desk = $_POST['mod_desk'];
$ano_desk = $_POST['ano_desk'];
$placa_desk = $_POST['placa_desk'];
$km_desk = $_POST['km_desk'];

//VARIAVEIS AUXILIARES 
$var_cor = '';
$var_modelo = '';
$var_ano = '';
$var_placa = '';
$var_km = '';

//TRATAMENTO 
if($cor_mob == ''){

    $var_cor = $cor_desk;

}else{

    $var_cor = $cor_mob;

}

if($modelo_mob ==''){

    $var_modelo = $modelo_desk;

}else{

    $var_modelo = $modelo_mob;

}

if($ano_mob == ''){

    $var_ano = $ano_desk;

}else{

    $var_ano = $ano_mob;

}

if($placa_mob == ''){

    $var_placa = $placa_desk;

}else{

    $var_placa = $placa_mob;

}

if($km_mob == ''){

    $var_km = $km_desk;

}else{

    $var_km = $km_mob;

}


//INSERT

echo $insert_veiculo = "INSERT INTO portal_check_car.VEICULO 
                    SELECT 
                    portal_check_car.SEQ_CD_VEICULO.NEXTVAL AS CD_VEICULO,
                    UPPER('$var_modelo') AS DS_MODELO,
                    '$var_ano' AS DS_ANO,
                    UPPER('$var_placa') AS DS_PLACA,
                    '$var_cor' AS CD_COR,
                    '$var_km' AS KM,
                    '$usuario' AS CD_USUARIO_CADASTRO,
                    SYSDATE AS HR_CADASTRO,
                    NULL AS CD_USUARIO_ULT_ALT,
                    NULL AS HR_ULT_ALT
                    FROM DUAL";

$res_insert_veiculo = oci_parse($conn_ora, $insert_veiculo);
$valida = oci_execute($res_insert_veiculo);


?>