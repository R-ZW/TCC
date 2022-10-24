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
    <link rel="stylesheet" type="text/css" href="../index/.assets/css_entrada.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_.materialize/css/materialize.min.css"  media="screen,projection"/>

</head>

<body>

    <div id="wapper">
        <div class="auth-background" style="<?php $i = $_GET['i']; echo "background: url(../_.imgs_default/nebulosas/$i.png);"?>"></div>
        <div class="panel-auth">

            <h2 style="text-align:center;">Nebula</h2>

            <h5 style="text-align:center; margin-top: 0">Recupere sua senha</h5>

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
            

            <form action="recuperar_senha_2.php" method="POST">

                <h6><i class="material-icons right">mail</i>Email:</h6>
                <input id="email" name="email" type="email" class="field" placeholder="insira seu email aqui" required>

                <br>

                <button type="submit" class="waves-effect waves-light btn btn_a center-align">Confirmar<i class="material-icons right">check</i></button>

                <br>

                <a href="../index/entrada.php" class="waves-effect waves-light btn btn_a center-align">Cancelar <i class="material-icons right">close</i></a>

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