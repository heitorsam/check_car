<?php

    include '../../conexao.php';

    $cons_chamado_desig = "SELECT (SELECT 
                                         (SELECT usu.NM_USUARIO FROM dbasgu.USUARIOS usu WHERE usu.CD_USUARIO = usux.CD_USUARIO_MV) AS NM_USU 
                                   FROM portal_check_car.USUARIO usux
                                   WHERE usux.TP_STATUS = 'A'
                                   AND usux.CD_USUARIO = cd.CD_MOTORISTA) NM_MOTORISTA,
                                   cd.CD_OS_MV,
                                   TO_CHAR(cd.HR_CADASTRO,'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO,
                                   cd.CD_CHAMADO_DESIGNADO,
                                   cd.TP_STATUS_CHAMADO
                           FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                           WHERE cd.CD_CHAMADO_DESIGNADO NOT IN (SELECT cdx.CD_CHAMADO_DESIGNADO
                                      FROM portal_check_car.CHAMADOS_DESIGNADOS cdx
                                      WHERE cdx.TP_STATUS_CHAMADO = 'C')
                           AND cd.TP_STATUS_CHAMADO IN ('D','A')";
    $res_desig = oci_parse($conn_ora, $cons_chamado_desig);
                 oci_execute($res_desig);

?>

<!--
<table class="table table-striped " style="text-align: center;">

<thead>

    <th style="text-align: center;"> Motorista</th>
    <th style="text-align: center;"> OS</th>
    <th style="text-align: center;"> Recebimento</th>
    <th style="text-align: center;"> Ações</th>

</thead>


<tbody>


<?php
/*
    while($row_table = oci_fetch_array($res_desig)){

        echo '<tr style="text-align: center;">';

            echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['NM_MOTORISTA'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['CD_OS_MV'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['HR_CADASTRO'] . '</td>';

            if($row_table['TP_STATUS_CHAMADO'] == 'A' || $row_table['TP_STATUS_CHAMADO'] == 'C'){

                echo '<td class="align-middle" style="text-align: center;"><button style="background-color:#b7b7b7 !important;  border-color: #b7b7b7 !important;" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button></td>';

            }else{

                echo '<td class="align-middle" style="text-align: center;"><button onclick="ajax_modal_update_motorista(' . $row_table['CD_CHAMADO_DESIGNADO'] . ')" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button></td>';

            }
           

        echo '</tr>';

    }
    */
?>



</tbody>

</table>

-->

<div class="row">

    <?php

        while($row_table = oci_fetch_array($res_desig)){
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div onclick="ajax_detalhe_os(' . $row_table['CD_OS_MV'] . ')" class="mini_caixa_chamado"><b>OS: ' . $row_table['CD_OS_MV'] . '</b></div>';
                    
                    if($row_table['TP_STATUS_CHAMADO'] == 'A' || $row_table['TP_STATUS_CHAMADO'] == 'C'){

                        echo '<div class="mini_caixa_chamado" style="float: right !important; color: #f64848 !important; background-color: #ffffff !important;"><i class="fa-solid fa-car"></i></div>';

                    }else{

                        echo '<div class="mini_caixa_chamado" style="float: right !important; color: #f64848 !important; background-color: #ffffff !important;" onclick="ajax_modal_update_motorista(' . $row_table['CD_CHAMADO_DESIGNADO'] . ')"><i class="fa-solid fa-pen-to-square"></i></div>';
                    
                    }

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-regular fa-id-card"></i> ' . $row_table['NM_MOTORISTA'] . '</b></div>';

                    echo '<div style="font-size: 12px !important; "class="mini_caixa_chamado"><b><i class="fa-regular fa-clock"></i></b> ' . $row_table['HR_CADASTRO'] . '</div>';  

                    echo '<div style="clear: both;"></div>';
                    
                    

                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>


