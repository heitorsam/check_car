<?php

//INCLUDE CABECALHO
include 'cabecalho.php';

//AJAX_ALERTA
include 'config/mensagem/ajax_mensagem_alert.php';

//ACESSO RESTRITO
include 'acesso_restrito.php';


?>

    <!--TITULOS-->

        <div class="div_br"> </div>
            
        <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-user efeito-zoom"></i> <label class="display_esconder_mobile"> Motoristas</label></h11>

        <div class='espaco_pequeno'></div>

        <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

        <div class="div_br"> </div>  
    
    <!-------------------------------->

    <!--DESKTOP-->
    <form id="form_deskt" method="POST" enctype='multipart/form-data'>
        
        <div class="row">

            <div class="col-md-2 esconde">

                Login MV:
                <input type="text" onchange="ajax_constroi_nome('1')" name="usu_mv" id="usu_mv" class="form form-control" placeholder="Informe o Usuário MV">

            </div>

            <div class="div_br"> </div> 

            <div class="col-md-3 esconde" style="display: none;" id="nome_moto">

                <div id="nome"></div> 

            </div>

            <div class="div_br"> </div> 

            <div class="col-md-2 esconde">
                
                Plantão:
                <select class="form-control" name="plantao" id="tp_plantao">

                    <option value="All">Selecione</option>
                    <option value="D">Dia</option>
                    <option value="N">Noite</option>


                </select>

            </div>
            <div class="div_br"> </div> 

            <div class="col-md-3 esconde">
                Foto:
                <div style="background-color: #eff0f1; border: dashed 1px #cbced1; text-align: center;">  
                    <label style="padding-top: 10px;"class="btn btn-default btn-sm center-block btn-file">

                        <i class="fa fa-upload fa-1x" aria-hidden="true"></i>
                        Selecine um Arquivo
                        <input name="foto" type="file" id="foto_usuario" style="display: none;">

                    </label>
                </div>

            </div>
            
        

            <div class='col-md-2 esconde'>
                
                </br>
                <button onclick="ajax_insert_form_motorista('2')" class='btn btn-primary'><i class="fa-solid fa-plus"></i></button>

            </div>

        </div>

    </form>

    <div class="div_br"> </div>

    <!--MODAL CADASTRO MOTORISTA-->
    <div class="modal fade top_modal" id="motorista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Motorista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form id="form" method="POST" enctype='multipart/form-data'>

                        <div class="col-md-3">

                            MV:
                            <input onchange="ajax_constroi_nome('2')" type="text" name="usu_mv" id="usu_mv_mob" class="form form-control" placeholder="Informe o Usuário MV">

                        </div>

                        <div class="div_br"> </div> 

                            <div class="col-md-3" style="display: none;" id="nome_moto_mobile">

                            <div id="nome_mobile"></div> 

                            </div>

                        <div class="div_br"> </div>

                        <div class="col-md-3">
                            
                            Plantão:
                            <select class="form-control" name="plantao" id="tp_plantao">

                                <option value="All">Selecione</option>
                                <option value="D">Dia</option>
                                <option value="N">Noite</option>


                            </select>

                        </div>
                        <div class="div_br"> </div> 

                        <div class="col-md-3">
                            Foto:
                            <div style="background-color: #eff0f1; border: dashed 1px #cbced1; text-align: center;">  
                                <label style="padding-top: 10px;"class="btn btn-default btn-sm center-block btn-file">

                                    <i class="fa fa-upload fa-1x" aria-hidden="true"></i>
                                    Selecine um Arquivo
                                    <input name="foto" type="file" id="foto_usuario" style="display: none;">

                                </label>
                            </div>

                        </div>

                    </form>

                        <!--GLOBAL MENSAGEM AÇÕES-->
                        <div id="mensagem_error"></div>
                                    
                               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>
                    <button onclick="ajax_insert_form_motorista('1')" type="button" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>


    <!--DETALHES MOTORISTA-->

    <div class="modal fade top_modal" id="det_motoroista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="width: 100%; text-align: center;">

                    <h5 class="modal-title" id="exampleModalLabel">
                       <div class="fnd_azul"> Motorista </div>
                    </h5>

                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    
                    </button>
                </div>

                <div class="modal-body">
                            
                    <div id="det_moto"></div>
                               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>

                </div>
            </div>
        </div>
    </div>

    <!--BOTÃO MOBILE QUE ABRE A MODAL-->

    <div class="row" style="background-color: #f9f9f9">

        <div class="col-md-3 col-12 esconde_btn" style="text-align: center; background-color: #f9f9f9 !important;">

            <button onclick="ajax_abre_modal()" class="botao_home" type="submit"><i class="fa-solid fa-plus"></i> Motorista</button>

        </div>

    </div>

    <!--GLOBAL MENSAGEM AÇÕES-->
    <div id="mensagem_acoes"></div>

    <!--GLOBAL CONSTROI TABELA MOTORISTA-->
    <div id="constroi_tabela_motorista"></div>


