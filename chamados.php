<?php

include 'cabecalho.php';

include 'config/mensagem/ajax_mensagem_alert.php';

//ACESSO RESTRITO
include 'acesso_restrito.php';

?>


<div class="div_br"> </div>

<h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-headset efeito-zoom"></i> <label class="display_esconder_mobile"> Chamados</label></h11>

<div class='espaco_pequeno'></div>

<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

    <div class="div_br"> </div>  
    <div class="div_br"> </div>  
    <div class="div_br"> </div>  

    <!--INPUT HIDE PARA PEGAR VALOR TOTAL DE LINHAS-->
    <div id="linhas"></div>

    
    <div class="row">


        <div id="botão1"style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-4" onclick="ajax_chama_pagina('1'),ajax_style('1')"><i class="fa-solid fa-circle-plus"></i> Solicitados</div>

        <div id="botão2"style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-4" onclick="ajax_chama_pagina('2'),ajax_style('2')"><i class="fa-solid fa-circle-check"></i> Designados</div>

        <div id="botão3"style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-4" onclick="ajax_chama_pagina('3'),ajax_style('3')"><i class="fa-solid fa-circle-plus"></i> Realizadas</div>


    </div>

    <div class="div_br"> </div>  
    <div class="div_br"> </div>  

    <div id="paginas"></div>  
    <div id="solic"></div>
      

    <!--MODAL DETALHE OS-->
    <div class="modal fade" id="detalhe_os_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="width: 100%; text-align: center;">
                    <div style="margin: 0 auto; background-color: #46A5D4; color: white; width: 50%; border-radius: 25px;">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes OS</h5>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                            
                    <div id="detalhe_os"></div>
                               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                </div>
            </div>
        </div>
    </div>

    <!--MODAL INDICA MOTORISTA-->
    <div class="modal fade top_modal" id="indica_motorista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-bell"></i> Escolha um Motorista</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div id="motorista"></div>


            <div id="mensagem_updates_indica"></div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="ajax_insert_lib_mot()">Designar</button>
        </div>
        </div>
    </div>
    </div>

    
    <!--MODAL INDICA MOTORISTA update-->
    <div class="modal fade top_modal" id="indica_motorista_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-bell"></i> Escolha um Motorista</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div id="motorista_update"></div>

            <div id="mensagem_updates"></div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="ajax_update_motorista()" >Designar</button>
        </div>
        </div>
    </div>
    </div>

    <!--MODAL DETALHE CHAMADO-->
    <div class="modal fade" id="detalhe_chamado_rea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div style="width: 100%; text-align: center;">
                <div style="margin: 0 auto; background-color: #46A5D4; color: white; width: 60%; border-radius: 25px;">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes da Corrida</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                        
                <div id="detalhe_chamado_realizados"></div>
                            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
    </div>

    <div id="mensagem_acoes"></div>

