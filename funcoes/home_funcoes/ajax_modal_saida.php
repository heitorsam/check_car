<?php

    session_start();

    include '../../conexao.php';

    $nm_logado = $_SESSION['usuarioNome'];

    

?>

<div class="row">
                    
    <div class="col-md-2">


        Veiculo:
        <select class="form form-control" id="veiculo">

            <?php
            
                $consulta_veiculo = "SELECT vei.CD_VEICULO,
                vei.DS_MODELO || ' - ' || vei.DS_PLACA AS DS_VEICULO 
                FROM portal_check_car.VEICULO vei";
                $res_veiculo = oci_parse($conn_ora, $consulta_veiculo);
                oci_execute($res_veiculo);

                
                while($row_vei = oci_fetch_array($res_veiculo)){

                    echo '<option value="' . $row_vei['CD_VEICULO'] . '">' . $row_vei['DS_VEICULO'] . '</option>';

                }

            ?>
        
        </select>

        <div class="div_br"></div>
        <div class="div_br"></div>
    
    </div>

    <div class="col-md-2">
        Kilometragem:
        <input type="number" class="form form-control" id="km" maxlength="100">

        <div class="div_br"></div>
        <div class="div_br"></div>

    </div>
    
    <div class="col-md-3">

        Motorista:
        <input type="text" class="form form-control" id="motorista" value="<?php echo $nm_logado; ?>" readonly>

        <div class="div_br"></div>
        <div class="div_br"></div>


    </div>

 </div>