<script>

    function ajax_constroi_nome(tp) {

        global_usu = '';

        

        if(tp == '2'){

            var usuario = document.getElementById('usu_mv_mob').value;
            global_usu = usuario;


        }else{

            var usuario = document.getElementById('usu_mv').value;
            global_usu = usuario;

        }

        $.ajax({
            type: 'GET',
            url: 'funcoes/motorista/nome_motorista.php',
            data: { usuario: usuario },

            success: function(response) {

                if (response.trim() !== "") {

                    if(tp == '2'){

                        document.getElementById("nome_moto_mobile").style.display = "block";

                        document.getElementById("nome_mobile").innerHTML = response;

                    }else{

                        document.getElementById("nome_moto").style.display = "block";

                        document.getElementById("nome").innerHTML = response;



                    }

                } else {

                    
                    if(tp == '2'){

                        document.getElementById("nome_moto_mobile").style.display = "none";;

                        document.getElementById("nome_mobile").innerHTML = "";

                    }else{

                        document.getElementById("nome_moto").style.display = "none";;

                        document.getElementById("nome").innerHTML = "";


                    }

                
                }
            },

        });
    }

    //FUNÇÃO PARA MUDAR PLANTÃO DO MOTORISTA
    function ajax_edita_plantao(tp_status, motorista){

        status = '';

        if(tp_status == 1){

            status = 'N'

        }else{

            status = 'D'

        }

        $.ajax({
                    
        url: "funcoes/motorista/ajax_update_plantao.php",
        type: "POST",
        data: {

            status : status,
            motorista : motorista

        },

        cache: false,
        success: function(dataResult){

            console.log(dataResult);

            if(dataResult == 'Sucesso'){

                //alert(var_beep);
                //MENSAGEM            
                var_ds_msg = 'Plantão%20alterado%20com%20sucesso!';
                var_tp_msg = 'alert-success';
                //var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                
                ajax_tabela_motorista();

            }else{

                 //alert(var_beep);
                //MENSAGEM            
                var_ds_msg = 'Erro%20ao%20alterar%20plantão!';
                //var_tp_msg = 'alert-success';
                var_tp_msg = 'alert-danger';
                //var_tp_msg = 'alert-primary';
                $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            }
            
        }

    });  


        
    }

    //FUNÇÕES QUE INICIALIZAM COM A PAGINA

        window.onload = function(){

            ajax_tabela_motorista();

        }


        function ajax_tabela_motorista(){

            $('#constroi_tabela_motorista').load('funcoes/motorista/tabela_motorista.php');

        }

    ///////////////////////////////////////////////    
    
    //MODALS DA PAGINA
    
        //MOBILE
        function ajax_abre_modal(){

            $('#motorista').modal('show');

        }

        //MOBILE
        function ajax_fecha_modal(){

            $('#motorista').modal('hide');

        }

    ////////////////////////////

    //FUNÇÕES DA PAGINA 

        function ajax_insert_form_motorista(tp_insert){

            tp_form = '';

            if(tp_insert == '1'){

                let form = document.getElementById('form')
                tp_form = form;

            }else{

                let form = document.getElementById('form_deskt')
                tp_form = form;

            }

            // Inicializa com os dados do Form
            let formData = new FormData(tp_form)

            $.ajax({

                url: "funcoes/motorista/insert_form_motorista.php",
                type: 'post',
                data: formData,
                processData: false,
                contentType: false

            }).done(function(response) {

                console.log(response.NR_EXISTE);

                if (response.NR_EXISTE == '0') {

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Informe%20um%20usuario%20valido!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_error').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                    
                }else{

                    if(tp_insert == '1'){

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Motorista%20cadastrado%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    //var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';

                    $('#mensagem_error').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                    
                    setTimeout(function() {

                        $('#motorista').modal('hide');
                        
                    }, 2000);

                    ajax_tabela_motorista();

                    }else{

                        setTimeout(function() {

                            //alert(var_beep);
                            //MENSAGEM            
                            var_ds_msg = 'Motorista%20cadastrado%20com%20sucesso!';
                            var_tp_msg = 'alert-success';
                            //var_tp_msg = 'alert-danger';
                            //var_tp_msg = 'alert-primary';

                            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                            ajax_tabela_motorista();

                            setTimeout(function() {

                                data.submit(); // Substitua "tp_form" pelo formulário correto
                                
                            }, 60000);


                        }, 0);

                    }
                }

            }).fail(function(jqXHR, textStatus, errorThrown) {

                console.error("Erro na requisição AJAX:", textStatus, errorThrown);

            });



        }

        function ajax_chama_detalhes_motorista(cd_usuario){
            
            $('#det_motoroista').modal('show');
            $('#det_moto').load('funcoes/motorista/detalhes_motorista.php?cd_usuario='+cd_usuario);

        }


        function ajax_deletar_motorista(cd_motorista){

                $.ajax({
                    
                    url: "funcoes/motorista/ajax_deletar_motorista.php",
                    type: "POST",
                    data: {

                        cd_motorista : cd_motorista

                    },

                    cache: false,
                    success: function(dataResult){

                        console.log(dataResult);

                        if(dataResult == 'Sucesso'){

                            //alert(var_beep);
                            //MENSAGEM            
                            var_ds_msg = 'Motorista%20deletado%20com%20sucesso!';
                            var_tp_msg = 'alert-success';
                            //var_tp_msg = 'alert-danger';
                            //var_tp_msg = 'alert-primary';
                            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                        }else if(dataResult == '1'){

                            //alert(var_beep);
                            //MENSAGEM            
                            var_ds_msg = 'Erro%20ao%20deletar%20Motorista!';
                            //var_tp_msg = 'alert-success';
                            var_tp_msg = 'alert-danger';
                            //var_tp_msg = 'alert-primary';
                            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                        }else{

                            //alert(var_beep);
                            //MENSAGEM            
                            var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                            //var_tp_msg = 'alert-success';
                            var_tp_msg = 'alert-danger';
                            //var_tp_msg = 'alert-primary';
                            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                        

                        }
                        
                        ajax_tabela_motorista();
                    }

                });  

            
        }



        function ajax_inativar_motorista(cd_usuario,status){

                $.ajax({
                    
                    url: "funcoes/motorista/ajax_inativar_motorista.php",
                    type: "POST",
                    data: {

                        cd_usuario : cd_usuario,
                        status : status,
                    },

                    cache: false,
                    success: function(dataResult){

                        console.log(dataResult);

                        if(dataResult == 'Sucesso'){

                            //alert(var_beep);
                            //MENSAGEM            
                            var_ds_msg = 'Status%20Alterado%20com%20sucesso!';
                            var_tp_msg = 'alert-success';
                            //var_tp_msg = 'alert-danger';
                            //var_tp_msg = 'alert-primary';
                            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                        }else if(dataResult == '1'){

                            //alert(var_beep);
                            //MENSAGEM            
                            var_ds_msg = 'Erro%20ao%20alterar%20status!';
                            //var_tp_msg = 'alert-success';
                            var_tp_msg = 'alert-danger';
                            //var_tp_msg = 'alert-primary';
                            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                        }else{
                            //alert(var_beep);
                            //MENSAGEM            
                            var_ds_msg = 'Erro%20Contate%20o%20Suporte!';
                            //var_tp_msg = 'alert-success';
                            var_tp_msg = 'alert-danger';
                            //var_tp_msg = 'alert-primary';
                            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                        

                        }
                        
                        ajax_tabela_motorista();
                    }

                });  
            

        }

        
        function ajax_mensagem(){

            //MENSAGEM            
            var_ds_msg = 'Motorista%20possui%20vinculo%20com%20serviços!';
            //var_tp_msg = 'alert-success';
            var_tp_msg = 'alert-danger';
            //var_tp_msg = 'alert-primary';
            $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

        }


    ///////////////////////////////////////////////////////



</script>


<?php

include 'rodape.php';

?>