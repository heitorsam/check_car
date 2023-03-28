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
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="col-md-3">

                        Login Mv:
                        <input type="text" id="usu_mv" class="form form-control" placeholder="Informe o Usuário MV!">

                    </div>
                    <div class="div_br"> </div> 

                    <div class="col-md-3">
                        
                        Plantão:
                        <select class="form-control" id="tp_plantao">

                            <option value="All">Selecione</option>


                        </select>

                    </div>
                    <div class="div_br"> </div> 

                    <div class="col-md-3">
                        Foto:
                        <div style="background-color: #eff0f1; border: dashed 1px #cbced1; text-align: center;">  
                            <label style="padding-top: 10px;"class="btn btn-default btn-sm center-block btn-file">

                                <i class="fa fa-upload fa-1x" aria-hidden="true"></i>
                                 Selecine um Arquivo!
                                <input type="file" id="foto_usuario" style="display: none;">

                            </label>
                        </div>

                    </div>
                                    
                               
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

            <button onclick="ajax_abre_modal()" class="botao_home" type="submit"><i class="fa-solid fa-plus"></i> Motorista</button>

        </div>

    </div>





<script>

        //MOBILE
        function ajax_abre_modal(){

         $('#motorista').modal('show');

        }


</script>


<?php

include 'rodape.php';

?>