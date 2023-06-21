
<?php 

session_start();

include '../../conexao.php';

$var_nome = $_SESSION['usuarioNome'];

$var_usuario_login = $_SESSION['usuarioLogin'];

//CONSULTA PARA VERIFICAR SE HÁ CHECKLIST
$cons_tabela_carro = "SELECT vc.*, cor.DS_RGB
                      FROM portal_check_car.CHECKLIST ck
                      INNER JOIN portal_check_car.VEICULO vc
                        ON vc.CD_VEICULO = ck.CD_VEICULO
                      INNER JOIN portal_check_car.COR cor
                        ON cor.CD_COR = vc.CD_COR
                      WHERE ck.CD_CHECKLIST IN (SELECT MAX(ack.CD_CHECKLIST)
                                              FROM portal_check_car.CHECKLIST ack
                                              WHERE ack.CD_USUARIO_CADASTRO = '$var_usuario_login')
                      AND ck.TP_CHECKLIST = 'S'";

$res_tabela_carro = oci_parse($conn_ora, $cons_tabela_carro);
oci_execute($res_tabela_carro);

$row_carro = oci_fetch_array($res_tabela_carro);

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
<div class="row" style="background-color: #f9f9f9 !important">
        
    <?php 

        if(isset($row_carro['DS_MODELO'])){

    ?>

        <div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">

        Tipo:
        <select class="form-control" id="tp_status">
            <option value="">Selecione</option>
            <option value="R">Retorno</option>
        </select>

        </div> 


    <?php 

        }else{

    ?>

        <div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">

        Tipo:
        <select class="form-control" id="tp_status">
            <option value="">Selecione</option>
            <option value="S">Saida</option>
            <option value="R">Retorno</option>
        </select>

        </div> 


    <?php   

        }
    ?>

    <?php

        if(isset($row_carro['DS_MODELO'])){

    ?>

    <div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">

        Veiculo:
        <select class="form-control" id="veiculo">

            <option value="">Selecione</option>
            
            <?php

                    
                echo '<option value="'. $row_carro['CD_VEICULO'] .'">'. $row_carro['DS_MODELO'] . ' / ' . $row_carro['DS_PLACA'] .'</option>';



            ?>


        </select>

    </div>

    <?php

        }else{

    ?>

            
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


    <?php

        }

    ?>
    
    <div class="col-md-3 col-12" style="background-color: #f9f9f9 !important;">

        Condutor:   
        <input type="text" class="form form-control" value="<?php echo  $var_nome; ?>" readonly>

    </div>

    <div class='col-md-3 col-12 esconde' style="background-color: #f9f9f9 !important;">

        </br>
        <button onclick="ajax_constroi_check_list() , ajax_insert_tabela_checklist()" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>

    </div>

                
    <div class='col-12 esconde_btn_desktop' style="background-color: #f9f9f9 !important;">

        </br>
        <button style="width: 50%;" onclick="ajax_constroi_check_list() , ajax_insert_tabela_checklist()" class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button>

    </div>


</div>
    