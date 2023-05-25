<?php
    //CONEXÃO
    include '../../conexao.php';

    //VARIAVEL
    $var_nome = $_GET['usuario'];

    //CONSULTA
    $cons_nome = "SELECT usu.NM_USUARIO
    FROM dbasgu.USUARIOS usu 
    WHERE usu.CD_USUARIO = UPPER(:var_nome)";

    $res_nome = oci_parse($conn_ora, $cons_nome);
    oci_bind_by_name($res_nome, ':var_nome', $var_nome);
    oci_execute($res_nome);

    $row_motorista = oci_fetch_array($res_nome);

    if ($row_motorista) {

        $motorista_lindo = $row_motorista['NM_USUARIO'];

    }else{


        $motorista_lindo = 'Não Encontrado';

    }
    
?>
Motorista:
<input readonly type="text" class="form form-control" id="motoristalindo" value = "<?php echo $motorista_lindo;?>">