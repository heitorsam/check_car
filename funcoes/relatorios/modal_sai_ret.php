<?php 

include '../../conexao.php';

$OS = $_GET['OS'];

$cons_modal = "SELECT * 
               FROM (SELECT 
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
            WHERE res.SN_CONCLUIDO = '1')tot
            WHERE tot.CD_OS_MV = '$OS'";

$res_modal = oci_parse($conn_ora, $cons_modal);
             oci_execute($res_modal);

$row = oci_fetch_array($res_modal);

?>

<div class="row">

    <div class="col-md-3">

        Saida:
        <input type="text" class="form form-control" readonly value="<?php echo $row['HR_SAIDA']?>">

    </div>
    <div class="div_br"></div>
    <div class="col-md-3">

        Km Inicial:
        <input type="text" class="form form-control" readonly value="<?php echo $row['KM_SAIDA']?>">

    </div>
    <div class="div_br"></div>
    <div class="col-md-3">

        Retorno:
        <input type="text" class="form form-control" readonly value="<?php echo $row['HR_RETORNO']?>">

    </div>
    <div class="div_br"></div>
    <div class="col-md-3">

        Km Final:
        <input type="text" class="form form-control" readonly value="<?php echo $row['KM_RETORNO']?>">

    </div>
    <div class="div_br"></div>
    <div class="col-md-3">

        Diferença:
        <input type="text" class="form form-control" readonly value="<?php echo $row['DIFERENCA_KM_RODADO']?>">

    </div>



</div>
