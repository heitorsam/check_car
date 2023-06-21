<?php

    session_start();

    include '../../conexao.php';

    $nm_logado = $_SESSION['usuarioNome'];

    $cd_usuario_logado = $_SESSION['usuarioLogin'];

    $cons_verif_check_in = "SELECT vc.*, cor.DS_RGB
                                FROM portal_check_car.CHECKLIST ck
                            INNER JOIN portal_check_car.VEICULO vc
                                ON vc.CD_VEICULO = ck.CD_VEICULO
                            INNER JOIN portal_check_car.COR cor
                                ON cor.CD_COR = vc.CD_COR
                            WHERE ck.CD_CHECKLIST IN
                                    (SELECT MAX(ack.CD_CHECKLIST)
                                        FROM portal_check_car.CHECKLIST ack
                                    WHERE ack.CD_USUARIO_CADASTRO = '$cd_usuario_logado')
                                AND ck.TP_CHECKLIST = 'S'";
    $res_check_in = oci_parse($conn_ora, $cons_verif_check_in);
                    oci_execute($res_check_in);

    $row_checkin = oci_fetch_array($res_check_in);

    

?>

<div class="col-md-3">

    <input type="text" id="veiculo_saida" value="<?php echo $row_checkin['CD_VEICULO']; ?>" hidden>

</div>

<div class="row">
                    

    <div class="col-md-3">
        Veiculo:
        <input type="text" class="form form-control" value="<?php echo $row_checkin['DS_MODELO'] . ' / ' . $row_checkin['DS_PLACA'] ?>" readonly>

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