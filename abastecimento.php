<?php

    //CHAMANDO CABECALHO
    include 'cabecalho.php';

    
    //ACESSO RESTRITO
    include 'acesso_restrito.php';


?>

<div class="div_br"> </div>

    <h11 class="display_esconder_mobile"><i  style="cursor: pointer;" class="fa-solid fa-gas-pump efeito-zoom"></i> <label class="display_esconder_mobile"> Abastecimento</label></h11>

    <div class='espaco_pequeno'></div>

    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

    <div class="div_br"> </div>  

    <div class="row">

        <div class="col-1" style="background-color: #f9f9f9 !important;"></div>
        <div id="bota_x" style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-4" onclick="ajax_chama_pagina_abastecimento('1'),ajax_style('1')"><i class="fa-solid fa-circle-plus"></i> Abastecer</div>
        <div class="col-1" style="background-color: #f9f9f9 !important;"></div>
        <div class="col-1" style="background-color: #f9f9f9 !important;"></div>
        <div id="bota_z" style="background-color: #f9f9f9 !important; cursor: pointer;" class="col-4" onclick="ajax_chama_pagina_abastecimento('2'),ajax_style('2')"><i class="fa-solid fa-circle-check"></i> Realizados</div>
        <div class="col-1" style="background-color: #f9f9f9 !important;"></div>
        

    </div>

    <div class="div_br"> </div>  
    <div class="div_br"> </div>

    <div id="detalhes_paginas"></div>


    
    <div id="mensagem_acoes"></div>


<script>

        function ajax_style(btn){

            if (btn == '1') {

                document.getElementById('bota_x').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer;");

                document.getElementById('bota_z').removeAttribute("style");
                
                // ADICIONA O CURSOR APÓS RETIRAR O STYLE
                document.getElementById('bota_z').setAttribute("style", "cursor: pointer;");


            }else{

                document.getElementById('bota_z').setAttribute("style", "border-bottom: solid 2px #17a2b8; cursor: pointer;");

                document.getElementById('bota_x').removeAttribute("style");

                // ADICIONA O CURSOR APÓS RETIRAR O STYLE
                document.getElementById('bota_x').setAttribute("style", "cursor: pointer;");

      
            } 

        }

    window.onload = function(){

        ajax_chama_pagina_abastecimento('1');

    }

    function ajax_exibe_ab_realizados(){

        var periodo = document.getElementById('periodo').value;
        var veiculo = document.getElementById('cd_veiculo_ab').value;
        
        $('#realizados').load('funcoes/abastecimento/ajax_exibe_ab_realizados.php?periodo='+periodo+'&veiculo='+veiculo);

    }

    
    function ajax_chama_pagina_abastecimento(tp_pagina){

        if(tp_pagina == '1'){

            $('#detalhes_paginas').load('funcoes/abastecimento/ajax_detelhe_pagina_abastecer.php');

        }else{

            
            $('#detalhes_paginas').load('funcoes/abastecimento/ajax_detelhe_pagina_ab_realizados.php');

        }


    }


    function ajax_confirma_abastecimento(){

        var cd_veiculo = document.getElementById('cd_veiculo').value;
        var km_abastacimento = document.getElementById('km_abastacimento').value;
        var litro_abastecimento = document.getElementById('litro_abastacimento').value;
        var valor_abastecimento = document.getElementById('valor_abastacimento').value;

        $.ajax({
            
            url: "funcoes/abastecimento/ajax_insert_abastecimento.php",
            type: "POST",
            data: {

                cd_veiculo : cd_veiculo,
                km_abastacimento : km_abastacimento,
                litro_abastecimento: litro_abastecimento,
                valor_abastecimento: valor_abastecimento

            },
            
            cache: false,
            success: function(dataResult){

                console.log(dataResult);

                if(dataResult == 'Sucesso'){

                    //alert(var_beep);
                    //MENSAGEM            
                    var_ds_msg = 'Abastecimento%20Cadastrado%20com%20sucesso!';
                    var_tp_msg = 'alert-success';
                    //var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                    document.getElementById('cd_veiculo').value = 'All';
                    document.getElementById('km_abastacimento').value = '';
                    document.getElementById('litro_abastacimento').value = '';
                    document.getElementById('valor_abastacimento').value = '';

                    document.getElementById('model').value = '';
                    document.getElementById('placa').value = '';
                    document.getElementById('Motorista').value = '';

                    }else{


                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20Cadastrar%20abastecimento!';
                    //var_tp_msg = 'alert-success';
                    var_tp_msg = 'alert-danger';
                    //var_tp_msg = 'alert-primary';
                    $('#mensagem_acoes').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                }


            }

        });
        
        


    }

    function ajax_exibe_veiculo(){

        var cd_veiculo = document.getElementById('cd_veiculo').value;
        var veiculo = cd_veiculo;

        $('#detalhes_veiculo').load('funcoes/abastecimento/ajax_detelhe_veiculo.php?cd_veiculo='+veiculo);

    }



</script>

<?php

    include 'rodape.php';

?>