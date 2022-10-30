<?php
session_start();
    require_once "../../_______necessarios/.conexao_bd.php";
    
    echo '<meta charset="UTF-8">';

    $id_curso= $_GET['id_curso'];
    $i = $_GET['i'];
    $carga_horaria= $_POST['carga_horaria'];

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
