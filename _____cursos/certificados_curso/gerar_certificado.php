<?php

    require 'vendor/autoload.php';

    use Dompdf\Dompdf;

    $nome_usuario = "claudio";
    $nome_curso = "curso";
    $carga_horaria= "10h";

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