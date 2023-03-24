<?php 
    //CABECALHO
    include 'cabecalho.php';

    //ACESSO ADM
    //include 'acesso_restrito_adm.php';
?>

    <div class="div_br"> </div>

    <!--MENSAGENS-->
    <?php
        include 'js/mensagens.php';
        include 'js/mensagens_usuario.php';
    ?>

    <!--DESKTOP-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-car efeito-zoom" aria-hidden="true"></i> Check Car</h11>

        </div>

    </div>

        <div class="div_br"> </div>

        <div class="row">

            <div class="col-md-3 col-12" style="text-align: center;">

            <a href="check_list.php" class="botao_home" type="submit"><i class="fa-solid fa-car-side"></i>  Check List</a>

            </div>

        </div>

    <!--ADMINISTRADORES-->

        <div class="row">

            <div class="col-md-3 col-12" style="text-align: center;">

            <a href="veiculos.php" class="botao_home_adm" type="submit"><i class="fa-solid fa-car"></i> Veiculos</a>

            </div>

            <div class="col-md-3 col-12" style="text-align: center;">

            <a href="motorista.php" class="botao_home_adm" type="submit"><i class="fa-solid fa-car"></i> Motoristas</a>

            </div>

        </div>






<?php
    //RODAPE
    include 'rodape.php';
?>
