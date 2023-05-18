<?php

    include '../../conexao.php';

    $cons_tabela_cor = "SELECT cor.CD_COR,
                               cor.DS_COR,
                               cor.DS_RGB
                        FROM portal_check_car.COR cor
                        ORDER BY 1 ASC";

    $res_cons_tabela_cor = oci_parse($conn_ora, $cons_tabela_cor);
                           oci_execute($res_cons_tabela_cor);

?>


 <!-- 
<table class="table table-striped " style="text-align: center;">

    <thead>

        <th style="text-align: center;"> Descrição</th>
        <th style="text-align: center;"> Descrição</th>
        <th style="text-align: center;"> Hexadecimal</th>
        <th style="text-align: center;"> Ações</th>

    </thead>


    <tbody>

    
    <?php
        /*

        while($row = oci_fetch_array($res_cons_tabela_cor)){



            echo '<tr style="text-align: center;">';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row['DS_COR'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">' . "<i class='fa-solid fa-circle' style='text-shadow: 1px 1px 1px #4f5050ab; color: " . $row['DS_RGB'] . "'></i> " . '</td>';


            

            
            echo '<td class="align-middle" style="text-align: center;">'  .  $row['DS_RGB'] . '</td>';

            ?>

                <td><button onclick="ajax_alert('Deseja excluir esta cor?','ajax_deleta_cor(<?php echo $row['CD_COR']; ?>)')" class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button></td>


            <?php


            echo '</tr>';

        }

        */
    ?>

    </tbody>

</table>

-->


<div class="row">

    <?php

        while($row_table = oci_fetch_array($res_cons_tabela_cor)){
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-palette"></i> ' . $row_table['DS_COR'] . '</b></div>';
    ?>


                <div onclick="ajax_alert('Deseja excluir esta cor?','ajax_deleta_cor(<?php echo $row_table['CD_COR']; ?>)')" class="mini_caixa_chamado" style="float: right !important; color: #f64848 !important; background-color: #ffffff !important;"><i class="fa-solid fa-trash"></i></div>
    
    <?php
                    echo '<div class="mini_caixa_chamado"><i style="text-shadow: 1px 1px 1px #4f5050ab; color:' . $row_table['DS_RGB']. ' " class="fa-solid fa-droplet"></i></div>';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-eye-dropper"></i> ' . $row_table['DS_RGB'] . '</b></div>';

                    echo '<div style="clear: both;"></div>';
                    
                    

                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>






