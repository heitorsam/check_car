<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $data_ini = $_GET['data1'];
    $data_fim = $_GET['data2'];

    $data_format_1 = $data_ini;
    $data_format_2 = $data_fim;

    $ini_date = date("d/m/Y", strtotime($data_format_1));

    $fim_date = date("d/m/Y", strtotime($data_format_2));

    //INICIANDO CONSULTA
    $cons_abas = "SELECT 
                        (SELECT vei.DS_MODELO FROM portal_check_car.VEICULO vei WHERE vei.CD_VEICULO = abas.CD_VEICULO) AS NM_VEICULO,
                        abas.DS_LITROS || 'L' AS LITROS,
                        'R$' || abas.DS_VALOR AS VALOR,
                        (SELECT usu.NM_USUARIO 
                        FROM dbasgu.USUARIOS usu
                        WHERE usu.CD_USUARIO = abas.CD_USUARIO_CADASTRO) AS MOTORISTA
                  FROM portal_check_car.ABASTECIMENTO abas
                  WHERE TRUNC(abas.HR_CADASTRO) BETWEEN TO_DATE('$ini_date','DD/MM/YYYY') AND TO_DATE('$fim_date','DD/MM/YYYY')
                  ORDER BY abas.CD_ABASTECIMENTO DESC";

    $res_abas = oci_parse($conn_ora, $cons_abas);
                oci_execute($res_abas);
                
?>

<div class="div_br"></div>
<div class="div_br"></div>

    
<div class="row">

    <?php

        while($row = oci_fetch_array($res_abas)){
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-car"></i> ' . $row['NM_VEICULO'] . '</b></div>';

                    echo '<div class="mini_caixa_chamado"><i class="fa-solid fa-gas-pump"></i> '. $row['LITROS'] .'</div>';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-money-bill-1"></i> ' . $row['VALOR'] . '</b></div>';   
                    
                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-id-card"></i> ' . $row['MOTORISTA'] . '</b></div>';   

                    echo '<div style="clear: both;"></div>';
                    
                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>
