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
        <div class="panel-auth">

            <h2 style="text-align:center;">Nebula</h2>

            <h5 style="text-align:center; margin-top: 0">Entre usando sua conta</h5>

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


            <form action="../______usuarios/login.php" method="POST">

                <h6><i class="material-icons right">person</i>Email:</h6>
                <input id="field" name="email" type="email" class="validate" placeholder="insira seu email aqui" required>

                <h6><i class="material-icons right">vpn_key</i>Senha:</h6>
                <input id="field" name="senha" type="password" class="validate" placeholder="insira sua senha aqui" required>
        
                <aside class="col">
                    <a href="../______usuarios/recuperar_senha_1.php?i=<?= $i;?>">Esqueceu a senha?</a>
                </aside>

                <button type="submit" class="waves-effect waves-light btn btn_a center-align">Entrar <i class="material-icons right">send</i></button>

                <br>
                <br>
                <br>

                <h5>Não possui conta?</h5>
                <a href="../______usuarios/____C1_form_cadastro_usuario.php?i=<?= $i;?>" class="waves-effect waves-light btn btn_a center-align"><i class="material-icons right">person_add</i>Criar conta</a>

                
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

</body>

</html>