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

        Veiculo:
        <select class="form form-control" id="cd_veiculo" onchange="ajax_exibe_veiculo()">
        <option value = "All" >Selecione</option>
            <?php

            while($row_veiculo = oci_fetch_array($res_veiculo)){

                echo '<option value = "' . $row_veiculo['CD_VEICULO'] . '">' . $row_veiculo['DS_VEICULO'] . '</option>';
                

            }

            ?>
        </select>

    </div>

</div>

<div id="detalhes_veiculo"></div>