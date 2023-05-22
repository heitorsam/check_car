<?php

    //CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_check = $_GET['cd_checklist'];

    //WHILE SELECT PEGAR ITENS 
    $cons_while = "SELECT CD_ITEM_VEICULO 
                    FROM portal_check_car.ITEM_VEICULO";
    $res_while = oci_parse($conn_ora, $cons_while);
                 oci_execute($res_while);
    
    //INICIANDO WHILE 
    $cont_while = 0;
    $texto_final_while = '';
            
    while ($row_while = oci_fetch_array($res_while)){

        if($cont_while > 0){

            $texto_final_while .= ',';

        }

        $texto_final_while .= $row_while['CD_ITEM_VEICULO'];

        $texto_final_while .= ' AS "H' . $row_while['CD_ITEM_VEICULO'] . '"';

        $cont_while = $cont_while + 1;

    }

    $texto_final_while .= '';

    //FINALIZANDO O WHILE


    //PIVOT
    $cons_pivot = "SELECT * FROM (
   
        SELECT res.CD_ITEM_VEICULO AS CD_ITEM_VEICULO, res.DS_RESPOSTA
                   FROM(
                  SELECT tot.*,
                  (SELECT cor.DS_RGB
                     FROM portal_check_car.COR cor
                    WHERE cor.CD_COR = tot.COR) AS DS_COR
                    FROM (SELECT res.*,
                          (SELECT vei.CD_COR
                             FROM portal_check_car.VEICULO vei
                            WHERE vei.CD_VEICULO = res.CD_VEICULO) AS COR
                     FROM (SELECT ick.CD_ITEM_VEICULO,
                                  ick.DS_RESPOSTA,
                                  (SELECT iv.DS_ITEM_VEICULO
                                     FROM portal_check_car.ITEM_VEICULO iv
                                    WHERE iv.CD_ITEM_VEICULO = ick.CD_ITEM_VEICULO) AS DS_ITEM,
                                  (SELECT iv.SN_PADRAO
                                     FROM portal_check_car.ITEM_VEICULO iv
                                    WHERE iv.CD_ITEM_VEICULO = ick.CD_ITEM_VEICULO) AS SN_PADRAO,
                                  (SELECT ck.CD_VEICULO
                                     FROM portal_check_car.CHECKLIST ck
                                    WHERE ck.CD_CHECKLIST = ick.CD_CHECKLIST) AS CD_VEICULO
                             FROM portal_check_car.ITCHECKLIST ick
                            WHERE ick.CD_CHECKLIST = $var_check
                            ORDER BY ick.CD_ITEM_VEICULO ASC) res ) tot) res
     
     )
     pivot 
     (
        MAX(DS_RESPOSTA) 
        FOR CD_ITEM_VEICULO IN (" . $texto_final_while . ")

     )";

    $res_pivot = oci_parse($conn_ora, $cons_pivot);
    oci_execute($res_pivot);

    $row_pivot = oci_fetch_array($res_pivot);


   $teste_coluna = 'H18';
    
    //echo $row_pivot[$teste_coluna];


    $cons_items = "SELECT tot.*,
                        (SELECT cor.DS_RGB
                        FROM portal_check_car.COR cor
                        WHERE cor.CD_COR = tot.COR) AS DS_COR
                        FROM (SELECT res.*,
                                (SELECT vei.CD_COR
                                FROM portal_check_car.VEICULO vei
                                WHERE vei.CD_VEICULO = res.CD_VEICULO) AS COR
                        FROM (SELECT ick.CD_ITEM_VEICULO,
                                        ick.DS_RESPOSTA,
                                        (SELECT iv.DS_ITEM_VEICULO
                                        FROM portal_check_car.ITEM_VEICULO iv
                                        WHERE iv.CD_ITEM_VEICULO = ick.CD_ITEM_VEICULO) AS DS_ITEM,
                                        (SELECT iv.SN_PADRAO
                                        FROM portal_check_car.ITEM_VEICULO iv
                                        WHERE iv.CD_ITEM_VEICULO = ick.CD_ITEM_VEICULO) AS SN_PADRAO,
                                        (SELECT ck.CD_VEICULO
                                        FROM portal_check_car.CHECKLIST ck
                                        WHERE ck.CD_CHECKLIST = ick.CD_CHECKLIST) AS CD_VEICULO
                                FROM portal_check_car.ITCHECKLIST ick
                                WHERE ick.CD_CHECKLIST = $var_check
                                ORDER BY ick.CD_ITEM_VEICULO ASC) res ) tot
                                WHERE tot.SN_PADRAO = 'N'";
    $res_itens = oci_parse($conn_ora, $cons_items);
                 oci_execute($res_itens);

    $cons_obs = "SELECT ck.OBS_GERAL 
                FROM portal_check_car.CHECKLIST ck
                WHERE ck.CD_CHECKLIST = $var_check";

    $res_cons_obs = oci_parse($conn_ora, $cons_obs);
    oci_execute($res_cons_obs);
    
    $row_obs = oci_fetch_array($res_cons_obs);


