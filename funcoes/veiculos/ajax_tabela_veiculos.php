<?php

    include '../../conexao.php';

   $cons_tabela_veiculo = "SELECT vei.CD_VEICULO,
                               vei.DS_MODELO,
                               vei.DS_ANO,
                               vei.DS_PLACA,
                               vei.TP_STATUS,
                               vei.KM || ' Km' AS KM,
                               (SELECT cor.DS_COR FROM portal_check_car.COR cor WHERE cor.CD_COR = vei.CD_COR) COR,
                               (SELECT cor.DS_RGB FROM portal_check_car.COR cor WHERE cor.CD_COR = vei.CD_COR) RGB
                            FROM portal_check_car.VEICULO vei
                            ORDER BY 1 ASC";

    $res_cons_tabela_veiculo = oci_parse($conn_ora, $cons_tabela_veiculo);
                           oci_execute($res_cons_tabela_veiculo);

?>

<!--
  
<table class="table table-striped " style="text-align: center;">

    <thead>

        <th style="text-align: center;"> Status</th>
        <th style="text-align: center;"> Modelo</th>
        <th style="text-align: center;"> Ano</th>
        <th style="text-align: center;"> Placa</th>
        <th style="text-align: center;"> Km Inicial</th>
        <th style="text-align: center;"> Cor Veiculo</th>

    </thead>


    <tbody>

    
    <?php

        /*
        while($row = oci_fetch_array($res_cons_tabela_veiculo)){

            echo '<tr style="text-align: center;">';

                if($row['TP_STATUS'] == 'A'){


                    echo '<td class="align-middle" style="text-align: center;">' . '<i style=" color: #79c332; cursor: pointer; font-size: 20px;" class="fa-solid fa-toggle-on"' ;

                    ?>

                        onclick="ajax_inativa_veiculo( <?php echo $row['CD_VEICULO']; ?>,'<?php echo $row['TP_STATUS']; ?>')"

                                    <?php

                   echo '></i>' . '</td>';
                
                
                
                }else{

                    echo '<td class="align-middle" style="text-align: center;">' . '<i style=" color: #dd9696; cursor: pointer; font-size: 20px; "class="fa-solid fa-toggle-off"' ;

                    ?>

                        onclick="ajax_inativa_veiculo( <?php echo $row['CD_VEICULO']; ?>,'<?php echo $row['TP_STATUS']; ?>')"

                    <?php

                   echo '></i></button>' . '</td>';

                }

                echo '<td class="align-middle" style="text-align: center;">'  .  $row['DS_MODELO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row['DS_ANO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row['DS_PLACA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row['KM'] . '</td>';
                

                echo '<td class="align-middle" style="text-align: center;">' . "<i class='fa-solid fa-circle' style='text-shadow: 1px 1px 1px #4f5050ab; color: " . $row['RGB'] . "'></i> " . '</td>';


            echo '</tr>';

        }

        */

    ?>


        

    </tbody>

</table>

-->


<div class="row">

    <?php

        while($row_table = oci_fetch_array($res_cons_tabela_veiculo)){
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-caret-right"></i> ' . $row_table['DS_MODELO'] . '</b></div>';
            
    
                    if($row_table['TP_STATUS'] == 'A'){
    ?>

                    <div onclick="ajax_inativa_veiculo(<?php echo $row_table['CD_VEICULO']; ?>,'<?php echo $row_table['TP_STATUS']; ?>')" class="mini_caixa_chamado" style="float: right !important; color: #79c332 !important; background-color: #ffffff !important;"><i style=" color: #79c332; cursor: pointer; font-size: 20px;" class="fa-solid fa-toggle-off"></i></div>
   
   <?php

                    }else{
    ?>


                    <div onclick="ajax_inativa_veiculo(<?php echo $row_table['CD_VEICULO'];?>,'<?php echo $row_table['TP_STATUS']; ?>')" class="mini_caixa_chamado" style="float: right !important; color: #dd9696 !important; background-color: #ffffff !important;"><i style=" color: #dd9696; cursor: pointer; font-size: 20px;" class="fa-solid fa-toggle-on"></i></div>

    <?php

                    }

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-calendar-days"></i> ' . $row_table['DS_ANO'] . '</b></div>';
                    
                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-square-parking"></i> ' . $row_table['DS_PLACA'] . '</b></div>';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-road"></i> ' . $row_table['KM'] . '</b></div>';

                    echo '<div class="mini_caixa_chamado" ><b><i style="text-shadow: 1px 1px 1px #4f5050ab; color:' . $row_table['RGB'] . '"class="fa-solid fa-car"></i></b></div>';

                    echo '<div style="clear: both;"></div>';
                    
                    

                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>


