<?php

//CHAMANDO CONEXÃO 
include '../../conexao.php';

//CONSULTA
$cons_tabela = "SELECT vei.CD_ITEM_VEICULO,
                       vei.DS_ITEM_VEICULO,
                       TO_CHAR(vei.HR_CADASTRO, 'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO 
                FROM portal_check_car.item_veiculo vei
                WHERE vei.SN_PADRAO <> 'S'
                ORDER BY 1 ASC";
$res_tabela = oci_parse($conn_ora, $cons_tabela);
              oci_execute($res_tabela);

?>

<!--
<table class="table table-striped " style="text-align: center;">

    <thead>

        <th style="text-align: center;"> Item</th>
        <th style="text-align: center;"> Hr Cadastro</th>
        <th style="text-align: center;"> Ações</th>

    </thead>


    <tbody>

    
    <?php

        /*
        while($row = oci_fetch_array($res_tabela)){

            echo '<tr style="text-align: center;">';

            echo '<td class="align-middle" style="text-align: center;">'  .  $row['DS_ITEM_VEICULO'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row['HR_CADASTRO'] . '</td>';

            
            ?>

            <td><button onclick="ajax_alert('Deseja excluir este item?','ajax_deleta_item(<?php echo $row['CD_ITEM_VEICULO']; ?>)')" class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button></td>


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

        while($row_table = oci_fetch_array($res_tabela)){

    ?>

            <div class="col-12 col-md-4" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
   
   <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-screwdriver"></i> ' . $row_table['DS_ITEM_VEICULO'] . '</b></div>';
    ?>           
                    <div onclick="ajax_alert('Deseja excluir este item?','ajax_deleta_item(<?php echo $row_table['CD_ITEM_VEICULO']; ?>)')" class="mini_caixa_chamado" style="float: right !important; color: #f64848 !important; background-color: #ffffff !important;"><i class="fa-solid fa-trash"></i></div>
    <?php              
                    echo '<div class="mini_caixa_chamado"><b><i class="fa-regular fa-clock"></i> ' . $row_table['HR_CADASTRO'] . '</b></div>';

                    echo '<div style="clear: both;"></div>';
                    

                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>
