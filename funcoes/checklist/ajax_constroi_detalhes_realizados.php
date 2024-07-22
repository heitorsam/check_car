<?php

//CHAMANDO SESSÃO
session_start();

//CHAMANDO CONEXÃO
include '../../conexao.php';

//CHAMANDO USUARIO DA SESSÃO
$usuario = $_SESSION['usuarioLogin'];

//RECEBENDO VARIAVEL
$var_veiculo = $_GET['cd_veiculo'];
$data = $_GET['data'];

//CONSULTA PARA VERIFICAR SE É ADM
$cons_adm = " SELECT COUNT(*) AS QTD
              FROM dbasgu.USUARIOS usu
              INNER JOIN dbasgu.PAPEL_USUARIOS pu
              ON usu.CD_USUARIO =  pu.CD_USUARIO
              WHERE pu.CD_PAPEL IN (451) -- USUARIO ADM
              AND usu.CD_USUARIO = '$usuario'";

$res_cons_adm = oci_parse ($conn_ora, $cons_adm);
oci_execute($res_cons_adm);
$row_adm = oci_fetch_array($res_cons_adm);

//CONSULTA REALIZADOS
$cons_realizados = "SELECT * FROM (
    SELECT ck.CD_CHECKLIST,
                       ck.TP_CHECKLIST,
                       ck.TP_PLANTAO,
                       ck.OBS_GERAL,
                       (SELECT vei.DS_MODELO FROM portal_check_car.VEICULO vei WHERE vei.CD_VEICULO = ck.CD_VEICULO) AS DS_VEICULO,
                       
                       (SELECT vei.DS_PLACA FROM portal_check_car.VEICULO vei WHERE vei.CD_VEICULO = ck.CD_VEICULO) AS DS_PLACA,
    
                       CASE 
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '1' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| LPAD(EXTRACT(MONTH FROM ck.HR_CADASTRO),2,0)
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '2' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| LPAD(EXTRACT(MONTH FROM ck.HR_CADASTRO),2,0)
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '3' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| LPAD(EXTRACT(MONTH FROM ck.HR_CADASTRO),2,0)
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '4' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| LPAD(EXTRACT(MONTH FROM ck.HR_CADASTRO),2,0)
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '5' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| LPAD(EXTRACT(MONTH FROM ck.HR_CADASTRO),2,0)
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '6' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| LPAD(EXTRACT(MONTH FROM ck.HR_CADASTRO),2,0)
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '7' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| LPAD(EXTRACT(MONTH FROM ck.HR_CADASTRO),2,0)
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '8' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| LPAD(EXTRACT(MONTH FROM ck.HR_CADASTRO),2,0)
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '9' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| LPAD(EXTRACT(MONTH FROM ck.HR_CADASTRO),2,0)
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '10' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| EXTRACT(MONTH FROM ck.HR_CADASTRO)                
                         WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '11' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| EXTRACT(MONTH FROM ck.HR_CADASTRO)  
                           WHEN EXTRACT(MONTH FROM ck.HR_CADASTRO) = '12' THEN EXTRACT(YEAR FROM ck.HR_CADASTRO) ||'-'|| EXTRACT(MONTH FROM ck.HR_CADASTRO) 
                         ELSE ''
                       END  AS HR_CADASTRO_FORMAT,
                       ck.CD_USUARIO_CADASTRO,
                       usu.NM_USUARIO,
                       TO_CHAR(ck.HR_CADASTRO,'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO
                FROM portal_check_car.CHECKLIST ck
                INNER JOIN dbasgu.USUARIOS usu
                   ON usu.CD_USUARIO = ck.CD_USUARIO_CADASTRO
                WHERE ck.TP_CHECKLIST IN ('S','R')
                AND ck.CD_VEICULO = $var_veiculo
                ORDER BY ck.CD_CHECKLIST DESC)res
                WHERE res.HR_CADASTRO_FORMAT = '$data'";
                if($row_adm['QTD'] <> 1 ){

                    $cons_realizados .= "AND res.CD_USUARIO_CADASTRO = '$usuario'";

                }

//echo $cons_realizados;

$res_realizados = oci_parse ($conn_ora, $cons_realizados);
                  oci_execute($res_realizados);

while($row_realizados = oci_fetch_array($res_realizados)){

?>

<!-- Modal -->
<div class="modal fade" id="checklist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Check List Realizado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="checklist_det"></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>
      </div>
    </div>
  </div>
</div>

<div class="row">

    <div class="col-12 col-md-4" style="background-color: #f9f9f9 !important; padding-top: 0px; padding-bottom: 0px;">

        <div class="lista_home_itens" style="cursor:pointer;" onclick="ajax_modal_check_list('<?php echo $row_realizados['CD_CHECKLIST']; ?>')">

            <b> <?php echo $row_realizados['DS_VEICULO'];?> / <?php echo $row_realizados['DS_PLACA']; ?> </b> 
            <a style="font-size: 12px; text-decoration: none; cursor: pointer; color: #6ba4e1;" class="fa-solid fa-magnifying-glass"></a>
            <br> <?php echo $row_realizados['NM_USUARIO'];?> - <?php echo $row_realizados['HR_CADASTRO'];?> - <?php if(isset($row_realizados['OBS_GERAL'])){echo $row_realizados['OBS_GERAL'];}else{ echo 'Não Possui Observações';} ?>

        </div>

    </div>

</div>

<div class="div_br"> </div>  


<?php 


} 

?>