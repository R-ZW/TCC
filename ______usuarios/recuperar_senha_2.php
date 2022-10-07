<?php
session_start();
require_once "../_______necessarios/.conexao_bd.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


$email = $_POST['email'];

$sql = "SELECT * FROM usuarios WHERE email='$email'";
$resultado = mysqli_query($conexao, $sql);
$usuario = mysqli_fetch_assoc($resultado);

if (!is_null($usuario)) {

    $token = bin2hex(random_bytes(50));
    $dataExpiracao = new DateTime();
    $dataExpiracao->add(new DateInterval("P1D"));

    $sql_1 = "INSERT INTO password_reset VALUES ('$email', '$token', \"" . $dataExpiracao->format('Y-m-d H:i:s') . "\", 0)";
    $resultado_1 = mysqli_query($conexao, $sql_1);

    if ($resultado_1) {

        $mail = new PHPMailer(true);
        try {
            // configurações para o envio do email
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->setLanguage('br');
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nebula.recuperar.senha@gmail.com';
            $mail->Password = 'xazrvneodtvvxsti';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //quem vai enviar o email
            $mail->setFrom('nebula.recuperar.senha@gmail.com', 'Recuperar Senha');
            $mail->addAddress($email);                            //Add a recipient
            $mail->addReplyTo('nebula.recuperar.senha@gmail.com', 'Recuperar Senha');

            //conteúdo do email
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Redefinir a sua senha da plataforma Nebula (NÃO RESPONDA ESSE EMAIL)';

            $mail->Body = 
                "Olá,<br> Você solicitou a redefinição da sua senha na plataforma Nebula.<br>
                Para redefinir a sua senha clique neste
                <a href=\"" . filter_input(INPUT_SERVER, 'SERVER_NAME') . "/www/TCC/______usuarios/nova_senha.php?email=" . $email . "&token=" . $token . "\">link</a>.<br>
                Este link só funcionará uma única vez, e expirará em um dia.<br>
                <br>
                Obrigado!";

            if ($mail->send()) {

                $_SESSION['mensagem'] = 'Mensagem enviada com sucesso!';

            } else {

                $_SESSION['mensagem'] = 'Erro ao enviar a mensagem.';

            }

        } catch (Exception $e) {

            $_SESSION['mensagem'] = "A mensagem não pode ser enviada. Erro: {$mail->ErrorInfo}";

        }

    } else {

        $_SESSION['mensagem'] = "Erro ao gravar no banco de dados.<br>" .
        mysqli_error($conexao);

    }

} else {
    
    $_SESSION['mensagem'] = "Email informado inexistente!";

}

header("Location: ../index/entrada.php");