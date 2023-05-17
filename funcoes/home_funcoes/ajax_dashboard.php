<?php

    //CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEIS
    $var_usuario = $_GET['usuario'];
    $var_periodo = $_GET['periodo'];

    //STATUS
    $cons_total_status= "SELECT
                                (SELECT COUNT(res.CD_CHAMADO_DESIGNADO)   
                                 FROM (SELECT cd.*, EXTRACT(MONTH FROM cd.HR_CADASTRO) AS MONTH_1
                                       FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                                       INNER JOIN portal_check_car.USUARIO usu
                                        ON usu.CD_USUARIO = cd.CD_MOTORISTA
                                       WHERE usu.CD_USUARIO_MV = 'LDPGOMES'
                                       AND cd.TP_STATUS_CHAMADO = 'C') res
                                WHERE res.MONTH_1 = 05) AS QTD_CONCLUIDOS,

                                    (SELECT COUNT(cd.CD_CHAMADO_DESIGNADO)
                                    FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                                INNER JOIN portal_check_car.USUARIO usu
                                    ON usu.CD_USUARIO = cd.CD_MOTORISTA
                                WHERE usu.CD_USUARIO_MV = 'LDPGOMES'
                                AND cd.TP_STATUS_CHAMADO = 'A') AS QTD_ANDAMENTO,
                                
                                (SELECT COUNT(cd.CD_CHAMADO_DESIGNADO)
                                 FROM portal_check_car.CHAMADOS_DESIGNADOS cd
                                 INNER JOIN portal_check_car.USUARIO usu
                                    ON usu.CD_USUARIO = cd.CD_MOTORISTA
                                 WHERE usu.CD_USUARIO_MV = 'LDPGOMES'
                                 AND cd.TP_STATUS_CHAMADO = 'D') AS QTD_PENDENTE
                                    
                            FROM DUAL";

    $res_total_status = oci_parse($conn_ora, $cons_total_status);
    oci_execute($res_total_status);

    while($valores = oci_fetch_array($res_total_status)){
        $QTD_CONCLUIDOS = $valores['QTD_CONCLUIDOS'];
        $QTD_ANDAMENTO = $valores['QTD_ANDAMENTO'];
        $QTD_PENDENTE = $valores['QTD_PENDENTE'];
    }
                        
?>


<div style="max-width:70%; height: 400px !important; margin: 0 auto; text-align: center;">

<div class="div_br"> </div>
<div class="div_br"> </div>
<h11><i class="fa-solid fa-chart-column efeito-zoom"></i> Realizados</h11>
<div class="div_br"> </div>

<canvas id="myChart" style="width: 100%; height: 300px !important;"></canvas>

</div>

</div>

<script>

    var ctx = document.getElementById("myChart").getContext("2d")

    var data = {

        labels: [
            ''
        ],

        datasets: [

            {
                label: "Pendente",
                backgroundColor: "#a2b3fc",
                data: [<?php 
                            
                                echo $QTD_PENDENTE.',';
                            ?>]
            },

            {
                label: "Andamento",
                backgroundColor: "#ff9f73",
                data: [<?php 
                            
                                echo $QTD_ANDAMENTO.',';
                            ?>]
            },
            
            {
                label: "Atendidos",
                backgroundColor: "#8ac2b6",
                data: [<?php 
                            
                                echo $QTD_CONCLUIDOS.',';
                            ?>]
            }
           
           
        ]
    }

    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Concluidos Mensal'
                }
            }
        },
    }); 




</script>