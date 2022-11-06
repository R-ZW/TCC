<?php
session_start();
include_once "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $id_questao = mysqli_real_escape_string($conexao,$_POST['id_questao']);
    $id_questionario = mysqli_real_escape_string($conexao,$_POST['id_questionario']);
    $desenvolvimento_questao = mysqli_real_escape_string($conexao,$_POST['desenvolvimento_questao']);

    if(isset($_POST['distribuicao_alternativas'])){

        $distribuicao_alternativas = "padronizada";

    } else {

        $distribuicao_alternativas = "aleatoria";

    }

    $sql = "UPDATE questoes SET desenvolvimento_questao='$desenvolvimento_questao', distribuicao_alternativas='$distribuicao_alternativas' WHERE id_questao=$id_questao"; 
    $resultado = mysqli_query($conexao,$sql);

    if($resultado)
    {

        $_SESSION['mensagem'] = "Alterações salvas com sucesso!";
        header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

?>