<?php
session_start();
    require '../../_______necessarios/.conexao_bd.php';
    require 'vendor/autoload.php';

    use Dompdf\Dompdf;

    $email = $_SESSION['email'];
    $id_curso = $_GET['id_curso'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);
    $nome_usuario = $linha['nome_usuario'];

    $sql1 = "SELECT * FROM cursos WHERE id_curso=$id_curso";
    $resultado1 = mysqli_query($conexao, $sql1);
    $linha1 = mysqli_fetch_assoc($resultado1);
    $nome_curso = $linha1['nome_curso'];
    $carga_horaria= $linha1['certificado_curso'];

    $dompdf = new Dompdf();
    $dompdf -> loadHtml("
    
        <h1 style='text-align:center;'>Certificado de conclusão de curso</h1>
    
        <h3>A plataforma Nebula certifica que $nome_usuario, concluiu o curso $nome_curso. <br>
        <br>
        Carga horária: $carga_horaria.</h3>
    
    ");
    $dompdf -> setPaper('A4', 'landscape');
    $dompdf -> render();
    $dompdf -> stream();

?>