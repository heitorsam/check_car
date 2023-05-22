<?php

include '../../conexao.php';

$var_periodo = $_GET['periodo'];
$var_veiculo = $_GET['veiculo'];

$var_periodo_format = $var_periodo;

$data_1 = date('m-Y', strtotime($var_periodo_format));

$data = str_replace("-", "/", $data_1);

$consulta = "SELECT * 
             FROM (
             SELECT res.CD_VEICULO,
                 (SELECT vei.DS_MODELO || ' - ' || vei.DS_PLACA AS DS_VEICULOS
                     FROM portal_check_car.VEICULO vei WHERE vei.CD_VEICULO = res.CD_VEICULO) AS DS_VEICULOS,
                 res.DS_KM,
                 res.DS_LITROS,
                 res.DS_VALOR,
                 TO_CHAR(res.HR_CADASTRO, 'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO,
                 res.MES || '/' || res.ANO AS PERIODO
             FROM (
             SELECT abas.CD_VEICULO,
                 abas.DS_KM,
                 abas.DS_LITROS,
                 abas.DS_VALOR,
                 abas.HR_CADASTRO,
                 CASE 
                     WHEN LENGTH(EXTRACT(MONTH FROM abas.HR_CADASTRO)) <= 1THEN LPAD(EXTRACT(MONTH FROM abas.HR_CADASTRO),2,0)
                     ELSE TO_CHAR(EXTRACT(MONTH FROM abas.HR_CADASTRO))
                 END AS MES,
                 
                 EXTRACT(YEAR FROM abas.HR_CADASTRO) AS ANO
                 
             FROM portal_check_car.ABASTECIMENTO abas
             WHERE abas.CD_VEICULO = $var_veiculo)res)tot
             WHERE tot.PERIODO = '$data'";

$execute = oci_parse($conn_ora, $consulta);
           oci_execute($execute);

?>

<div class="row">

    <?php

        while($row_table = oci_fetch_array($execute)){
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div class="mini_caixa_chamado"><b>Veiculo: ' . $row_table['DS_VEICULOS'] . '</b></div>';

                    echo '<div class="mini_caixa_chamado"><b>Km:</b> ' . $row_table['DS_KM'] . '</div>';  

                    echo '<div class="mini_caixa_chamado"><b>Litros:</b> ' . $row_table['DS_LITROS'] . '</div>';

                    echo '<div class="mini_caixa_chamado"><b>Valor:</b> R$' . $row_table['DS_VALOR'] . '</div>';

                    echo '<div class="mini_caixa_chamado"><b>Data:</b> ' . $row_table['HR_CADASTRO'] . '</div>';
                    
                    echo '<div style="clear: both;"></div>';

                    

                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>
