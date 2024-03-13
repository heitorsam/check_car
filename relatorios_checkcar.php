<?php

    include 'cabecalho.php';

//ACESSO RESTRITO
include 'acesso_restrito.php';

?>

    <div class="div_br"></div>

    <!--TITULOS-->


    <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-clipboard efeito-zoom"></i> <label class="display_esconder_mobile"> Relatórios</label></h11>

    <div class='espaco_pequeno'></div>

    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>


    <div class="div_br"></div>
    <div class="div_br"></div>

    <div class="row">


    <div id="botão1"style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-2" onclick="ajax_pagina_botoes('1'),ajax_style('1')"><i class="fa-solid fa-car"></i> Saida & Retorno</div>

    <div id="botão2"style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-2" onclick="ajax_pagina_botoes('2'),ajax_style('2')"><i class="fa-solid fa-gas-pump"></i> KM Setor</div>

    <div id="botão3"style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-2" onclick="ajax_pagina_botoes('3'),ajax_style('3')"><i class="fa-solid fa-gas-pump"></i> Abastecimento</div>


    </div>

    <div class="div_br"></div>
    <div class="div_br"></div>

    <div id="constroi_botoes"></div>

    <div id="constroi_relatorio"></div>
    <div id="constroi_relatorio_abas"></div>

    <div id="mensagem_acoes"></div>

    <!-- Modal -->
    <div class="modal fade" id="modal_detalhe_sai_ret" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes Saida & Retorno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="det_sai_ret"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

    <script>

        function ajax_style(btn){

            if (btn == '1') {

                document.getElementById('botão1').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer; background-color: #f9f9f9 !important;");

                document.getElementById('botão2').removeAttribute("style");
                document.getElementById('botão3').removeAttribute("style");

                // ADICIONA O CURSOR APÓS RETIRAR O STYLE
                document.getElementById('botão2').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");
                document.getElementById('botão3').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");

            } else if (btn == '2') {

                document.getElementById('botão2').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer; background-color: #f9f9f9 !important;");

                document.getElementById('botão1').removeAttribute("style");
                document.getElementById('botão3').removeAttribute("style");

                // ADICIONA O CURSOR APÓS RETIRAR O STYLE
                document.getElementById('botão1').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");
                document.getElementById('botão3').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");
                
            } else {

                document.getElementById('botão3').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer; background-color: #f9f9f9 !important;");

                document.getElementById('botão1').removeAttribute("style");
                document.getElementById('botão2').removeAttribute("style");

                // ADICIONA O CURSOR APÓS RETIRAR O STYLE
                document.getElementById('botão1').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");
                document.getElementById('botão2').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");

            } 


        }


        function ajax_procura_relatorio(tp_pesquisa){

            var data_inicial = document.getElementById('data_relatorio_1').value;
            var data_final = document.getElementById('data_relatorio_2').value;
            var pesquisa = tp_pesquisa;

            if(tp_pesquisa == '2'){

                $('#constroi_relatorio').load('funcoes/relatorios/ajax_rel_sai_ret.php?data1='+data_inicial+'&data2='+data_final+'&pesquisa='+pesquisa);

            }else{

                $('#constroi_relatorio').load('funcoes/relatorios/ajax_rel_sai_ret.php?data1='+data_inicial+'&data2='+data_final+'&pesquisa='+pesquisa);

            }

        }


        function ajax_emite_excel(){

            var data_inicial = document.getElementById('data_relatorio_1').value;
            var data_final = document.getElementById('data_relatorio_2').value;

            if(data_inicial == ''){

                //MENSAGEM            
                var_ds_msg = 'Selecione%20uma%20data!';
                //var_tp_msg = 'alert-success';
                var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            }else if(data_final == ''){

                //MENSAGEM            
                var_ds_msg = 'Selecione%20uma%20data!';
                //var_tp_msg = 'alert-success';
                var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            }else{

                window.location.href = 'funcoes/relatorios/excel/gera_excel_sai_ret.php?dt_ini='+ data_inicial + '&dt_fim=' + data_final;

            }

        }

        function ajax_detalhe_sai_ret(os){


            $('#modal_detalhe_sai_ret').modal('show')
            $('#det_sai_ret').load('funcoes/relatorios/modal_sai_ret.php?OS='+os);

        }

        function ajax_pagina_botoes(tp_botao){

            if(tp_botao == '1'){

                $('#constroi_botoes').load('funcoes/relatorios/pagina_sai_ret.php');

                document.getElementById("constroi_relatorio").style.display = "block";
                document.getElementById("constroi_relatorio_abas").style.display = "none";


            }

            if(tp_botao == '2'){

                $('#constroi_botoes').load('funcoes/relatorios/pagina_km_setor.php');

                document.getElementById("constroi_relatorio").style.display = "none";
                document.getElementById("constroi_relatorio_abas").style.display = "block";

            }

            if(tp_botao == '3'){

                $('#constroi_botoes').load('funcoes/relatorios/pagina_abastecimento.php');

                document.getElementById("constroi_relatorio").style.display = "none";
                document.getElementById("constroi_relatorio_abas").style.display = "block";

            }
            

        }

        window.onload = function(){
        
            $('#constroi_botoes').load('funcoes/relatorios/pagina_sai_ret.php');
            
            ajax_style('1')

            document.getElementById('botão1').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer; background-color: #f9f9f9 !important;");

            document.getElementById('botão2').removeAttribute("style");
            document.getElementById('botão3').removeAttribute("style");

            // ADICIONA O CURSOR APÓS RETIRAR O STYLE
            document.getElementById('botão2').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");
            document.getElementById('botão3').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");

        }

        function ajax_procura_abastecimento(tp_btn){

            var data_inicial = document.getElementById('data_abas_1').value;
            var data_final = document.getElementById('data_abas_2').value;
            var pesquisa = tp_btn;

            if(pesquisa == '2'){

                $('#constroi_relatorio_abas').load('funcoes/relatorios/ajax_abas.php?data1='+data_inicial+'&data2='+data_final+'&pesquisa='+pesquisa);

            }else{

                $('#constroi_relatorio_abas').load('funcoes/relatorios/ajax_abas.php?data1='+data_inicial+'&data2='+data_final+'&pesquisa='+pesquisa);

            }


        }

        function ajax_constroi_km_setor(){

            var data_inicial = document.getElementById('data_abas_1').value;
            var data_final = document.getElementById('data_abas_2').value;

            console.log('Data inicial: ', data_inicial);
            console.log('Data final: ', data_final);

            $('#constroi_relatorio_abas').load('funcoes/relatorios/ajax_abas_km_setor.php?data1='+data_inicial+'&data2='+data_final);


        }

        

        function ajax_emite_excel_abas(){

            var data_inicial = document.getElementById('data_abas_1').value;
            var data_final = document.getElementById('data_abas_2').value;

            if(data_inicial == ''){

                //MENSAGEM            
                var_ds_msg = 'Selecione%20uma%20data!';
                //var_tp_msg = 'alert-success';
                var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            }else if(data_final == ''){

                //MENSAGEM            
                var_ds_msg = 'Selecione%20uma%20data!';
                //var_tp_msg = 'alert-success';
                var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            }else{

                window.location.href = 'funcoes/relatorios/excel/gera_excel_abas.php?dt_ini='+ data_inicial + '&dt_fim=' + data_final;

            }

        }

        function ajax_lib_mot(os){

            var js_os_mv = os;

            //ABRINDO MODAL
            $('#modal_rateio').modal('show')

            //CONSTRUINDO CORPO COM MOTORISTA
            $('#rateio').load('funcoes/chamados/ajax_constroi_modal_motorista.php?&os='+js_os_mv);

        }

    </script>

<!--MODAL RATEIO-->
<div class="modal fade top_modal" id="modal_rateio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-divide"></i> Rateio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div id="rateio"></div>


            <div id="mensagem_updates_indica"></div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="ajax_insert_lib_mot()">Designar</button>
        </div>
        </div>
    </div>
</div>


<?php

    include 'rodape.php';

?>