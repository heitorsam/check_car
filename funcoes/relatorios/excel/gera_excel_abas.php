<?php

    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=abastecimento_veiculo.xls");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);

    include '../../../conexao.php';

    //RECEBENDO VARIAVEL
    $data_ini = $_GET['dt_ini'];

    $data_fim = $_GET['dt_fim'];

    $data_format_1 = $data_ini;
    $data_format_2 = $data_fim;

    $ini_date = date("d/m/Y", strtotime($data_format_1));

    $fim_date = date("d/m/Y", strtotime($data_format_2));

    $consulta_rel = "SELECT 
                    (SELECT vei.DS_MODELO FROM portal_check_car.VEICULO vei WHERE vei.CD_VEICULO = abas.CD_VEICULO) AS NM_VEICULO,
                    abas.DS_LITROS || 'L' AS LITROS,
                    'R$' || abas.DS_VALOR AS VALOR,
                    (SELECT usu.NM_USUARIO 
                    FROM dbasgu.USUARIOS usu
                    WHERE usu.CD_USUARIO = abas.CD_USUARIO_CADASTRO) AS MOTORISTA
                FROM portal_check_car.ABASTECIMENTO abas
                WHERE TO_CHAR(abas.HR_CADASTRO,'DD/MM/YYYY') BETWEEN '$ini_date' AND '$fim_date'
                ORDER BY abas.CD_ABASTECIMENTO DESC";

    $res_rel = oci_parse($conn_ora, $consulta_rel);
               oci_execute($res_rel);


?>

<table class="table table-striped" cellspacing="0" cellpadding="0">

    <tr>
        <th class="p-2">Veiculo</th>
        <th class="p-2">Litros</th>
        <th class="p-2">Valor</th>
        <th class="p-2">Motorista</th>


    </tr>

    <tbody>

        <?php

            while($row = oci_fetch_array($res_rel)){

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