<?php

//CHAMANDO CONEXÃO
include '../../conexao.php';

$var_cd = $_GET['cd_usuario'];

$cons_tabela_detalhe = "SELECT usu.NM_USUARIO,
                               usu.CPF,
                               usux.BLOB_FOTO,
                               usu.TP_STATUS
                               FROM dbasgu.USUARIOS usu
                               LEFT JOIN portal_check_car.USUARIO usux
                                      ON usux.CD_USUARIO_MV = usu.CD_USUARIO
                                WHERE usux.CD_USUARIO = $var_cd ";

$res_tabela_detalhe = oci_parse($conn_ora, $cons_tabela_detalhe);
                      oci_execute($res_tabela_detalhe);

$row = oci_fetch_array($res_tabela_detalhe);

?>



    <!--ESTRUTURA CADASTRO DE PERFIL-->

    <?php if(isset($row['BLOB_FOTO'])){

    $imagem = $row['BLOB_FOTO'] ->load(); // (1000) = 1kB

    ?>
    <div style="width: 200; height: 180px; padding-left: 15px ">

        <div id="imagem" style="background-image: url(data:image/gif;base64,<?php echo $imagem; ?>);
                                                                        background-repeat: no-repeat;
                                                                        background-position: center; 
                                                                        background-size: cover;
                                                                        background-size: contain;
                                                                        width: 150px; height: 150px; margin: 0 auto; border-radius: 100px; background-color: #e5f4fb !important; ">

        </div>

    </div>


    <?php

        }

    ?>

    <div style="width: 100%; text-align: center !important; font-weight: bold; ">

        <?php echo $row['NM_USUARIO']; ?>

    </div>

    <div style="width: 100%; text-align: center !important;">

    <?php 
    
        if($row['CPF'] == ''){

            echo '<label style="font-weight: bold;">CPF: Não Há!</label> ';

        }else{

            echo '<label style="font-weight: bold;">CPF: </label> ' . $row['CPF'];

        }
        
    ?>


    </div>

