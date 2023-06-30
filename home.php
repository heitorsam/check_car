<meta http-equiv="refresh" content="180">
<?php 

    //CABECALHO
    include 'cabecalho.php';

    //ACESSO RESTRITO
    include 'acesso_restrito.php';

    $var_usuario = $_SESSION['usuarioLogin'];
    $nm_logado = $_SESSION['usuarioNome'];

    include 'config/mensagem/ajax_mensagem_alert.php';

    include 'conexao.php';

    $data =  date("Y/m/d");
    $month = date("m", strtotime($data));
    
?>

    <div class="div_br"> </div>

    <!--MENSAGENS-->
    <?php

        include 'js/mensagens.php';
        include 'js/mensagens_usuario.php';

    ?>
  
    <div class="div_br"> </div>
    <div class="div_br"> </div>

<?php 

if(isset($row_carro['DS_MODELO'])){


?>
    <!--PENDENTES-->
    <div>

        <div class= "title_mob">
        
        <h11 class="center_desktop"><i class="fa-solid fa-clock efeito-zoom" aria-hidden="true"></i> Pendentes</h11>

        </div>

    </div>

    <!--PENDENTES-->
    <div>

        <div class="esconde_botão_desktop">

            <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Chamados Pendentes</h11>

        </div>

    </div>

    
    <div class="div_br"> </div>

    <div id="chamados_recebidos_pendentes"></div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>

<?php

}else{

?>

    <div class="col-12 col-md-6" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px; padding-left: 0px;">
 
<?php
 
          echo '<div class="lista_home_itens_pend" style="cursor:pointer; text-align: left;">';

             echo '<div style="padding-left: 6px !important;">Realize o check-in em um veiculo para visualizar suas demandas</div>';
             
             echo '<div style="clear: both;"></div>';

            

         echo '</div>';

         
         
        echo '</div>';
}

?>

    <div class="div_br"> </div>


    <!--ANDAMENTO-->
    <div>

        <div class= "title_mob">
        <h11 class="center_desktop"><i class="fa-solid fa-play efeito-zoom" aria-hidden="true"></i> Andamento</h11>

        </div>

    </div>

    <!--ANDAMENTOs-->    
    <div>

        <div  class="esconde_botão_desktop">

        <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Chamados Andamento</h11>

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
        <h11 class="center_desktop"><i class="fa-solid fa-circle-check efeito-zoom" aria-hidden="true"></i> Concluidos</h11>

        </div>

    </div>

    <!--CONCLUIDOS-->    
    <div>

        <div  class="esconde_botão_desktop">

        <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Chamados Concluidos</h11>

        </div>

    </div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>

    <div id="chamados_concluidos"></div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>

    <!--DASHBOARD-->    

    <div class="row">
        <div class="col-md-12">
        <div id="div_dashboard"></div> 
        </div> 
    </div>     

    <!--MODAL SAIDA MOTORISTA-->
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

                 <div id="saida_veiculo"></div>

                 <div id="mensagem_return"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="ajax_motorista_preenche_s_r_veiculo()" >Iniciar</button>
            </div>
            </div>
        </div>
    </div>

    <!--MODAL DE RETORNO MOTORISTA-->
    <div class="modal fade top_modal" id="retorno_veiculo" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">

                 <div style="width: 100%; text-align: center;">

                    <h5 class="modal-title" id="exampleModalLabel">
                       <div class="fnd_azul"> Controle de Retorno </div>
                    </h5>

                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    
                    </button>
            </div>
            <div class="modal-body">

                <div id="retorno_corrida_veiculo"></div>

                <div id="mensagem_teste"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="ajax_finaliza_updates_sistema_checkcar()">Finalizar</button>
            </div>
            </div>
        </div>
    </div>

    <!--MODAL DETALHE OS-->
    <div class="modal fade" id="detalhe_os_modal_home" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            
                    <div id="detalhe_os_home"></div>
                               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                </div>
            </div>
        </div>
    </div>

    <div id="mensagem_acoes"></div>
    

