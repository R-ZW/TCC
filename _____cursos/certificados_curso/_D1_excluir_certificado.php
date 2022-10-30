<?php
session_start();
    require_once "../../_______necessarios/.conexao_bd.php";
    
    echo '<meta charset="UTF-8">';

    $id_curso= $_GET['id_curso'];

    $sql = "UPDATE cursos SET certificado_curso='sem-certificado' WHERE id_curso=$id_curso";
    $resultado = mysqli_query($conexao, $sql);

    if($resultado)
    {
        $_SESSION['mensagem'] = "Certificado excluído com sucesso!";
        echo "<script>window.history.go(-1);</script>";
    }

?>
