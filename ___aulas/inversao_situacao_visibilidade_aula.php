<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $id_curso = $_GET['id_curso'];
    $id_aula = $_GET['id_aula'];

    $sql = "SELECT * FROM aulas WHERE id_aula=$id_aula";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    $visibilidade_aula = $linha['visibilidade_aula'];


    if($visibilidade_aula == "visível"){

        $sql_1 = "UPDATE aulas SET visibilidade_aula='não-visível' WHERE id_aula=$id_aula";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    } else {

        $sql_1 = "UPDATE aulas SET visibilidade_aula='visível' WHERE id_aula=$id_aula";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    }

    echo "<script>window.history.go(-1);</script>";

?>