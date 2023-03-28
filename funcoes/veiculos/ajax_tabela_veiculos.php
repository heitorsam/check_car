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

        while($row = oci_fetch_array($res_cons_tabela_veiculo)){

            echo '<tr style="text-align: center;">';

                if($row['TP_STATUS'] == 'A'){


                    echo '<td class="align-middle" style="text-align: center;">' . '<i style=" color: #9ee162; cursor: pointer; font-size: 20px;" class="fa-solid fa-toggle-on"' ;

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

    ?>


        

    </tbody>

</table>
