<?php

    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_os = $_GET['os_mv'];

    //CONSULTA
    $cons_modal_os = "SELECT
                        sol.CD_OS,
                        TO_CHAR(sol.DT_PEDIDO, 'DD/MM/YYYY HH24:MI:SS') AS DT_PEDIDO,
                        sol.DS_SERVICO,
                        sol.DS_OBSERVACAO,
                        (SELECT usu.NM_USUARIO FROM dbasgu.USUARIOS usu WHERE usu.CD_USUARIO = sol.NM_SOLICITANTE) AS NM_USUARIO_SOLICITANTE,
                        (SELECT loc. DS_LOCALIDADE FROM dbamv.LOCALIDADE loc WHERE loc.CD_LOCALIDADE = sol.CD_LOCALIDADE) AS NM_LOCALIDADE
                    FROM dbamv.SOLICITACAO_OS sol
                    WHERE sol.CD_OFICINA = 9
                    AND sol.CD_MULTI_EMPRESA = 1
                    --AND sol.TP_SITUACAO = 'S'
                    AND sol.CD_OS = $var_os";

    //echo $cons_modal_os;

    $res_modal_os = oci_parse($conn_ora, $cons_modal_os);
                    oci_execute($res_modal_os);
    $row = oci_fetch_array($res_modal_os);

?>

<div class="fnd_azul">OS</div>
<div class="row">

    <div class="col-md-12">
        <input readonly type="text" class="form form-control" value="<?php echo $row['CD_OS']; ?>">
    </div>
    
</div>

<div class="div_br"> </div>

<div class="fnd_azul">Localidade</div>
<div class="row">

    <div class="col-md-12">
        <input readonly type="text" class="form form-control" value="<?php echo $row['NM_LOCALIDADE']; ?>">
    </div>
    
</div>

<div class="div_br"> </div>

<div class="fnd_azul">Serviço:</div>
<div class="row">

    <div class="col-md-12">
        <textarea readonly class="textareaa" name="area" id="textarea" cols="50" rows="10" style="word-wrap: break-word"><?php echo $row['DS_SERVICO']; ?></textarea>
    </div>

</div>

<div class="div_br"> </div>

<div class="fnd_azul">Observações:</div>
<div class="row">

    <div class="col-md-12">
        <textarea readonly class="textareaa" name="area" id="textarea" cols="50" rows="10" style="word-wrap: break-word"><?php echo $row['DS_OBSERVACAO']; ?></textarea>
    </div>

</div>


