<?php
session_start();
    require_once "../../_______necessarios/.conexao_bd.php";
    
    if (!isset($_SESSION['id_usuario'])) {
        $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
        header("Location: ../../nebula.php");
        die;
    }
    
    $id_curso= mysqli_real_escape_string($conexao,$_GET['id_curso']);
    $i = mysqli_real_escape_string($conexao,$_GET['i']);
    $carga_horaria= mysqli_real_escape_string($conexao,$_POST['carga_horaria']);

    $sql = "UPDATE cursos SET certificado_curso='$carga_horaria' WHERE id_curso=$id_curso";
    $resultado = mysqli_query($conexao, $sql);

    if($resultado and $i==0)
    {
        $_SESSION['mensagem'] = "Certificado cadastrado com sucesso!";
        echo "<script>window.history.go(-1);</script>";
        die;
    }
    if($resultado and $i==1)
    {
        $_SESSION['mensagem'] = "Alterações salvas com sucesso!";
        echo "<script>window.history.go(-1);</script>";
        die;
    }

?>
