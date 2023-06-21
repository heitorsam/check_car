<?php

    //CHAMANDO SESSÃO
    session_start();

    //CHAMANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO VARIAVEL
    $var_motorista = $_POST['js_motorista'];
    $var_os = $_POST['js_os'];
    $var_status = $_POST['js_tp_status'];
    $usuario = $_SESSION['usuarioLogin'];

    //DEFININDO VARIAVEIS
    $var_titulo = 'Recebimento de OS!';

    //VERIFICANDO SE HÁ VINCULO DO MOTORISTA INDICADO COM ALGUM VEICULO
    $verifica_vinculo = "SELECT vc.*, cor.DS_RGB,
                                (SELECT usux.NM_USUARIO FROM dbasgu.USUARIOS usux WHERE usux.CD_USUARIO = ck.CD_USUARIO_CADASTRO) AS NM_MOTORISTA
                            FROM portal_check_car.CHECKLIST ck
                        INNER JOIN portal_check_car.VEICULO vc
                            ON vc.CD_VEICULO = ck.CD_VEICULO
                        INNER JOIN portal_check_car.COR cor
                            ON cor.CD_COR = vc.CD_COR
                        WHERE ck.CD_CHECKLIST IN
                                (SELECT MAX(ack.CD_CHECKLIST)
                                FROM portal_check_car.CHECKLIST ack
                                INNER JOIN portal_check_car.USUARIO usu
                                    ON usu.CD_USUARIO_MV = ack.CD_USUARIO_CADASTRO
                                WHERE usu.CD_USUARIO = $var_motorista)
                        AND ck.TP_CHECKLIST = 'S'";
    $res_vinculo = oci_parse($conn_ora, $verifica_vinculo);
                   oci_execute($res_vinculo);
                   
    $row_vinculo = oci_fetch_array($res_vinculo);

    if(isset($row_vinculo['CD_VEICULO'])){

        $cons_insert_chamado = "INSERT INTO portal_check_car.CHAMADOS_DESIGNADOS cd
                            SELECT 
                            portal_check_car.SEQ_CD_CHAMADO_DESIGNADO.NEXTVAL AS CD_CHAMADO_DESIGNADO,
                            '$var_motorista' AS CD_MOTORISTA,
                            '$var_os' AS CD_OS_MV,
                            '$var_status' AS TP_STATUS_CHAMADO,
                            '$usuario' AS CD_USUARIO_CADASTRO,
                            SYSDATE AS HR_CADASTRO,
                            NULL AS CD_USUARIO_ULT_ALT,
                            NULL AS HR_ULT_ALT
                            FROM DUAL";
        $res_insert_chamado = oci_parse($conn_ora, $cons_insert_chamado);
                              oci_execute($res_insert_chamado);

        //EMAIL 

        $nome = 'Check_car';
        $email = $row_vinculo['EMAIL'];
        $assunto = "(OS: " . $var_os . ") " . $var_titulo;
        $msg = "Olá! <br><br>";

        $msg = "<b>ATENÇÃO</b> <br><br> Olá! " . $row_vinculo['NM_MOTORISTA'] . " Você acaba de receber uma nova designação de serviço, confira no aplicativo! <br><br>";

        $msg .=" 

            <b>Mensagem automatica do sistema check car!</b> <br><br>
            Projeto desenvolvido pela equipe de Projetos da Santa Casa de São José dos Campos

        <br><br> Atenciosamente.

        </br></br>";

        //VERIFICANDO MENSAGEM:
        ECHO $msg;

        if (PATH_SEPARATOR ==":") { $quebra = "\r\n"; } 
        else { $quebra = "\n"; }	
        $headers = "MIME-Version: 1.1".$quebra;	
        $headers .= "Content-type: text/plain; charset=iso-8859-1".$quebra;	
        $headers .= "From: webmaster@santacasasjc.com.br".$quebra; 
        //E-mail do remetente	
        $headers .= "Return-Path: webmaster@santacasasjc.com.br".$quebra; 
                        
        // Chame o arquivo com as Classes do PHPMailer
        require_once('../../phpmailer/class.phpmailer.php');
            
        // Instancia a classe PHPMailer
        $mail = new PHPMailer();
            
        // ConfiguraÃ§Ã£o dos dados do servidor e tipo de conexao (Estes dados voce obtem com seu host)
        $mail->IsSMTP(); // Define que a mensagem sera SMTP
        $mail->Host = "smtp.santacasasaudesjc.com.br"; // Endereco do servidor SMTP
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAuth = true; // Autenticacao (True: Se o email sera autenticado | False: se o Email nao sera autenticado)
        $mail->Username = 'webmaster@santacasasjc.com.br'; // Usuario do servidor SMTP
        $mail->Password = '@Tecnologia#2018'; // A Senha do email indicado acima
        // Remetente (Identificao que sera¡ mostrada para quem receber o email)
        $mail->From = "webmaster@santacasasjc.com.br";
        $mail->FromName = "Check car";
            
        // Destinatario
        $mail->AddAddress($email, $nome);

        // Opcional (Se quiser enviar copia do email)
        //$mail->AddCC('copia@dominio.com.br', 'Copia'); 
        //$mail->AddBCC('transporte@santacasasjc.com.br', 'Copia Oculta');

        // Define tipo de Mensagem que vai ser enviado
        $mail->IsHTML(true); // Define que o e-mail sera enviado como HTML

        // Assunto e Mensagem do email
        $mail->Subject  = $assunto; // Assunto da mensagem
        $mail->Body = $msg;	
        //$mail->AddAttachment($_SERVER['DOCUMENT_ROOT']. '/upload/123.pdf');
            
            
        // Envia a Mensagem
        $enviado = $mail->Send();

        // Verifica se o email foi enviado
        if($enviado){
            echo "E-mail enviado com sucesso!";

        }else{
            echo "Houve um erro ao enviar o email! " . $mail->ErrorInfo;
        }

    }else{



        echo $var_erro = 1;
        

    }

?>



