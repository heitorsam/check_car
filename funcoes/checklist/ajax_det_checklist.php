<?php

    //CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_check = $_GET['cd_checklist'];

    //CONSULTA CHECKLIST
    $cons_it = "SELECT tot.*,
                    (SELECT cor.DS_RGB FROM portal_check_car.COR cor WHERE cor.CD_COR = tot.COR) AS DS_COR 
                    FROM (SELECT res.*,
                          (SELECT vei.CD_COR FROM portal_check_car.VEICULO vei WHERE vei.CD_VEICULO = res.CD_VEICULO) AS COR
                          FROM (SELECT ick.CD_ITEM_VEICULO,
                                       ick.DS_RESPOSTA,
                                       (SELECT iv.DS_ITEM_VEICULO FROM portal_check_car.ITEM_VEICULO iv WHERE iv.CD_ITEM_VEICULO = ick.CD_ITEM_VEICULO) AS DS_ITEM,
                                       (SELECT iv.SN_PADRAO FROM portal_check_car.ITEM_VEICULO iv WHERE iv.CD_ITEM_VEICULO = ick.CD_ITEM_VEICULO) AS SN_PADRAO,
                                       (SELECT ck.CD_VEICULO FROM portal_check_car.CHECKLIST ck WHERE ck.CD_CHECKLIST = ick.CD_CHECKLIST) AS CD_VEICULO
                                FROM portal_check_car.ITCHECKLIST ick
                                WHERE ick.CD_CHECKLIST = 234
                                ORDER BY ick.CD_ITEM_VEICULO ASC)res)tot";
    $res_it = oci_parse($conn_ora, $cons_it);
              oci_execute($res_it);

?>





<!--DESKTOP E MOBILE-->
<div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Itens Danificados:</label></div>
    
    <div class="div_br"> </div> 

    <div>

        <div class="carro_check" style="margin: 0 auto; ">

            <div class="row">
                <div style="text-align: center; "class="col-1"></div>
                <div style="text-align: center; "class="col-2"> 02 <input id="2" style="zoom: 2.0;" type="checkbox" ></div>
                <div style="text-align: center; " class="col-2">03 <input id="3" style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">04 <input id="4" style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">05 <input id="5" style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">06 <input id="6" style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-1"></div>
            </div>

            <div class="row">
                <div style="text-align: center; " class="col-1"></div>
                
                <div style="text-align: center; line-height: 60px; " class="col-2">01 <input id="1" style="zoom: 2.0;" type="checkbox"></div>

                <div  class="col-6">
                    <br><br>
                    <div style=" background-color: <?php echo $row['COR']; ?>; width: 150px; height: 60px; margin: 0 auto;">
                        <img src="img/car.png">
                    </div>

                </div>
                
                <div style=" text-align: center; line-height: 60px; " class="col-2">07 <input id="7" style="zoom: 2.0;" type="checkbox" ></div>
                <div style=" text-align: center; " class="col-1"></div>
            </div>

            <div class="row">
                <div style="text-align: center; " class="col-1"></div>
                <div style="text-align: center; " class="col-2">12 <input id="12" style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">11 <input id="11" style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">10 <input id="10" style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">09 <input id="9"  style="zoom: 2.0;" type="checkbox"></div>
                <div style="text-align: center; " class="col-2">08 <input id="8"  style="zoom: 2.0;" type="checkbox"></div>
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
                
                <div style="text-align: center; " class="col-4"></div>

                <div style="text-align: center; " class="col-8">

                    <div style="float: left; width: 50%;" >

                        <select class="form-control" id="select_pneu_13">

                            <option value="">Selecione</option>
                            <option value="OK">OK</option>
                            <option value="GI">GI</option>
                            <option value="LS">LS</option>
                            <option value="LC">LC</option>
                            <option value="CR">CR</option>
                            <option value="VZ">VZ</option>

                        </select>

                    </div>

                    <div style="float: left; width: 50%;">

                        <select class="form-control" id="select_pneu_14">

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

                <div style="text-align: center; " class="col-4">
                    <div class="div_br"> </div> 
                    <select class="form-control" id="select_pneu_17">

                        <option value="">Selecione</option>
                        <option value="OK">OK</option>
                        <option value="GI">GI</option>
                        <option value="LS">LS</option>
                        <option value="LC">LC</option>
                        <option value="CR">CR</option>
                        <option value="VZ">VZ</option>

                    </select>

                </div>

                <div class="col-8">

                    <div class="div_br"> </div> 
                    <div style=" width: 150px; height: 60px; margin: 0 auto;">
                        <img src="img/chassi.png">
                    </div>

                </div>

  
            </div>


            <div class="row">
                
                <div style="text-align: center; " class="col-4"></div>

                <div style="text-align: center; " class="col-8">

                    <div style="float: left; width: 50%;" >

                        <select class="form-control" id="select_pneu_16">

                            <option value="">Selecione</option>
                            <option value="OK">OK</option>
                            <option value="GI">GI</option>
                            <option value="LS">LS</option>
                            <option value="LC">LC</option>
                            <option value="CR">CR</option>
                            <option value="VZ">VZ</option>

                        </select>

                    </div>

                    <div style="float: left; width: 50%;">

                        <select class="form-control" id="select_pneu_15">

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

                <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">

                    <img id="gal_1" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 

                </div>

                <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
                </div>

                <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
        
                    <img id="gal_3" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 
        
                </div> 
        
                <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">     
                </div> 
        
                <div  style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
        
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

        <div class="col-md-3 col-12">

            Items:


        </div> 

    </div>
    
    <div class="div_br"> </div> 

    <div class="row">

        <div class='col-md-12 col-12'>

             Observações:
            <input type="text" class="form-control" id="obs_geral_final">

        </div>

    </div>

    <div class="div_br"> </div>  
