<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';


    //RECEBENDO VARIAVEIS
    $var_chamado = $_POST['js_global_chamado'];
    $var_os = $_POST['js_global_os'];
    $var_usuario = $_POST['js_global_usuario'];
    $var_status = $_POST['js_tp_status'];

    //RODANDO PRIMEIRO UPDATE BANCO DE DADOS CHECK_CAR 

        $cons_up = "UPDATE
                    portal_check_car.CHAMADOS_DESIGNADOS cd
                    SET
                    cd.TP_STATUS_CHAMADO = '$var_status'
                    WHERE
                    cd.CD_CHAMADO_DESIGNADO = $var_chamado";
        $res_up = oci_parse($conn_ora, $cons_up);
                  oci_execute($res_up);
                
    /////////////////////////////////////////////////////

    //RODANDO UPDATE NA TABELA DE OS MV ( SOLICITACAO_OS )

        $cons_up_mv = " UPDATE
                         dbamv.SOLICITACAO_OS sol
                         SET
                         sol.SN_RECEBIDA = 'S',
                         sol.CD_RESPONSAVEL = '$var_usuario',
                         sol.CD_USUARIO_RECEBE_SOL_SERV = '$var_usuario',
                         sol.DT_USUARIO_RECEBE_SOL_SERV = SYSDATE
                         WHERE
                         sol.CD_OS = $var_os";
        $res_up_mv = oci_parse($conn_ora, $cons_up_mv);
        $valida = oci_execute($res_up_mv);

    ///////////////////////////////////////////////////////

    //VALIDACAO
    if (!$valida) {   
        
            $erro = oci_error($res_up_mv);																							
            $msg_erro = htmlentities($erro['message']);
            //header("Location: $pag_login");
            //echo $erro;
            echo $msg_erro;
    
    }else{
    
            echo 'Sucesso';
            
    }












?>