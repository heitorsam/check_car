<?php

//CONEXÃO
include '../../conexao.php';

//INCLUDE AJAX ALERT
include '../../config/mensagem/ajax_mensagem_alert.php';

//RECEBENDO VARIAVEIS
$var_cd_veiculo = $_GET['cd_veiculo'];
$seq = $_GET['cd_seq'];
$cd_condutor = $_GET['condutor'];

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

//CONSULTA ITEM PARA SELECT 
$cons_item = "SELECT itvei.CD_ITEM_VEICULO,
                     itvei.DS_ITEM_VEICULO
              FROM portal_check_car.item_veiculo itvei
              WHERE itvei.SN_PADRAO <> 'S'
              ORDER BY itvei.CD_ITEM_VEICULO ASC";

$res_item  = oci_parse($conn_ora, $cons_item);
             oci_execute($res_item);


//CONSULTA PARA PEGAR PLANTÃO DO MOTORISTA
$cons_plantao ="SELECT usu.TP_PLANTAO
                  FROM portal_check_car.USUARIO usu
                WHERE usu.CD_USUARIO = $cd_condutor";
$res_plantao  = oci_parse($conn_ora, $cons_plantao);
                oci_execute($res_plantao);
     $row_plantao = oci_fetch_array($res_plantao);

