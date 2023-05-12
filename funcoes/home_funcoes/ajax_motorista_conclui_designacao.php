<?php

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //SELECT PARA PEGAR O VALOR QUE O USUARIO RECEBEU A SOLICITACAO



    //RECEBENDO VARIAVEIS
    $var_js_os = $_POST['js_os'];
    $var_js_usuario = $_POST['js_usuario'];
    $var_js_status = $_POST['js_status'];
    $var_js_chamado = $_POST['chamado'];

    //DATAS





    
    date_default_timezone_set('America/Sao_Paulo');
    $data_finalizacao = date("d/m/Y H:i:s");
    $data_finalizacao;

    //CALCULOS PARA REALIZAR O INSERT OU UPDATE 
    include '../../calculo_horas.php';


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
                                         AS HR_FINAL,
                                         AS HR_INICIO,
                       '0'               AS VL_TEMPO_GASTO,
                       $var_js_os        AS CD_OS,
                                         AS CD_FUNC,
                        '11456'          AS CD_SERVICO,
                        NULL             AS DS_SERVICO,
                                         AS VL_TEMPO_GASTO_MIN,
                        'N'              AS SN_CHECK_LIST,
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

    
?>