<?php

    //CHAMANDO CONEXÃO
    include 'cabecalho.php';

    //CHAMANDO ALERTA
    include 'config/mensagem/ajax_mensagem_alert.php';
    
    //ACESSO RESTRITO
    include 'acesso_restrito.php';


?>

<div class="div_br"> </div>

<h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-list-ul efeito-zoom"></i> <label class="display_esconder_mobile"> Item Veiculo</label></h11>

<div class='espaco_pequeno'></div>

<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  

<!--DESKTOP-->

<div class="div_br"> </div> 

<div class="row">

    <div class="col-md-3 esconde">

        Item:
        <input type="text" class="form-control" id="ds_item" placeholder="Informe o nome do item">

    </div> 
    
    <div class='col-md-2 esconde'>

        </br>
        <button onclick="ajax_cadastra_item('2')" class='btn btn-primary'><i class="fa-solid fa-plus"></i></button>

    </div>

</div>

<!--MENSAGEM AÇÕES-->
<div id="mensagem_acoes"></div>

<!--MOBILE-->

<!--MODAL-->

<div class="modal fade top_modal" id="item_veiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                Item:
                <input type="text" id="ds_item_mobile" class="form form-control" placeholder="Informe o nome do item">

            </div>
            <div class="div_br"> </div> 

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button onclick="ajax_cadastra_item('1')" type="button" class="btn btn-primary">Cadastrar</button>
        </div>
        </div>

    </div>

</div>

<div class="row" style="background-color: #f9f9f9">

    <div class="col-md-3 col-12 esconde_btn" style="text-align: center; background-color: #f9f9f9 !important;">

        <button onclick="ajax_abre_modal()" class="botao_home" type="submit"><i class="fa-solid fa-plus"></i> Item</button>

    </div>

</div>

<div class="div_br"> </div> 

<!--TABELA-->
<div id="tabela_items"></div>



<script>

    //MODALS DA PAGINA

    //MOBILE
    function ajax_abre_modal(){

        $('#item_veiculo').modal('show');

    }

    //MOBILE
    function ajax_fecha_modal(){

        $('#item_veiculo').modal('hide');

    }


    //FUNÇÕES QUE INICIALIZAM COM A PAGINA
    window.onload = function(){

        ajax_carrega_tabela_items();

    }

    function ajax_carrega_tabela_items(){

        $('#tabela_items').load('funcoes/item/ajax_carrega_tabela_items.php');

    }


    //FUNÇOES DA PAGINA
    function ajax_cadastra_item(tp_insert){

        var global_item = '';

        if(tp_insert == '1'){

            var item = document.getElementById('ds_item_mobile').value;
            global_item = item;

        }else{

            var item = document.getElementById('ds_item').value;
            global_item = item;

        }

        $.ajax({
            
            url: "funcoes/item/ajax_cadastra_item.php",
            type: "POST",
            data: {

                global_item : global_item

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
                
                ajax_carrega_tabela_items();
                ajax_fecha_modal()

                //DESKTOP
                document.getElementById('ds_item').value = '';
                document.getElementById('ds_item_mobile').value = '';

            }

        });  

    }


    function ajax_deleta_item(cd_item){

        var item = cd_item

        $.ajax({
            
            url: "funcoes/item/ajax_deleta_item.php",
            type: "POST",
            data: {

                item : item

            },

            cache: false,
            success: function(dataResult){

                console.log(dataResult);

                if(dataResult == 'Sucesso'){

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Item%20Deletado%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    //var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                }else{

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20deletar%20item!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


                }
                
                ajax_carrega_tabela_items();

                //DESKTOP
                document.getElementById('ds_item').value = '';

            }

        });  

    }



</script>


<?php


    include 'rodape.php';


?>