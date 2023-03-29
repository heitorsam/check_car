<?php

    include '../../conexao.php';

    $cons_tabela_usu = "SELECT usu.CD_USUARIO,
                               usu.CD_USUARIO_MV,
                               usu.TP_PLANTAO,
                               usu.TP_STATUS,
                               0 AS QTD_TOTAL,
                               usu.BLOB_FOTO
                        FROM portal_check_car.USUARIO usu
                        ORDER BY 1 ASC";

    $res_cons_tabela_usu = oci_parse($conn_ora, $cons_tabela_usu);
                           oci_execute($res_cons_tabela_usu);

?>


  
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

                if($row['QTD_TOTAL'] == 0){

                    echo '<td class="align-middle" style="text-align: center;">' . '<button onclick="ajax_deletar_motorista(' . $row['CD_USUARIO'] . ')"class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button>' . '</td>';

                }else{

                    echo '<td class="align-middle" style="text-align: center;">' . '<button onclick="ajax_mensagem()" style="border-color: #aeb3b9 !important; background-color: #aeb3b9 !important" class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button>' . '</td>';

                }
                


            echo '</tr>';

        }

    ?>


        

    </tbody>

</table>
