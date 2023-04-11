<?php

    //CHAMANDO CABECALHO
    include 'cabecalho.php';

?>

<div class="div_br"> </div>

    <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-gas-pump efeito-zoom"></i> <label class="display_esconder_mobile"> Abastecimento</label></h11>

    <div class='espaco_pequeno'></div>

    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"> </div>  
  


    <!--DESKTOP-->
    <div>

        <div class= "title_mob">

        <h11 class="center_desktop"><i class="fa-solid fa-gas-pump efeito-zoom" aria-hidden="true"></i> Abastecimento</h11>

        </div>

    </div>

    <div class="col-md-12 esconde_btn_desktop">

        Veiculo:
        <input type="text" id="cd_veiculo" class="form-control" onchange="ajax_exibe_veiculo()">

    </div>
    

    <div id="detalhes_veiculo"></div>


<script>


    function ajax_exibe_veiculo(){

        var cd_veiculo = document.getElementById('cd_veiculo').value;
        
        alert(cd_veiculo);
        $('#detalhes_veiculo').load('funcoes/abastecimento/ajax_detelhe_veiculo.php?cd_veiculo='+cd_veiculo);


    }



</script>

<?php

    include 'rodape.php';

?>