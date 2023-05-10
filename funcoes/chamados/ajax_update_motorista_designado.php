<?php


    include '../../conexao.php';

    //RECEBENDO VARIAVEIS
    $var_chamado = $_POST['js_chamado'];
    $var_motorista = $_POST['js_cd_motorista'];

    //CONSULTA QUE RODA UPDATE
    $cons_update_mot = "UPDATE
                        portal_check_car.CHAMADOS_DESIGNADOS cd
                        SET
                        cd.CD_MOTORISTA = $var_motorista
                        WHERE
                        cd.CD_CHAMADO_DESIGNADO = $var_chamado";
    $res_update_mot = oci_parse($conn_ora, $cons_update_mot);
                      oci_execute($res_update_mot);


?>