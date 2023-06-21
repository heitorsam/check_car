<?php

    session_start();

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    $var_usuario_login = $_SESSION['usuarioLogin'];
    
    //CONSULTA PARA VERIFICAR SE HÁ VEICULOS COM CHECKIN
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
?>
<?php


if(isset($row_carro['DS_MODELO'])){

?>

<div class="row">

    <div class="col-md-3">

        Veiculo:
        <select class="form form-control" id="cd_veiculo" onchange="ajax_exibe_veiculo()">
        <option value = "All" >Selecione</option>


           <option value = "<?php echo $row_carro['CD_VEICULO']; ?>"><?php echo $row_carro['DS_MODELO'] . ' / ' . $row_carro['DS_PLACA']; ?></option>
                


        </select>

    </div>

</div>




<?php

}else{

?>

    <div class="col-12 col-md-6" style="background-color: rgba(0,0,0,0) !important; padding-top: 0px; padding-bottom: 0px; padding-left: 0px;">
 
<?php
 
          echo '<div class="lista_home_itens_pend" style="cursor:pointer; text-align: left;">';

             echo '<div style="padding-left: 6px !important;">Realize o check-in em um veiculo para poder realizar um abastecimento</div>';
             
             echo '<div style="clear: both;"></div>';

            

         echo '</div>';

         
         
        echo '</div>';


}

?>


<div id="detalhes_veiculo"></div>