<?php

    date_default_timezone_set('America/Sao_Paulo');

    //CHAMANDO CONEXÃO
    include '../../conexao.php';


    //RECEBENDO VARIAVEIS
    $var_js_os = $_POST['js_os'];
    '</br>';
    $var_js_usuario = $_POST['js_usuario'];
    '</br>';
    $var_js_status = $_POST['js_status'];
    '</br>';
    $var_js_chamado = $_POST['js_chamado'];

    //VERIFICANDO USUARIO NA TABALA DBAMV.FUNCIONARIOS
    $cons_func = "SELECT func.CD_FUNC 
    FROM dbamv.FUNCIONARIO func
    WHERE func.CD_USUARIO = '$var_js_usuario'
    AND func.SN_ATIVO = 'S'";
    
    $res_func = oci_parse($conn_ora, $cons_func);
        oci_execute($res_func);

    $row_func = oci_fetch_array($res_func);

    $cd_func_mv = $row_func['CD_FUNC'];

    //SELECT PARA PEGAR A DATA QUE O USUARIO RECEBEU A SOLICITACAO
    $cons_dt_recebe_serv = "SELECT 
                            TO_CHAR(sol.DT_USUARIO_RECEBE_SOL_SERV,'DD/MM/YYYY HH24:MI:SS') AS DT_USUARIO_RECEBE_SOL_SERV
                            FROM dbamv.SOLICITACAO_OS sol
                            WHERE sol.CD_OS = $var_js_os";

    $res_dt_recebe_serv = oci_parse($conn_ora, $cons_dt_recebe_serv);
                          oci_execute($res_dt_recebe_serv);

    $row_data = oci_fetch_array($res_dt_recebe_serv);

    //DATAS

    $data_recebimento_serv = $row_data['DT_USUARIO_RECEBE_SOL_SERV'];
   
    $data_finalizacao = date("d/m/Y H:i:s");

    $dataIni = $data_recebimento_serv;
    $dataFim = $data_finalizacao;



    //CALCULOS PARA REALIZAR O INSERT OU UPDATE 
    include '../../calculo_horas.php';

    $minutos = $horasUteisEntreDuasDatas->format('%i');

    //INICIANDO PASSO(1) UPDATE SOLICITACAO_OS
    $cons_update_solicitacao = "UPDATE
                                    dbamv.SOLICITACAO_OS sol
                                SET
                                    sol.CD_ESPEC = 43,
                                    sol.TP_LOCAL = 'I',
                                    sol.CD_MOT_SERV = 54
                                WHERE
                                sol.CD_OS = $var_js_os";

    
    $res_update_solicitacao = oci_parse($conn_ora, $cons_update_solicitacao);
                              oci_execute($res_update_solicitacao);
 

    //INICIANDO PASSO (2) NOVO UPDATE NA SOLICITACAO_OS 
    $cons_update_dois = "UPDATE
                            dbamv.SOLICITACAO_OS sol
                        SET
                            sol.DT_EXECUCAO = SYSDATE,
                            sol.TP_SITUACAO = 'C',
                            sol.SN_EMAIL_ENVIADO = 'S',
                            sol.CD_USUARIO_FECHA_OS = '$var_js_usuario',
                            sol.DT_USUARIO_FECHA_OS = SYSDATE  
                        WHERE
                            sol.CD_OS = $var_js_os";
    
    $res_update_dois = oci_parse($conn_ora, $cons_update_dois);
                       oci_execute($res_update_dois);   
                       
    //RODANDO UPDATE NA TABELA CHAMADOS_DESIGNADOS 
    $cons_update_chamados = "UPDATE
                                portal_check_car.CHAMADOS_DESIGNADOS cd
                            SET
                                cd.TP_STATUS_CHAMADO = 'C'
                            WHERE
                                cd.CD_CHAMADO_DESIGNADO = $var_js_chamado";

    $res_update_chamados = oci_parse($conn_ora, $cons_update_chamados);
                           oci_execute($res_update_chamados);
    
    //INICIANDO PASSO (3) INSERT NA TABELA ITSOLICITACAO_OS

    //EXECUTANDO SEQUENCE SEPARADAMENTE.
    $consulta_nextval_serv = "SELECT 
                              dbamv.SEQ_ITOS.NEXTVAL AS CD_ITSOLICITACAO_OS 
                              FROM DUAL";

    $result_nextval_serv = oci_parse($conn_ora, $consulta_nextval_serv);
                           oci_execute($result_nextval_serv);

    $row_nextval_serv = oci_fetch_array($result_nextval_serv);

    $var_nextval_serv = $row_nextval_serv['CD_ITSOLICITACAO_OS'];

    $cons_insert_it = "INSERT INTO dbamv.ITSOLICITACAO_OS
                       SELECT 
                       $var_nextval_serv AS CD_ITSOLICITACAO_OS,
                       TO_DATE('$dataFim','DD/MM/YYYY HH24:MI:SS') AS HR_FINAL,
                       TO_DATE('$dataIni','DD/MM/YYYY HH24:MI:SS') AS HR_INICIO,
                       '0'               AS VL_TEMPO_GASTO,
                       $var_js_os        AS CD_OS,
                       '$cd_func_mv'     AS CD_FUNC,
                        '11456'          AS CD_SERVICO,
                        'Corrida Realizada no Aplicativo checkcar'             AS DS_SERVICO,
                        $minutos         AS VL_TEMPO_GASTO_MIN,
                        'S'              AS SN_CHECK_LIST,
                        NULL             AS VL_REAL,
                        NULL             AS CD_BEM,
                        NULL             AS VL_REFERENCIA,
                        NULL             AS CD_LEITURA,
                        '1'              AS VL_HORA,
                        '1'              AS VL_HORA_EXTRA,
                        '0'              AS VL_EXTRA,
                        '0'              AS VL_EXTRA_MIN,
                        NULL             AS DS_FUNCIONARIO,
                        NULL             AS CD_ITSOLICITACAO_OS_INTEGRA,
                        NULL             AS CD_SEQ_INTEGRA,
                        NULL             AS DT_INTEGRA,
                        NULL             AS CD_ITSOLICITACAO_OS_FILHA,
                        NULL             AS CD_TIPO_PROCEDIMENTO_PLANO

                       FROM DUAL";
    $res_insert_it = oci_parse($conn_ora, $cons_insert_it);
           $valida = oci_execute($res_insert_it);

    ///////////////////////////////////////////////////////////////////

    //VALIDACAO
    if (!$valida) {   
        
        $erro = oci_error($res_insert_it);																							
        $msg_erro = htmlentities($erro['message']);
        //header("Location: $pag_login");
        //echo $erro;
        echo $msg_erro;

    }else{

        echo 'Sucesso';
        
    }


        


?>