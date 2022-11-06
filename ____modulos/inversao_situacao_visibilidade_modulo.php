<?php
session_start();
include_once "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $id_curso = mysqli_real_escape_string($conexao,$_GET['id_curso']);
    $id_modulo = mysqli_real_escape_string($conexao,$_GET['id_modulo']);


    $sql = "SELECT * FROM modulos WHERE id_modulo=$id_modulo";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    $visibilidade_modulo = $linha['visibilidade_modulo'];


    if($visibilidade_modulo == "visível"){

        $sql_1 = "UPDATE modulos SET visibilidade_modulo='não-visível' WHERE id_modulo=$id_modulo";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    } else {

        $sql_1 = "UPDATE modulos SET visibilidade_modulo='visível' WHERE id_modulo=$id_modulo";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    }

    if($resultado and $resultado_1){

        echo "<script>window.history.go(-1);</script>";

    } 

?>