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


  
<table class="table table-striped " style="text-align: center;">

    <thead>

        <th style="text-align: center;"> Descrição</th>
        <th style="text-align: center;"> Descrição</th>
        <th style="text-align: center;"> Hexadecimal</th>
        <th style="text-align: center;"> Ações</th>

    </thead>


    <tbody>

    
    <?php

        while($row = oci_fetch_array($res_cons_tabela_cor)){

            echo '<tr style="text-align: center;">';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row['DS_COR'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">' . "<i class='fa-solid fa-circle' style='text-shadow: 1px 1px 1px #4f5050ab; color: " . $row['DS_RGB'] . "'></i> " . '</td>';


            

            
            echo '<td class="align-middle" style="text-align: center;">'  .  $row['DS_RGB'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">' . '<button onclick="ajax_deleta_cor(' . $row['CD_COR'] . ')"class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button>' . '</td>';


            echo '</tr>';

        }

    ?>


        

    </tbody>

</table>





