<?php

//CHAMANDO CONEXÃO 
include '../../conexao.php';

//CONSULTA
$cons_tabela = "SELECT vei.CD_ITEM_VEICULO,
                       vei.DS_ITEM_VEICULO,
                       TO_CHAR(vei.HR_CADASTRO, 'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO 
                FROM portal_check_car.item_veiculo vei
                ORDER BY 1 ASC";
$res_tabela = oci_parse($conn_ora, $cons_tabela);
              oci_execute($res_tabela);

?>

<table class="table table-striped " style="text-align: center;">

    <thead>

        <th style="text-align: center;"> Item</th>
        <th style="text-align: center;"> Hr Cadastro</th>
        <th style="text-align: center;"> Ações</th>

    </thead>


    <tbody>

    
    <?php

        while($row = oci_fetch_array($res_tabela)){

            echo '<tr style="text-align: center;">';

            echo '<td class="align-middle" style="text-align: center;">'  .  $row['DS_ITEM_VEICULO'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row['HR_CADASTRO'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">' . '<button onclick="ajax_deleta_item(' . $row['CD_ITEM_VEICULO'] . ')"class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button>' . '</td>';


            echo '</tr>';

        }

    ?>


        

    </tbody>

</table>