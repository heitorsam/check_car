<?php

include 'cabecalho.php';


?>


<div class="div_br"> </div>

<h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-headset efeito-zoom"></i> <label class="display_esconder_mobile"> Chamados</label></h11>

<div class='espaco_pequeno'></div>

<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  



    <!--MOBILE-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i  style="cursor: pointer;" class="fa-solid fa-headset efeito-zoom"></i> Chamados</h11>

        </div>

    </div>

    <div class="div_br"> </div>  
    <div class="div_br"> </div>  

    <!--INPUT HIDE PARA PEGAR VALOR TOTAL DE LINHAS-->
    <div id="linhas"></div>

    
    <div class="row">

        <div style="background-color: #f9f9f9 !important;" class="col-1"></div>
        <div style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-4" onclick="ajax_chama_pagina('1')"><i class="fa-solid fa-circle-plus"></i> Solicitados</div>
        <div style="background-color: #f9f9f9 !important;" class="col-2"></div>
        <div style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-4" onclick="ajax_chama_pagina('2')"><i class="fa-solid fa-circle-check"></i> Designados</div>
        <div style="background-color: #f9f9f9 !important;" class="col-1"></div>

    </div>

    <div id="paginas"></div>  
      

    <!--MODAL DETALHE OS-->
    <div style="margin-top:50%;"  class="modal fade" id="detalhe_os_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="width: 100%; text-align: center;">
                    <div style="margin: 0 auto; background-color: #46A5D4; color: white; width: 50%; border-radius: 25px;">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes OS</h5>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
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
    <div style="margin-top:50%;" class="modal fade " id="indica_motorista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            <button type="button" class="btn btn-primary" onclick="ajax_insert_lib_mot()">Sim</button>
        </div>
        </div>
    </div>
    </div>

<script>

  

    function ajax_lib_mot(os){

        //ABRINDO MODAL
        $('#indica_motorista').modal('show')

        //CONSTRUINDO CORPO COM MOTORISTA
        $('#motorista').load('funcoes/chamados/ajax_constroi_modal_motorista.php?');

    }

    function ajax_insert_lib_mot(){

        var global_cd_os;
        var motorista = document.getElementById('motorista_indicado').value;

        alert(global_cd_os);
        alert(motorista);

        /* $.ajax({
            
            url: "funcoes/chamados/ajax_insert_lib_mot.php",
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

            }

        });
        */

    }


    global_inicio = 1;
    global_pag = 10;
    global_fim = 0;

    //FUNÇÃO QUE CONSTROI A TABELA E A PAGINAÇÃO
    function pagtabela(direcao){

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
           
        $('#paginas').load('funcoes/chamados/ajax_constroi_chamados_solicitados.php?global_inicio='+global_inicio+'&global_fim='+global_fim);
        
        //CHAMANDO CONSULTA AUXILIAR PARA VERIFICAR QUANTIDADE DE LINHAS
        $('#linhas').load('funcoes/chamados/ajax_quantidade_linhas_solicitados.php?');

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

    }

    function ajax_chama_pagina(pagina){

        if(pagina == '1'){

            $('#paginas').load('funcoes/chamados/ajax_constroi_chamados_solicitados.php');

        }else{

            $('#paginas').load('funcoes/chamados/ajax_constroi_chamados_designados.php');

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