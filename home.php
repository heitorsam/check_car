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
  
    <div class="div_br"> </div>
    <div class="div_br"> </div>

        <!--DESKTOP-->

        <!--PENDENTES-->
        <div>

            <div class="esconde_botão_desktop">

            <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Chamados Pendentes</h11>

            </div>

        </div>

        <div class="div_br"> </div>
        <div class="div_br"> </div>

        <!--CONCLUIDOS-->    
        <div>

            <div  class="esconde_botão_desktop">

            <h11 class="center_desktop"><i class="fa-solid fa-list-check efeito-zoom" aria-hidden="true"></i> Chamados Concluidos</h11>

            </div>

        </div>

    <!--MOBILE-->

    <!--PENDENTES-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Pendentes</h11>

        </div>

    </div>

    <div id="chamados_recebidos_pendentes">

    <div class="div_br"> </div>
    <div class="div_br"> </div>

    <!--CONCLUIDOS-->    
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-list efeito-zoom" aria-hidden="true"></i> Concluidos</h11>

        </div>

    </div>

    <div id="chamados_concluidos_pendentes">


<?php
    //RODAPE
    include 'rodape.php';
?>
