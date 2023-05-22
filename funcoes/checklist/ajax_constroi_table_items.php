<?php 

//CHAMANDO CONEXÃO 
include '../../conexao.php';

//RECEBENDO VARIAVEL
$var_seq = $_GET['seq'];

//CONSULTA ITEM PARA CONSTRUIR TABELA
$cons_item_tab = "SELECT iv.CD_ITEM_VEICULO,
                         iv.DS_ITEM_VEICULO,
                         itc.DS_RESPOSTA
                  FROM portal_check_car.ITCHECKLIST itc
                  INNER JOIN portal_check_car.ITEM_VEICULO iv
                     ON iv.CD_ITEM_VEICULO = itc.CD_ITEM_VEICULO
                  WHERE itc.CD_CHECKLIST = $var_seq
                  AND iv.SN_PADRAO = 'N'
                  ORDER BY iv.CD_ITEM_VEICULO ASC";

$res_item_tab  = oci_parse($conn_ora, $cons_item_tab);
             oci_execute($res_item_tab);


?>

<table class="table table-striped " style="text-align: center;">

    <thead>

        <th style="text-align: center;"> Item</th>
        <th style="text-align: center;"> Situacao</th>
        <th style="text-align: center;"> Ações</th>

    </thead>


    <tbody>

    
    <?php

        while($row_table = oci_fetch_array($res_item_tab)){

            echo '<tr style="text-align: center;">';

            echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['DS_ITEM_VEICULO'] . '</td>';
            
            if($row_table['DS_RESPOSTA'] == 'DANIFICADO'){

                echo '<td class="align-middle" style="text-align: center;">'.'<i class="fa-solid fa-screwdriver-wrench"></i>'.'</td>';

            }

            echo '<td class="align-middle" style="text-align: center;">' . '<button onclick="ajax_deleta_item_table(' . $row_table['CD_ITEM_VEICULO'] . ')"class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button>' . '</td>';


            echo '</tr>';

        }

    ?>


        

    </tbody>

</table>