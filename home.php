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


    <!--ANDAMENTO-->
    <div>

        <div class= "title_mob">
        <h11 class="center_desktop"><i class="fa-solid fa-play efeito-zoom" aria-hidden="true"></i> Andamento</h11>

        </div>

    </div>

    <!--ANDAMENTOs-->    
    <div>

        <div  class="esconde_botão_desktop">

        <h11 class="center_desktop"><i class="fa-solid fa-list-check efeito-zoom" aria-hidden="true"></i> Chamados Andamento</h11>

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

        <h11 class="center_desktop"><i class="fa-solid fa-list-check efeito-zoom" aria-hidden="true"></i> Chamados Concluidos</h11>

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

                <div class="row">
                    
                    <div class="col-md-2">


                        Veiculo:
                        <select class="form form-control" id="veiculo">

                            <?php
                            
                                $consulta_veiculo = "SELECT vei.CD_VEICULO,
                                vei.DS_MODELO || ' - ' || vei.DS_PLACA AS DS_VEICULO 
                                FROM portal_check_car.VEICULO vei";
                                $res_veiculo = oci_parse($conn_ora, $consulta_veiculo);
                                oci_execute($res_veiculo);

                                
                                while($row_vei = oci_fetch_array($res_veiculo)){

                                    echo '<option value="' . $row_vei['CD_VEICULO'] . '">' . $row_vei['DS_VEICULO'] . '</option>';

                                }

                            ?>
                        
                        </select>

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

                <div class="row">
                    

                    <div class="col-md-2">
                        Kilometragem:
                        <input type="text" class="form form-control" id="km_retorno">

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

                <div id="mensagem_return"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="ajax_finaliza_updates_sistema_checkcar()">Finalizar</button>
            </div>
            </div>
        </div>
    </div>

    <div id="mensagem_acoes"></div>
    

<script>   

    function ajax_finaliza_updates_sistema_checkcar(){

        global_km_ini;
        global_chamados;
        js_status = 'C';
        js_km_retorno = document.getElementById('km_retorno').value;

        if(js_km_retorno <= global_km_ini){

            //alert(var_beep);
            //MENSAGEM            
            var_ds_msg = 'informe%20uma%20kilometragem%20valida!';
            //var_tp_msg = 'alert-success';
            var_tp_msg = 'alert-danger';
            //var_tp_msg = 'alert-primary';
            $('#mensagem_return').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

        }else{

            $.ajax({
                
                url: "funcoes/home_funcoes/ajax_finaliza_updates_sistema_checkcar.php",
                type: "POST",
                data: {

                    global_chamados : global_chamados,
                    js_status : js_status,
                    js_km_retorno : js_km_retorno

                },

                cache: false,
                success: function(dataResult){

                    console.log(dataResult);

                    if(dataResult == 'Sucesso'){

                        $('#retorno_veiculo').modal('hide');

                        //alert(var_beep);
                        //MENSAGEM            
                        var_ds_msg = 'Corrida%20Finalizada%20com%20sucesso!';
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
        

    }

    global_chamados = '';
    global_km_ini = '';

    function ajax_motorista_conclui_designacao(tp,chamado, os, usuario, km_saida){


        global_chamados = chamado
        global_km_ini = km_saida;
        //////////////////////////////

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

                    $('#retorno_veiculo').modal('show');
                   
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

    function ajax_motorista_preenche_s_r_veiculo() {

        js_veiculo = document.getElementById('veiculo').value;
        js_km = document.getElementById('km').value;
        js_chamado = js_glob_chamado;
        js_motorista = js_glob_motorista;

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

                if(dataResult == 'Sucesso'){

                    $('#saida_retorno_veiculo').modal('hide');

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



</script>



<?php
    //RODAPE
    include 'rodape.php';
?>



