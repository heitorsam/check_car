<?php 
    
include 'cabecalho.php';

//ACESSO RESTRITO
include 'acesso_restrito.php';


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

    <div class="row">

        <div style="background-color: #f9f9f9 !important;" class="col-1"></div>

        <div id="botao_xX" style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-4" onclick="ajax_chama_pagina('1'),ajax_style('1')"><i class="fa-solid fa-circle-plus"></i> Novo</div>
       
        <div style="background-color: #f9f9f9 !important;" class="col-2"></div>
        
        <div id="bota_zZ" style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-4" onclick="ajax_chama_pagina('2'),ajax_style('2')"><i class="fa-solid fa-circle-check"></i> Realizados</div>
        
        <div style="background-color: #f9f9f9 !important;" class="col-1"></div>

    </div>

    <!--INPUT PARA PEGAR VALOR DA SEQUENCE NO JAVASCRIPT-->
    <input type="text" id="seq" value="<?php echo $row_seq['SEQ_CK']; ?>" hidden>

    <div id="paginas"></div>

    <div class="div_br"> </div> 

    <div id="restante_check_list"></div>

    <div id="mensagem_acoes"></div>

    <script>

        function ajax_style(btn){

            if (btn == '1') {

                document.getElementById('botao_xX').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer; background-color: #f9f9f9 !important;");


                document.getElementById('bota_zZ').removeAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer;");

                // ADICIONA O CURSOR APÓS RETIRAR O STYLE
                document.getElementById('bota_zZ').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");


            }else{

                document.getElementById('bota_zZ').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer; background-color: #f9f9f9 !important;");

                document.getElementById('botao_xX').removeAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer;");

                // ADICIONA O CURSOR APÓS RETIRAR O STYLE
                document.getElementById('botao_xX').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");


            } 

        }

        
        //ABRE MODAL COM DETALHES DO QUE FOI FEITO NO CHECKLIST
        function ajax_modal_check_list(checklist){

            $('#checklist').modal('show');
            
            $('#checklist_det').load('funcoes/checklist/ajax_det_checklist.php?cd_checklist='+checklist);

        }

        //CONSTRUINDO REALIZADOS COM BASE NO VEICULO
        function ajax_constroi_realizados(){

            var cd_veiculo = document.getElementById('veiculo_realizados').value;
            var data_realizados = document.getElementById('data_realizados').value;
            $('#constroi_realizado').load('funcoes/checklist/ajax_constroi_detalhes_realizados.php?cd_veiculo='+cd_veiculo+'&data='+data_realizados);

        }
        



        //CHAMANDO DIV PAGINAS ASSIM QUE ABRE A PAGINA!
        window.onload = function(){

            $('#paginas').load('funcoes/checklist/ajax_constroi_pagina_pesquisa.php');

            ajax_style('1');

            document.getElementById('botao_xX').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer; background-color: #f9f9f9 !important;");

            document.getElementById('bota_zZ').removeAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer;");

            // ADICIONA O CURSOR APÓS RETIRAR O STYLE
            document.getElementById('bota_zZ').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");


        }

        

        //CHAMANDO PAGINA
        function ajax_chama_pagina(pagina){

            if(pagina == '1'){

                $('#paginas').load('funcoes/checklist/ajax_constroi_pagina_pesquisa.php');

            }else{

                $('#paginas').load('funcoes/checklist/ajax_constroi_pagina_realizados.php');

            }

        }
        
        //UPDATE QUE REALIZA AO FINALIZAR CHECKLIST
        function ajax_roda_update(){

            var sequence = document.getElementById('seq').value;
            var tipo = document.getElementById('tp_status').value;
            var obs_geral = document.getElementById('obs_geral_final').value;
            var plantao = document.getElementById('plantao').value;

            $.ajax({
                
                url: "funcoes/checklist/ajax_update_checklist.php",
                type: "POST",
                data: {

                    sequence : sequence,
                    tipo : tipo,
                    obs_geral : obs_geral,
                    plantao : plantao

                },
                
                cache: false,
                success: function(dataResult){

                    console.log(dataResult);
                    ajax_reload_pagina();
                    
                }

                

            }); 


        }


        //FUNCTION CHAMA MENSAGEM E RELOAD NA PAGINA
        function ajax_reload_pagina(){

            //MENSAGEM            
            var_ds_msg = 'Checklist%20realizado%20com%20sucesso!';
            var_tp_msg = 'alert-success';
            //var_tp_msg = 'alert-danger';
            //var_tp_msg = 'alert-primary';
            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
           
            //RELOAD NA PAGINA DEPOIS DE 3SEG!
            setTimeout(function() {
                window.location.reload(1);
            }, 3000)

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

            var seq = document.getElementById('seq').value;

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

                $('#restante_check_list').load('funcoes/checklist/ajax_constroi_check_list.php?cd_veiculo='+veiculo+'&cd_seq='+seq+'&condutor='+condutor);

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