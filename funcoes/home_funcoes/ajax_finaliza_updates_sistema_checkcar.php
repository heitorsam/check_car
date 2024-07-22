<?php

    session_start();

    include '../../conexao.php';

    //RECEBENDO VARIAVEIS
    $var_chamado = $_POST['js_global_chamado_fim'];
    $status = $_POST['js_status'];
    $var_km = $_POST['js_km_retorno'];
    $usuario = $_SESSION['usuarioLogin'];

    //INICIANDO CONSULTA PARA PEGAR VEICULO 
    $cons_vei = "SELECT srv.CD_VEICULO
                FROM portal_check_car.SAI_RET_VEICULO srv
                WHERE srv.CD_CHAMADO_DESIGNADO = $var_chamado";

    $res_vei = oci_parse($conn_ora, $cons_vei);
    oci_execute($res_vei);

    //PEGANDO VALOR
    $row_veiculo = oci_fetch_array($res_vei);
    $veiculo = $row_veiculo['CD_VEICULO'];


    //INICIANDO CONSULTA DE VALIDAÇÃO 
    $cons_valid = "SELECT MAX(res.KM) AS KM_INI,
                            MAX(res.KM) + 1000 AS KM_FIN
                    FROM (

                    SELECT 'KM INICIAL' AS DESCRICAO,
                        vei.KM AS KM
                    FROM portal_check_car.VEICULO vei
                    WHERE vei.CD_VEICULO = $veiculo

                    UNION ALL 

                    SELECT 'ULTIMO KM' AS DESCRICAO,
                        CAST(srv.KM_SAIDA AS INT) AS KM
                    FROM portal_check_car.SAI_RET_VEICULO srv
                    WHERE srv.CD_VEICULO = $veiculo
                    AND srv.CD_SAI_RET IN (SELECT MAX(srvX.CD_SAI_RET)  AS CD_SAI_RET
                                        FROM portal_check_car.SAI_RET_VEICULO srvX
                                        WHERE srvX.CD_VEICULO = srv.CD_VEICULO))res";
                                        
    $res_valid = oci_parse($conn_ora, $cons_valid);
    oci_execute($res_valid);

    $mensagem = '';
    $variavel_KM_INI = '';
    $variavel_KM_FIN = '';

    while($row_km = oci_fetch_array($res_valid)){

    $variavel_KM_INI = $row_km['KM_INI'];
    $variavel_KM_FIN = $row_km['KM_FIN'];

    }

    if($var_km < $variavel_KM_INI){

        //$mensagem = 'valor ' . $var_km  . ' deve estar entre ' . $variavel_KM_INI . ' - ' . $variavel_KM_FIN;
        //echo $mensagem;

        //$mensagem = 'KM_INI';
        //echo $mensagem;

        echo 'Erro,%20o%20km%20deve%20estar%20entre%20' . number_format($variavel_KM_INI, 0, ',', '.') . '%20e%20' . number_format($variavel_KM_FIN, 0, ',', '.');

    }elseif($var_km > $variavel_KM_FIN){
        

        //$mensagem = 'valor ' . $var_km  . ' deve estar entre ' . $variavel_KM_INI . ' - ' . $variavel_KM_FIN;
        //echo $mensagem;

        //$mensagem = 'KM_INI';
        //echo $mensagem;

        echo 'Erro,%20o%20km%20deve%20estar%20entre%20' . number_format($variavel_KM_INI, 0, ',', '.') . '%20e%20' . number_format($variavel_KM_FIN, 0, ',', '.');


    }elseif($var_km >= $variavel_KM_INI &&  $var_km <= $variavel_KM_FIN){

        ///////////////////////////
        ///////////////////////////
        //AQUI FAZ O UPDATE DO KM//
        ///////////////////////////
        ///////////////////////////

        //INICIANDO UPDATE KM
        $cons_update_km = "UPDATE portal_check_car.veiculo vc
                           SET vc.KM = '$var_km'
                           WHERE vc.CD_VEICULO = $veiculo";

        $res_update_km = oci_parse($conn_ora, $cons_update_km);
        $valida_update_km = oci_execute($res_update_km);

        $cons_update_sai_ret = "UPDATE
                                portal_check_car.SAI_RET_VEICULO srv
                            SET
                            srv.HR_RETORNO = SYSDATE,
                            srv.KM_RETORNO = '$var_km'
                            WHERE
                                srv.CD_CHAMADO_DESIGNADO = '$var_chamado'";
        $res_update_sai_ret = oci_parse($conn_ora, $cons_update_sai_ret);
                    $valida = oci_execute($res_update_sai_ret);


        //VALIDACAO
        if (!$valida) {   
            
            $erro = oci_error($res_update_sai_ret);																							
            $msg_erro = htmlentities($erro['message']);
            //header("Location: $pag_login");
            //echo $erro;
            echo $msg_erro;

        }else{

            echo 'Sucesso';
            
        }

    }

?>