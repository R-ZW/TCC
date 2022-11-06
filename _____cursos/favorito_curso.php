<?php
session_start();
include_once "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $email = $_SESSION['email'];
    $id_curso = mysqli_real_escape_string($conexao,$_GET['id_curso']);

    $sql = "SELECT * FROM favoritos_curso WHERE email='$email' AND id_curso=$id_curso";
    $resultado = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_assoc($resultado);
    $situacao_favorito_curso = $linha['situacao_favorito_curso'];

    if(is_null($situacao_favorito_curso)){

        $sql_1 = "INSERT INTO favoritos_curso (email, id_curso, situacao_favorito_curso) 
                                       VALUES ('$email','$id_curso','favorito')";
        $resultado_1 = mysqli_query($conexao, $sql_1);

        echo "<script>window.history.go(-1);</script>";

        die;

    }

    if($situacao_favorito_curso == "favorito"){

        $sql_1 = "UPDATE favoritos_curso SET situacao_favorito_curso='não-favorito' WHERE email='$email' AND id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    } elseif($situacao_favorito_curso == "não-favorito"){

        $sql_1 = "UPDATE favoritos_curso SET situacao_favorito_curso='favorito' WHERE email='$email' AND id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    }

    echo "<script>window.history.go(-1);</script>";

?>