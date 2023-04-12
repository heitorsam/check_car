<?php

    //CHAMANDO CABECALHO
    include 'cabecalho.php';

?>



<div class="row">

    <div class="col-1">
    </div>

    <div class="col-10">

        <input type="range" class="form-range" id="range_pessoa" 
        style="width: 100%; accent-color: blue !important;" onmouseup="fnc_descobre_pessoa_range()">
        
    </div>

    <div class="col-1">
    </div>

    <div class="col-1">
    </div>

    <div class="col-2">

        Pessoa 01

    </div>

    <div class="col-2">

        Pessoa 02

    </div>

    <div class="col-2">

        Pessoa 03

    </div>

    <div class="col-2">

        Pessoa 04

    </div>

    <div class="col-2">

        Pessoa 05

    </div>

    <div class="col-1">
    </div>

    <div class="col-1">
    </div>

    <div class="col-10">

        <input type="text" id="txt_pessoa" class="form-control" value="" style="widht: 100% !important;">
        
    </div>

    <div class="col-1">
    </div>


</div>


<script>


    function fnc_descobre_pessoa_range(){

        var js_resultado_pessoa = '';
        var js_accent_cor = 'white';

        var js_vl_range_pessoa = document.getElementById('range_pessoa').value;

        if(js_vl_range_pessoa >= 0 && js_vl_range_pessoa <= 19){ js_resultado_pessoa = 'Rafael'; js_accent_cor = 'green'; }
        if(js_vl_range_pessoa >= 20 && js_vl_range_pessoa <= 39){ js_resultado_pessoa = 'Leonardo'; js_accent_cor = 'blue'; }
        if(js_vl_range_pessoa >= 40 && js_vl_range_pessoa <= 59){ js_resultado_pessoa = 'Lenine'; js_accent_cor = 'red'; }
        if(js_vl_range_pessoa >= 60 && js_vl_range_pessoa <= 79){ js_resultado_pessoa = 'Segato'; js_accent_cor = 'orange'; }
        if(js_vl_range_pessoa >= 80 && js_vl_range_pessoa <= 100){ js_resultado_pessoa = 'Ariene';js_accent_cor = 'pink';  }

        //alert(js_resultado_pessoa);

        document.getElementById('txt_pessoa').value = js_resultado_pessoa;
        document.getElementById('range_pessoa').style.accentColor = js_accent_cor;
    }


</script>


<?php

    include 'rodape.php';

?>