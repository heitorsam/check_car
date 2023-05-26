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

                    UNION ALL 

                    SELECT 'ULTIMO KM' AS DESCRICAO,
                        CAST(srv.KM_RETORNO AS INT) AS KM
                    FROM portal_check_car.SAI_RET_VEICULO srv
                    WHERE srv.CD_VEICULO = $var_veiculo
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

        $mensagem = 'KM_INI';
        echo $mensagem;


    }elseif($var_km > $variavel_KM_FIN){


        $mensagem = 'KM_FIN';
        echo $mensagem;

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
        $valida =     oci_execute($res_insert);

                    
        //VALIDACAO
        if (!$valida) {   
        
            $erro = oci_error($res_insert_veiculo);																							
            $msg_erro = htmlentities($erro['message']);
            //header("Location: $pag_login");
            //echo $erro;
            echo $msg_erro;

        }else{

            echo 'Sucesso';
            
        }


    }else{

        echo 'erro';


    }


?>