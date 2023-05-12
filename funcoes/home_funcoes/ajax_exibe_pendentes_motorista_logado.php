<?php 

    //CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL DO USUARIO LOGADO
    $var_logado = $_GET['js_usuario_logado'];

    $cons_usuario_pendentes = "SELECT cd.CD_OS_MV,
                                    TO_CHAR(cd.HR_CADASTRO,'DD/MM/YYYY HH24:MI:SS') AS HR_DESIGNACAO,

                                    (SELECT usu.CD_USUARIO_MV 
                                    FROM portal_check_car.USUARIO usu WHERE usu.CD_USUARIO = cd.CD_MOTORISTA) AS CD_USUARIO_MV,
                                    
                                    (SELECT usu.NM_USUARIO
                                    FROM dbamv.SOLICITACAO_OS sol 
                                    INNER JOIN dbasgu.USUARIOS usu
                                        ON usu.CD_USUARIO = sol.NM_USUARIO
                                    WHERE sol.CD_OS = cd.CD_OS_MV) AS NM_SOLICITANTE,

                                    cd.CD_CHAMADO_DESIGNADO,
                                    cd.CD_MOTORISTA
                                    
                                FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                                INNER JOIN portal_check_car.USUARIO usu
                                ON usu.CD_USUARIO = cd.CD_MOTORISTA
                                WHERE usu.CD_USUARIO_MV = '$var_logado'
                                AND cd.TP_STATUS_CHAMADO = 'D'";
    $res_pendentes = oci_parse($conn_ora, $cons_usuario_pendentes);
                     oci_execute($res_pendentes);


?>




<div class="row">

    <?php

        while($row_table = oci_fetch_array($res_pendentes)){
    ?>
            <div onclick="ajax_alert('Deseja começar esta corrida?','ajax_motorista_recebe_designacao(<?php echo $row_table['CD_CHAMADO_DESIGNADO']; ?>,<?php echo $row_table['CD_OS_MV']; ?>,\'<?php echo $row_table['CD_USUARIO_MV']; ?>\',<?php echo $row_table['CD_MOTORISTA']; ?>)')" 
                 class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div class="mini_caixa_chamado"><b>OS ' . $row_table['CD_OS_MV'] . '</b></div>';

                    echo '<div class="mini_caixa_chamado">' . $row_table['HR_DESIGNACAO'] . '</div>';  

                    echo '<div class="mini_caixa_chamado">' . $row_table['NM_SOLICITANTE'] . '</div>';
                    
                    echo '<div style="clear: both;"></div>';

                    

                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>

<!--
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['CD_OS_MV'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['HR_DESIGNACAO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['NM_SOLICITANTE'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;"><button onclick="ajax_inicia_corrida_motorista(' . $row_table['CD_OS_MV'] . ')"class="btn btn-primary"><i class="fa-solid fa-car-side"></i></button></td>';
-->