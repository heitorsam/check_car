<?php

    include '../../conexao.php';

    $cons_chamado_desig = "SELECT (SELECT 
                                         (SELECT usu.NM_USUARIO FROM dbasgu.USUARIOS usu WHERE usu.CD_USUARIO = usux.CD_USUARIO_MV) AS NM_USU 
                                   FROM portal_check_car.USUARIO usux
                                   WHERE usux.TP_STATUS = 'A'
                                   AND usux.CD_USUARIO = cd.CD_MOTORISTA) NM_MOTORISTA,
                                   cd.CD_OS_MV,
                                   TO_CHAR(cd.HR_CADASTRO,'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO,
                                   cd.CD_CHAMADO_DESIGNADO
                           FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                           WHERE cd.CD_CHAMADO_DESIGNADO NOT IN (SELECT cdx.CD_CHAMADO_DESIGNADO
                                      FROM portal_check_car.CHAMADOS_DESIGNADOS cdx
                                      WHERE cdx.TP_STATUS_CHAMADO = 'C')";
    $res_desig = oci_parse($conn_ora, $cons_chamado_desig);
                 oci_execute($res_desig);

?>

<table class="table table-striped " style="text-align: center;">

<thead>

    <th style="text-align: center;"> Motorista</th>
    <th style="text-align: center;"> OS</th>
    <th style="text-align: center;"> Recebimento</th>
    <th style="text-align: center;"> Ações</th>

</thead>


<tbody>


<?php

    while($row_table = oci_fetch_array($res_desig)){

        echo '<tr style="text-align: center;">';

            echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['NM_MOTORISTA'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['CD_OS_MV'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['HR_CADASTRO'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;"><button onclick="ajax_modal_update_motorista(' . $row_table['CD_CHAMADO_DESIGNADO'] . ')"class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button></td>';

        echo '</tr>';

    }

?>


    

</tbody>

</table>