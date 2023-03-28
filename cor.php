<?php

include 'cabecalho.php';


?>

<div class="div_br"> </div>

    <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-palette efeito-zoom"></i> <label class="display_esconder_mobile"> Cores</label></h11>

    <div class='espaco_pequeno'></div>

    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>   


    <!--DESKTOP-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-palette efeito-zoom" aria-hidden="true"></i> Cores</h11>

        </div>

    </div>

    <div class="row">

        <div class="col-md-3 esconde">

            Cor:
            <input type="text" id="cor_desktop" class="form form-control" placeholder="Digite o Nome da Cor">

        </div>

        <div class="div_br"> </div> 

        <div class="col-md-2 esconde">

            RGB:
            <input value="#ffffff" type="color" id="rgb_desktop" class="form form-control">
            
        </div>

        <div class='col-md-3 esconde'>
            
            </br>
            <button onclick="ajax_insert_tabela_cor_desktop()" class='btn btn-primary'><i class="fa-solid fa-plus"></i></button>

        </div>


    </div>

    <!--MOBILE-->

    <div id="mensagem_acoes"></div>

    <!--MODAL-->

    <div class="modal fade" id="cor_veiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cores</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="col-md-3">

                Cor:
                <input type="text" id="cor" class="form form-control" placeholder="Digite o Nome da Cor">

            </div>
            <div class="div_br"> </div> 

            <div class="col-md-3">

                RGB:
                <input value="#ffffff" type="color" id="rgb" class="form form-control">

            </div>
            <div class="div_br"> </div> 
           
    

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button onclick="ajax_insert_tabela_cor(), ajax_fecha_modal()"type="button" class="btn btn-primary">Cadastrar</button>
        </div>
        </div>
    </div>
    </div>

    <div class="row">

        <div class="col-md-3 col-12 esconde_btn" style="text-align: center;">

            <button onclick="ajax_abre_modal()" class="botao_home" type="submit"><i class="fa-solid fa-plus"></i> Cores</button>

        </div>

    </div>

    <div class="div_br"> </div>  
    
    <div id="body_cores"></div>



<script>

        function ajax_deleta_cor(cor){  

            var cd_cores = cor

            $.ajax({
            
                url: "funcoes/cor/ajax_deletar_cor.php",
                type: "POST",
                data: {

                    cd_cores : cd_cores,
                },

                cache: false,
                success: function(dataResult){

                    console.log(dataResult);

                    if(dataResult == 'Sucesso'){

                        //alert(var_beep);
                        //MENSAGEM            
                        var_ds_msg = 'Cor%20Deletada%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        //var_tp_msg = 'alert-danger';
                        //var_tp_msg = 'alert-primary';
                        $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                    }else if(dataResult == '1'){

                        //alert(var_beep);
                        //MENSAGEM            
                        var_ds_msg = 'Cor%20possui%20vínculo%20com%20veiculo!';
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
                    
                    ajax_constroi_tabela();
                }

             });  
        

        }



        window.onload = function(){

            ajax_constroi_tabela();

        }


        function ajax_constroi_tabela(){

           $('#body_cores').load('funcoes/cor/ajax_tabela_cores.php'); 

        }

        //MOBILE
        function ajax_abre_modal(){

            $('#cor_veiculo').modal('show');

        }

        //MOBILE
        function ajax_fecha_modal(){

            $('#cor_veiculo').modal('hide');

        }


        //INSERT MOBILE
        function ajax_insert_tabela_cor(){  

            //MOBILE
            var rgba_mob = document.getElementById('rgb').value;
            var nome_mob = document.getElementById('cor').value;

            $.ajax({
                
                url: "funcoes/cor/ajax_cadastro_cor.php",
                type: "POST",
                data: {

                    rgba_mobile : rgba_mob,
                    nome_cor_mob: nome_mob

                },

                cache: false,
                success: function(dataResult){

                    console.log(dataResult);

                    if(dataResult == 'Sucesso'){

                        //alert(var_beep);
                        //MENSAGEM            
                        var_ds_msg = 'Cor%20Cadastrada%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        //var_tp_msg = 'alert-danger';
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

                    ajax_constroi_tabela();
                    
                    //MOBILE
                    document.getElementById('rgb').value = '';
                    document.getElementById('cor').value = '';

                }

            });  
        }

        //INSERT DESKTOP
        function ajax_insert_tabela_cor_desktop(){  

            //DESKTOP
            var rgba_desk = document.getElementById('rgb_desktop').value;
            var nome_desk = document.getElementById('cor_desktop').value;

            $.ajax({
                
                url: "funcoes/cor/ajax_cadastro_cor_desktop.php",
                type: "POST",
                data: {

                    rgba_desktop : rgba_desk,
                    nome_cor_desktop: nome_desk

                },

                cache: false,
                success: function(dataResult){

                    console.log(dataResult);

                    if(dataResult == 'Sucesso'){

                        //alert(var_beep);
                        //MENSAGEM            
                        var_ds_msg = 'Cor%20Cadastrada%20com%20sucesso!';
                        var_tp_msg = 'alert-success';
                        //var_tp_msg = 'alert-danger';
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

                    ajax_constroi_tabela();

                    //DESKTOP
                    document.getElementById('rgb_desktop').value = '';
                    document.getElementById('cor_desktop').value = '';

                }

            });  
        }

</script>

<?php

include 'rodape.php';

?>