<?php

    //CHAMANDO CABECALHO
    include 'cabecalho.php';

    //CHAMANDO CONEXÃO
    include 'conexao.php';

    $cons_veiculo = "SELECT vei.CD_VEICULO,
                            vei.DS_MODELO ||' - '|| vei.DS_PLACA AS DS_VEICULO
                        FROM portal_check_car.VEICULO vei
                        WHERE vei.TP_STATUS = 'A'";
    $res_veiculo = oci_parse($conn_ora, $cons_veiculo);
                   oci_execute($res_veiculo);
?>

<div class="div_br"> </div>

    <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-gas-pump efeito-zoom"></i> <label class="display_esconder_mobile"> Abastecimento</label></h11>

    <div class='espaco_pequeno'></div>

    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

    <div class="div_br"> </div>  
    


    <!--DESKTOP-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-gas-pump efeito-zoom" aria-hidden="true"></i> Abastecimento</h11>

        </div>

    </div>

    <div class="row">
        <div class="col-md-3">

            Veiculo:
            <select class="form form-control" id="cd_veiculo" onchange="ajax_exibe_veiculo()">
            <option value = "All" >Selecione</option>
                <?php

                while($row_veiculo = oci_fetch_array($res_veiculo)){

                    echo '<option value = "' . $row_veiculo['CD_VEICULO'] . '">' . $row_veiculo['DS_VEICULO'] . '</option>';
                    

                }

                ?>
            </select>

        </div>
    </div>
    

    <div id="detalhes_veiculo"></div>


<script>

    function ajax_confirma_abastecimento(){



        alert('oi');



    }

    function ajax_exibe_veiculo(){



            var cd_veiculo = document.getElementById('cd_veiculo').value;
            var veiculo = cd_veiculo;

        $('#detalhes_veiculo').load('funcoes/abastecimento/ajax_detelhe_veiculo.php?cd_veiculo='+veiculo);


    }



</script>

<?php

    include 'rodape.php';

?>