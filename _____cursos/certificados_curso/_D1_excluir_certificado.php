<?php
session_start();
    require_once "../../_______necessarios/.conexao_bd.php";
    
    if (!isset($_SESSION['id_usuario'])) {
        $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
        header("Location: ../../nebula.php");
        die;
    }

    $id_curso= mysqli_real_escape_string($conexao,$_GET['id_curso']);

    $sql = "UPDATE cursos SET certificado_curso='sem-certificado' WHERE id_curso=$id_curso";
    $resultado = mysqli_query($conexao, $sql);

    if($resultado)
    {
        $_SESSION['mensagem'] = "Certificado excluído com sucesso!";
        echo "<script>window.history.go(-1);</script>";
    }

?>
