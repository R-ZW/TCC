<?php
session_start();

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaMD5 = md5($senha);

    require_once "conexao_bd.php";

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($conexao, $sql);
    $usuario = mysqli_fetch_assoc($resultado);


    if (is_null($usuario)) {

        $_SESSION['mensagem'] = "Usuário informado não existe";
        header("Location: 00___entrada.php");

    } else if ($senhaMD5 == $usuario['senha']) {

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        header("Location: 01_capa.php");

    } else {

        $_SESSION['mensagem'] = "Senha inválida!";
        header("Location: 00___entrada.php");      
    }

?>