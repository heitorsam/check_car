<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL PAGINAÇÃO
    @$var_inicio = $_GET['global_inicio'];
    @$var_fim = $_GET['global_fim'];

    //RECEBENDO VARIAVEL DE DATA
    $data = $_GET['data1'];
    $data2 = $_GET['data2'];

    $data_format_1 = $data;
    $data_correta1 = date("d/m/Y", strtotime($data_format_1));

    $data_format_2 = $data2;
    $data_correta2 = date("d/m/Y", strtotime($data_format_2));

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
                                 WHERE sol.CD_OFICINA = 9
                                  AND sol.CD_MULTI_EMPRESA = 1
                                  AND sol.TP_SITUACAO = 'S'
                                  AND sol.CD_OS NOT IN (SELECT cd.CD_OS_MV
                                                        FROM portal_check_car.CHAMADOS_DESIGNADOS cd)
                                  AND sol.DT_PEDIDO BETWEEN TO_DATE('$data_correta1', 'DD/MM/YYYY') AND TO_DATE('$data_correta2', 'DD/MM/YYYY')                      
                                                        ) res                    
                                                        )tot";

                                    if(!isset($var_inicio) && !isset($var_fim)){

                                        $cons_chamados_solic .=" WHERE tot.LINHA BETWEEN 1 AND 10";

                                    }else{
                                            
                                        $cons_chamados_solic .=" WHERE tot.LINHA BETWEEN $var_inicio AND $var_fim";

                                    }
                            
                             $cons_chamados_solic .= " ORDER BY tot.LINHA ASC";
    $res_solic = oci_parse($conn_ora, $cons_chamados_solic);
                 oci_execute($res_solic);


?>


<div style="width: 50%; margin: 0 auto; text-align: center;">

<i class="fa-solid fa-chevron-left efeito-zoom" style="cursor: pointer;" id="back" onclick="pagtabela('esq')"></i>

      

<i class="fa-solid fa-chevron-right efeito-zoom" style="cursor: pointer;" id="next" onclick="pagtabela('dir')" ></i>

</div>

<div class="div_br"> </div>

<div class="row">

    <?php

        while($row_table = oci_fetch_array($res_solic)){
    ?>
            <div class="col-12 col-md-3" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px;">
    <?php
                echo '<div class="lista_home_itens_pend" style="cursor:pointer;">';

                    echo '<div onclick="ajax_detalhe_os(' . $row_table['CD_OS'] . ')" class="mini_caixa_chamado"><b>OS: ' . $row_table['CD_OS'] . '</b></div>';

                    echo '<div class="mini_caixa_chamado" style="float: right !important; color: #f64848 !important; background-color: #ffffff !important;" onclick="ajax_lib_mot(' . $row_table['CD_OS'] . ')"><i class="fa-solid fa-user"></i></div>';

                    echo '<div class="mini_caixa_chamado"><b><i class="fa-solid fa-user-plus"></i> ' . $row_table['NM_USUARIO_SOLICITANTE'] . '</b></div>';

                    echo '<div style="font-size: 11px !important; "class="mini_caixa_chamado"><i class="fa-regular fa-clock"></i> ' . $row_table['DT_PEDIDO'] . '</div>';  

                    echo '<div style="clear: both;"></div>';
                    
                    

                echo '</div>';

                
                
            echo '</div>';

        }

    ?>

</div>