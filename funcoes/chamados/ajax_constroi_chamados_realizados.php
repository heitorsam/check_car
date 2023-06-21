<div class="row">

    <div class="col-md-3">

        Inicio:
        <input type="date" class="form form-control" id="data1">

    </div>

    <div class="col-md-3">

        Fim:
        <input type="date" class="form form-control" id="data2">

    </div>

    <div class='col-md-3 esconde'>
        <br>
        <button onclick="ajax_chama_caixa_chamado_realizados('1')" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>
    
    </div>

    <div class='col-12 esconde_btn_desktop' style="background-color: #f9f9f9 !important;">

    </br>
    <button onclick="ajax_chama_caixa_chamado_realizados('2')" style="width: 50%;" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>

</div>

<div class="div_br"> </div>

<div id="caixas_chamado"></div>
