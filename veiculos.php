<?php

//CABECALHO
include 'cabecalho.php';

//CONEXÃO
include 'conexao.php';

//AJAX ALERTA
include 'config/mensagem/ajax_mensagem_alert.php';


//ACESSO RESTRITO
include 'acesso_restrito.php';


$cons_tabela_cor = "SELECT cor.CD_COR,
                            cor.DS_COR,
                            cor.DS_RGB
                            FROM portal_check_car.COR cor
                            ORDER BY 1 ASC";

$res_cons_tabela_cor = oci_parse($conn_ora, $cons_tabela_cor);
                       $valida = oci_execute($res_cons_tabela_cor);
     

?>

<div class="div_br"> </div>
    
    <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-car efeito-zoom"></i> <label class="display_esconder_mobile"> Veiculos</label></h11>

    <div class='espaco_pequeno'></div>

    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>   


    <div class="row">

        <div class="col-md-3 esconde">

            Modelo:
            <input type="text" id="modelo_desktop" class="form form-control">

        </div>

        <div class="col-md-2 esconde">

            Ano:
            <input type="number" id="ano_desktop" class="form form-control">

        </div>

        <div class="col-md-2 esconde">

            Placa:
            <input type="text" id="Placa_desktop" class="form form-control">

        </div>

        <div class="col-md-3 esconde">

            E-mail:
            <input type="text" id="email_carro_desktop" class="form form-control" placeholder="E-mail do veiculo">

        </div>

    </div>

    <div class="div_br"> </div> 


    <div class="row">

        <div class="col-md-2 esconde">

            Km:
            <input type="number" id="km_desktop" class="form form-control">

        </div>

                
        <div class="col-md-2 esconde">

            Cor:
            <select class="form form-control" id="cor_desktop">

                <option value="All">Selecione</option>

                <?php

                    while($row = oci_fetch_array($res_cons_tabela_cor)){

                        echo'<option value="' .  $row['CD_COR'] . '">'. $row['DS_COR'] . '</option>';


                    };

                ?>

            </select>

        </div>


        <div class='col-md-3 esconde'>

            </br>
            <button onclick="ajax_insert_veiculo('2')"class='btn btn-primary'><i class="fa-solid fa-plus"></i></button>

        </div>


    
    </div>


    <!--MOBILE-->

    <!--MODAL-->

    <div class="modal fade" id="cad_veiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Veiculos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="col-md-2 ">
                
                Cor:
                <select class="form-control" id="cor_mob">
                    
                    <option value="All">Selecione</option>
                    <?php

                        $tabela_cor = "SELECT cor.CD_COR,
                        cor.DS_COR,
                        cor.DS_RGB
                        FROM portal_check_car.COR cor
                        ORDER BY 1 ASC";

                        $res_tabela_cor = oci_parse($conn_ora, $tabela_cor);
                        $valida = oci_execute($res_tabela_cor);

                        while($row_mob = oci_fetch_array($res_tabela_cor)){

                            echo '<option value="' . $row_mob['CD_COR'] . '">' . $row_mob['DS_COR'] . '</option>';

                        }

                    ?>

                </select>

            </div>

            <div class="div_br"> </div> 

            <div class="col-md-3">

                Modelo:
                <input type="text" id="modelo_mob" class="form form-control">

            </div>
            <div class="div_br"> </div> 
            <div class="col-md-2">

                Ano:
                <input type="number" id="ano_mob" class="form form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;">

            </div>
            <div class="div_br"> </div> 
            <div class="col-md-2">

                Placa:
                <input type="text" id="Placa_mob" class="form form-control" maxlength="10">

            </div>
            <div class="div_br"> </div> 
            <div class="col-md-2">

                E-mail:
                <input type="text" id="email_carro_mob" class="form form-control" maxlength="10" placeholder="E-mail do veiculo">

            </div>
            <div class="div_br"> </div> 
            <div class="col-md-2 ">

                Km:
                <input type="number" id="km_mob" class="form form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;">

            </div>

            <div class="div_br"> </div>


        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button onclick="ajax_insert_veiculo('1'), ajax_fecha_modal()" type="button" class="btn btn-primary">Cadastrar</button>
        </div>
        </div>
    </div>
    </div>

    <div class="row" style="background-color: #f9f9f9">

        <div class="col-md-3 col-12 esconde_btn" style="text-align: center; background-color: #f9f9f9 !important;">

            <button onclick="ajax_abre_modal()" class="botao_home" type="submit"><i class="fa-solid fa-plus"></i> Veiculos</button>

        </div>

    </div>

    <div class="div_br"> </div>  
    
    <div id="mensagem_acoes"></div>

    <div id="veiculos"></div>



    <script>

        //FUNÇÃO PARA DELETAR O VEICULO
        function ajax_deleta_veiculo(cd_veiculo){

            $.ajax({

            url: "funcoes/veiculos/ajax_deletar_veiculos.php",
            type: "POST",
            data: {
                
                //VARIAVEIS
                cd_veiculo : cd_veiculo,
                
            },

            cache: false,
            success: function(dataResult){

                console.log(dataResult);

                if(dataResult == 'Sucesso'){

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Veiculo%20deletado%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    //var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                }else{

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20excluir%20veiculo!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                }

                ajax_constroi_tabela_veiculos();

            }

            });  

        }


        //MODALS DA PAGINA
        function ajax_abre_modal(){

            $('#cad_veiculo').modal('show');

        }

        function ajax_fecha_modal(){

            $('#cad_veiculo').modal('hide');

        }


        //////////////////////////////////////

        //FUNÇÕES QUE SÃO CARREGADAS COM A PAGINA
        window.onload = function(){

            ajax_constroi_tabela_veiculos();

        }


        function ajax_constroi_tabela_veiculos(){

            $('#veiculos').load('funcoes/veiculos/ajax_tabela_veiculos.php'); 

        }

        //////////////////////////////////////////////


        
        //FUNÇOES DA PAGINA
        function ajax_insert_veiculo(tp_insert){

            global_cores = '';
            global_modelo =  '';
            global_ano  = '';
            global_placa = '';
            global_km = '';
            global_email = '';


            if(tp_insert == '1'){

                //MOBILE
                var cd_cores_mob = document.getElementById('cor_mob').value;
                var modelo_mob = document.getElementById('modelo_mob').value;
                var ano_mob = document.getElementById('ano_mob').value;
                var placa_mob = document.getElementById('Placa_mob').value;
                var km_mob = document.getElementById('km_mob').value;
                var emailmob = document.getElementById('email_carro_mob').value;

                global_cores  = cd_cores_mob;
                global_modelo = modelo_mob;
                global_ano   = ano_mob;
                global_placa = placa_mob;
                global_km  = km_mob;
                global_email = emailmob;

                


            }else{

                //DESKTOP
                var cd_cores_desk = document.getElementById('cor_desktop').value;
                var modelo_desk = document.getElementById('modelo_desktop').value;
                var ano_desk = document.getElementById('ano_desktop').value;
                var placa_desk = document.getElementById('Placa_desktop').value;
                var km_desk = document.getElementById('km_desktop').value;
                var emaildesk = document.getElementById('email_carro_desktop').value;

                global_cores  = cd_cores_desk;
                global_modelo = modelo_desk;
                global_ano   = ano_desk;
                global_placa = placa_desk;
                global_km  = km_desk;
                global_email = emaildesk;
                


            }

            $.ajax({

                url: "funcoes/veiculos/ajax_insert_veiculos.php",
                type: "POST",
                data: {
                    
                    //MOBILE
                    global_cores : global_cores,
                    global_modelo : global_modelo,
                    global_ano : global_ano,
                    global_placa : global_placa,
                    global_km : global_km,
                    global_email : global_email
                    
                },

                cache: false,
                success: function(dataResult){

                console.log(dataResult);

                if(dataResult == 'Sucesso'){

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Veiculo%20Cadastrado%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    //var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                }else{

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20cadastrar%20veiculo!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                }
                
                ajax_constroi_tabela_veiculos();

                //MOBILE
                document.getElementById('cor_mob').value = '';
                document.getElementById('modelo_mob').value = '';
                document.getElementById('ano_mob').value = '';
                document.getElementById('Placa_mob').value = '';
                document.getElementById('km_mob').value = '';
                document.getElementById('email_carro_mob').value = '';

                //DESKTOP
                document.getElementById('cor_desktop').value = '';
                document.getElementById('modelo_desktop').value = '';
                document.getElementById('ano_desktop').value = '';
                document.getElementById('Placa_desktop').value = '';
                document.getElementById('km_desktop').value = '';
                document.getElementById('email_carro_desktop').value = '';

                }

            });  


        }


        //DELETAR VEICULO
        function ajax_inativa_veiculo(cd_veiculo, status){
                
                $.ajax({
                
                    url: "funcoes/veiculos/ajax_inativa_veiculos.php",
                    type: "POST",
                    data: {
                        
                        //MOBILE
                        cd_veiculo : cd_veiculo,
                        status : status

                        
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

                    }else {

                        //alert(var_beep);
                        //MENSAGEM            
                        var_ds_msg = 'Erro%20ao%20alterar%20status!';
                        //var_tp_msg = 'alert-success';
                        var_tp_msg = 'alert-danger';
                        //var_tp_msg = 'alert-primary';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                    }
                    
                    ajax_constroi_tabela_veiculos();

                    }

                }); 
            
        }



    </script>

<?php

include 'rodape.php';

?>