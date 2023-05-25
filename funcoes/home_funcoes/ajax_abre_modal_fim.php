<?php

session_start();

$nm_logado = $_SESSION['usuarioNome'];


?>


<div class="row">
                    
    <div class="col-md-2">
        Kilometragem:
        <input type="number" class="form form-control" id="km_retorno" maxlength="100">

        <div class="div_br"></div>
        <div class="div_br"></div>

    </div>

    <div class="col-md-3">

        Motorista:
        <input type="text" class="form form-control" id="motorista" value="<?php echo $nm_logado; ?>" readonly>

        <div class="div_br"></div>
        <div class="div_br"></div>


    </div>

</div>