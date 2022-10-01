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

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs próprio-->
    <link rel="stylesheet" type="text/css" href=".css_index/entrada.css">

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../_.materialize/css/configs.css">

</head>

<body>

    <main>

        <div class="container">
            <div class="card-panel">

                <h3 class="indigo-text center-align">NEBULA</h3>
                <div class="br-titulo-sub"><br></div>
                <h5 class="indigo-text center-align">Formulário de Login</h5>

                    <form action="../______usuarios/login.php" method="POST">

                        <?php if (isset($_SESSION['mensagem'])) {
                            echo "<div class='red-text'>" . exibeMensagens() . "</div>";
                        } ?>

                        Email:<input id="email" name="email" type="email" class="validate" required><br>

                        <br>

                        Senha: <input id="senha" name="senha" type="password" class="validate" required><br>

                        <br>
                        <br>

                        <input type="submit" value="Entrar">
                        <a href="../______usuarios/____C1_form_cadastro_usuario.php">Criar Conta</a><br>

                        <br>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <br>
    <br>

</body>

</html>