<?php 


    //CABECALHO
    include 'cabecalho.php';

    //ACESSO ADM
    //include 'acesso_restrito_adm.php';

    $var_usuario = $_SESSION['usuarioLogin'];

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

    <div id="chamados_concluidos"></div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>

    <!--DASHBOARD-->    
    <div>

        <div class= "title_mob">
        
        <h11 class="center_desktop"><i class="fa-solid fa-chart-line efeito-zoom" aria-hidden="true"></i> Dashboard</h11>

        </div>

    </div>


<script>   

    function ajax_motorista_recebe_designacao(chamado, os, usuario){

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

    }

    function ajax_exibe_pendentes_motorista_logado(){

        var js_usuario_logado = '<?php echo $var_usuario; ?>'

        $('#chamados_recebidos_pendentes').load('funcoes/home_funcoes/ajax_exibe_pendentes_motorista_logado.php?js_usuario_logado='+js_usuario_logado);

    }


    
    function ajax_exibe_andamento_motorista_logado(){

        var js_usuario_logado = '<?php echo $var_usuario; ?>'

        $('#chamados_recebidos_andamanto').load('funcoes/home_funcoes/ajax_exibe_andamento_motorista_logado.php?js_usuario_logado='+js_usuario_logado);

    }


</script>



<?php
    //RODAPE
    include 'rodape.php';
?>



