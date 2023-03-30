<?php 

include 'cabecalho.php';

$datahoje = date('Y-m-d', time());

//CONEXÃO
include 'conexao.php';

//CONSULTA VEICULO
$cons_veiculo = "SELECT vei.CD_VEICULO,
                        vei.DS_MODELO,
                        vei.DS_PLACA,
                        vei.CD_COR,
                        (SELECT cor.DS_RGB FROM portal_check_car.COR cor WHERE cor.CD_COR = vei.CD_COR) AS COR
                        FROM portal_check_car.VEICULO vei";
$res_cons_veiculo = oci_parse($conn_ora, $cons_veiculo);
                    oci_execute($res_cons_veiculo);

?>
    
    <div class="div_br"> </div>

    <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-list-check efeito-zoom"></i> <label class="display_esconder_mobile"> Check List</label></h11>

    <div class='espaco_pequeno'></div>

    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

    <div class="div_br"> </div>  
   
    <!--DESKTOP-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i  style="cursor: pointer;" class="fa-solid fa-list-check efeito-zoom"></i> Check List</h11>

        </div>

    </div>

    <div class="div_br"> </div> 

    <!--DESKTOP-->
    <div class="row">

        <div class="col-md-3 esconde">

            Tipo:
            <select class="form-control">
                <option value="All">Selecione</option>
                <option value="S">Saida</option>
                <option value="R">Retorno</option>
            </select>

        </div> 

        <div class="col-md-3 esconde">

            Data:
            <input min="<?php echo $datahoje; ?>" type="date" id="dt_check_list" class="form form-control">

        </div>

        <div class="col-md-3 esconde">

            Veiculo:
            <select class="form-control" id="veiculo" onchange="ajax_constroi_check_list()">

                <option value="All">Selecione</option>
                
                <?php

                        while($row = oci_fetch_array($res_cons_veiculo)){

                            echo '<option value="'. $row['CD_VEICULO'] .'">'. $row['DS_MODELO'] .'</option>';

                        }

                ?>


            </select>

        </div>



    </div>
    
    <div class="div_br"> </div> 

    <div class="div_br"> </div> 

    <div id="restante_check_list"></div>

    <script>

        //RESTANTE DO CHECKLIST
        function ajax_constroi_check_list(){

            var veiculo = document.getElementById('veiculo').value;

            alert(veiculo);

           $('#restante_check_list').load('funcoes/checklist/ajax_constroi_check_list.php?cd_veiculo='+veiculo);

        }



        //FUEL
        var global_js_valor_gal = 'x';

        function js_exibe_valor_gal(){

            alert(global_js_valor_gal);
            
        }

        function js_gal_sel(js_vl_sel){

            document.getElementById('gal_1').style.display = 'none';
            document.getElementById('gal_3').style.display = 'none';
            document.getElementById('gal_5').style.display = 'none';            

            document.getElementById('gal_'+js_vl_sel).style.display = 'block';

            global_js_valor_gal = js_vl_sel;

            alert(global_js_valor_gal);
        }

    </script>


<?php 

include 'rodape.php';

?>