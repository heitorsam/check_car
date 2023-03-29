<?php
session_start();	
    //PHP GERAL

    //PAGINA ATUAL
    $_SESSION['pagina_acesso'] = substr($_SERVER["PHP_SELF"],1,30);

    //CORRIGE PROBLEMAS DE HEADER (LIMPAR O BUFFER)
    ob_start();

    //VARIAVEIS NOME
    @$nome = $_SESSION['usuarioNome'];
    @$pri_nome = substr($nome, 0, strpos($nome, ' '));

    //ACESSO RESTRITO
    //include 'acesso_restrito.php';    
?>

<?php

//CONEXÃO
include 'conexao.php';

$var_usuario = $_SESSION['usuarioLogin'];

$cons_tabela_detalhe = "SELECT usu.NM_USUARIO,
                                usu.CPF,
                                usux.BLOB_FOTO,
                                usu.TP_STATUS
                                FROM dbasgu.USUARIOS usu
                                LEFT JOIN portal_check_car.USUARIO usux
                                    ON usux.CD_USUARIO_MV = usu.CD_USUARIO
                                WHERE usu.CD_USUARIO = '$var_usuario'";

$res_tabela_detalhe = oci_parse($conn_ora, $cons_tabela_detalhe);
oci_execute($res_tabela_detalhe);

$row = oci_fetch_array($res_tabela_detalhe);

if(isset($row['BLOB_FOTO'])){

    $imagem = $row['BLOB_FOTO'] ->load(); // (1000) = 1kB

}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/logo/icone_santa_casa_sjc_colorido.png">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Check Car</title>
    <!--CSS-->
    <?php 
        include 'css/style.php';
        include 'css/style_mobile.php';
    ?>

    <script>
        function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        }

        function closeNav() {
        document.getElementById("mySidebar").style.width = "0";

        }

        function aumentarImagem() {
        var imagem = document.getElementById("imagem");
        var divImagemAmpliada = document.getElementById("imagem-ampliada");
        var imagemAmpliada = document.getElementById("imagem-ampliada-img");
        imagemAmpliada.src = imagem.style.backgroundImage.slice(4, -1).replace(/"/g, "");
        divImagemAmpliada.style.display = "flex";
        }

        function fecharImagem() {
        var divImagemAmpliada = document.getElementById("imagem-ampliada");
        divImagemAmpliada.style.display = "none";
        }


    </script>

    </script>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/302b2cb8e2.js" crossorigin="anonymous"></script>
    <!--GRAFICOS CHART JS 
    <script src="js/Chart.js-2.9.4/dist/Chart.js"></script>--> 
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"> </script>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    
    <!--EXTRAIR EXCEL-->
    

</head>
<body>
    <header>    


        <!--APARECER NO DESKTOP-->
        <nav class="navbar navbar-expand-md navbar-dark bg-color navbar_desktop">

            <a class="navbar-brand" href="home.php">
                <img src="img/logo/icone_santa_casa_sjc_branco.png" height="28px" width="28px" class="d-inline-block align-top efeito-zoom" alt="Santa Casa de São José dos Campos">
                <h10>Check Car</h10>
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarsExample06">
                <ul class="navbar-nav">          
                    <li class="nav-item active">
                        <a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
                    </li>
                    <div class="menu_azul_claro">
                        <li class="nav-item">
                            <h10><a class="nav-link" onclick="ajax_redireciona_easter_egg('1')"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Faq</a></h10>
                        </li>
                    </div>

                    <div class="menu_preto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="conta_click('2')">
                            <i class="fa fa-bars" aria-hidden="true"></i> Menu</a></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown06">

                            <!--MENU-->      

                                <a class="dropdown-item" href="check_list.php"><i class="fas fa-file-import"></i>  Check List</a>
                            


                            </div>
                        </li>
                    </div>
                    
                    </li>
                    <div class="menu_perfil">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $pri_nome ?></a></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown06">
                            <a class="dropdown-item" href="sair.php"> <i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a>
                            </div>
                        </li>
                    <div class="menu_vermelho">
                        
                </ul>
                
            </div>
            
        </nav>

        <!--APARECER NO MOBILE-->

        <div class="mobile_nav_bar">


            <nav class="navbar navbar-dark bg-color">

                <a class="navbar-brand" href="home.php">

                    <img src="img/logo/icone_santa_casa_sjc_branco.png" height="28px" width="28px" class="d-inline-block align-top efeito-zoom" alt="Santa Casa de São José dos Campos">
                    <h10>Check Car</h10>

                </a>

                <button class="navbar-toggler" type="button" onclick="openNav()">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div id="mySidebar" class="sidebar">

                    <div style="width: 200; height: 180px; padding-top: 15px">

                        <div onclick="aumentarImagem()" id="imagem" style="background-image: url(data:image/gif;base64,<?php echo $imagem; ?>);
                                                                                        background-repeat: no-repeat;
                                                                                        background-position: center; 
                                                                                        background-size: cover;
                                                                                        background-size: contain;
                                                                                        width: 150px; height: 150px; margin: 0 auto; border-radius: 100px; border: solid 2px #bfbdbd; ">

                        </div>

                    </div>

                    <div id="imagem-ampliada" style="display: none;
                                                    position: fixed;
                                                    top: 0;
                                                    left: 0;
                                                    height: 100%;
                                                    width: 100%;
                                                    background-color: rgba(0, 0, 0, 0.5);
                                                    z-index: 999;">

                    <img id="imagem-ampliada-img" style="position: absolute;
                                                        top: 50%;
                                                        left: 50%;
                                                        border-radius: 25px;
                                                        box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
                                                        transform: translate(-50%, -50%);
                                                        max-height: 90%;
                                                        max-width: 90%;">

                    <div style="margin: 0 auto; padding-top: 160px; color: rgba(254,254,254,0.6); font-size: 25px;">


                        <div style="border-radius: 30px; border: solid 1px rgba(254,254,254,0.6); width: 40px; height: 40px; text-align: center;">

                            <i onclick="fecharImagem()" class="fa-solid fa-xmark"></i>

                        </div>


                    </div>

                    </div>

                     <div style="color: white; text-align: center; font-size: 18px;">
                        
                        <?php echo $pri_nome;?>

                    </div>

                    <div class="div_br"> </div>

                    <a href="javascript:void(0)" class="closebtn"><i onclick="closeNav()" class="fa-solid fa-xmark"></i></a>


                    <a href="check_list.php" style="background-color: #46a5d4; font-size: 20px; color: white; "><i class="fa-solid fa-check"></i> Check List</a>
                    <div style="position: absolute; bottom: 60px;">
                        <a href="sair.php" style="background-color: #404145; font-size: 20px; color: white; "><i class="fa-solid fa-person-running"></i> Sair</a>
                    </div>
                </div>
                
            </nav>

        </div>


    </header>
    <main>

        <div class="conteudo">
            <div class="container">

