<?php

include 'cabecalho.php';


?>

<div class="div_br"> </div>
    
    <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-car efeito-zoom"></i> <label class="display_esconder_mobile"> Veiculos</label></h11>

    <div class='espaco_pequeno'></div>

    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>   


    <!--DESKTOP-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-car efeito-zoom" aria-hidden="true"></i> Veiculos</h11>

        </div>

    </div>

    <div class="row">

        <div class="col-md-3 esconde">

            Modelo:
            <input type="text" id="modelo" class="form form-control">

        </div>

        <div class="col-md-2 esconde">

            Ano:
            <input type="number" id="ano" class="form form-control">

        </div>

        <div class="col-md-2 esconde">

            Placa:
            <input type="number" id="Placa" class="form form-control">

        </div>

    </div>

    <div class="div_br"> </div> 


    <div class="row">

        <div class="col-md-2 esconde">

            Km:
            <input type="number" id="km" class="form form-control">

        </div>

                
        <div class="col-md-2 esconde">
                Cor:
                <select class="form form-control" id="cor">

                    <option value="All">Selecione</option>



                </select>
        </div>


        <div class='col-md-3 esconde'>

            </br>
            <button class='btn btn-primary'><i class="fa-solid fa-plus"></i></button>

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

            

            <div class="col-md-3">

                Modelo:
                <input type="text" id="modelo" class="form form-control">

            </div>
            <div class="div_br"> </div> 
            <div class="col-md-2">

                Ano:
                <input type="number" id="ano" class="form form-control">

            </div>
            <div class="div_br"> </div> 
            <div class="col-md-2">

                Placa:
                <input type="number" id="Placa" class="form form-control">

            </div>
            <div class="div_br"> </div> 
            <div class="col-md-2 ">

                Km:
                <input type="number" id="km" class="form form-control">

            </div>
            <div class="div_br"> </div>

        
            <div class="col-md-2 ">
                Cor:
                <select class="form form-control" id="cor">

                    <option value="All">Selecione</option>



                </select>
            </div>



    

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary">Cadastrar</button>
        </div>
        </div>
    </div>
    </div>

    <div class="row">

        <div class="col-md-3 col-12 esconde_btn" style="text-align: center;">

            <button onclick="ajax_abre_modal()" class="botao_home" type="submit"><i class="fa-solid fa-plus"></i> Veiculos</button>

        </div>

    </div>



    <script>

        function ajax_abre_modal(){

            $('#cad_veiculo').modal('show');

        }


    </script>

<?php

include 'rodape.php';

?>