?>




<!--DESKTOP E MOBILE-->
<div style="background-color: #46a5d4; color: #ffffff; font-weight: bold; border-radius: 15px;"> <label style="padding-left: 15px; padding-top: 10px;">Itens Danificados:</label></div>
    
    <div class="div_br"> </div> 

    

    <div>

        <div class="carro_check" style="margin: 0 auto; ">

            <div class="row">


                <div style="text-align: center; "class="col-1"></div>

                <?php

                if(@$row_pivot['H2'] == 'DANIFICADO'){

                    echo '<div onclick="return false;" style="text-align: center; "class="col-2"> 02 <input id="2" style="zoom: 2.0;" type="checkbox" checked></div>';
                
                }else{
                  
                    echo '<div onclick="return false;" style="text-align: center; "class="col-2"> 02 <input id="2" style="zoom: 2.0;" type="checkbox" ></div>';
                    
                }

                if(@$row_pivot['H3'] == 'DANIFICADO'){

                    echo '<div onclick="return false;" style="text-align: center; " class="col-2">03 <input id="3" style="zoom: 2.0;" type="checkbox" checked></div>';
                
                }else{
                  
                    echo '<div onclick="return false;" style="text-align: center; " class="col-2">03 <input id="3" style="zoom: 2.0;" type="checkbox"></div>';
                    
                }

                if(@$row_pivot['H4'] == 'DANIFICADO'){

                    echo '<div onclick="return false;" style="text-align: center; " class="col-2">04 <input id="4" style="zoom: 2.0;" type="checkbox" checked></div>';
                
                }else{
                  
                    echo '<div onclick="return false;" style="text-align: center; " class="col-2">04 <input id="4" style="zoom: 2.0;" type="checkbox"></div>';
                    
                }

                if(@$row_pivot['H5'] == 'DANIFICADO'){

                    echo '<div onclick="return false;" style="text-align: center; " class="col-2">05 <input id="5" style="zoom: 2.0;" type="checkbox" checked></div>';
                
                }else{
                  
                    echo '<div onclick="return false;" style="text-align: center; " class="col-2">05 <input id="5" style="zoom: 2.0;" type="checkbox"></div>';
                   
                    
                }

                if(@$row_pivot['H6'] == 'DANIFICADO'){

                    echo '<div onclick="return false;" style="text-align: center; " class="col-2">06 <input id="6" style="zoom: 2.0;" type="checkbox" checked></div>';
                
                }else{
                  
                    echo '<div onclick="return false;" style="text-align: center; " class="col-2">06 <input id="6" style="zoom: 2.0;" type="checkbox"></div>';
                   
                    
                }



                ?>
                
                
                
                
                <div style="text-align: center; " class="col-1"></div>


            </div>

            <div class="row">
                <div style="text-align: center; " class="col-1"></div>
                
                <?php if(@$row_pivot['H1'] == 'DANIFICADO'){

                    echo '<div onclick="return false;" style="text-align: center; line-height: 60px; " class="col-2">01 <input id="1" style="zoom: 2.0;" type="checkbox" checked></div>';
                
                }else{

                    echo '<div onclick="return false;" style="text-align: center; line-height: 60px; " class="col-2">01 <input id="1" style="zoom: 2.0;" type="checkbox"></div>';

                }

                ?>
                

                <div  class="col-6">
                    <br><br>
                    <div style=" background-color: <?php echo $row['DS_COR']; ?>; width: 150px; height: 60px; margin: 0 auto;">
                        <img src="img/car.png">
                    </div>

                </div>

                <?php if(@$row_pivot['H7'] == 'DANIFICADO'){

                    echo '<div onclick="return false;" style=" text-align: center; line-height: 60px; " class="col-2">07 <input id="7" style="zoom: 2.0;" type="checkbox" checked></div>';

                    }else{

                    echo '<div onclick="return false;" style=" text-align: center; line-height: 60px; " class="col-2">07 <input id="7" style="zoom: 2.0;" type="checkbox" ></div>';

                    }

                ?>
                
                
                <div style=" text-align: center; " class="col-1"></div>
            </div>

            <div class="row">
                <div style="text-align: center; " class="col-1"></div>

                <?php 

                    if(@$row_pivot['H12'] == 'DANIFICADO'){

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">12 <input id="12" style="zoom: 2.0;" type="checkbox" checked></div>';

                    }else{

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">12 <input id="12" style="zoom: 2.0;" type="checkbox"></div>';

                    }

                    if(@$row_pivot['H11'] == 'DANIFICADO'){

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">11 <input id="11" style="zoom: 2.0;" type="checkbox" checked></div>';

                    }else{

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">11 <input id="11" style="zoom: 2.0;" type="checkbox"></div>';

                    }

                    
                    if(@$row_pivot['H10'] == 'DANIFICADO'){

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">10 <input id="10" style="zoom: 2.0;" type="checkbox" checked></div>';

                    }else{

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">10 <input id="10" style="zoom: 2.0;" type="checkbox"></div>';

                    }

                                        
                    if(@$row_pivot['H9'] == 'DANIFICADO'){

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">09 <input id="9"  style="zoom: 2.0;" type="checkbox" checked></div>';

                    }else{

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">09 <input id="9"  style="zoom: 2.0;" type="checkbox"></div>';

                    }

                    if(@$row_pivot['H8'] == 'DANIFICADO'){

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">08 <input id="8"  style="zoom: 2.0;" type="checkbox" checked></div>';

                    }else{

                        echo '<div onclick="return false;" style="text-align: center; " class="col-2">08 <input id="8"  style="zoom: 2.0;" type="checkbox"></div>';

                    }

                ?>
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

                        <select class="form-control" id="select_pneu_13" readonly>

                            <option value=""><?php echo @$row_pivot['H13'] ?></option>

                        </select>

                    </div>

                    <div style="float: left; width: 50%;">

                        <select class="form-control" id="select_pneu_14" readonly>

                            <option value=""><?php echo @$row_pivot['H14'] ?></option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="row">

                <div style="text-align: center; " class="col-4" >
                    <div class="div_br"> </div> 
                    <select class="form-control" id="select_pneu_17" readonly>

                        <option value=""><?php echo @$row_pivot['H17'] ?></option>


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

                        <select class="form-control" id="select_pneu_16" readonly>

                            <option value=""><?php echo @$row_pivot['H16'] ?></option>

                        </select>

                    </div>

                    <div style="float: left; width: 50%;">

                        <select class="form-control" id="select_pneu_15" readonly>

                            <option value=""><?php echo @$row_pivot['H16'] ?></option>

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

                    
                    <?php
                    
                        if($row_pivot['H18'] == '0'){

                    ?>

                            <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">

                            <img id="gal_1" style="width: 30px; height: 58px; display: block;" src="img/veloc_opt_leo.png"> 

                            </div>

                    <?php


                        }else{

                    ?>

                            <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">

                            <img id="gal_1" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 

                            </div>


                    <?php


                        }
                    
                    ?>

                    <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;"></div>

                    <?php

                        if($row_pivot['H18'] == '50'){
                    
                    ?>

                            <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
                                
                                <img id="gal_3" style="width: 30px; height: 58px; display: block;" src="img/veloc_opt_leo.png"> 

                            </div> 



                    <?php

                        }else{

                    ?>
                    
                             <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
                                
                                <img id="gal_3" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 

                            </div> 


                    <?php

                        }

                    ?>


                    <div style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;"></div> 
                    
                    <?php

                        if($row_pivot['H18'] == '100'){

                    ?>

                        <div  style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
                                
                            <img id="gal_5" style="width: 30px; height: 58px; display: block;" src="img/veloc_opt_leo.png"> 

                        </div>

                    <?php

                        }else{

                    ?>

                        <div  style="float: left; width: 30px; height: 60px; background-color: rgba(1,1,1,0) !important; padding: 0px; text-align: center;">
                                
                                <img id="gal_5" style="width: 30px; height: 58px; display: none;" src="img/veloc_opt_leo.png"> 
    
                        </div>



                    <?php


                        }
                    
                    ?>

                    
 
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
    
    <table class="table table-striped " style="text-align: center;">

        <thead>

            <th style="text-align: center;"> Item</th>
            <th style="text-align: center;"> Situacao</th>

        </thead>


        <tbody>

        
        <?php

            while($row_table = oci_fetch_array($res_itens)){

                echo '<tr style="text-align: center;">';

                echo '<td class="align-middle" style="text-align: center;">'  .  $row_table['DS_ITEM'] . '</td>';
                
                if($row_table['DS_RESPOSTA'] == 'DANIFICADO'){


                    echo '<td class="align-middle" style="text-align: center;">'.'<i class="fa-solid fa-screwdriver-wrench"></i>'.'</td>';

                }

                echo '</tr>';

            }

        ?>


            

        </tbody>

    </table>

    <div class="div_br"> </div> 

    <div class="row">

        <div class='col-md-12 col-12'>

             Observações:
            <input type="text" class="form-control" id="obs_geral_final" readonly value="<?php echo $row_obs['OBS_GERAL']; ?>">

        </div>

    </div>

    <div class="div_br"> </div>  
