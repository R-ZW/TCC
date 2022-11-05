<?php
session_start();
require_once "../_______necessarios/.funcoes.php";
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
    <link rel="stylesheet" type="text/css" href=".assets/css_entrada.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_.materialize/css/materialize.min.css"  media="screen,projection"/>

</head>

<body>

    <div id="wapper">
        <div class="auth-background" style="<?php $i = rand(1, 8); echo "background: url(../_.imgs_default/nebulosas/$i.png);"?>"></div>
        <div class="panel-auth" style="padding-top:50px;">

            <div class='center'><img src='../_.imgs_default/logo_n1.png' width="200px" height="230px"></div><br>

            <h5 style="text-align:center; margin-top:0px;">Entre usando sua conta</h5>

            <br>
            <?php if (isset($_SESSION['mensagem'])) {

            if($_SESSION['mensagem'] == "Mensagem enviada com sucesso!" or 
               $_SESSION['mensagem'] == "Nova senha foi redefinida com sucesso!"){

                echo "<span class='green-text' style='font-weight:500 !important;'>" . exibeMensagens() . "</span>";

            } else {

                echo "<span class='red-text' style='font-weight:500 !important;'>" . exibeMensagens() . "</span>";

            }

            } ?>
            <br>
            <br>


            <form action="../______usuarios/login.php" method="POST">

                <h6><i class="material-icons right">person</i>Email:</h6>
                <input id="email" name="email" type="email" class="field" placeholder="insira seu email aqui" required>
                
                <h6><i class="material-icons right">vpn_key</i>Senha:</h6>
                <div class="input-field col s6">
                    <div class="text-align: -webkit-center"><i class="material-icons postfix right-align" style="font-size:1.4rem; margin-top:6px;" onclick="mostrar()">remove_red_eye</i></div>
                    <input id="senha" name="senha" type="password" class="field" placeholder="insira sua senha aqui" required>
                </div>
                
                <aside class="col">
                    <a href="../______usuarios/recuperar_senha_1.php?i=<?= $i;?>">Esqueceu a senha?</a>
                </aside>

                <button type="submit" class="waves-effect waves-light btn btn_a center-align">Entrar <i class="material-icons right">send</i></button>

                <br>
                <br>
                <br>
                <br>

                <h5>Não possui conta?</h5>
                <a href="../______usuarios/____C1_form_cadastro_usuario.php?i=<?= $i;?>" class="waves-effect waves-light btn btn_a center-align"><i class="material-icons right">person_add</i>Criar conta</a>

                
            </form>
            <br>
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
    <script>
        function mostrar() {
            var senha = document.getElementById("senha");
            if (senha.type === "password") {
                senha.type = "text";
            } else {
                senha.type = "password";
            }
        }
    </script>

</body>

</html>