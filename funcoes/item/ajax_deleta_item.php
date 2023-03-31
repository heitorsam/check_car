<?php 

    //CHAMANDO CONEXÃO
    include '../../conexao.php';


    //RECEBENDO VARIAVEL
    $var_item = $_POST['item'];

    $cons_delete = "DELETE  
                    FROM portal_check_car.item_veiculo vei
                    WHERE  vei.CD_ITEM_VEICULO = $var_item";

    $res_delete =   oci_parse($conn_ora, $cons_delete);
    $valida =       oci_execute($res_delete);

    //VALIDACAO
    if (!$valida) {   
    
        $erro = oci_error($res_delete);																							
        $msg_erro = htmlentities($erro['message']);
        //header("Location: $pag_login");
        //echo $erro;
        echo $msg_erro;

    }else{

        echo 'Sucesso';
        
    }


?>