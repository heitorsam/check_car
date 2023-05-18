<?php


    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    $cons_veiculo = "SELECT vei.CD_VEICULO,
                            vei.DS_MODELO ||' - '|| vei.DS_PLACA AS DS_VEICULO
                        FROM portal_check_car.VEICULO vei
                        WHERE vei.TP_STATUS = 'A'";
    $res_veiculo = oci_parse($conn_ora, $cons_veiculo);
                   oci_execute($res_veiculo);

?>



<div class="row">

    <div class="col-md-3">

        Periodo:
        <input type="month" class="form form-control" id="periodo">

        <div class="div_br"></div>
        <div class="div_br"></div>


    </div>


    <div class="col-md-3">

        Veiculo:
        <select class="form form-control" id="cd_veiculo_ab" onchange="ajax_exibe_ab_realizados()">
        <option value = "All" >Selecione</option>
            <?php

            while($row_veiculo = oci_fetch_array($res_veiculo)){

                echo '<option value = "' . $row_veiculo['CD_VEICULO'] . '">' . $row_veiculo['DS_VEICULO'] . '</option>';
                

            }

            ?>

        </select>

    </div>



</div>

<div class="div_br"></div>
<div class="div_br"></div>

<h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-regular fa-clock efeito-zoom"></i> <label class="display_esconder_mobile"> Historico</label></h11>

<div class="div_br"></div>

<div id="realizados"></div>