<?php

    //CHAMANDO SESSÃO
    session_start();

    //USUARIO DA SESSÃO
    $usuario = $_SESSION['usuarioLogin'];

    //CONEXAO
    include '../../conexao.php';

    //RECEBENDO VARIAVEIS 
    $var_sequence = $_POST['sequence'];
    $var_cd_item = $_POST['cd_item'];
    $var_resposta = $_POST['resposta'];
    $var_sn_apenas_exclui = $_POST['sn_apenas_exclui'];

    //INICIANDO O DELETEs
    $delete_checklist = "DELETE FROM portal_check_car.ITCHECKLIST itc
                         WHERE itc.CD_CHECKLIST = '$var_sequence'
                         AND itc.CD_ITEM_VEICULO = '$var_cd_item'";

    $res_delete = oci_parse($conn_ora, $delete_checklist);

    oci_execute($res_delete);

    echo $delete_checklist;


    if($var_sn_apenas_exclui == 'N'){
            
        //INICIANDO O INSERT
        $insert_checklist = "INSERT INTO portal_check_car.ITCHECKLIST 
                            SELECT 
                            portal_check_car.SEQ_CD_ITCHECKLIST.NEXTVAL AS CD_ITCHECKLIST,
                            '$var_sequence' AS CD_CHECKLIST,
                            '$var_cd_item' AS CD_ITEM_VEICULO,
                            '$var_resposta' AS DS_RESPOSTA,
                            'NENHUMA' AS DS_OBSERVACAO,
                            '$usuario ' AS CD_USUARIO_CADASTRO,
                            SYSDATE AS HR_CADASTRO,
                            NULL AS CD_USUARIO_ULT_ALT,
                            NULL AS HR_ULT_ALT
                            FROM DUAL";

        $res_insert = oci_parse($conn_ora, $insert_checklist);

        oci_execute($res_insert);

        //echo $insert_checklist;

    }

?>