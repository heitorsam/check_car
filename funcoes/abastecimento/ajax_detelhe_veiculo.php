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
                        WHERE vei.TP_STATUS = 'A'
                        AND vei.CD_VEICULO = $var_cd_veiculo";
    $res_veiculo = oci_parse($conn_ora, $cons_veiculo);
                   oci_execute($res_veiculo);
    $row_vei = oci_fetch_array($res_veiculo)


?>

<div class="div_br"> </div>  

<div class="col-md-12 esconde_btn_desktop">

    Modelo:
    <input type="text" style="text-align: center;" class="form-control" value="<?php echo $row_vei['DS_MODELO']; ?>" readonly>

</div>

<div class="div_br"> </div>

<div class="col-md-12 esconde_btn_desktop">

    Placa:
    <input type="text" style="text-align: center;" class="form-control" value="<?php echo $row_vei['DS_PLACA']; ?>" readonly>

</div>

<div class="div_br"> </div>

<div class="col-md-12 esconde_btn_desktop">

    Motorista:
    <input type="text" style="text-align: center;" class="form-control" value="<?php echo $usuarioNome ?>" readonly>

</div>

<div class="div_br"> </div>

<div class="col-md-12 esconde_btn_desktop">

    Km:
    <input type="text" style="text-align: center;" class="form-control" id="km_abastacimento">

</div>

<div class="div_br"> </div>

<div class="col-md-12 esconde_btn_desktop">

    Litros:
    <input type="text" style="text-align: center;" class="form-control" id="litro_abastacimento">

</div>

<div class="div_br"> </div>

<div class="col-md-12 esconde_btn_desktop">

    Valor:
    <input type="text" style="text-align: center;" class="form-control" id="valor_abastacimento">

</div>

<div class="div_br"> </div>

<div class='col-12 esconde_btn_desktop'>

<div>
    <button style="width: 50%;" class='btn btn-primary'><i class="fa-solid fa-check"></i> Confirmar</button>
    
</div>

</div>