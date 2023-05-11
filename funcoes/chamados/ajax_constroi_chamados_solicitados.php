<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    @$var_inicio = $_GET['global_inicio'];
    @$var_fim = $_GET['global_fim'];

    //CHAMANDO CONEXÃO
    $cons_chamados_solic = "SELECT * 
                            FROM (SELECT  ROWNUM AS LINHA,
                                        res.* 
                            FROM (SELECT sol.CD_OS,
                                    TO_CHAR(sol.DT_PEDIDO, 'DD/MM/YYYY HH24:MI:SS') AS DT_PEDIDO,
                                    sol.DS_SERVICO,
                                    sol.DS_OBSERVACAO,
                                    (SELECT usu.NM_USUARIO
                                        FROM dbasgu.USUARIOS usu
                                        WHERE usu.CD_USUARIO = sol.NM_SOLICITANTE) AS NM_USUARIO_SOLICITANTE,
                                    (SELECT loc. DS_LOCALIDADE
                                        FROM dbamv.LOCALIDADE loc
                                        WHERE loc.CD_LOCALIDADE = sol.CD_LOCALIDADE) AS NM_LOCALIDADE
                                  FROM dbamv.SOLICITACAO_OS sol
                                 --WHERE sol.CD_OFICINA = 9
                                  WHERE sol.CD_OFICINA = 34
                                  AND sol.DT_PEDIDO >= SYSDATE - 7
                                  AND sol.CD_MULTI_EMPRESA = 1
                                  AND sol.TP_SITUACAO = 'S'
                                  AND sol.CD_OS NOT IN (SELECT cd.CD_OS_MV
                                                        FROM portal_check_car.CHAMADOS_DESIGNADOS cd)) res)tot";

                                    if(!isset($var_inicio) && !isset($var_fim)){

                                        $cons_chamados_solic .=" WHERE tot.LINHA BETWEEN 1 AND 10";

                                    }else{
                                            
                                        $cons_chamados_solic .=" WHERE tot.LINHA BETWEEN $var_inicio AND $var_fim";

                                    }
                            
                             $cons_chamados_solic .= "ORDER BY tot.LINHA ASC";
    $res_solic = oci_parse($conn_ora, $cons_chamados_solic);
                 oci_execute($res_solic);



?>

<div style="width: 50%; margin: 0 auto; text-align: center;">

<i class="fa-solid fa-chevron-left efeito-zoom" style="cursor: pointer;" id="back" onclick="pagtabela('esq')"></i>

      

<i class="fa-solid fa-chevron-right efeito-zoom" style="cursor: pointer;" id="next" onclick="pagtabela('dir')" ></i>

</div>

<div class="div_br"> </div>


<table class="table table-striped " style="text-align: center;">

<thead>

    <th style="text-align: center;">    OS   </th>
    <th style="text-align: center;"> Data</th>
    <th style="text-align: center;"> Solicitante</th>
    <th style="text-align: center;"> Motorista</th>

</thead>


<tbody>


<?php

    while($row_table = oci_fetch_array($res_solic)){

        echo '<tr style="text-align: center;">';

            echo '<td onclick="ajax_detalhe_os(' . $row_table['CD_OS'] . ')" class="align-middle" style="text-align: center; cursor: pointer;">   '  .  $row_table['CD_OS'] . '   </td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['DT_PEDIDO'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['NM_USUARIO_SOLICITANTE'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">' . '<button class="btn btn-primary" onclick="ajax_lib_mot(' . $row_table['CD_OS'] . ')"><i class="fa-solid fa-user"></i></button>' . '</td>';

        echo '</tr>';

    }

?>


    

</tbody>

</table>