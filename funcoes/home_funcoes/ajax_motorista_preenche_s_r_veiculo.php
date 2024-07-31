<?php

    session_start();

    //INICIANDO A CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_veiculo = $_POST['js_veiculo'];
    $var_km = $_POST['js_km'];
    $var_chamado = $_POST['js_chamado'];
    $var_motorista = $_POST['js_motorista'];
    $usuario = $_SESSION['usuarioLogin'];

    //INICIANDO CONSULTA DE VALIDAÇÃO 
    $cons_valid = "SELECT MAX(res.KM) AS KM_INI,
                          MAX(res.KM) + 1000 AS KM_FIN
                    FROM (

                    SELECT 'KM INICIAL' AS DESCRICAO,
                        vei.KM AS KM
                    FROM portal_check_car.VEICULO vei
                    WHERE vei.CD_VEICULO = $var_veiculo

                    --UNION ALL 

                    --SELECT 'ULTIMO KM' AS DESCRICAO,
                     --   CAST(srv.KM_RETORNO AS INT) AS KM
                    --FROM portal_check_car.SAI_RET_VEICULO srv
                    --WHERE srv.CD_VEICULO = $var_veiculo
                    --AND srv.CD_SAI_RET IN (SELECT MAX(srvX.CD_SAI_RET)  AS CD_SAI_RET
                      --                  FROM portal_check_car.SAI_RET_VEICULO srvX
                        --                WHERE srvX.CD_VEICULO = srv.CD_VEICULO)
    )res";
                                        
    $res_valid = oci_parse($conn_ora, $cons_valid);
                 oci_execute($res_valid);

    //echo  $cons_valid;

    $mensagem = '';
    $variavel_KM_INI = '';
    $variavel_KM_FIN = '';

    while($row_km = oci_fetch_array($res_valid)){

        $variavel_KM_INI = $row_km['KM_INI'];
        $variavel_KM_FIN = $row_km['KM_FIN'];

    }

    if($var_km < $variavel_KM_INI){

        //$mensagem = 'KM_INI';
        //echo $mensagem;

        echo 'Erro,%20o%20km%20deve%20estar%20entre%20' . number_format($variavel_KM_INI, 0, ',', '.') . '%20e%20' . number_format($variavel_KM_FIN, 0, ',', '.');

    }elseif($var_km > $variavel_KM_FIN){

        //$mensagem = 'KM_FIN';
        //echo $mensagem;

        echo 'Erro,%20o%20km%20deve%20estar%20entre%20' . number_format($variavel_KM_INI, 0, ',', '.') . '%20e%20' . number_format($variavel_KM_FIN, 0, ',', '.');

    }elseif($var_km >= $variavel_KM_INI &&  $var_km <= $variavel_KM_FIN){
        
        //INICIANDO INSERT
        $cons_insert = "INSERT INTO portal_check_car.SAI_RET_VEICULO
                        SELECT
                        portal_check_car.SEQ_CD_SAI_RET.NEXTVAL AS CD_SAI_RET,
                        $var_chamado AS CD_CHAMADO_DESIGNADO,
                        $var_motorista AS CD_MOTORISTA,
                        $var_veiculo AS CD_VEICULO,
                        SYSDATE AS HR_SAIDA,
                        NULL AS HR_RETORNO,
                        '$var_km' AS KM_SAIDA,
                        NULL AS KM_RETORNO,
                        '$usuario' AS CD_USUARIO_CADASTRO,
                        SYSDATE AS HR_CADASTRO,
                        NULL AS CD_USUARIO_ULT_ALT,
                        NULL AS HR_ULT_ALT
                        FROM DUAL";
        $res_insert = oci_parse($conn_ora, $cons_insert);
        $valida = oci_execute($res_insert);

        ///////////////////////////
        ///////////////////////////
        //AQUI FAZ O UPDATE DO KM//
        ///////////////////////////
        ///////////////////////////

        //INICIANDO UPDATE KM
        $cons_update_km = "UPDATE portal_check_car.veiculo vc
                           SET vc.KM = '$var_km'
                           WHERE vc.CD_VEICULO = $var_veiculo";

        $res_update_km = oci_parse($conn_ora, $cons_update_km);
        $valida_update_km = oci_execute($res_update_km);
        

        //INICIANDO INSERT ITSOLICITACAO_OS 
        $cons_insert_it = "INSERT INTO dbamv.ITSOLICITACAO_OS itsol
        SELECT
          dbamv.SEQ_ITOS.NEXTVAL AS CD_ITSOLICITACAO_OS, 
          SYSDATE - INTERVAL '15' MINUTE AS HR_FINAL, 
          SYSDATE - INTERVAL '5' MINUTE AS HR_INICIO, 
          1 AS VL_TEMPO_GASTO, 
          (SELECT cdaux.CD_OS_MV FROM portal_check_car.CHAMADOS_DESIGNADOS cdaux WHERE cdaux.CD_CHAMADO_DESIGNADO = $var_chamado) AS CD_OS,
          (SELECT faux.CD_FUNC FROM dbamv.FUNCIONARIO faux WHERE faux.CD_USUARIO = '$usuario' AND faux.SN_ATIVO = 'A') AS CD_FUNC,
          11479 AS CD_SERVICO, 
          NULL AS DS_SERVICO, 
          10 AS VL_TEMPO_GASTO_MIN, 
          'S' AS SN_CHECK_LIST, 
          NULL AS VL_REAL, 
          NULL AS CD_BEM, 
          NULL AS VL_REFERENCIA, 
          NULL AS CD_LEITURA, 
          1 AS VL_HORA, 
          NULL AS VL_HORA_EXTRA, 
          NULL AS VL_EXTRA, 
          NULL AS VL_EXTRA_MIN, 
          NULL AS DS_FUNCIONARIO, 
          NULL AS CD_ITSOLICITACAO_OS_INTEGRA, 
          NULL AS CD_SEQ_INTEGRA, 
          NULL AS DT_INTEGRA, 
          NULL AS CD_ITSOLICITACAO_OS_FILHA, 
          NULL AS CD_TIPO_PROCEDIMENTO_PLANO
        FROM DUAL";
        $res_insert_it = oci_parse($conn_ora, $cons_insert_it);
        $valida_it = oci_execute($res_insert_it);

         //INICIANDO UPDATE SOLICITACAO_OS 
         $cons_update_os = "UPDATE dbamv.SOLICITACAO_OS so
         SET 
           so.DT_EXECUCAO = SYSDATE + INTERVAL '5' MINUTE,
           so.TP_SITUACAO = 'C',
           so.CD_ESPEC = 43,
           so.DT_ULTIMA_ATUALIZACAO = SYSDATE + INTERVAL '10' MINUTE,
           so.TP_LOCAL = 'I',
           so.CD_MOT_SERV = 54,
           so.SN_RECEBIDA = 'S',
           so.CD_RESPONSAVEL = '$usuario',
           so.CD_USUARIO_RECEBE_SOL_SERV = '$usuario',
           so.DT_USUARIO_RECEBE_SOL_SERV = SYSDATE + INTERVAL '5' MINUTE,
           so.CD_USUARIO_FECHA_OS = '$usuario',
           so.DT_USUARIO_FECHA_OS = SYSDATE + INTERVAL '10' MINUTE
         WHERE so.CD_OS = (SELECT cdaux.CD_OS_MV FROM portal_check_car.CHAMADOS_DESIGNADOS cdaux WHERE cdaux.CD_CHAMADO_DESIGNADO = $var_chamado)";
         $res_update_os = oci_parse($conn_ora, $cons_update_os);
         $valida_update_os = oci_execute($res_update_os);

                    
        //VALIDACAO
        if (!$valida && !$valida_it && !$valida_update_os) {   
        
            //$erro = oci_error($res_insert_veiculo);																							
            //$msg_erro = htmlentities($erro['message']);
            //echo $msg_erro;

            echo 'Ocorreu um erro';

        }else{

            echo 'Sucesso';
            
        }


    }else{

        echo 'erro';


    }


?>