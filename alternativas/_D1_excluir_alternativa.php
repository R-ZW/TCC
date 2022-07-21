<?php
    
    include "../_______necessarios/.conexao_bd.php";

    $id_alternativa = $_GET['id_alternativa'];
    $id_questionario = $_GET['id_questionario'];

    $sql = "DELETE FROM alternativas WHERE id_alternativa=$id_alternativa";
    $resultado = mysqli_query($conexao,$sql);

    mysqli_close($conexao);

    if($resultado){

        header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

?>