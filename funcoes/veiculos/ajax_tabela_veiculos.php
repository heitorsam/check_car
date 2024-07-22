<?php
// CHAMANDO CONEXÃO
include '../../conexao.php';

//INCLUDE AJAX ALERT
include '../../config/mensagem/ajax_mensagem_alert.php';

// CHAMANDO CONSULTA
$cons_setor = "SELECT vc.*, cor.DS_COR,
               CASE 
               WHEN vc.TP_STATUS = 'I' THEN 'Inativo'
               WHEN vc.TP_STATUS = 'A' THEN 'Ativo'
               ELSE vc.TP_STATUS
               END AS DS_STATUS,
               (SELECT COUNT(*) AS QTD FROM portal_check_car.CHECKLIST ck WHERE ck.CD_VEICULO = vc.CD_VEICULO) AS QTD_CK, 
               (SELECT COUNT(*) AS QTD FROM portal_check_car.ABASTECIMENTO ab WHERE ab.CD_VEICULO = vc.CD_VEICULO) AS QTD_AB,
               (SELECT COUNT(*) AS QTD FROM portal_check_car.SAI_RET_VEICULO sr WHERE sr.CD_VEICULO = vc.CD_VEICULO) AS QTD_SR
               FROM portal_check_car.VEICULO vc 
               LEFT JOIN portal_check_car.COR 
               ON cor.CD_COR = vc.CD_COR
               ORDER BY vc.CD_VEICULO ASC";
$res_setor = oci_parse($conn_ora, $cons_setor);
oci_execute($res_setor);
?>

<div class="row mt-4">
    <div class="col-md-10">
        <table id="tabela-setores" class="table">
            <thead>
                <tr style="text-align: center;">
                    <th>Código</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>Placa</th>
                    <th>Cor</th>
                    <th>KM</th>
                    <th>Email</th>
                    <th>Status</th>                    
                    <!--
                    <th>Usuário Cadastro</th>
                    <th>Hora Cadastro</th>
                    <th>Usuário Última Alteração</th>
                    <th>Hora Última Alteração</th>                    
                    -->
                    <th style="width: 100px;">Opções</th>
                </tr>
            </thead>
            <tbody style="text-align: center;">
                <?php while ($row = oci_fetch_assoc($res_setor)): ?>
                    <tr>
                        <td class="align-middle"><?php echo ($row['CD_VEICULO']); ?></td>
                        <td class="align-middle"><?php echo ($row['DS_MODELO']); ?></td>
                        <td class="align-middle"><?php echo ($row['DS_ANO']); ?></td>
                        <td class="align-middle"><?php echo ($row['DS_PLACA']); ?></td>
                        <td class="align-middle"><?php echo ($row['DS_COR']); ?></td>
                        <td class="align-middle"><?php echo number_format($row['KM'], 0, ',', '.'); ?></td>
                        <td class="align-middle"><?php echo ($row['EMAIL']); ?></td>     
                        
                        <!--ATIVAR E INATIVAR -->
                        <td class="align-middle">
                            <?php 
                                if($row['TP_STATUS'] == 'A'){
                            ?>
                                    <div onclick="ajax_inativa_veiculo('<?php echo $row['CD_VEICULO']; ?>','<?php echo $row['TP_STATUS']; ?>')"><i style="color: #79c332; cursor: pointer; font-size: 15px; " class="fa-solid fa-toggle-on"></i></div>
                            <?php                                            
                               }else{
                            ?>                          
                                    <div onclick="ajax_inativa_veiculo('<?php echo $row['CD_VEICULO']; ?>','<?php echo $row['TP_STATUS']; ?>')"><i style="color: #dd9696; cursor: pointer; font-size: 15px; " class="fa-solid fa-toggle-off"></i></div>
                            <?php
                                }
                            ?>
                        </td>

                        <!--
                        <td class="align-middle"><?php //echo ($row['CD_USUARIO_CADASTRO']); ?></td>
                        <td class="align-middle"><?php //echo ($row['HR_CADASTRO']); ?></td>
                        <td class="align-middle"><?php //echo ($row['CD_USUARIO_ULT_ALT']); ?></td>
                        <td class="align-middle"><?php //echo ($row['HR_ULT_ALT']); ?></td>
                        -->
                    
                        <!--OPCOES-->
                        <td class="align-middle">
                            <?php 
                                if($row['QTD_CK']+$row['QTD_AB']+$row['QTD_SR'] > 0){

                                    ?> <button class="btn btn_adm" style="background-color: #d2d1d1 !important; color: #ffffff !important;" disable><i class="fa-solid fa-trash-can"></i></button> <?php
                               
                                }else{
                                    
                                    ?> <button onclick="ajax_alert('Deseja excluir este item?','ajax_deleta_veiculo(<?php echo $row['CD_VEICULO']; ?>)')" class="btn btn-adm"><i class="fa-solid fa-trash-can"></i></button> <?php

                                }
                            ?>
                        
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>