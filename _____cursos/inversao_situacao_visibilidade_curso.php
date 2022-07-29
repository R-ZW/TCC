<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $id_curso = $_GET['id_curso'];
    $i = $_GET['i'];


    $sql = "SELECT * FROM cursos WHERE id_curso=$id_curso";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    $visibilidade_curso = $linha['visibilidade_curso'];


    if($visibilidade_curso == "visível"){

        $sql_1 = "UPDATE cursos SET visibilidade_curso='não-visível' WHERE id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    } else {

        $sql_1 = "UPDATE cursos SET visibilidade_curso='visível' WHERE id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    }

    if($i==0){

        header ("Location: ../index/produtor/PROD____home_produtor.php");

    } elseif($i==1) {

        header ("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    } 

?>