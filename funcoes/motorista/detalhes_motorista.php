<?php

//CHAMANDO CONEXÃO
include '../../conexao.php';

$var_cd = $_GET['cd_usuario'];

$cons_tabela_detalhe = "SELECT usu_c.CD_USUARIO,
                                usu_c.CD_USUARIO_MV,
                                (SELECT usu.NM_USUARIO FROM dbasgu.USUARIOS usu WHERE usu.CD_USUARIO = usu_c.CD_USUARIO_MV) AS NM_MOTORISTA,
                                usu_c.TP_STATUS,
                                usu_c.TP_PLANTAO,
                                usu_c.BLOB_FOTO,
                                (SELECT usu.CPF FROM dbasgu.USUARIOS usu WHERE usu.CD_USUARIO = usu_c.CD_USUARIO_MV) AS CPF,
                                (SELECT usu.DS_EMAIL FROM dbasgu.USUARIOS usu WHERE usu.CD_USUARIO = usu_c.CD_USUARIO_MV) AS EMAIL
                            FROM portal_check_car.USUARIO usu_c
                            WHERE usu_c.CD_USUARIO = $var_cd";

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

    <div style="background-color: rgba(229,244,251,1); border: solid 1px #46A5D4;">

        <div class="div_br"> </div>


        <div style="width: 100%; text-align: center !important; font-weight: bold; ">

            <?php echo $row['NM_MOTORISTA']; ?>

        </div>

        
        <div style="width: 100%; text-align: center !important; font-weight: bold; ">

            <?php echo $row['EMAIL']; ?>

        </div>


        <div style="width: 100%; text-align: center !important;">

            <?php 
            
                if($row['CPF'] == ''){

                    echo '<label style="font-weight: bold;">CPF: Não Cadastrado</label> ';

                }else{

                    echo '<label style="font-weight: bold;">CPF: </label> ' . $row['CPF'];

                }
                
            ?>


        </div>


        <div style="width: 100%; text-align: center !important; font-weight: bold; ">

            <?php 
                
                if($row['TP_PLANTAO'] == 'D'){

                    echo '<td class="align-middle" style="text-align: center;">'  .  '<span data-tooltip="  Plantão Diurno  "><i style=" color: #e9ca73;" class="fa-solid fa-sun"></i></span>' . '</td>';
            
                }else{

                    echo '<td class="align-middle" style="text-align: center;">'  .  '<span data-tooltip="  Plantão Noturno  "><i style="color: #ad4bb9;" class="fa-solid fa-moon"></i></span>' . '</td>';

                }
                
            ?>

        </div>

        <div class="div_br"> </div>


    <div>

