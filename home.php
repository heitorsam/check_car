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

        
    <?php

    echo '<div style="width: 100%;">';
        echo '<div class="fnd_azul" style=" border-radius: 25px !important; width: 60%; margin: 0 auto; text-align: center;" class="esconde_btn_desktop">';
        echo 'Bem vindo  <label style="font-weight: bold;">' . $pri_nome . '</label>';
        echo '</div>';
    echo '</div>';

    ?>

        <div class="div_br"> </div>
        <div class="div_br"> </div>

    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Pendentes</h11>

        </div>

    </div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>

   
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Concluidos</h11>

        </div>

    </div>


<?php
    //RODAPE
    include 'rodape.php';
?>
