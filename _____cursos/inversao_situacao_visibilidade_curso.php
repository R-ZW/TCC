<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $id_curso = mysqli_real_escape_string($conexao,$_GET['id_curso']);

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

    echo "<script>window.history.go(-1);</script>";

?>