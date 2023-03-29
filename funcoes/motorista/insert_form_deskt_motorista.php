<?php

//SESSION
session_start();


//USUARIO DA SESSÃO
$usuario = $_SESSION['usuarioLogin'];

//CONEXÃO
include '../../conexao.php';

//VERIFICA SE O ARQUIVO FOI ENVIADO
if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $var_foto = file_get_contents($_FILES['foto']['tmp_name']);
  } else {
    $var_foto = null;
  }

//RECEBENDO VARIAVEIS
echo $var_login = $_POST['usu_mv'];
$var_plantao = $_POST['plantao'];

$var_foto = base64_encode($var_foto);

echo $cons_insere_motorista = "INSERT INTO portal_check_car.USUARIO 
                                   (CD_USUARIO,
                                   CD_USUARIO_MV,
                                   TP_PLANTAO,
                                   BLOB_FOTO,
                                   TP_STATUS,
                                   CD_USUARIO_CADASTRO,
                                   HR_CADASTRO,
                                   CD_USUARIO_ULT_ALT,
                                   HR_ULT_ALT
                                   )
                            VALUES 
                                   (portal_check_car.SEQ_CD_USUARIO.NEXTVAL,
                                   '$var_login',
                                   '$var_plantao',
                                   empty_blob(),
                                   'A',
                                   '$usuario',
                                    SYSDATE,
                                    NULL,
                                    NULL)
                                    RETURNING BLOB_FOTO INTO :image";


$res_cons_insere_motorista = oci_parse($conn_ora, $cons_insere_motorista);

$blob = oci_new_descriptor($conn_ora, OCI_D_LOB);

oci_bind_by_name($res_cons_insere_motorista, ":image", $blob, -1, OCI_B_BLOB);

oci_execute($res_cons_insere_motorista, OCI_DEFAULT);

if(!$blob->save($var_foto)) {

   oci_rollback($conn_ora);
}
else {
   oci_commit($conn_ora);
}

oci_free_statement($res_cons_insere_motorista);
$blob->free();



?>
