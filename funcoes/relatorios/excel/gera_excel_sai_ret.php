<?php

    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=saida_retorno_veiculos.xls");
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

    $consulta_rel = "SELECT 
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
                    ORDER BY srt.CD_SAI_RET DESC)res
                    WHERE res.SN_CONCLUIDO = '1'
                    AND TO_CHAR(res.HR_SAIDA,'DD/MM/YYYY') BETWEEN '$ini_date' AND '$fim_date'";
    $res_rel = oci_parse($conn_ora, $consulta_rel);
               oci_execute($res_rel);


?>

<table class="table table-striped" cellspacing="0" cellpadding="0">

    <tr>
        <th class="p-2">Os</th>
        <th class="p-2">Motorista</th>
        <th class="p-2">Veiculo</th>
        <th class="p-2">Saida</th>
        <th class="p-2">Km Saida</th>
        <th class="p-2">Retorno</th>
        <th class="p-2">Km Retorno</th>
        <th class="p-2">Diferença Km</th>

    </tr>

    <tbody>

        <?php

            while($row = oci_fetch_array($res_rel)){

                echo '<tr>';
                   
                echo '<td class="align-middle">'  .  $row['CD_OS_MV'] . '</td>';
                echo '<td class="align-middle">'  .  $row['NM_MOTORISTA'] . '</td>';
                echo '<td class="align-middle">'  .  $row['NM_VEICULO'] . '</td>';
                echo '<td class="align-middle">'  .  $row['HR_SAIDA'] . '</td>';
                echo '<td class="align-middle">'  .  $row['KM_SAIDA'] . ' Km</td>';
                echo '<td class="align-middle">'  .  $row['HR_RETORNO'] . '</td>';
                echo '<td class="align-middle">'  .  $row['KM_RETORNO'] . ' Km</td>';
                echo '<td class="align-middle">'  .  $row['DIFERENCA_KM_RODADO'] . ' Km</td>';

                echo '</tr>';
                
            }

        ?>

    </tbody>

</table>