<?php
session_start();
include_once "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $id_material = mysqli_real_escape_string($conexao,$_GET['id_material']);

    $sql = "SELECT * FROM materiais WHERE id_material=$id_material";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    $visibilidade_material = $linha['visibilidade_material'];


    if($visibilidade_material == "visível"){

        $sql_1 = "UPDATE materiais SET visibilidade_material='não-visível' WHERE id_material=$id_material";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    } else {

        $sql_1 = "UPDATE materiais SET visibilidade_material='visível' WHERE id_material=$id_material";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    }

    if($resultado and $resultado_1){

        echo "<script>window.history.go(-1);</script>";

    }

?>