<script>

    global_dt_solic1 = '';
    global_dt_solic2 = '';

    function ajax_exibe_solic(tp_btn){

        
        var data1 = document.getElementById('data1solic').value;
        var data2 = document.getElementById('data2solic').value;

        global_dt_solic1 = data1;
        global_dt_solic2 = data2;

        if(tp_btn == '1'){

            if(data1 == ''){

                //alert(var_beep);
                //MENSAGEM            
                var_ds_msg = 'Preencha%20os%20campos%20necessarios!';
                //var_tp_msg = 'alert-success';
                var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


            }else if(data2 == ''){

                //alert(var_beep);
                //MENSAGEM
                var_ds_msg = 'Preencha%20os%20campos%20necessarios!';
                //var_tp_msg = 'alert-success';
                var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);



            }else{

                $('#solic').load('funcoes/chamados/ajax_exibe_solic.php?data1='+data1+'&data2='+data2);

            }

            

        }else{

            if(data1 == ''){

                //alert(var_beep);
                //MENSAGEM            
                var_ds_msg = 'Preencha%20os%20campos%20necessarios!';
                //var_tp_msg = 'alert-success';
                var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


            }else if(data2 == ''){

                //alert(var_beep);
                //MENSAGEM
                var_ds_msg = 'Preencha%20os%20campos%20necessarios!';
                //var_tp_msg = 'alert-success';
                var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);



            }else{


                $('#solic').load('funcoes/chamados/ajax_exibe_solic.php?data1='+data1+'&data2='+data2);
            
            }

        }
        
    }


    function ajax_chama_caixa_chamado_realizados(tp_botao){

        var data1 = document.getElementById('data1').value;
        var data2 = document.getElementById('data2').value;
        var setor = document.getElementById('filtro-setor').value;
        var solicitante = document.getElementById('filtro-solicitante').value;

        if(tp_botao == '1'){

            $('#caixas_chamado').load('funcoes/chamados/ajax_caixas_chamado_realizados.php?data1='+data1+'&data2='+data2+'&setor='+setor+'&solicitante='+solicitante);

        }else{

            $('#caixas_chamado').load('funcoes/chamados/ajax_caixas_chamado_realizados.php?data1='+data1+'&data2='+data2+'&setor='+setor+'&solicitante='+solicitante);

        }
        

    }

    function ajax_detalhe_chamado(cd_chamado_d){

        //ABRINDO MODAL
        $('#detalhe_chamado_rea').modal('show')

        //CONSTRUINDO CORPO COM MOTORISTA
        $('#detalhe_chamado_realizados').load('funcoes/chamados/ajax_detalhe_chamado_rea.php?chamado='+cd_chamado_d);

    }

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

    function ajax_modal_update_motorista(cd_chamado_d){


        //ABRINDO MODAL
        $('#indica_motorista_update').modal('show')

        //CONSTRUINDO CORPO COM MOTORISTA
        $('#motorista_update').load('funcoes/chamados/ajax_motorista_designado.php?&chamado='+cd_chamado_d);

    }


    function ajax_update_motorista(){

        var js_chamado = document.getElementById('chamado_designado').value;
        var js_cd_motorista = document.getElementById('mot_up').value;

        if(js_cd_motorista == 'All'){

            //alert(var_beep);
            //MENSAGEM            
            var_ds_msg = 'Selecione%20um%20Motorista!%20';
            //var_tp_msg = 'alert-success';
            var_tp_msg = 'alert-danger';
            //var_tp_msg = 'alert-primary';
            $('#mensagem_updates').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


        }else{

            $.ajax({
                
                url: "funcoes/chamados/ajax_update_motorista_designado.php",
                type: "POST",
                data: {

                    js_chamado : js_chamado,
                    js_cd_motorista : js_cd_motorista
                    


                },
                
                cache: false,
                success: function(dataResult){

                    console.log(dataResult);

                    //FECHANDO MODAL
                    $('#indica_motorista_update').modal('hide');

                    ajax_chama_pagina('2');

                      //alert(var_beep);
                      //MENSAGEM            
                      var_ds_msg = 'Motorista%20designado%20com%20sucesso!';
                      var_tp_msg = 'alert-success';
                      //var_tp_msg = 'alert-danger';
                      //var_tp_msg = 'alert-primary';
                      $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                
                }

            });
        
        }


    }

    function ajax_lib_mot(os){

        var js_os_mv = os;

        //ABRINDO MODAL
        $('#indica_motorista').modal('show')

        //CONSTRUINDO CORPO COM MOTORISTA
        $('#motorista').load('funcoes/chamados/ajax_constroi_modal_motorista.php?&os='+js_os_mv);

    }

    function ajax_insert_lib_mot(){

        var js_motorista = document.getElementById('motorista_indicado').value;
        var js_os = document.getElementById('os_mv').value;
        var js_tp_status = 'D'

        
        if(js_motorista == 'All'){ 

            //alert(var_beep);
            //MENSAGEM            
            var_ds_msg = 'Indique%20um%20Motorista!%20';
            //var_tp_msg = 'alert-success';
            var_tp_msg = 'alert-danger';
            //var_tp_msg = 'alert-primary';
            $('#mensagem_updates_indica').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

        }else {

            $.ajax({
                
                url: "funcoes/chamados/ajax_insert_lib_mot.php",
                type: "POST",
                data: {

                    js_motorista : js_motorista,
                    js_os : js_os,
                    js_tp_status: js_tp_status


                },
                
                cache: false,
                success: function(dataResult){

                    console.log(dataResult);

                    if(dataResult == 1){

                        //alert(var_beep);
                        //MENSAGEM            
                        var_ds_msg = 'Motorista%20não%20possui%20check-in%20em%20veiculo!';
                        //var_tp_msg = 'alert-success';
                        var_tp_msg = 'alert-danger';
                        //var_tp_msg = 'alert-primary';
                        $('#mensagem_updates_indica').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                    }else{

                        //FECHANDO MODAL
                        $('#indica_motorista').modal('hide');
                        pagtabela();

                    
                    }

                }

            });

        }
        
            

    }


    global_inicio = 1;
    global_pag = 10;
    global_fim = 0;

    //FUNÇÃO QUE CONSTROI A TABELA E A PAGINAÇÃO
    function pagtabela(direcao){

        global_dt_solic1;
        global_dt_solic2;

        var_direcao = direcao;
        var_tot_linha = document.getElementById('linhas_tot').value;

        if(var_direcao == 'dir'){

            global_inicio = global_inicio + global_pag;

        }

        if(var_direcao == 'esq'){

            if(global_inicio !== 1){

                global_inicio = global_inicio - global_pag;

            }

        }

        if(global_fim <=  var_tot_linha){

            global_fim = global_inicio + global_pag - 1;

        }else{

            global_inicio = 1;
            global_fim = 10;

        }
           
        $('#solic').load('funcoes/chamados/ajax_exibe_solic.php?global_inicio='+global_inicio+'&global_fim='+global_fim+'&data1='+global_dt_solic1+'&data2='+global_dt_solic2);
        
        //CHAMANDO CONSULTA AUXILIAR PARA VERIFICAR QUANTIDADE DE LINHAS
        $('#linhas').load('funcoes/chamados/ajax_quantidade_linhas_solicitados.php?data1='+global_dt_solic1+'&data2='+global_dt_solic2);

    };


     /*
    // Função que será chamada a cada 20 segundos usando setInterval
    function atualizarPagina() {

        pagtabela('dir'); // Chamando a função pagtabela com o argumento 'dir'

    }

    // Chamando a função atualizarPagina a cada 20 segundos usando setInterval
    setInterval(atualizarPagina, 10000); // 10000 milissegundos = 10 segundos
    */


    window.onload = function(){

        $('#paginas').load('funcoes/chamados/ajax_constroi_chamados_solicitados.php');
        $('#linhas').load('funcoes/chamados/ajax_quantidade_linhas_solicitados.php?');
        $('[data-toggle="tooltip"]').tooltip();

            ajax_style('1')

            document.getElementById('botão1').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer; background-color: #f9f9f9 !important;");

            document.getElementById('botão2').removeAttribute("style");
            document.getElementById('botão3').removeAttribute("style");

            // ADICIONA O CURSOR APÓS RETIRAR O STYLE
            document.getElementById('botão2').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");
            document.getElementById('botão3').setAttribute("style", "cursor: pointer; background-color: #f9f9f9 !important;");


    }

    function ajax_chama_pagina(pagina){

        if(pagina == '1'){

            $('#paginas').load('funcoes/chamados/ajax_constroi_chamados_solicitados.php');

        }else if(pagina == '2'){

            $('#paginas').load('funcoes/chamados/ajax_constroi_chamados_designados.php');

            var div = document.getElementById('solic');
            div.innerHTML = ''; // Limpa o conteúdo da div

        }else{

            var div = document.getElementById('paginas');
            div.innerHTML = ''; // Limpa o conteúdo da div

            $('#paginas').load('funcoes/chamados/ajax_constroi_chamados_realizados.php');

            
        }

    }


    function ajax_detalhe_os(os){

        $('#detalhe_os_modal').modal('show')
        
        $('#detalhe_os').load('funcoes/chamados/ajax_constroi_modal_det_chamados.php?os='+os);


    }

</script>


<?php

include 'rodape.php';


?>