<?php
session_start();
    
    include "../_______necessarios/.conexao_bd.php";

    $id_questao = mysqli_real_escape_string($conexao,$_GET['id_questao']);
    $id_questionario = mysqli_real_escape_string($conexao,$_GET['id_questionario']);

    //excluindo as alternativas da questão
    $sql = "DELETE FROM alternativas WHERE id_questao=$id_questao";
    $resultado = mysqli_query($conexao,$sql);
    //excluidas as alternativas da questão

    
    //excluindo a questão
    $sql_1 = "DELETE FROM questoes WHERE id_questao=$id_questao";
    $resultado_1 = mysqli_query($conexao,$sql_1);
    //excluida a questão

    if($resultado and $resultado_1){

        $_SESSION['mensagem'] = "Questão excluída com sucesso!";
        header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

?>
