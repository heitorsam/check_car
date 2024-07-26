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
    $cons_abas = "SELECT 0 AS CD_SETOR, 'Total' AS NM_SETOR, SUM(res.QTD_KM_TOTAL) AS QTD_KM_TOTAL
    FROM (
    
    SELECT tot.CD_SETOR, tot.NM_SETOR, 'SEM RATEIO' AS TIPO, SUM(DIFERENCA_KM_RODADO) AS QTD_KM_TOTAL
      FROM (SELECT so.CD_SETOR,
                   st.NM_SETOR,
                   CAST(res.KM_RETORNO AS INT) - CAST(res.KM_SAIDA AS INT) AS DIFERENCA_KM_RODADO
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
             WHERE res.SN_CONCLUIDO = '1'
               AND TRUNC(res.HR_SAIDA) BETWEEN
                   TO_DATE('$ini_date', 'DD/MM/YYYY') AND
                   TO_DATE('$fim_date', 'DD/MM/YYYY')
                    AND so.CD_OS NOT IN (SELECT rt.CD_OS FROM portal_check_car.RATEIO rt)) tot
              
     GROUP BY tot.CD_SETOR, tot.NM_SETOR
          
     UNION ALL
     
     SELECT tot.CD_SETOR, tot.NM_SETOR,
     
     'COM RATEIO' AS TIPO, SUM(DIFERENCA_KM_RODADO) AS QTD_KM_TOTAL
      FROM (SELECT st.CD_SETOR,
                   st.NM_SETOR,
                   (CAST(res.KM_RETORNO AS INT) - CAST(res.KM_SAIDA AS INT)) * (rt.PORCENTAGEM/100) AS DIFERENCA_KM_RODADO
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
             INNER JOIN portal_check_car.RATEIO rt
               ON rt.CD_OS = so.CD_OS
             INNER JOIN dbamv.SETOR st
               ON st.CD_SETOR = rt.CD_SETOR
             WHERE res.SN_CONCLUIDO = '1'
               AND TRUNC(res.HR_SAIDA) BETWEEN
                   TO_DATE('$ini_date', 'DD/MM/YYYY') AND
                   TO_DATE('$fim_date', 'DD/MM/YYYY')
                     ) tot
              
     GROUP BY tot.CD_SETOR, tot.NM_SETOR
    ) res

    UNION ALL  

    SELECT dados.*
    FROM (   
    SELECT res.CD_SETOR, res.NM_SETOR, SUM(res.QTD_KM_TOTAL) AS QTD_KM_TOTAL
    FROM (
    
    SELECT tot.CD_SETOR, tot.NM_SETOR, 'SEM RATEIO' AS TIPO, SUM(DIFERENCA_KM_RODADO) AS QTD_KM_TOTAL
      FROM (SELECT so.CD_SETOR,
                   st.NM_SETOR,
                   CAST(res.KM_RETORNO AS INT) - CAST(res.KM_SAIDA AS INT) AS DIFERENCA_KM_RODADO
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
             WHERE res.SN_CONCLUIDO = '1'
               AND TRUNC(res.HR_SAIDA) BETWEEN
                   TO_DATE('$ini_date', 'DD/MM/YYYY') AND
                   TO_DATE('$fim_date', 'DD/MM/YYYY')
                    AND so.CD_OS NOT IN (SELECT rt.CD_OS FROM portal_check_car.RATEIO rt)) tot
              
     GROUP BY tot.CD_SETOR, tot.NM_SETOR
          
     UNION ALL
     
     SELECT tot.CD_SETOR, tot.NM_SETOR,
     
     'COM RATEIO' AS TIPO, SUM(DIFERENCA_KM_RODADO) AS QTD_KM_TOTAL
      FROM (SELECT st.CD_SETOR,
                   st.NM_SETOR,
                   (CAST(res.KM_RETORNO AS INT) - CAST(res.KM_SAIDA AS INT)) * (rt.PORCENTAGEM/100) AS DIFERENCA_KM_RODADO
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
             INNER JOIN portal_check_car.RATEIO rt
               ON rt.CD_OS = so.CD_OS
             INNER JOIN dbamv.SETOR st
               ON st.CD_SETOR = rt.CD_SETOR
             WHERE res.SN_CONCLUIDO = '1'
               AND TRUNC(res.HR_SAIDA) BETWEEN
                   TO_DATE('$ini_date', 'DD/MM/YYYY') AND
                   TO_DATE('$fim_date', 'DD/MM/YYYY')
                     ) tot
              
     GROUP BY tot.CD_SETOR, tot.NM_SETOR
    ) res
    GROUP BY res.CD_SETOR, res.NM_SETOR 
    ORDER BY res.NM_SETOR ASC ) dados";

    //echo $cons_abas;

    $res_abas = oci_parse($conn_ora, $cons_abas);
                oci_execute($res_abas);
                
?>

<div class="div_br"></div>
<div class="div_br"></div>

<table class='table table-striped' style='text-align: center'>

        <thead>

            <th style="text-align: center; border: solid 2px #3185c1;" >Código</th> 
            <th style="text-align: center; border: solid 2px #3185c1;" >Setor</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >KM</th>
            <!--<th style="text-align: center; border: solid 2px #3185c1;" >Opções</th>-->

            
        </thead>

        <tbody>
       
        <?php

            while($row = @oci_fetch_array($res_abas)){

                echo '<tr>';

                    echo '<td class="align-middle">'  .  $row['CD_SETOR'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['NM_SETOR'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['QTD_KM_TOTAL'] . '</td>';
                    //echo '<td class="align-middle">'  .  'Botão aqui' .  '</td>';
              
                
                echo '</tr>';

                
            }


        ?>

        </tbody>

    </table>