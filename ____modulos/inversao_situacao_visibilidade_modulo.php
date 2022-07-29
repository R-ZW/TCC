<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $id_curso = $_GET['id_curso'];
    $id_modulo = $_GET['id_modulo'];


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

        header ("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    } 

?>