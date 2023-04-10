<?php 

include 'cabecalho.php';

$datahoje = date('Y-m-d', time());

//CONEXÃO
include 'conexao.php';

//RODANDO SEQUENCE 
$cons_seq = "SELECT
             portal_check_car.SEQ_CD_CHECKLIST.NEXTVAL AS SEQ_CK
             FROM DUAL";
$res_seq = oci_parse($conn_ora, $cons_seq);
           oci_execute($res_seq);
$row_seq = oci_fetch_array($res_seq);


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
        
        <!--INPUT PARA PEGAR VALOR DA SEQUENCE NO JAVASCRIPT-->
        <input type="text" id="seq" value="<?php echo $row_seq['SEQ_CK']; ?>" hidden>


        <div class="col-md-3 esconde">

            Tipo:
            <select class="form-control" id="tp_status">
                <option value="">Selecione</option>
                <option value="S">Saida</option>
                <option value="R">Retorno</option>
            </select>

        </div> 

        <div class="col-md-2 esconde">

            Veiculo:
            <select class="form-control" id="veiculo">

                <option value="">Selecione</option>
                
                <?php

                        while($row = oci_fetch_array($res_cons_veiculo)){

                            echo '<option value="'. $row['CD_VEICULO'] .'">'. $row['DS_MODELO'] . ' / ' . $row['DS_PLACA'] .'</option>';

                        }

                ?>


            </select>

        </div>


        <div class="col-md-3 esconde">

            Condutor:
            <select class="form-control" id="condutor">

                <option value="">Selecione</option>
                                
                <?php

                        
                        //CONSULTA MOTORISTA
                        $cons_motorista = "SELECT usu.CD_USUARIO,
                        usu.CD_USUARIO_MV,
                        (SELECT usux.NM_USUARIO FROM dbasgu.USUARIOS usux WHERE usux.CD_USUARIO = usu.CD_USUARIO_MV) AS NM_USUARIO
                        FROM portal_check_car.USUARIO usu
                        WHERE usu.TP_STATUS = 'A'";
                        $res_cons_motorista = oci_parse($conn_ora, $cons_motorista);
                        oci_execute($res_cons_motorista);    

                        $row_motorista = oci_fetch_array($res_cons_motorista);

                        while($row_motorista = oci_fetch_array($res_cons_motorista)){

                            echo '<option value="'. $row_motorista['CD_USUARIO'] .'">'. $row_motorista['NM_USUARIO'] .'</option>';

                        }

                ?>


            </select>

        </div>

        <div class='col-md-2 esconde'>

            </br>
            <button onclick="ajax_constroi_check_list() , ajax_insert_tabela_checklist()" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>

        </div>



    </div>
    
    <div class="div_br"> </div> 

    <div class="div_br"> </div> 

    <div id="restante_check_list"></div>

    <script>


        //UPDATE QUE REALIZA AO FINALIZAR CHECKLIST
        function ajax_roda_update(){

            

            var sequence = document.getElementById('seq').value;
            var tipo = document.getElementById('tp_status').value;
            var obs_geral = document.getElementById('obs_geral_final').value;
            
            alert(obs_geral);

            $.ajax({
                
                url: "funcoes/checklist/ajax_update_checklist.php",
                type: "POST",
                data: {

                    sequence : sequence,
                    tipo : tipo,
                    obs_geral : obs_geral

                },
                
                cache: false,
                success: function(dataResult){

                    console.log(dataResult);

                    
                }

                

            }); 


        }

        //DELETE TABELA ITCHECKLIST DESKTOP
        function ajax_deleta_item_table(cd_item){

            var sequence = document.getElementById('seq').value;

            $.ajax({
                
                url: "funcoes/checklist/ajax_deleta_item_table.php",
                type: "POST",
                data: {

                    sequence : sequence,
                    cd_item : cd_item

                },
                
                cache: false,
                success: function(dataResult){

                    console.log(dataResult);
                    ajax_constroi_tabela_items();
                    
                }

                

            });  

        }


        //INSERT TABELA ITCHECKLIST DESKTOP
        function ajax_insert_tabela_itchecklist(js_cd_item,js_resposta){



            if(js_cd_item == '0'){

                js_cd_item = document.getElementById('tp_item_cadastrado').value;
                js_resposta = 'DANIFICADO';
            }

            //RECEBENDO VALORES
            if(js_resposta == 'PNEU'){

                js_resposta = document.getElementById('select_pneu_'+js_cd_item).value;
                
            }
                            
            
            //RECEBENDO VALORES PNEUS/LOGICA
            if(js_resposta == 'PNEU'){

                js_resposta = document.getElementById('select_pneu_'+js_cd_item).value;
            }
             
            var js_sequence = document.getElementById('seq').value;
            var js_apenas_exclui = 'N';

            if(js_cd_item >= 1 && js_cd_item <= 12 && document.getElementById(''+js_cd_item+'').checked == false){

                var js_apenas_exclui = 'S';

            }
            
            $.ajax({
                
                url: "funcoes/checklist/ajax_insert_tabela_itchecklist.php",
                type: "POST",
                data: {

                    sequence : js_sequence,
                    cd_item : js_cd_item,
                    resposta : js_resposta,
                    sn_apenas_exclui : js_apenas_exclui


                },
                
                cache: false,
                success: function(dataResult){

                    console.log(dataResult);
                    ajax_constroi_tabela_items();
                    
                }

                

            });  

            

            
            
        }

        //INSERT TABELA CHECKLIST DESKTOP
        function ajax_insert_tabela_checklist(){

            tipo = document.getElementById('tp_status').value;
            veiculo = document.getElementById('veiculo').value;
            condutor = document.getElementById('condutor').value;
            sequence = document.getElementById('seq').value;

            $.ajax({
                
                url: "funcoes/checklist/ajax_insert_tabela_checklist.php",
                type: "POST",
                data: {

                    tipo : tipo,
                    veiculo : veiculo,
                    condutor : condutor,
                    sequence : sequence


                },
                
                cache: false,
                success: function(dataResult){

                    console.log(dataResult);

                    
                }

            });  

        }

        //RESTANTE DO CHECKLIST DESKTOP
        function ajax_constroi_check_list(){

            var condutor = document.getElementById('condutor').value;
            if(condutor == ''){
                document.getElementById('condutor').focus();
            }

            var veiculo = document.getElementById('veiculo').value;
            if(veiculo == ''){
                document.getElementById('veiculo').focus();
            }
            
            var status = document.getElementById('tp_status').value;
            if(status == ''){
                document.getElementById('tp_status').focus();
            }

            if(status != ''  && veiculo != '' && condutor != ''){

                $('#restante_check_list').load('funcoes/checklist/ajax_constroi_check_list.php?cd_veiculo='+veiculo);

            }
           
            
            
        }

        //CONSTROI TABELA DESKTOP / MOBILE
        function ajax_constroi_tabela_items(){

            sequence = document.getElementById('seq').value;
            $('#tabela_items').load('funcoes/checklist/ajax_constroi_table_items.php?seq='+sequence);

        }



        //FUEL DESKTOP/MOBILE
        var global_js_valor_gal = 'x';

        function js_gal_sel(js_vl_sel){

            document.getElementById('gal_1').style.display = 'none';
            document.getElementById('gal_3').style.display = 'none';
            document.getElementById('gal_5').style.display = 'none';            

            document.getElementById('gal_'+js_vl_sel).style.display = 'block';

            global_js_valor_gal = js_vl_sel;

            //alert(global_js_valor_gal);
        }

    </script>


<?php 

include 'rodape.php';

?>