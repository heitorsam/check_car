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
                                AND (SELECT solaux.TP_SITUACAO
                                    FROM dbamv.SOLICITACAO_OS solaux
                                    WHERE solaux.CD_OS = cd.CD_OS_MV) = 'S'                                     
                                AND cd.TP_STATUS_CHAMADO = 'D'";
                                
    $res_pendentes = oci_parse($conn_ora, $cons_usuario_pendentes);
    oci_execute($res_pendentes);

?>

<div class="row">


    <?php

        $varcontrole = 0;

        while($row_table = oci_fetch_array($res_pendentes)){

            $varcontrole = $varcontrole + 1 
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div onclick="ajax_exite_det_os('. $row_table['CD_OS_MV'] .')" class="mini_caixa_chamado"><b>OS ' . $row_table['CD_OS_MV'] . '</b></div>';

                    echo '<div onclick="ajax_exite_det_os('. $row_table['CD_OS_MV'] .')" class="mini_caixa_chamado">' . $row_table['HR_DESIGNACAO'] . '</div>';  
    ?>
                    <div onclick="ajax_alert('Deseja começar esta corrida?','ajax_abre_modal_inicio(<?php echo $row_table['CD_CHAMADO_DESIGNADO']; ?>,<?php echo $row_table['CD_OS_MV']; ?>,\'<?php echo $row_table['CD_USUARIO_MV']; ?>\',<?php echo $row_table['CD_MOTORISTA']; ?>)')" class="mini_caixa_chamado" style="position: relative; float: right;"><i style="color: #ff7070;" class="fa-solid fa-play"></i></div>

    <?php
                    echo '<div onclick="ajax_exite_det_os('. $row_table['CD_OS_MV'] .')" class="mini_caixa_chamado">' . $row_table['NM_SOLICITANTE'] . '</div>';
                    
                    echo '<div style="clear: both;"></div>';

                   

                echo '</div>';

                
                
            echo '</div>';

   

        }
        
        if($varcontrole == 0){

        ?>

           <div class="col-12 col-md-4" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
        
        <?php
        
                 echo '<div class="lista_home_itens_pend" style="cursor:pointer; text-align: left;">';

                    echo '<div style="padding-left: 6px !important;">Você não possui chamados pendentes</div>';
                    
                    echo '<div style="clear: both;"></div>';

                   

                echo '</div>';

                
                
            echo '</div>';

 
        }



    ?>

</div>