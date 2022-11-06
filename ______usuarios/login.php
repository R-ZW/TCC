<?php
session_start();
require_once "../_______necessarios/.conexao_bd.php";

if (!isset($_POST['email'])) {
    $_SESSION['mensagem'] = "Você não pode acessar esta página desta forma!";
    header("Location: ../nebula.php");
    die;
}

    $email = strtolower(mysqli_real_escape_string($conexao,$_POST['email']));
    $senha = mysqli_real_escape_string($conexao,$_POST['senha']);
    $senhaMD5 = md5($senha);

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($conexao, $sql);
    $usuario = mysqli_fetch_assoc($resultado);


    if (is_null($usuario)) {

        $_SESSION['mensagem'] = "Usuário informado não existe";
        header("Location: ../index/entrada.php");

    } else if ($senhaMD5 == $usuario['senha']) {

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['email'] = $email;
        header("Location: ../index/consumidor/CONS____home_consumidor.php");

    } else {

        $_SESSION['mensagem'] = "Senha inválida!";
        header("Location: ../index/entrada.php");      
    }

?>