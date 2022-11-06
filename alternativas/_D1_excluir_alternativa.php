<?php
session_start();
include "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $id_alternativa = mysqli_real_escape_string($conexao,$_GET['id_alternativa']);
    $id_questionario = mysqli_real_escape_string($conexao,$_GET['id_questionario']);

    $sql = "DELETE FROM alternativas WHERE id_alternativa=$id_alternativa";
    $resultado = mysqli_query($conexao,$sql);

    if($resultado){

        $_SESSION['mensagem'] = "Alternativa excluída com sucesso!";
        header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

?>