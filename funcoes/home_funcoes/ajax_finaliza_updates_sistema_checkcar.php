<?php

    session_start();

    include '../../conexao.php';

    //RECEBENDO VARIAVEIS
    $var_chamado = $_POST['global_chamados'];
    $status = $_POST['js_status'];
    $var_km = $_POST['js_km_retorno'];
    $usuario = $_SESSION['usuarioLogin'];

    $cons_update_chamados = "UPDATE
                                portal_check_car.CHAMADOS_DESIGNADOS cd
                            SET
                                cd.TP_STATUS_CHAMADO = '$status'
                            WHERE
                                cd.CD_CHAMADO_DESIGNADO = $var_chamado";

    $res_update_chamados = oci_parse($conn_ora, $cons_update_chamados);
                           oci_execute($res_update_chamados);
                                

    $cons_update_sai_ret = "UPDATE
                            portal_check_car.SAI_RET_VEICULO srv
                        SET
                        srv.HR_RETORNO = SYSDATE,
                        srv.KM_RETORNO = '$var_km'
                        WHERE
                            srv.CD_CHAMADO_DESIGNADO = '$var_chamado'";
    $res_update_sai_ret = oci_parse($conn_ora, $cons_update_sai_ret);
                          oci_execute($res_update_sai_ret);



?>