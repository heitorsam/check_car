<?php

    //CHAMANDO CONEXÃO 
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $data_ini = $_GET['data1'];
    $data_fim = $_GET['data2'];
    $pesquisa = $_GET['pesquisa'];

    $data_format_1 = $data_ini;
    $data_format_2 = $data_fim;

    $ini_date = date("d/m/Y", strtotime($data_format_1));

    $fim_date = date("d/m/Y", strtotime($data_format_2));

    $consulta_rel = "SELECT ttt.*,   
                     (SELECT CASE WHEN SUM(rt.CD_OS) > 0 THEN 'S' ELSE 'N' END AS SN_RATEIO
                      FROM portal_check_car.RATEIO rt
                      WHERE rt.CD_OS = ttt.CD_OS_MV
                     ) AS SN_RATEIO
                    FROM(
                    SELECT 
                    (SELECT cdx.CD_OS_MV FROM portal_check_car.CHAMADOS_DESIGNADOS cdx WHERE cdx.CD_CHAMADO_DESIGNADO = res.CD_CHAMADO_DESIGNADO) AS CD_OS_MV,
                    (SELECT 
                        (SELECT usu.NM_USUARIO FROM dbasgu.USUARIOS usu WHERE usu.CD_USUARIO = usu_c.CD_USUARIO_MV) AS NM_MOTORISTA
                    FROM portal_check_car.USUARIO usu_c
                    WHERE usu_c.CD_USUARIO = res.CD_MOTORISTA) AS NM_MOTORISTA,
                    (SELECT vei.DS_MODELO || ' / ' || vei.DS_PLACA FROM portal_check_car.VEICULO vei WHERE vei.CD_VEICULO = res.CD_VEICULO) AS NM_VEICULO,
                    TO_CHAR(res.HR_SAIDA, 'DD/MM/YYYY HH24:MI:SS') AS HR_SAIDA,
                    res.KM_SAIDA,
                    TO_CHAR(res.HR_RETORNO, 'DD/MM/YYYY HH24:MI:SS') AS HR_RETORNO,
                    res.KM_RETORNO,
                    CAST(res.KM_RETORNO AS INT) - CAST(res.KM_SAIDA AS INT) AS DIFERENCA_KM_RODADO
                  
                    FROM (
                    SELECT srt.*,
                        CASE
                            WHEN srt.CD_CHAMADO_DESIGNADO IN ( SELECT cd.CD_CHAMADO_DESIGNADO
                                                                FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                                                                WHERE cd.TP_STATUS_CHAMADO = 'C') THEN '1' ELSE '0'
                        END AS SN_CONCLUIDO
                    FROM portal_check_car.SAI_RET_VEICULO srt
                    )res
                    WHERE res.SN_CONCLUIDO = '1'
                    AND TRUNC(res.HR_SAIDA) BETWEEN TO_DATE('$ini_date','DD/MM/YYYY') AND TO_DATE('$fim_date','DD/MM/YYYY')
                    ) ttt
                    ORDER BY ttt.HR_SAIDA";

    //echo $consulta_rel;

    $res_rel = oci_parse($conn_ora, $consulta_rel);
               oci_execute($res_rel);

?>

<div class="div_br"></div>
<div class="div_br"></div>

<?php 

    if($pesquisa == '1'){

?>
    
<div class="row">

    <?php

        while($row = oci_fetch_array($res_rel)){
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div onclick="ajax_detalhe_sai_ret('. $row['CD_OS_MV'] .')"class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div class="mini_caixa_chamado"><b>OS: ' . $row['CD_OS_MV'] . '</b></div>';

                    echo '<div class="mini_caixa_chamado"><i class="fa-solid fa-id-card"></i> '. $row['NM_MOTORISTA'] .'</div>';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-car"></i> ' . $row['NM_VEICULO'] . '</b></div>';   
                    
                    echo '<div style="clear: both;"></div>';
                    
                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>






<?php

    }else{


    
?>

<table class='table table-striped' style='text-align: center'>

        <thead>

            <th style="text-align: center; border: solid 2px #3185c1;" >OS</th> 
            <th style="text-align: center; border: solid 2px #3185c1;" >Motorista</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >Veiculo</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >Hr Saida</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >Km Saida</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >Hr Retorno</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >Km Retorno</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >Diferença Km</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >Rateio</th>
            
        </thead>

        <tbody>
       
        <?php

            while($row = @oci_fetch_array($res_rel)){

                echo '<tr>';

                    echo '<td class="align-middle">'  .  $row['CD_OS_MV'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['NM_MOTORISTA'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['NM_VEICULO'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['HR_SAIDA'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['KM_SAIDA'] . ' Km</td>';
                    echo '<td class="align-middle">'  .  $row['HR_RETORNO'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['KM_RETORNO'] . ' Km</td>';
                    echo '<td class="align-middle">'  .  $row['DIFERENCA_KM_RODADO'] . ' Km</td>';

                    echo '<td class="align-middle">';
                    echo '<button class="btn btn-primary" onclick="ajax_rateio_modal(' . $row['CD_OS_MV'] . ",'" . $row['SN_RATEIO'] . "'" . ')">';

                    if($row['SN_RATEIO'] == 'S'){

                        echo '<i class="far fa-eye"></i>';

                    }else{

                        echo '<i class="fas fa-divide"></i>';
                    }
                    
                    
                    echo '</button>';
                    echo '</td>';
                
                echo '</tr>';

                
            }


        ?>

        </tbody>

    </table>
<?php

    }

?>
