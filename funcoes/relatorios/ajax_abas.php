<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $data_ini = $_GET['data1'];
    $data_fim = $_GET['data2'];
    $pesquisa = $_GET['pesquisa'];

    $data_format_1 = $data_ini;
    $data_format_2 = $data_fim;

    $ini_date = date("d/m/Y", strtotime($data_format_1));

    $fim_date = date("d/m/Y", strtotime($data_format_2));


    //INICIANDO CONSULTA
    $cons_abas = "SELECT 
                        (SELECT vei.DS_MODELO FROM portal_check_car.VEICULO vei WHERE vei.CD_VEICULO = abas.CD_VEICULO) AS NM_VEICULO,
                        abas.DS_LITROS || 'L' AS LITROS,
                        'R$' || abas.DS_VALOR AS VALOR,
                        (SELECT usu.NM_USUARIO 
                        FROM dbasgu.USUARIOS usu
                        WHERE usu.CD_USUARIO = abas.CD_USUARIO_CADASTRO) AS MOTORISTA
                  FROM portal_check_car.ABASTECIMENTO abas
                  WHERE TO_CHAR(abas.HR_CADASTRO,'DD/MM/YYYY') BETWEEN '$ini_date' AND '$fim_date'
                  ORDER BY abas.CD_ABASTECIMENTO DESC";

    $res_abas = oci_parse($conn_ora, $cons_abas);
                oci_execute($res_abas);
                
?>

<div class="div_br"></div>
<div class="div_br"></div>



<?php 

    if($pesquisa == '1'){

?>
    
<div class="row">

    <?php

        while($row = oci_fetch_array($res_abas)){
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-car"></i> ' . $row['NM_VEICULO'] . '</b></div>';

                    echo '<div class="mini_caixa_chamado"><i class="fa-solid fa-gas-pump"></i> '. $row['LITROS'] .'</div>';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-money-bill-1"></i> ' . $row['VALOR'] . '</b></div>';   
                    
                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-id-card"></i> ' . $row['MOTORISTA'] . '</b></div>';   

                    echo '<div style="clear: both;"></div>';
                    
                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>

<?php

    }else{


    
?>

<table class='table table-striped' style='text-align: center'>

        <thead>

            <th style="text-align: center; border: solid 2px #3185c1;" >Veiculo</th> 
            <th style="text-align: center; border: solid 2px #3185c1;" >Litros</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >Valor</th>
            <th style="text-align: center; border: solid 2px #3185c1;" >Motorista</th>

            
        </thead>

        <tbody>
       
        <?php

            while($row = oci_fetch_array($res_abas)){

                echo '<tr>';

                    echo '<td class="align-middle">'  .  $row['NM_VEICULO'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['LITROS'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['VALOR'] . '</td>';
                    echo '<td class="align-middle">'  .  $row['MOTORISTA'] . '</td>';
              
                
                echo '</tr>';

                
            }


        ?>

        </tbody>

    </table>
<?php

    }

?>