?>
    <!--INPUT PARA PEGAR VALOR DO MOTORISTA -->
    <input type="text" id="plantao" value="<?php echo $row_plantao['TP_PLANTAO']; ?>" hidden>

    <div class="div_br"> </div> 

    <!--DESKTOP E MOBILE-->
    <div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Itens Danificados:</label></div>
    
    <div class="div_br"> </div> 


    <div>

        <div class="carro_check" style="margin: 0 auto; background-color: #f9f9f9 !important;">

            <div class="row">
                <div style="text-align: center;background-color: #f9f9f9 !important;"class="col-1"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;"class="col-2"> 02 <input id="2" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('2','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-2">03 <input id="3" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('3','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-2">04 <input id="4" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('4','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-2">05 <input id="5" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('5','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-2">06 <input id="6" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('6','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-1"></div>
            </div>

            <div class="row">
                <div style="text-align: center; background-color: #f9f9f9 !important;" class="col-1"></div>
                <div style="text-align: center; background-color: #f9f9f9 !important;line-height: 60px; " class="col-2">01 <input id="1" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('1','DANIFICADO')"></div>

                <div  class="col-6" style="background-color: #f9f9f9 !important;">
                    <br><br>
                    <div style=" background-color: <?php echo $row['COR']; ?>; width: 150px; height: 60px; margin: 0 auto;">
                        <img src="img/car.png">
                    </div>

                </div>
                
                <div style=" text-align: center;background-color: #f9f9f9 !important;line-height: 60px; " class="col-2">07 <input id="7" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('7','DANIFICADO')"></div>
                <div style=" text-align: center;background-color: #f9f9f9 !important;" class="col-1"></div>
            </div>

            <div class="row">
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-1"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-2">12 <input id="12" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('12','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-2">11 <input id="11" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('11','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-2">10 <input id="10" style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('10','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-2">09 <input id="9"  style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('9','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-2">08 <input id="8"  style="zoom: 2.0;" type="checkbox" onclick="ajax_insert_tabela_itchecklist('8','DANIFICADO')"></div>
                <div style="text-align: center;background-color: #f9f9f9 !important;" class="col-1"></div>
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
                
                <div style="text-align: center; background-color: #f9f9f9 !important;" class="col-4"></div>

                <div style="text-align: center; background-color: #f9f9f9 !important;" class="col-8">

                    <div style="float: left; width: 50%; background-color: #f9f9f9 !important;" >

                        <select class="form-control" id="select_pneu_13" onchange="ajax_insert_tabela_itchecklist('13','PNEU')">

                            <option value="">Selecione</option>
                            <option value="OK">OK</option>
                            <option value="GI">GI</option>
                            <option value="LS">LS</option>
                            <option value="LC">LC</option>
                            <option value="CR">CR</option>
                            <option value="VZ">VZ</option>

                        </select>

                    </div>

                    <div style="float: left; width: 50%; background-color: #f9f9f9 !important;">

                        <select class="form-control" id="select_pneu_14" onchange="ajax_insert_tabela_itchecklist('14','PNEU')">

                            <option value="">Selecione</option>
                            <option value="OK">OK</option>
                            <option value="GI">GI</option>
                            <option value="LS">LS</option>
                            <option value="LC">LC</option>
                            <option value="CR">CR</option>
                            <option value="VZ">VZ</option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="row">

                <div style="text-align: center; background-color: #f9f9f9 !important;" class="col-4">
                    <div class="div_br"> </div> 
                    <select class="form-control" id="select_pneu_17" onchange="ajax_insert_tabela_itchecklist('17','PNEU')">

                        <option value="">Selecione</option>
                        <option value="OK">OK</option>
                        <option value="GI">GI</option>
                        <option value="LS">LS</option>
                        <option value="LC">LC</option>
                        <option value="CR">CR</option>
                        <option value="VZ">VZ</option>

                    </select>

                </div>

                <div class="col-8" style="background-color: #f9f9f9 !important;">

                    <div class="div_br"> </div> 
                    <div style=" width: 150px; height: 60px; margin: 0 auto; background-color: #f9f9f9 !important;">
                        <img src="img/chassi.png">
                    </div>

                </div>

  
            </div>


            <div class="row">
                
                <div style="text-align: center; background-color: #f9f9f9 !important;" class="col-4"></div>

                <div style="text-align: center; background-color: #f9f9f9 !important;" class="col-8">

                    <div style="float: left; width: 50%;" >

                        <select class="form-control" id="select_pneu_16" onchange="ajax_insert_tabela_itchecklist('16','PNEU')">

                            <option value="">Selecione</option>
                            <option value="OK">OK</option>
                            <option value="GI">GI</option>
                            <option value="LS">LS</option>
                            <option value="LC">LC</option>
                            <option value="CR">CR</option>
                            <option value="VZ">VZ</option>

                        </select>

                    </div>

                    <div style="float: left; width: 50%; background-color: #f9f9f9 !important;">

                        <select class="form-control" id="select_pneu_15" onchange="ajax_insert_tabela_itchecklist('15','PNEU')">

                            <option value="">Selecione</option>
                            <option value="OK">OK</option>
                            <option value="GI">GI</option>
                            <option value="LS">LS</option>
                            <option value="LC">LC</option>
                            <option value="CR">CR</option>
                            <option value="VZ">VZ</option>

                        </select>

                    </div>

                </div>

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

                <div onclick="js_gal_sel(1), ajax_insert_tabela_itchecklist('18','0')" style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">

                    <img id="gal_1" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 

                </div>

                <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
                </div>

                <div onclick="js_gal_sel(3), ajax_insert_tabela_itchecklist('18','50')" style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
        
                    <img id="gal_3" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 
        
                </div> 
        
                <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">     
                </div> 
        
                <div onclick="js_gal_sel(5), ajax_insert_tabela_itchecklist('18','100')" style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
        
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

        <div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">

            Items:
            <select class="form-control" id="tp_item_cadastrado">
                <option value="">Selecione</option>

                <?php

                    while($row_item = oci_fetch_array($res_item)){

                        echo '<option value="'. $row_item['CD_ITEM_VEICULO'] .'">'. $row_item['DS_ITEM_VEICULO'] .'</option>';
                
                    }

                ?>

            </select>

        </div> 

        
        <div class='col-md-3 col-12 esconde' style="background-color: #f9f9f9 !important;">

            </br>
            <button onclick="ajax_insert_tabela_itchecklist('0')" class='btn btn-primary'><i class="fa-solid fa-plus"></i></button>

        </div>

                        
        <div class='col-12 esconde_btn_desktop' style="background-color: #f9f9f9 !important;">

            <div>
                <button style="width: 50%;" onclick="ajax_insert_tabela_itchecklist('0')" class='btn btn-primary'><i class="fa-solid fa-plus"></i></button>
            </div>

        </div>


    </div>

    
    <div class="div_br"> </div> 

    <div id="tabela_items"></div>


    <div class="row">

        <div class='col-md-12 col-12' style="background-color: #f9f9f9 !important;">

             Observações:
            <input type="text" class="form-control" id="obs_geral_final">

        </div>

    </div>

    <div class="div_br"> </div>  

    <div class="row">

        <div class='col-md-2 esconde' style="background-color: #f9f9f9 !important;">

            </br>
            <button onclick="ajax_alert('Deseja confirmar o Checklist?','ajax_roda_update()')" class='btn btn-primary'><i class="fa-solid fa-check"></i> Finalizar</button>

        </div>

                                
        <div class='col-12 esconde_btn_desktop' style="background-color: #f9f9f9 !important;">

            <div>
                <button style="width: 50%;" onclick="ajax_alert('Deseja confirmar o Checklist?','ajax_roda_update()')" class='btn btn-primary'><i class="fa-solid fa-check"></i> Finalizar</button>
                
            </div>

        </div>


    </div>


