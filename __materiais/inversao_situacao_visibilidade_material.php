<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $id_aula = $_GET['id_aula'];
    $id_material = $_GET['id_material'];
    $i = $_GET['i'];


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

        header ("Location: ../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula");

    }

?>