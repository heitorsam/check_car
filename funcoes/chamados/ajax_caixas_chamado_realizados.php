<?php

    include '../../conexao.php';

    //RECEBENDO VARIAVEIS
    $data1 = $_GET['data1'];
    $data2 = $_GET['data2'];
    $setor = $_GET['setor'];
    $solicitante = $_GET['solicitante'];

    $data_format_1 = $data1;
    $data_format_2 = $data2;

    $ini_date = date("d/m/Y", strtotime($data_format_1));

    $fim_date = date("d/m/Y", strtotime($data_format_2));

    $cons_chamado_desig = "SELECT (SELECT 
                                         (SELECT usu.NM_USUARIO FROM dbasgu.USUARIOS usu WHERE usu.CD_USUARIO = usux.CD_USUARIO_MV) AS NM_USU 
                                   FROM portal_check_car.USUARIO usux
                                   WHERE usux.CD_USUARIO = cd.CD_MOTORISTA) NM_MOTORISTA,
                                   cd.CD_OS_MV,
                                   TO_CHAR(cd.HR_CADASTRO,'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO,
                                   cd.CD_CHAMADO_DESIGNADO,
                                   cd.CD_OS_MV
                           FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                           INNER JOIN dbamv.SOLICITACAO_OS os
                             ON os.CD_OS = cd.CD_OS_MV
                           WHERE cd.TP_STATUS_CHAMADO = 'C'";

                           if($setor > 0){

                             $cons_chamado_desig .=" AND os.CD_SETOR = $setor ";

                           }  
                           
                           if($solicitante > 0){

                            $cons_chamado_desig .=" AND os.NM_SOLICITANTE = '$solicitante' ";

                          }   

                           $cons_chamado_desig .=" AND TO_CHAR(cd.HR_CADASTRO,'DD/MM/YYYY') BETWEEN '$ini_date' AND '$fim_date'
                           ORDER BY cd.CD_CHAMADO_DESIGNADO DESC";
    $res_desig = oci_parse($conn_ora, $cons_chamado_desig);
                 oci_execute($res_desig);

?>


<div class="row">

    <?php

        while($row_table = oci_fetch_array($res_desig)){
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div onclick="ajax_detalhe_os(' . $row_table['CD_OS_MV'] . ')" class="mini_caixa_chamado"><b>OS: ' . $row_table['CD_OS_MV'] . '</b></div>';

                    echo '<div onclick="ajax_detalhe_chamado(' . $row_table['CD_CHAMADO_DESIGNADO'] . ')" class="mini_caixa_chamado" style="float: right !important; color: #f64848 !important; background-color: #ffffff !important;"><i class="fa-solid fa-car"></i></div>';
                    
                    echo '<div class="mini_caixa_chamado"><b><i class="fa-regular fa-id-card"></i> ' . $row_table['NM_MOTORISTA'] . '</b></div>';

                    echo '<div style="font-size: 11px !important; "class="mini_caixa_chamado"><i class="fa-regular fa-clock"></i> ' . $row_table['HR_CADASTRO'] . '</div>';  

                    echo '<div style="clear: both;"></div>';
                    
                    

                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>