<script>   


    global_chamado = '';
    global_os = '';
    global_usuario_mv = '';
    global_motorista = '';


    function ajax_abre_modal_inicio(chamado, os_mv, usuario_mv, motorista){

        global_chamado = chamado;
        global_motorista = motorista;
        global_os = os_mv;
        global_usuario_mv = usuario_mv;

        $('#saida_retorno_veiculo').modal('show');
        $('#saida_veiculo').load('funcoes/home_funcoes/ajax_modal_saida.php');

    }

    function ajax_motorista_preenche_s_r_veiculo() {

        js_veiculo = document.getElementById('veiculo_saida').value;
        js_km = document.getElementById('km').value;
        js_chamado = global_chamado;
        js_motorista = global_motorista;
        js_usuario_mv = global_usuario_mv;
        js_os_mv = global_os;

        $.ajax({
            
            url: "funcoes/home_funcoes/ajax_motorista_preenche_s_r_veiculo.php",
            type: "POST",
            data: {

                js_veiculo : js_veiculo,
                js_km : js_km,
                js_chamado : js_chamado,
                js_motorista : js_motorista

            },

            cache: false,
            success: function(dataResult){

                console.log(dataResult);

                if(dataResult == 'KM_INI'){

                     //MENSAGEM            
                     var_ds_msg = 'Erro%20ao%20iniciar%20corrida%20informe%20um%20km%20valido!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_return').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                }else if(dataResult == 'KM_FIN'){

                     //MENSAGEM            
                     var_ds_msg = 'Erro%20ao%20iniciar%20corrida%20informe%20um%20km%20valido!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_return').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                }else if(dataResult == 'Sucesso'){


                    $('#saida_retorno_veiculo').modal('hide');

                    ajax_motorista_recebe_designacao(js_chamado, js_os_mv, js_usuario_mv, js_motorista, js_veiculo);


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


    function ajax_motorista_recebe_designacao(chamado, os, usuario, motorista){

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
                ajax_exibe_consolidado();

            }

        });  


    }

    js_global_chamado_fim = '';
    js_global_os_fim = '';
    js_global_usuario_fim = '';
    js_global_km_ini = '';


    function ajax_abre_modal_fim(tp, chamado, os, usuario, km_ini_corrida){

        js_global_chamado_fim = chamado;
        js_global_os_fim = os;
        js_global_usuario_fim = usuario;
        js_global_km_ini = km_ini_corrida;

        $('#retorno_veiculo').modal('show');
        $('#retorno_corrida_veiculo').load('funcoes/home_funcoes/ajax_abre_modal_fim.php');

    }

    function ajax_finaliza_updates_sistema_checkcar(){

        js_global_km_ini;
        js_global_chamado_fim;
        js_global_os_fim;
        js_global_usuario_fim;
        js_status = 'C';
        js_km_retorno = document.getElementById('km_retorno').value;

            $.ajax({
                
                url: "funcoes/home_funcoes/ajax_finaliza_updates_sistema_checkcar.php",
                type: "POST",
                data: {

                    js_global_chamado_fim : js_global_chamado_fim,
                    js_status : js_status,
                    js_km_retorno : js_km_retorno

                },

                cache: false,
                success: function(dataResult){

                    console.log(dataResult);

                    if(dataResult == 'KM_INI'){

                    //MENSAGEM            
                     var_ds_msg = 'Erro%20ao%20iniciar%20corrida%20informe%20um%20km%20valido!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_teste').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                    }else if(dataResult == 'KM_FIN'){

                    //MENSAGEM            
                     var_ds_msg = 'Erro%20ao%20iniciar%20corrida%20informe%20um%20km%20valido!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_teste').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                    }else if(dataResult == 'Sucesso'){

                        $('#retorno_veiculo').modal('hide');

                        ajax_motorista_conclui_designacao(js_global_chamado_fim, js_global_os_fim, js_global_usuario_fim, js_global_km_ini);

                    
                    }else{

                        //MENSAGEM            
                        var_ds_msg = 'Erro%20ao%20finalizar%20corrida!';
                        //var_tp_msg = 'alert-success';
                        var_tp_msg = 'alert-danger';
                        //var_tp_msg = 'alert-primary';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                    }

                    ajax_exibe_andamento_motorista_logado();
                    ajax_exibe_concluido_motorista_logado();
                    ajax_exibe_consolidado();


                }

            }); 
            
            


    }


    function ajax_motorista_conclui_designacao(chamado, os, usuario, km_saida){

        js_chamado = chamado;
        js_os = os;
        js_usuario = usuario;
        js_status = 'C';

        $.ajax({
            
            url: "funcoes/home_funcoes/ajax_motorista_conclui_designacao.php",
            type: "POST",
            data: {

                js_chamado : js_chamado,
                js_os : js_os,
                js_usuario : js_usuario,
                js_status : js_status,

            },

            cache: false,
            success: function(dataResult){

                console.log(dataResult);

                if(dataResult == 'Sucesso'){

                    //MENSAGEM            
                    var_ds_msg = 'Corrida%20finalizada%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    //var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                    
                   
                }else{


                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20finalizar%20corrida!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                }

                ajax_exibe_andamento_motorista_logado();
                ajax_exibe_concluido_motorista_logado();
                ajax_exibe_consolidado();


            }

        }); 

    }

  

    window.onload = function(){

        ajax_exibe_pendentes_motorista_logado();
        ajax_exibe_andamento_motorista_logado();
        ajax_exibe_concluido_motorista_logado();
        ajax_exibe_consolidado();
    }

    function ajax_exibe_consolidado(){

        var js_mes_atual = '<?php echo $month; ?>';
        var js_usuario_logado = '<?php echo $var_usuario; ?>';

        $('#div_dashboard').load('funcoes/home_funcoes/ajax_dashboard.php?periodo='+js_mes_atual+'&usuario='+js_usuario_logado);

    }

    function ajax_exibe_pendentes_motorista_logado(){

        var js_usuario_logado = '<?php echo $var_usuario; ?>';

        $('#chamados_recebidos_pendentes').load('funcoes/home_funcoes/ajax_exibe_pendentes_motorista_logado.php?js_usuario_logado='+js_usuario_logado);

    }


    
    function ajax_exibe_andamento_motorista_logado(){

        var js_usuario_logado = '<?php echo $var_usuario; ?>';

        $('#chamados_recebidos_andamanto').load('funcoes/home_funcoes/ajax_exibe_andamento_motorista_logado.php?js_usuario_logado='+js_usuario_logado);

    }
    

        
    function ajax_exibe_concluido_motorista_logado(){

        var js_usuario_logado = '<?php echo $var_usuario; ?>';

        $('#chamados_concluidos').load('funcoes/home_funcoes/ajax_exibe_concluido_motorista_logado.php?js_usuario_logado='+js_usuario_logado);

    }

    function ajax_exite_det_os(os){

        os_mv = os;

        $('#detalhe_os_modal_home').modal('show')
        $('#detalhe_os_home').load('funcoes/home_funcoes/ajax_modal_detalhe_os_home.php?os_mv='+os_mv);




    }



</script>



<?php
    //RODAPE
    include 'rodape.php';
?>



