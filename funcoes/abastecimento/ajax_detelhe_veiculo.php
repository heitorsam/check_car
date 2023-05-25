<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //CHAMANDO SESSÃO
    session_start();

    //RECEBENDO USUARIO DA SESSÃO
    $usuario = $_SESSION['usuarioLogin'];
    $usuarioNome = $_SESSION['usuarioNome'];
    
    //RECEBENDO VARIAVEL
    $var_cd_veiculo = $_GET['cd_veiculo'];


    //CONSULTA PARA EXIBIR OS VEICULOS CADASTRADOS NO SELECT
    $cons_veiculo = "SELECT vei.CD_VEICULO,
                            vei.DS_MODELO,
                            vei.DS_ANO,
                            vei.DS_PLACA,
                            vei.KM
                        FROM portal_check_car.VEICULO vei
                        WHERE vei.TP_STATUS = 'A'";

                        if($var_cd_veiculo <> 'All'){

                        $cons_veiculo .=   " AND vei.CD_VEICULO = $var_cd_veiculo";

                        }
                        
    $res_veiculo = oci_parse($conn_ora, $cons_veiculo);
                   oci_execute($res_veiculo);
    $row_vei = oci_fetch_array($res_veiculo)


?>

<div class="div_br"> </div> 

<div class="row">

    <div class="col-md-3 ">

        Modelo:
        <input id="model" type="text" style="text-align: center;" class="form-control" value="<?php if($var_cd_veiculo <> 'All'){ echo $row_vei['DS_MODELO']; }else{ echo '-'; }  ?>" readonly>
        <div class="div_br"> </div>
    </div>

    <div class="div_br"> </div>

    <div class="col-md-3 ">

        Placa:
        <input id="placa" type="text" style="text-align: center;" class="form-control" value="<?php if($var_cd_veiculo <> 'All'){ echo $row_vei['DS_PLACA']; }else{ echo '-'; }  ?>" readonly>
        <div class="div_br"> </div>
    </div>

    <div class="div_br"> </div>

    <div class="col-md-3 ">

        Motorista:
        <input id="Motorista" type="text" style="text-align: center;" class="form-control" value="<?php if($var_cd_veiculo <> 'All'){ echo $usuarioNome; }else{ echo '-'; }  ?>" readonly>
        <div class="div_br"> </div>
    </div>

    <div class="div_br"> </div>

</div>

<div class="row">

    <div class="div_br"> </div>

    <div class="col-md-3 ">

        Litros:
        <input type="number" style="text-align: center;" class="form-control" id="litro_abastacimento" maxlength="100">
        <div class="div_br"> </div>

    </div>

    <div class="div_br"> </div>

    <div class="col-md-3 ">

        Valor:
        <input type="number" style="text-align: center;" class="form-control" id="valor_abastacimento" maxlength="100">
        <div class="div_br"> </div>

    </div>

</div>
<div class="div_br"> </div>

<?php 
if($var_cd_veiculo <> 'All'){

?>

<div style="width: 100%; display: flex; justify-content: center; align-items: center;">

    <button style="margin: 0 auto;" class='btn btn-primary' onclick="ajax_confirma_abastecimento()"><i class="fa-solid fa-check"></i> Confirmar</button>

</div>



<?php 

}else{

?>


<div style="width: 100%; display: flex; justify-content: center; align-items: center;">

    <button style="margin: 0 auto; background-color: #aeb3b9 !important; border-color: #aeb3b9 !important;" class='btn btn-primary'><i class="fa-solid fa-check"></i> Confirmar</button>

</div>



<?php

}

?>
