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

//CONSULTA CONDUTOR
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

    </div>
    
    <div class="div_br"> </div> 

    <!--DESKTOP E MOBILE-->
    <div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Identificação do Veiculo:</label></div>

    <div class="div_br"> </div> 

    <!--DESKTOP-->
    <div class="row">

        <div class="col-md-3 esconde">

            Veiculo:
            <select class="form-control">

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

    <!--DESKTOP E MOBILE-->
    <div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Identificação do Condutor:</label></div>
    
    <div class="div_br"> </div> 

    <!--DESKTOP-->
    <div class="row">

        <div class="col-md-3 esconde">

            Condutor:
            <select class="form-control">

                <option value="All">Selecione</option>


            </select>

        </div>

    </div>

    <div class="div_br"> </div> 

    <!--DESKTOP E MOBILE-->
    <div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Itens Danificados:</label></div>
    
    <div class="div_br"> </div> 


    <div>

        <div class="carro_check" style="margin: 0 auto;">

            <div class="row">
                <div style="text-align: center; "class="col-1"></div>
                <div style="text-align: center;" class="col-2">02</div>
                <div style="text-align: center; " class="col-2">03</div>
                <div style="text-align: center; " class="col-2">04</div>
                <div style="text-align: center; " class="col-2">05</div>
                <div style="text-align: center; " class="col-2">06</div>
                <div style="text-align: center; " class="col-1"></div>
            </div>

            <div class="row">
                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; line-height: 60px; " class="col-2">01</div>

                <div  class="col-6">

                    <div style=" background-color: pink; width: 150px; height: 60px; margin: 0 auto;">
                        <img src="img/car.png">
                    </div>

                </div>
                
                <div style=" text-align: center; line-height: 60px; " class="col-2">07</div>
                <div style=" text-align: center; " class="col-1"></div>
            </div>

            <div class="row">
                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; " class="col-2">12</div>
                <div style="text-align: center; " class="col-2">11</div>
                <div style="text-align: center; " class="col-2">10</div>
                <div style="text-align: center; " class="col-2">09</div>
                <div style="text-align: center; " class="col-2">08</div>
                <div style="text-align: center; " class="col-1"></div>
            </div>

        </div>

    </div>

    <!--DESKTOP E MOBILE-->
    <div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Controle Pneus:</label></div>

    <div class="div_br"> </div>

    <!--DESKTOP E MOBILE-->
    <div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Combustivel:</label></div>

        <div class="div_br"> </div>
        <div class="div_br"> </div>

        <div>

            <div style="margin: 0 auto; border: ridge 1px #999999; border-radius: 5px; width: 152px; height: 60px !important; padding: 0px; background-image: url('img/veloc_leo.png');">

                <div onclick="js_gal_sel(1)" style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">

                    <img id="gal_1" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 

                </div>

                <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
                </div>

                <div onclick="js_gal_sel(3)" style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
        
                    <img id="gal_3" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 
        
                </div> 
        
                <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">     
                </div> 
        
                <div onclick="js_gal_sel(5)" style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
        
                    <img id="gal_5" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 

                </div>

            </div>

        </div>


    </div>


    <script>

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