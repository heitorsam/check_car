<?php

    //INICIANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_chamado = $_GET['os'];

    $cons_chamado_det = "SELECT so.CD_OS,
                                so.DT_PEDIDO,
                                so.DS_SERVICO,
                                dbamv.fnc_long_para_char_os($var_chamado) AS DS_OBSERVACAO,
                                st.NM_SETOR,
                                so.DS_RAMAL,
                                usu.NM_USUARIO
                        FROM dbamv.SOLICITACAO_OS so
                        LEFT JOIN dbamv.SETOR st 
                        ON st.CD_SETOR = so.CD_SETOR
                        LEFT JOIN dbasgu.USUARIOS usu 
                        ON usu.CD_USUARIO = so.NM_USUARIO
                        WHERE so.CD_OS = $var_chamado";

    $res_chamado_det = oci_parse($conn_ora, $cons_chamado_det);
                       oci_execute($res_chamado_det);

    $row_corrida = oci_fetch_array($res_chamado_det);


?>


<div style="background-color: #ffffff; text-align: left; padding: 20px;">
    <div class="div_br"></div>

    <div class="row">
        <div class="col-12 col-md-6" style="text-align: left; padding: 4px;">
            <b>OS:</b>
            <input readonly type="text" class="form form-control" id="cd_os" value="<?php echo $row_corrida['CD_OS']; ?>"> 
            <div class="div_br"></div>
        </div>

        <div class="col-12 col-md-6" style="text-align: left; padding: 4px;">
            <b>Data Pedido:</b>
            <?php 
                $data_pedido_formatada = date('d/m/Y', strtotime($row_corrida['DT_PEDIDO']));
            ?>
            <input readonly type="text" class="form form-control" id="dt_pedido" value="<?php echo $data_pedido_formatada; ?>"> 
            <div class="div_br"></div>
        </div>

        <div class="col-12" style="text-align: left; padding: 4px;">
            <b>Serviço:</b><br>
            <textarea readonly class="form-control"><?php echo $row_corrida['DS_SERVICO']; ?></textarea>
            <div class="div_br"></div>
        </div>

        <div class="col-12" style="text-align: left; padding: 4px;">
            <b>Observação:</b><br>
            <textarea readonly class="form-control"><?php echo $row_corrida['DS_OBSERVACAO']; ?></textarea>
            <div class="div_br"></div>
        </div>

        <div class="col-12 col-md-6" style="text-align: left; padding: 4px;">
            <b>Setor:</b>
            <input readonly type="text" class="form form-control" id="nm_setor" value="<?php echo $row_corrida['NM_SETOR']; ?>"> 
            <div class="div_br"></div>
        </div>

        <div class="col-12 col-md-6" style="text-align: left; padding: 4px;">
            <b>Ramal:</b>
            <input readonly type="text" class="form form-control" id="ds_ramal" value="<?php echo $row_corrida['DS_RAMAL']; ?>"> 
            <div class="div_br"></div>
        </div>

        <div class="col-12" style="text-align: left; padding: 4px;">
            <b>Usuário:</b>
            <input readonly type="text" class="form form-control" id="nm_usuario" value="<?php echo $row_corrida['NM_USUARIO']; ?>"> 
            <div class="div_br"></div>
        </div>
        
        <!-- Outros campos aqui -->
    </div>
    
    <!-- Outras linhas de dados aqui -->
</div>
