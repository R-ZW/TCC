<?php
session_start();
require_once "../_______necessarios/.conexao_bd.php";
require_once "../_______necessarios/.funcoes.php";

$email = $_GET['email'];
$token = $_GET['token'];

$sql = "SELECT * FROM password_reset WHERE email='$email' AND token='$token'";
$resultado = mysqli_query($conexao, $sql);
$reset = mysqli_fetch_assoc($resultado);

if(!is_null($reset)) {

    $hoje = new DateTime();
    $dataExpiracao = new DateTime($reset['data_expiracao']);

    if ($hoje < $dataExpiracao) {

        if($reset['usado'] == 0){

        } else {

            $_SESSION['mensagem'] = "Pedido de recuperação de senha já foi usado! Realize o pedido de recuperação de senha novamente se deseja alterar a senha.";
        
        }

    } else {

        $_SESSION['mensagem'] = "Pedido de recuperação de senha expirado! Realize o pedido de recuperação de senha novamente";

    }

} else {

    $_SESSION['mensagem'] = "Pedido de recuperação de senha inválido";

}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Nebula</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Another Icon Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs próprio-->
    <link rel="stylesheet" type="text/css" href="../index/.assets/css_entrada.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_.materialize/css/materialize.min.css"  media="screen,projection"/>

</head>

<body>

    <div id="wapper">
        <div class="auth-background" style="<?php $i = rand(1, 8); echo "background: url(../_.imgs_default/nebulosas/$i.png);"?>"></div>
        <div class="panel-auth">

            <h2 style="text-align:center;">Nebula</h2>

            <h5 style="text-align:center; margin-top: 0">Nova senha</h5>

            <br>
            <br>
            <br>
            <?php if (isset($_SESSION['mensagem'])) {

            if($_SESSION['mensagem'] == "Mensagem enviada com sucesso!" or 
               $_SESSION['mensagem'] == "Nova senha foi redefinida com sucesso!"){

                echo "<div class='green-text bold-text'>" . exibeMensagens() . "</div>";

            } else {

                echo "<div class='red-text bold-text'>" . exibeMensagens() . "</div>";

            }

            } ?>
            <br>
            <br>
            

            <form action="salvar_senha.php" method="POST" onsubmit="return validarSenha();">

                <input type="hidden" name="email" value="<?= $email ?>">
                <input type="hidden" name="token" value="<?= $token ?>">

                <h6><i class="material-icons right">lock_outline</i>Senha:</h6>
                <div class="input-field col s6">
                    <div class="text-align: -webkit-center"><i class="material-icons postfix right-align" style="font-size:1.3rem; margin-top:6px;" onclick="mostrar()">remove_red_eye</i></div>
                    <input id="senha" name="senha" type="password" class="field" placeholder="defina uma senha" required>
                </div>

                <h6><i class="material-icons right">lock_open</i>Confirmar Senha:</h6>
                <div class="input-field col s6">
                    <div class="text-align: -webkit-center"><i class="material-icons postfix right-align" style="font-size:1.3rem; margin-top:6px;" onclick="mostrar_confirmacao()">remove_red_eye</i></div>
                    <input id="confirmar_senha" name="confirmar_senha" type="password" placeholder="confirme sua senha" onblur="validarSenha()" class="field" required>
                </div>
                <br>

                <button type="submit" class="waves-effect waves-light btn btn_a center-align">Confirmar<i class="material-icons right">check</i></button>

                <br>

                <a href="../index/entrada.php" class="waves-effect waves-light btn btn_a center-align">Cancelar <i class="material-icons right">close</i></a>

                <br>
                
            </form>

        </div>

        <div class="content">
            <article class="message">
                <p>NEBULA</p>
                <h4>Desenvolva e compartilhe conhecimento</h4>
            </article>
        </div>
    </div>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>

    <script type="text/javascript">
    function validarSenha() {
        senha = document.getElementById("senha").value;
        rs = document.getElementById("confirmar_senha");
        repetirSenha = document.getElementById("confirmar_senha").value;

        if (senha == repetirSenha) {
            
            rs.setCustomValidity('');
            rs.checkValidity();
            return true;

        } else {

            rs.setCustomValidity('As senhas não conferem');
            rs.checkValidity();
            rs.reportValidity();
            return false;

        }
    }
    </script>
    <script>
        function mostrar() {
            var senha = document.getElementById("senha");
            if (senha.type === "password") {
                senha.type = "text";
            } else {
                senha.type = "password";
            }
        }
        function mostrar_confirmacao() {
            var senha = document.getElementById("confirmar_senha");
            if (senha.type === "password") {
                senha.type = "text";
            } else {
                senha.type = "password";
            }
        }
    </script>
</body>

</html>