<?php
session_start();
include_once "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $email = $_SESSION['email'];
    $id_aula = mysqli_real_escape_string($conexao,$_GET['id_aula']);

    $sql = "SELECT * FROM favoritos_aula WHERE email='$email' AND id_aula=$id_aula";
    $resultado = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_assoc($resultado);
    if(isset($linha)){
        $situacao_favorito_aula = $linha['situacao_favorito_aula'];
    }

    if(!isset($linha)){

        $sql_1 = "INSERT INTO favoritos_aula (email, id_aula, situacao_favorito_aula) 
                                       VALUES ('$email','$id_aula','favorito')";
        $resultado_1 = mysqli_query($conexao, $sql_1);

        echo "<script>window.history.go(-1);</script>";

        die;

    }

    if($situacao_favorito_aula == "favorito"){

        $sql_1 = "UPDATE favoritos_aula SET situacao_favorito_aula='não-favorito' WHERE email='$email' AND id_aula=$id_aula";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    } elseif ($situacao_favorito_aula == "não-favorito"){

        $sql_1 = "UPDATE favoritos_aula SET situacao_favorito_aula='favorito' WHERE email='$email' AND id_aula=$id_aula";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    }

    echo "<script>window.history.go(-1);</script>";

?>