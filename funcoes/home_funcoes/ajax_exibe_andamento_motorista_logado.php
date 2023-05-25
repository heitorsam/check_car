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

                                    (SELECT srv.KM_SAIDA
                                     FROM portal_check_car.SAI_RET_VEICULO srv WHERE srv.CD_CHAMADO_DESIGNADO = cd.CD_CHAMADO_DESIGNADO) AS KM_INI_CORRIDA
                                    
                                FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                                INNER JOIN portal_check_car.USUARIO usu
                                ON usu.CD_USUARIO = cd.CD_MOTORISTA
                                WHERE usu.CD_USUARIO_MV = '$var_logado'
                                AND cd.TP_STATUS_CHAMADO = 'A'";
    $res_pendentes = oci_parse($conn_ora, $cons_usuario_pendentes);
                     oci_execute($res_pendentes);


?>

<div class="row">


<!--ajax_motorista_conclui_designacao(\'<?php //echo 'f1'; ?>\',<?php //echo $row_table['CD_CHAMADO_DESIGNADO'];?>,<?php //echo $row_table['CD_OS_MV']; ?>,\'<?php //echo $row_table['CD_USUARIO_MV']; ?>\',\'<?php //echo $row_table['KM_INI_CORRIDA']; ?>\')-->
    <?php

        $varcontrole = 0;

        while($row_table = oci_fetch_array($res_pendentes)){

            $varcontrole = $varcontrole + 1 
    ?>
            <div onclick="ajax_alert('Deseja concluir esta corrida?','ajax_abre_modal_fim(\'<?php echo 'f1'; ?>\',<?php echo $row_table['CD_CHAMADO_DESIGNADO'];?>,<?php echo $row_table['CD_OS_MV']; ?>,\'<?php echo $row_table['CD_USUARIO_MV']; ?>\',\'<?php echo $row_table['KM_INI_CORRIDA']; ?>\')')" 
                 class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_andamento" style="cursor:pointer;">';

                    echo '<div class="mini_caixa_chamado"><b>OS ' . $row_table['CD_OS_MV'] . '</b></div>';

                    echo '<div class="mini_caixa_chamado">' . $row_table['HR_DESIGNACAO'] . '</div>';  

                    echo '<div class="mini_caixa_chamado">' . $row_table['NM_SOLICITANTE'] . '</div>';
                    
                    echo '<div style="clear: both;"></div>';

                echo '</div>';              
                
            echo '</div>';

        }

        if($varcontrole == 0){

            ?>
    
               <div class="col-12 col-md-4" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
            
            <?php
            
                     echo '<div class="lista_home_itens_pend" style="cursor:pointer; text-align: left;">';
    
                        echo '<div style="padding-left: 6px !important;">Você não possui chamados em andamento</div>';
                        
                        echo '<div style="clear: both;"></div>';
    
                       
    
                    echo '</div>';
    
                    
                    
                echo '</div>';
    
     
            }

    ?>

</div>