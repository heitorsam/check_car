
<?php 

include '../../conexao.php';

//CONSULTA VEICULO
$cons_veiculo = "SELECT vei.CD_VEICULO,
                        vei.DS_MODELO,
                        vei.DS_PLACA,
                        vei.CD_COR,
                        (SELECT cor.DS_RGB FROM portal_check_car.COR cor WHERE cor.CD_COR = vei.CD_COR) AS COR
                        FROM portal_check_car.VEICULO vei
                        WHERE vei.TP_STATUS <> 'I' ";
$res_cons_veiculo = oci_parse($conn_ora, $cons_veiculo);
                    oci_execute($res_cons_veiculo);

//CONSULTA MOTORISTA      
$cons_motorista = "SELECT usu.CD_USUARIO,
                            usu.CD_USUARIO_MV,
                            (SELECT usux.NM_USUARIO FROM dbasgu.USUARIOS usux WHERE usux.CD_USUARIO = usu.CD_USUARIO_MV) AS NM_USUARIO
                    FROM portal_check_car.USUARIO usu
                    WHERE usu.TP_STATUS = 'A'";
$res_cons_motorista = oci_parse($conn_ora, $cons_motorista);
                      oci_execute($res_cons_motorista);


?>



<!--DESKTOP-->
<div class="row" style="background-color: #f9f9f9">
        
    
    <div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">

        Tipo:
        <select class="form-control" id="tp_status">
            <option value="">Selecione</option>
            <option value="S">Saida</option>
            <option value="R">Retorno</option>
        </select>

    </div> 

    <div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">

        Veiculo:
        <select class="form-control" id="veiculo">

            <option value="">Selecione</option>
            
            <?php

                    while($row = oci_fetch_array($res_cons_veiculo)){

                        echo '<option value="'. $row['CD_VEICULO'] .'">'. $row['DS_MODELO'] . ' / ' . $row['DS_PLACA'] .'</option>';

                    }

            ?>


        </select>

    </div>


    <div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">

        Condutor:
        <select class="form-control" id="condutor">

            <option value="">Selecione</option>
                            
            <?php

                while($row_motorista = oci_fetch_array($res_cons_motorista)){

                    echo '<option value="'. $row_motorista['CD_USUARIO'] .'">'. $row_motorista['NM_USUARIO'] .'</option>';

                }

            ?>


        </select>

    </div>

    <div class='col-md-3 col-12 esconde'>

        </br>
        <button onclick="ajax_constroi_check_list() , ajax_insert_tabela_checklist()" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>

    </div>

                
    <div class='col-12 esconde_btn_desktop' style="background-color: #f9f9f9 !important;">

        </br>
        <button style="width: 50%;" onclick="ajax_constroi_check_list() , ajax_insert_tabela_checklist()" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>

    </div>


</div>
    