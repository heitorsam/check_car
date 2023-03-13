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

    <?php //if($_SESSION['SN_CUSTOS'] == 'S'){?>

    <a href="relatorio_custos.php" class="botao_home" type="submit"><i class="fa-solid fa-coins"></i>  Check List</a></td></tr>
    <span class="espaco_pequeno"></span>

    <?php //} ?>

    <div class='espaco_vertical_medio'></div>

    

<?php
    //RODAPE
    include 'rodape.php';
?>
