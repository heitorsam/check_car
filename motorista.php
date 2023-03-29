<?php

include 'cabecalho.php';


?>




<div class="div_br"> </div>
    
    <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-user efeito-zoom"></i> <label class="display_esconder_mobile"> Motoristas</label></h11>

    <div class='espaco_pequeno'></div>

    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  
<div class="div_br"> </div>  


    <!--DESKTOP-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-user-plus efeito-zoom" aria-hidden="true"></i> Motorista</h11>

        </div>

    </div>

    <!--MODAL-->

    <div class="modal fade" id="motorista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                            Login Mv:
                            <input type="text" name="usu_mv" id="usu_mv" class="form form-control" placeholder="Informe o Usuário MV!">

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
                                    Selecine um Arquivo!
                                    <input name="foto" type="file" id="foto_usuario" style="display: none;">

                                </label>
                            </div>

                        </div>

                    </form>
                                    
                               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button onclick="ajax_insert_form_motorista(), " type="button" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="row">

        <div class="col-md-3 col-12 esconde_btn" style="text-align: center;">

            <button onclick="ajax_abre_modal()" class="botao_home" type="submit"><i class="fa-solid fa-plus"></i> Motorista</button>

        </div>

    </div>

    <div id="constroi_tabela_motorista"></div>


<script>

    function ajax_deleta_usu(cd_usuario){

        alert(cd_usuario);

        $.ajax({
            
            url: "funcoes/motorista/ajax_deletar_motorista.php",
            type: "POST",
            data: {

                cd_usuario : cd_usuario,
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

        ajax_tabela_motorista();

    }


    function ajax_tabela_motorista(){

        $('#constroi_tabela_motorista').load('funcoes/motorista/tabela_motorista.php');

    }

    function ajax_insert_form_motorista(){

        let form = document.getElementById('form')

        // Inicializa com os dados do Form
        let formData = new FormData(form)

        $.ajax({

            url: "funcoes/motorista/insert_form_motorista.php",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false

        }).then(response => console.log("- Dados enviados", response.form));

        ajax_fecha_modal();

    }

    //MOBILE
    function ajax_abre_modal(){

        $('#motorista').modal('show');

    }

        //MOBILE
        function ajax_fecha_modal(){

        $('#motorista').modal('hide');

    }


</script>


<?php

include 'rodape.php';

?>