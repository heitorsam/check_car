<?php

    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=consumo.xls");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);

    include '../../../conexao.php';

    //RECEBENDO VARIAVEL
    $data_ini = $_GET['dt_ini'];

    $data_fim = $_GET['dt_fim'];

    $data_format_1 = $data_ini;
    $data_format_2 = $data_fim;

    $ini_date = date("d/m/Y", strtotime($data_format_1));

    $fim_date = date("d/m/Y", strtotime($data_format_2));

    $consulta_rel = "SELECT 0 AS CD_VEICULO, 'Total' AS DS_MODELO, '-' AS DS_ANO, '-' AS DS_PLACA, '-' AS DS_RGB, '-' AS DS_COR,
      --TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY') AS DATA_DIA,
      --TO_DATE(TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY'),'DD/MM/YYYY') AS DATA_DIA_DATE,
            SUM(CAST(res.KM_RETORNO AS INT) - CAST(res.KM_SAIDA AS INT)) AS DIFERENCA_KM_RODADO,
            COUNT(res.KM_SAIDA) AS QTD_SAIDA
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

      UNION ALL    
    
      SELECT dados.*
      FROM(
         SELECT vc.CD_VEICULO, vc.DS_MODELO, vc.DS_ANO, vc.DS_PLACA, cor.DS_RGB, cor.DS_COR,
     -- TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY') AS DATA_DIA,
      --TO_DATE(TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY'),'DD/MM/YYYY') AS DATA_DIA_DATE,
            SUM(CAST(res.KM_RETORNO AS INT) - CAST(res.KM_SAIDA AS INT)) AS DIFERENCA_KM_RODADO,
            COUNT(res.KM_SAIDA) AS QTD_SAIDA
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
      GROUP BY vc.CD_VEICULO, vc.DS_MODELO, vc.DS_ANO, vc.DS_PLACA, cor.DS_RGB, cor.DS_COR
      --TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY'), 
      --TO_DATE(TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY'),'DD/MM/YYYY') 
      ORDER BY vc.CD_VEICULO ASC) dados";

    $res_rel = oci_parse($conn_ora, $consulta_rel);
               oci_execute($res_rel);


?>

<table class="table table-striped" cellspacing="0" cellpadding="0">

    <tr>

         <th style="text-align: center; border: solid 2px #3185c1;" >Código</th> 
         <th style="text-align: center; border: solid 2px #3185c1;" >Modelo</th>
         <th style="text-align: center; border: solid 2px #3185c1;" >Ano</th>
         <th style="text-align: center; border: solid 2px #3185c1;" >Placa</th> 
         <th style="text-align: center; border: solid 2px #3185c1;" >Cor</th>
         <!--
         <th style="text-align: center; border: solid 2px #3185c1;" >Data</th>
         -->
         <th style="text-align: center; border: solid 2px #3185c1;" >Saídas</th>
         <th style="text-align: center; border: solid 2px #3185c1;" >KM</th>
         <!--<th style="text-align: center; border: solid 2px #3185c1;" >Opções</th>-->

    </tr>

    <tbody>

        <?php

            while($row = oci_fetch_array($res_rel)){

               echo '<tr>';

               echo '<td class="align-middle">'  .  $row['CD_VEICULO'] . '</td>';
               echo '<td class="align-middle">'  .  $row['DS_MODELO'] . '</td>';
               echo '<td class="align-middle">'  .  $row['DS_ANO'] . '</td>';
               echo '<td class="align-middle">'  .  $row['DS_PLACA'] . '</td>';

               echo '<td class="align-middle">' .  $row['DS_COR'] . '</td>';

               //echo '<td class="align-middle">'  .  $row['DATA_DIA'] . '</td>';
               echo '<td class="align-middle">'  .  $row['QTD_SAIDA'] . '</td>';   
               echo '<td class="align-middle">'  .  $row['DIFERENCA_KM_RODADO'] . '</td>';                  
               //echo '<td class="align-middle">'  .  'Botão aqui' .  '</td>';             
             
             echo '</tr>';
                
            }

        ?>

    </tbody>

</table>