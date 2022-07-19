<?php
session_start();
require_once "funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <title>Tela de Entrada</title>

</head>

<body>

    <main>
        
        <br>

        <form action="00_login.php" method="POST" class="col s12 l5 card-panel">

            <?php if (isset($_SESSION['mensagem'])) {
                echo "<div class='red-text'>" . exibeMensagens() . "</div>";
            } ?>

            Email:<input id="email" name="email" type="email" class="validate" required><br>

            <br>

            Senha: <input id="senha" name="senha" type="password" class="validate" required><br>

            <br>
            <br>

            <input type="submit" value="Entrar">
            <a href="00__form_cadastro_usuario.php">Criar Conta</a><br>

            <br>

        </form>

    </main>

    <br>
    <br>

</body>

</html>