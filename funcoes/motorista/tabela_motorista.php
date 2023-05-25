<?php

    include '../../conexao.php';

    $cons_tabela_usu = "SELECT usu.CD_USUARIO,
                               usu.CD_USUARIO_MV,
                               (SELECT usumv.NM_USUARIO
                                FROM dbasgu.USUARIOS usumv WHERE usumv.CD_USUARIO = usu.CD_USUARIO_MV) AS NM_MOTORISTA,
                               usu.TP_PLANTAO,
                               usu.TP_STATUS,
                               usu.BLOB_FOTO,
                               cdX.QTD_OS_ATENDIDA 
                        FROM portal_check_car.USUARIO usu
                        LEFT JOIN (SELECT cd.CD_MOTORISTA,
                                            COUNT(*) AS QTD_OS_ATENDIDA 
                                   FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                                   GROUP BY cd.CD_MOTORISTA) cdX
                                   ON cdX.CD_MOTORISTA = usu.CD_USUARIO
                        ORDER BY 1 ASC";

    $res_cons_tabela_usu = oci_parse($conn_ora, $cons_tabela_usu);
                           oci_execute($res_cons_tabela_usu);

?>

<div class="row">

<?php

    while($row_table = oci_fetch_array($res_cons_tabela_usu)){
?>
        <div class="col-12 col-md-6" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
<?php
            echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                echo '<div onclick="ajax_chama_detalhes_motorista(' . $row_table['CD_USUARIO'] . ')" class="mini_caixa_chamado"><i class="fa-solid fa-user-tag"></i></div>';
                echo '<div class="mini_caixa_chamado"><b>' . $row_table['NM_MOTORISTA'] . '</b></div>';

                if($row_table['TP_PLANTAO'] == 'D'){
?>
                    <div class="mini_caixa_chamado"><b><i onclick="ajax_edita_plantao('1','<?php echo $row_table['CD_USUARIO'] ?>')" style="color: orange;" class="fa-solid fa-sun"></i></b></div>

<?php
                }else{

?>                

                    <div class="mini_caixa_chamado"><b><i onclick="ajax_edita_plantao('2','<?php echo $row_table['CD_USUARIO'] ?>')" style="color: purple;" class="fa-solid fa-moon"></i></b></div>

<?php
                }

                if($row_table['TP_STATUS'] == 'A'){

?>
                    <div onclick="ajax_inativar_motorista('<?php echo $row_table['CD_USUARIO']; ?>','<?php echo $row_table['TP_STATUS']; ?>')" class="mini_caixa_chamado"><i style="color: #79c332; cursor: pointer; font-size: 15px; " class="fa-solid fa-toggle-on"></i></div>

<?php
                
                }else{
?>


                   <div onclick="ajax_inativar_motorista('<?php echo $row_table['CD_USUARIO']; ?>','<?php echo $row_table['TP_STATUS']; ?>')" class="mini_caixa_chamado"><i style="color: #dd9696; cursor: pointer; font-size: 15px; " class="fa-solid fa-toggle-off"></i></div>

<?php
                }

                if($row_table['QTD_OS_ATENDIDA'] == 0){

?>
                    <div onclick="ajax_alert('Deseja excluir este motorista?','ajax_deletar_motorista(<?php echo $row_table['CD_USUARIO']; ?>)')" class="mini_caixa_chamado" style="float: right !important; color: #f64848 !important; background-color: #ffffff !important;"><i class="fa-solid fa-trash"></i></div>

<?php
                }

                echo '<div style="clear: both;"></div>';
                
                

            echo '</div>';

            
            
        echo '</div>';

    }

?>

</div>
