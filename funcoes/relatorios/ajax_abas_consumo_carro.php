<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $data_ini = $_GET['data1'];
    $data_fim = $_GET['data2'];
    //$pesquisa = $_GET['pesquisa'];

    $data_format_1 = $data_ini;
    $data_format_2 = $data_fim;

    $ini_date = date("d/m/Y", strtotime($data_format_1));

    $fim_date = date("d/m/Y", strtotime($data_format_2));


    //INICIANDO CONSULTA
    $cons_abas = "SELECT vc.CD_VEICULO, vc.DS_MODELO, vc.DS_ANO, vc.DS_PLACA, cor.DS_RGB, cor.DS_COR,
    TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY') AS DATA_DIA,
    TO_DATE(TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY'),'DD/MM/YYYY') AS DATA_DIA_DATE,
           SUM(CAST(res.KM_RETORNO AS INT) - CAST(res.KM_SAIDA AS INT)) AS DIFERENCA_KM_RODADO
      FROM (SELECT srt.*,
                   CASE
                     WHEN srt.CD_CHAMADO_DESIGNADO IN
                          (SELECT cd.CD_CHAMADO_DESIGNADO
                             FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                            WHERE cd.TP_STATUS_CHAMADO = 'C') THEN
                      '1'
                     ELSE
                      '0'
                   END AS SN_CONCLUIDO
              FROM portal_check_car.SAI_RET_VEICULO srt
             ORDER BY srt.CD_SAI_RET DESC) res
     INNER JOIN portal_check_car.CHAMADOS_DESIGNADOS cd
        ON cd.CD_CHAMADO_DESIGNADO = res.CD_CHAMADO_DESIGNADO
     INNER JOIN dbamv.SOLICITACAO_OS so
        ON so.CD_OS = cd.CD_OS_MV
     INNER JOIN dbamv.SETOR st
        ON st.CD_SETOR = so.CD_SETOR
     INNER JOIN portal_check_car.VEICULO vc
       ON vc.CD_VEICULO = res.CD_VEICULO
     INNER JOIN portal_check_car.COR cor
       ON cor.CD_COR = vc.CD_COR
     WHERE res.SN_CONCLUIDO = '1'
    AND TRUNC(res.HR_SAIDA) BETWEEN
    TO_DATE('$ini_date', 'DD/MM/YYYY') AND
    TO_DATE('$fim_date', 'DD/MM/YYYY')
    GROUP BY vc.CD_VEICULO, vc.DS_MODELO, vc.DS_ANO, vc.DS_PLACA, cor.DS_RGB, cor.DS_COR,
    TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY'), 
    TO_DATE(TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY'),'DD/MM/YYYY') 
    ORDER BY TO_DATE(TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY'),'DD/MM/YYYY') ASC, vc.CD_VEICULO ASC";

    $res_abas = oci_parse($conn_ora, $cons_abas);
                oci_execute($res_abas);
                
?>

<div class="div_br"></div>
<div class="div_br"></div>

<table class='table table-striped' style='text-align: center'>

        <thead>

            
         <th style="text-align: center; border: solid 2px #3185c1;" >Código</th> 
         <th style="text-align: center; border: solid 2px #3185c1;" >Modelo</th>
         <th style="text-align: center; border: solid 2px #3185c1;" >Ano</th>
         <th style="text-align: center; border: solid 2px #3185c1;" >Placa</th> 
         <th style="text-align: center; border: solid 2px #3185c1;" >Cor</th>
         <th style="text-align: center; border: solid 2px #3185c1;" >Data</th>
         <th style="text-align: center; border: solid 2px #3185c1;" >KM</th>
         <!--<th style="text-align: center; border: solid 2px #3185c1;" >Opções</th>-->

            
        </thead>

        <tbody>
       
        <?php

            while($row = @oci_fetch_array($res_abas)){

                echo '<tr>';

                  echo '<td class="align-middle">'  .  $row['CD_VEICULO'] . '</td>';
                  echo '<td class="align-middle">'  .  $row['DS_MODELO'] . '</td>';
                  echo '<td class="align-middle">'  .  $row['DS_ANO'] . '</td>';
                  echo '<td class="align-middle">'  .  $row['DS_PLACA'] . '</td>';
                  echo '<td class="align-middle">'  .  '<i class="fas fa-car-side fa-flip-horizontal" style="color: ' . $row['DS_RGB']. ';"></i> ' .  $row['DS_COR'] . '</td>';
                  echo '<td class="align-middle">'  .  $row['DATA_DIA'] . '</td>';
                  echo '<td class="align-middle">'  .  $row['DIFERENCA_KM_RODADO'] . '</td>';                  
                  //echo '<td class="align-middle">'  .  'Botão aqui' .  '</td>';             
                
                echo '</tr>';

                
            }


        ?>

        </tbody>

    </table>