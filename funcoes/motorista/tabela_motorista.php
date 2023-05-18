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

<!--
  
<table class="table table-striped " style="text-align: center;">

    <thead>

        <th style="text-align: center;"> Detalhes</th>
        <th style="text-align: center;"> Usuario</th>
        <th style="text-align: center;"> Plantão</th>
        <th style="text-align: center;"> Status</th>
        <th style="text-align: center;"> Ações</th>

    </thead>


    <tbody>

    
    <?php

        /*
        while($row = oci_fetch_array($res_cons_tabela_usu)){

            echo '<tr style="text-align: center;">';

                echo '<td class="align-middle" style="text-align: center;">'  .'<i style="cursor: pointer;" onclick="ajax_chama_detalhes_motorista(' . $row['CD_USUARIO'] . ')"class="fa-regular fa-circle-question"></i>'. '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row['CD_USUARIO_MV'] . '</td>';

                if($row['TP_PLANTAO'] == 'D'){

                    echo '<td class="align-middle" style="text-align: center;">'  .  '<i style=" color: #e9ca73;" class="fa-solid fa-sun"></i>' . '</td>';
            
                }else{

                    echo '<td class="align-middle" style="text-align: center;">'  .  '<i style="color: #ad4bb9;" class="fa-solid fa-moon"></i>' . '</td>';

                }
                
                if($row['TP_STATUS'] == 'A'){


                    echo '<td class="align-middle" style="text-align: center;">' . '<i style=" color: #79c332; cursor: pointer; font-size: 20px;" class="fa-solid fa-toggle-on"' ;

                    ?>

                        onclick="ajax_inativar_motorista( <?php echo $row['CD_USUARIO']; ?>,'<?php echo $row['TP_STATUS']; ?>')"

                                    <?php

                   echo '></i>' . '</td>';
                
                
                
                }else{

                    echo '<td class="align-middle" style="text-align: center;">' . '<i style=" color: #dd9696; cursor: pointer; font-size: 20px; "class="fa-solid fa-toggle-off"' ;

                    ?>

                        onclick="ajax_inativar_motorista( <?php echo $row['CD_USUARIO']; ?>,'<?php echo $row['TP_STATUS']; ?>')"

                    <?php

                   echo '></i></button>' . '</td>';

                }

                if($row['QTD_OS_ATENDIDA'] == 0){


                ?>

                    <td><button onclick="ajax_alert('Deseja excluir este motorista?','ajax_deletar_motorista(<?php echo $row['CD_USUARIO']; ?>)')" class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button></td>


                <?php

                }else{

                    echo '<td class="align-middle" style="text-align: center;">' . '<button onclick="ajax_mensagem()" style="border-color: #aeb3b9 !important; background-color: #aeb3b9 !important" class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button>' . '</td>';

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

    while($row_table = oci_fetch_array($res_cons_tabela_usu)){
?>
        <div class="col-12 col-md-6" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
<?php
            echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                echo '<div onclick="ajax_chama_detalhes_motorista(' . $row_table['CD_USUARIO'] . ')" class="mini_caixa_chamado"><i class="fa-solid fa-user-tag"></i></div>';
                echo '<div class="mini_caixa_chamado"><b>' . $row_table['NM_MOTORISTA'] . '</b></div>';

                if($row_table['TP_PLANTAO'] == 'D'){

                    echo '<div class="mini_caixa_chamado"><b>' . '<i style="color: purple;" class="fa-solid fa-moon"></i>' . '</b></div>';

                }else{

                    
                    echo '<div class="mini_caixa_chamado"><b>' . '<i style=" color: orange;" class="fa-solid fa-sun"></i>' . '</b></div>';

                }

                if($row_table['TP_STATUS'] == 'A'){

?>
                    <div onclick="ajax_inativar_motorista('<?php echo $row_table['CD_USUARIO']; ?>','<?php echo $row_table['TP_STATUS']; ?>')" class="mini_caixa_chamado"><i style="color: #79c332; cursor: pointer; font-size: 20px; " class="fa-solid fa-toggle-on"></i></div>

<?php
                
                }else{
?>


                   <div onclick="ajax_inativar_motorista('<?php echo $row_table['CD_USUARIO']; ?>','<?php echo $row_table['TP_STATUS']; ?>')" class="mini_caixa_chamado"><i style="color: #dd9696; cursor: pointer; font-size: 20px; " class="fa-solid fa-toggle-off"></i></div>

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
