<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $id_aula = $_GET['id_aula'];
    $id_questionario = $_GET['id_questionario'];
    $i = $_GET['i'];


    $sql = "SELECT * FROM questionarios WHERE id_questionario=$id_questionario";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    $visibilidade_questionario = $linha['visibilidade_questionario'];


    if($visibilidade_questionario == "visível"){

        $sql_1 = "UPDATE questionarios SET visibilidade_questionario='não-visível' WHERE id_questionario=$id_questionario";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    } else {

        $sql_1 = "UPDATE questionarios SET visibilidade_questionario='visível' WHERE id_questionario=$id_questionario";
        $resultado_1 = mysqli_query($conexao, $sql_1); 

    }

    if($i == 0){

        header ("Location: ../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula");

    }
    if($i == 1){

        header ("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

?>