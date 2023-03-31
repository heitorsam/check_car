<?php

//CONEXÃO
include '../../conexao.php';

//RECEBENDO VARIAVEL
$var_cd_veiculo = $_GET['cd_veiculo'];

//CONSULTA VEICULO
$cons_veiculo = "SELECT vei.CD_VEICULO,
                        vei.DS_MODELO,
                        vei.DS_PLACA,
                        vei.CD_COR,
                        (SELECT cor.DS_RGB FROM portal_check_car.COR cor WHERE cor.CD_COR = vei.CD_COR) AS COR
                        FROM portal_check_car.VEICULO vei
                        WHERE vei.CD_VEICULO = $var_cd_veiculo";
$res_cons_veiculo = oci_parse($conn_ora, $cons_veiculo);
                    oci_execute($res_cons_veiculo);

$row = oci_fetch_array($res_cons_veiculo);

//CONSULTA ITEM
$cons_item = "SELECT itvei.CD_ITEM_VEICULO,
                     itvei.DS_ITEM_VEICULO
                 FROM portal_check_car.item_veiculo itvei";

$res_item  = oci_parse($conn_ora, $cons_item);
             oci_execute($res_item);

?>
   
    <div class="div_br"> </div> 

    <!--DESKTOP E MOBILE-->
    <div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Itens Danificados:</label></div>
    
    <div class="div_br"> </div> 


    <div>

        <div class="carro_check" style="margin: 0 auto; ">

            <div class="row">
                <div style="text-align: center; "class="col-1"></div>
                <div style="text-align: center;" class="col-2"> 02 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">03 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">04 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">05 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">06 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-1"></div>
            </div>

            <div class="row">
                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; line-height: 60px; " class="col-2">01 <input style="zoom: 2.0;" type="checkbox"></div>

                <div  class="col-6">
                    <br><br>
                    <div style=" background-color: <?php echo $row['COR']; ?>; width: 150px; height: 60px; margin: 0 auto;">
                        <img src="img/car.png">
                    </div>

                </div>
                
                <div style=" text-align: center; line-height: 60px; " class="col-2">07 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style=" text-align: center; " class="col-1"></div>
            </div>

            <div class="row">
                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; " class="col-2">12 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">11 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">10 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">09 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">08 <input style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-1"></div>
            </div>

        </div>

    </div>

    <!--DESKTOP E MOBILE-->
    <div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Controle Pneus:</label></div>

    <div class="div_br"> </div> 

    <div style="text-align: center;">
        <label style="font-weight: bold">(GI) = Gastos Irregulares / (LS) =  Liso / (LC) = Danificado / (CR) = Cortes / (VZ) = Vazio</label>
    </div>


    <div>

        <div class="carro_check" style="margin: 0 auto; ">



            <div class="row">

                <div style="text-align: center; "class="col-1"></div>
                <div style="text-align: center;" class="col-1"></div>
                <div style="text-align: center; " class="col-3">
                    <select class="form-control">

                        <option value="OK">OK</option>
                        <option value="GI">GI</option>
                        <option value="LS">LS</option>
                        <option value="LC">LC</option>
                        <option value="CR">CR</option>
                        <option value="VZ">VZ</option>

                    </select>
                </div>
                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; " class="col-3">
                    <select class="form-control">

                        <option value="OK">OK</option>
                        <option value="GI">GI</option>
                        <option value="LS">LS</option>
                        <option value="LC">LC</option>
                        <option value="CR">CR</option>
                        <option value="VZ">VZ</option>

                    </select>
                </div>
                <div style="text-align: center; " class="col-2"></div>
                <div style="text-align: center; " class="col-1"></div>

            </div>



            <div class="row">

                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; " class="col-3">
                    <select class="form-control">

                        <option value="OK">OK</option>
                        <option value="GI">GI</option>
                        <option value="LS">LS</option>
                        <option value="LC">LC</option>
                        <option value="CR">CR</option>
                        <option value="VZ">VZ</option>

                    </select>
                </div>

                <div  class="col-6">

                    <div class="div_br"> </div> 
                    <div style=" width: 150px; height: 60px; margin: 0 auto;">
                        <img src="img/chassi.png">
                    </div>

                </div>
                
                <div style=" text-align: center; line-height: 60px; " class="col-1"></div>
                <div style=" text-align: center; " class="col-1"></div>
                
            </div>

            <div class="row">

                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; " class="col-3">
                    <select class="form-control">

                        <option value="OK">OK</option>
                        <option value="GI">GI</option>
                        <option value="LS">LS</option>
                        <option value="LC">LC</option>
                        <option value="CR">CR</option>
                        <option value="VZ">VZ</option>

                    </select>
                </div>
                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; " class="col-3">
                    <select class="form-control">

                        <option value="OK">OK</option>
                        <option value="GI">GI</option>
                        <option value="LS">LS</option>
                        <option value="LC">LC</option>
                        <option value="CR">CR</option>
                        <option value="VZ">VZ</option>

                    </select>
                </div>
                <div style="text-align: center; " class="col-2"></div>
                <div style="text-align: center; " class="col-1"></div>

            </div>

        </div>

    </div>

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

    <div class="div_br"> </div>

    <!--DESKTOP E MOBILE-->
    <div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Inspeção/Vistoria Equipamentos:</label></div>

    <div class="div_br"> </div> 


    <div class="row">

        <div class="col-md-3 esconde">

            Items:
            <select class="form-control" id="tp_status">
                <option value="">Selecione</option>

                <?php

                    while($row_item = oci_fetch_array($res_item)){

                        echo '<option value="'. $row_item['CD_ITEM_VEICULO'] .'">'. $row_item['DS_ITEM_VEICULO'] .'</option>';

                    }

                ?>

            </select>

        </div> 

        <div class='col-md-2 esconde'>

            </br>
            <button onclick="ajax_adiciona_item_inspecao()" class='btn btn-primary'><i class="fa-solid fa-plus"></i></button>

        </div>

    </div>

    
    <div class="div_br"> </div> 


    <div class="row">

        <div class='col-md-12 esconde'>
             Observações:
            <input type="text" class="form-control" id="obs_geral">

        </div>

    </div>

    <div class="div_br"> </div>  

        <div class="row">
        <div class='col-md-2 esconde'>

            </br>
            <button class='btn btn-primary'><i class="fa-solid fa-check"></i> Finalizar</button>

        </div>

    </div>

