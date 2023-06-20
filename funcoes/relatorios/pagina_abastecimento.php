<div class="row">

<div class="col-md-3">

    Inicio:
    <input type="date" class="form form-control" id="data_abas_1">

</div>

<div class="col-md-3">

    Fim:
    <input type="date" class="form form-control" id="data_abas_2">

</div>

<div class='col-md-3 esconde'>
        
    </br>
    <button onclick="ajax_procura_abastecimento('2')" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>
    <button onclick="ajax_emite_excel_abas()" class='btn btn-primary'><i class="fa-solid fa-file-excel"></i></button>

</div>

</div>

<div class='col-12 esconde_btn_desktop' style="background-color: #f9f9f9 !important;">

</br>
<button onclick="ajax_procura_abastecimento('1')" style="width: 50%;" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>
<div class="div_br"></div>
<button onclick="ajax_emite_excel_abas()"style="width: 50%;" class='btn btn-primary'><i class="fa-solid fa-file-excel"></i></button>

</div>

