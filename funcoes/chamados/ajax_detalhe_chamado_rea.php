<?php

    //INICIANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_chamado = $_GET['chamado'];

    $cons_chamado_det = "SELECT tot.CD_OS_MV,
                        tot.TP_STATUS_CHAMADO,
                        tot.NM_MOTORISTA,
                        (SELECT vei.DS_MODELO || ' - ' || vei.DS_PLACA AS NM_VEICULO
                        FROM portal_check_car.VEICULO vei WHERE vei.CD_VEICULO = tot.CD_VEICULO) AS NM_VEICULO,
                        TO_CHAR(tot.HR_SAIDA,'DD/MM/YYYY HH24:MI:SS') AS HR_SAIDA,
                        tot.KM_SAIDA,
                        TO_CHAR(tot.HR_RETORNO,'DD/MM/YYYY HH24:MI:SS') AS HR_RETORNO,
                        tot.KM_RETORNO
                    FROM (
                    SELECT res.*,
                        (SELECT srv.CD_VEICULO 
                        FROM portal_check_car.SAI_RET_VEICULO srv WHERE srv.CD_CHAMADO_DESIGNADO = res.CD_CHAMADO_DESIGNADO) AS CD_VEICULO,
                        
                        (SELECT srv.HR_SAIDA 
                        FROM portal_check_car.SAI_RET_VEICULO srv WHERE srv.CD_CHAMADO_DESIGNADO = res.CD_CHAMADO_DESIGNADO) AS HR_SAIDA,
                        
                        (SELECT srv.HR_RETORNO 
                        FROM portal_check_car.SAI_RET_VEICULO srv WHERE srv.CD_CHAMADO_DESIGNADO = res.CD_CHAMADO_DESIGNADO) AS HR_RETORNO,
                        
                        (SELECT srv.KM_SAIDA 
                        FROM portal_check_car.SAI_RET_VEICULO srv WHERE srv.CD_CHAMADO_DESIGNADO = res.CD_CHAMADO_DESIGNADO) AS KM_SAIDA,

                        (SELECT srv.KM_RETORNO 
                        FROM portal_check_car.SAI_RET_VEICULO srv WHERE srv.CD_CHAMADO_DESIGNADO = res.CD_CHAMADO_DESIGNADO) AS KM_RETORNO
                    FROM (
                    SELECT cd.CD_CHAMADO_DESIGNADO,
                        cd.CD_OS_MV,
                        cd.TP_STATUS_CHAMADO,
                        
                        (SELECT (SELECT usux.NM_USUARIO 
                                FROM dbasgu.USUARIOS usux WHERE usux.CD_USUARIO = usu.CD_USUARIO_MV) AS NM_USUARIO
                        FROM portal_check_car.USUARIO usu 
                        WHERE usu.TP_STATUS = 'A'
                        AND usu.CD_USUARIO = cd.CD_MOTORISTA) AS NM_MOTORISTA
                        
                    FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                    WHERE cd.CD_CHAMADO_DESIGNADO = $var_chamado)res)tot";

    $res_chamado_det = oci_parse($conn_ora, $cons_chamado_det);
                       oci_execute($res_chamado_det);

    $row_corrida = oci_fetch_array($res_chamado_det);


?>


<div style="background-color: rgba(229,244,251,1); border: solid 1px #46A5D4;">

    <div class="div_br"></div>

    <div class="row">

        <div class="col-md-3 padding_desk">

            <b>OS:</b>
            <input readonly type="text" class="form form-control" id="cd_os" value="<?php echo $row_corrida['CD_OS_MV']; ?>"> 
            <div class="div_br"></div>

        </div>

        <div class="col-md-2 padding_desk padding_top_desk">

            <b>Status:</b>
            <?php

            if($row_corrida['TP_STATUS_CHAMADO'] == 'C'){

                echo ' <i class="fa-solid fa-check" style="color: #94ff9b;"></i>';

            }

            ?>   
            <div class="div_br"></div>        

        </div>

        <div class="col-md-4 padding_desk">

            <b>Motorista:</b>
            <input readonly type="text" class="form form-control" id="cd_os" value="<?php echo $row_corrida['NM_MOTORISTA']; ?>"> 
            <div class="div_br"></div>

        </div>

        <div class="col-md-3 padding_desk">

        <b>Veiculo:</b>
        <input readonly type="text" class="form form-control" id="cd_os" value="<?php echo $row_corrida['NM_VEICULO']; ?>"> 
        <div class="div_br"></div>

        </div>

    </div>
    
    <div class="div_br"></div>

    <div class="row">

    
    <div class="col-md-3 padding_desk">

        <b>Saida:</b>
        <input readonly type="text" class="form form-control" id="cd_os" value="<?php echo $row_corrida['HR_SAIDA']; ?>"> 
        <div class="div_br"></div>

    </div>

    <div class="col-md-3 padding_desk">

        <b>Km Inicial:</b>
        <input readonly type="text" class="form form-control" id="cd_os" value="<?php echo $row_corrida['KM_SAIDA']; ?>"> 
        <div class="div_br"></div>

    </div>

        
    <div class="col-md-3 padding_desk">

        <b>Retorno:</b>
        <input readonly type="text" class="form form-control" id="cd_os" value="<?php echo $row_corrida['HR_RETORNO']; ?>"> 
        <div class="div_br"></div>

    </div>

    <div class="col-md-3 padding_desk">

        <b>Km Final:</b>
        <input readonly type="text" class="form form-control" id="cd_os" value="<?php echo $row_corrida['KM_RETORNO']; ?>"> 
        <div class="div_br"></div>

    </div>



    </div>

    <div class="div_br"></div>


</div>