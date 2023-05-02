<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //CHAMANDO CONSULTA
    $cons_moto = "SELECT usux.CD_USUARIO,
                         usux.CD_USUARIO_MV,
                         (SELECT usu.NM_USUARIO FROM dbasgu.USUARIOS usu WHERE usu.CD_USUARIO = usux.CD_USUARIO_MV) AS NM_USU 
                  FROM portal_check_car.USUARIO usux
                  WHERE usux.TP_STATUS = 'A'";
    $res_moto = oci_parse($conn_ora, $cons_moto);
                oci_execute($res_moto);

    


?>


<select id="motorista_indicado" class="form form-control">

    <option value="All">Selecione</option>

    <?php

        while($row_motorista = oci_fetch_array($res_moto)){

            echo '<option value="'. $row_motorista['CD_USUARIO'] . '">'. $row_motorista['NM_USU'] . '</option>';

        }


    ?>

<select>