<?php 

    //CABECALHO
    include 'cabecalho.php';

    //ACESSO ADM
    //include 'acesso_restrito_adm.php';

    $var_usuario = $_SESSION['usuarioLogin'];
    $nm_logado = $_SESSION['usuarioNome'];

    include 'config/mensagem/ajax_mensagem_alert.php';

?>

    <div class="div_br"> </div>

    <!--MENSAGENS-->
    <?php

        include 'js/mensagens.php';
        include 'js/mensagens_usuario.php';

    ?>
  
    <div class="div_br"> </div>
    <div class="div_br"> </div>

        <!--DESKTOP-->

        <!--PENDENTES-->
        <div>

            <div class="esconde_botão_desktop">

            <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Chamados Pendentes</h11>

            </div>

        </div>

        <div class="div_br"> </div>
        <div class="div_br"> </div>

        <!--CONCLUIDOS-->    
        <div>

            <div  class="esconde_botão_desktop">

            <h11 class="center_desktop"><i class="fa-solid fa-list-check efeito-zoom" aria-hidden="true"></i> Chamados Concluidos</h11>

            </div>

        </div>

    <!--MOBILE-->

    <!--PENDENTES-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Pendentes</h11>

        </div>

    </div>

    
    <div class="div_br"> </div>

    <div id="chamados_recebidos_pendentes"></div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>


        <!--ANDAMENTO-->
        <div>

            <div class= "title_mob">

            <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Andamento</h11>

            </div>

        </div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>


    <div id="chamados_recebidos_andamanto"></div>
    

    <div class="div_br"> </div>
    <div class="div_br"> </div>

    
    <!--CONCLUIDOS-->    
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Concluidos</h11>

        </div>

    </div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>

    <div id="chamados_concluidos"></div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>

    <!--DASHBOARD-->    
    <div>

        <div class= "title_mob">
        
        <h11 class="center_desktop"><i class="fa-solid fa-chart-line efeito-zoom" aria-hidden="true"></i> Dashboard</h11>

        </div>

    </div>


    <!--MODAL SAIDA_RETORNO VEICULO-->
    <div class="modal fade top_modal" id="saida_retorno_veiculo" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">

                 <div style="width: 100%; text-align: center;">

                    <h5 class="modal-title" id="exampleModalLabel">
                       <div class="fnd_azul"> Controle de Saida </div>
                    </h5>

                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    
                    </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    
                    <div class="col-md-2">

                        Veiculo:
                        <select class="form form-control" id="veiculo">

                            <option value="All">Selecione<option>
                            
                        
                        </select>

                        <div class="div_br"></div>
                        <div class="div_br"></div>
                    
                    </div>


                    <div class="col-md-3">

                        Destino:
                        <input type="text" class="form form-control" id="destino">

                        <div class="div_br"></div>
                        <div class="div_br"></div>
                    

                    </div>
                    
                    <div class="col-md-2">
                        Kilometragem:
                        <input type="text" class="form form-control" id="km">

                        <div class="div_br"></div>
                        <div class="div_br"></div>

                    </div>
                    
                    <div class="col-md-3">

                        Motorista:
                        <input type="text" class="form form-control" id="motorista" value="<?php echo $nm_logado; ?>" readonly>

                        <div class="div_br"></div>
                        <div class="div_br"></div>


                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="ajax_motorista_preenche_s_r_veiculo()" >Iniciar</button>
            </div>
            </div>
        </div>
    </div>

<div id="mensagem_acoes"></div>
    

<script>   

    function ajax_motorista_conclui_designacao(chamado, os, usuario){

        alert(chamado);
        alert(os);
        alert(usuario);

        js_chamado = chamado;
        js_os = os;
        js_usuario = usuario;
        js_status = 'C';

    }

    function ajax_motorista_preenche_s_r_veiculo() {

        js_veiculo = document.getElementById('veiculo').value;
        js_destino = document.getElementById('destino').value;
        js_km = document.getElementById('km').value;
        js_chamado = js_glob_chamado;
        js_motorista = js_glob_motorista;

        $.ajax({
            
            url: "funcoes/home_funcoes/ajax_motorista_preenche_s_r_veiculo.php",
            type: "POST",
            data: {

                js_veiculo : js_veiculo,
                js_destino : js_destino,
                js_km : js_km,
                js_chamado : js_chamado,
                js_motorista : js_motorista

            },

            cache: false,
            success: function(dataResult){

                console.log(dataResult);

                if(dataResult == 'Sucesso'){

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Corrida%20iniciada%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    //var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                   
                }else{


                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20iniciar%20corrida!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                }


            }

        });  

        
    }

    js_glob_chamado = '';
    js_glob_motorista = '';

    function ajax_motorista_recebe_designacao(chamado, os, usuario, motorista){

        js_glob_chamado = chamado;
        js_glob_motorista = motorista;

        ///////////////////////////////////////
        js_global_chamado = chamado;
        js_global_os = os;
        js_global_usuario = usuario;
        js_tp_status = 'A'

        $.ajax({
            
            url: "funcoes/home_funcoes/ajax_update_os_chamados.php",
            type: "POST",
            data: {

                js_global_chamado : js_global_chamado,
                js_global_os : js_global_os,
                js_global_usuario : js_global_usuario,
                js_tp_status : js_tp_status

            },

            cache: false,
            success: function(dataResult){

                console.log(dataResult);

                if(dataResult == 'Sucesso'){

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Corrida%20iniciada%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    //var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                    $('#saida_retorno_veiculo').modal('show');
                   
                }else{


                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20iniciar%20corrida!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                }

                ajax_exibe_pendentes_motorista_logado();
                ajax_exibe_andamento_motorista_logado();

            }

        });  


    }

    window.onload = function(){

        ajax_exibe_pendentes_motorista_logado();
        ajax_exibe_andamento_motorista_logado();
        ajax_exibe_concluido_motorista_logado()

    }

    function ajax_exibe_pendentes_motorista_logado(){

        var js_usuario_logado = '<?php echo $var_usuario; ?>'

        $('#chamados_recebidos_pendentes').load('funcoes/home_funcoes/ajax_exibe_pendentes_motorista_logado.php?js_usuario_logado='+js_usuario_logado);

    }


    
    function ajax_exibe_andamento_motorista_logado(){

        var js_usuario_logado = '<?php echo $var_usuario; ?>'

        $('#chamados_recebidos_andamanto').load('funcoes/home_funcoes/ajax_exibe_andamento_motorista_logado.php?js_usuario_logado='+js_usuario_logado);

    }

        
    function ajax_exibe_concluido_motorista_logado(){

        var js_usuario_logado = '<?php echo $var_usuario; ?>'

        $('#chamados_concluidos').load('funcoes/home_funcoes/ajax_exibe_concluido_motorista_logado.php?js_usuario_logado='+js_usuario_logado);

    }



</script>



<?php
    //RODAPE
    include 'rodape.php';
?>



