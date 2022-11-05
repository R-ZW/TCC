<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $id_questionario = mysqli_real_escape_string($conexao,$_GET['id_questionario']);

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

    echo "<script>window.history.go(-1);</script>";

?>