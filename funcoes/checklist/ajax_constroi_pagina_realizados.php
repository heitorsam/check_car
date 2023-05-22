<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //CONSULTA VEICULO
    $cons_veiculo = "SELECT vei.CD_VEICULO,
    vei.DS_MODELO,
    vei.DS_PLACA,
    vei.CD_COR,
    (SELECT cor.DS_RGB FROM portal_check_car.COR cor WHERE cor.CD_COR = vei.CD_COR) AS COR
    FROM portal_check_car.VEICULO vei
    WHERE vei.TP_STATUS <> 'I' ";
    $res_cons_veiculo = oci_parse($conn_ora, $cons_veiculo);
    oci_execute($res_cons_veiculo);

?>

<div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">

    Veiculo:
    <select class="form-control" id="veiculo_realizados">

        <option value="">Selecione</option>
        
        <?php

            while($row = oci_fetch_array($res_cons_veiculo)){

                echo '<option value="'. $row['CD_VEICULO'] .'">'. $row['DS_MODELO'] . ' / ' . $row['DS_PLACA'] .'</option>';

            }

        ?>


    </select>

</div>

<div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">
    Periodo:
    <input type="month" class="form-control" id="data_realizados" onchange="ajax_constroi_realizados()">

</div>


<!--DESKTOP-->
<div>

    <div class= "title_mob">

    <h11 class="center_desktop"><i class="fa-solid fa-bars-staggered"></i> Listagem</h11>

    </div>

</div>

<div class="div_br"> </div> 

<div id="constroi_realizado"></div>
