<?php
session_start();
include "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $id_questionario = mysqli_real_escape_string($conexao,$_POST['id_questionario']);
    $nome_questionario = mysqli_real_escape_string($conexao,$_POST['nome_questionario']);

    $tempo_numero = mysqli_real_escape_string($conexao,$_POST['tempo_numero']);
    $tempo_unidade = mysqli_real_escape_string($conexao,$_POST['tempo_unidade']);

    $tempo_proxima_realizacao = $tempo_numero."-".$tempo_unidade;


    if(isset($_POST['distribuicao_questoes'])){

        $distribuicao_questoes = "padronizada";

    } else {

        $distribuicao_questoes = "aleatoria";

    }

    if(isset($_POST['visibilidade_questionario'])){

        $visibilidade_questionario = "visível";

    } else {

        $visibilidade_questionario = "não-visível";

    }


    $sql = "UPDATE questionarios SET nome_questionario='$nome_questionario', distribuicao_questoes='$distribuicao_questoes', tempo_proxima_realizacao='$tempo_proxima_realizacao', visibilidade_questionario='$visibilidade_questionario' WHERE id_questionario=$id_questionario"; 
    $resultado = mysqli_query($conexao,$sql);

    if($resultado){

        $_SESSION['mensagem'] = "Alterações salvas com sucesso!";
        echo "<script>window.history.go(-1);</script>";

    }
?>