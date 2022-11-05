<?php
session_start();
    require '../../_______necessarios/.conexao_bd.php';
    require 'vendor/autoload.php';

    use Dompdf\Dompdf;

    $email = $_SESSION['email'];
    $id_curso = mysqli_real_escape_string($conexao,$_GET['id_curso']);

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);
    $nome_usuario = $linha['nome_usuario'];

    $sql1 = "SELECT * FROM cursos WHERE id_curso=$id_curso";
    $resultado1 = mysqli_query($conexao, $sql1);
    $linha1 = mysqli_fetch_assoc($resultado1);
    $nome_curso = $linha1['nome_curso'];
    $carga_horaria= $linha1['certificado_curso'];

    $dompdf = new Dompdf(['enable_remote' => true]);
    $dompdf -> loadHtml("

        <!DOCTYPE html>
        <html lang='pt'>
        <head>
            <meta charset='UTF-8'>
        </head>
            <body>

                <style>
                    @page{ 
                        margin: 0px;
                    }

                    body{
                        background-color:#210D30;
                    }
                </style>

                <div style='color:#DBDBDB;'>

                    <br><br>

                    <center><img src='http://localhost/TCC/_.imgs_default/logo_n3.png' width='120px' height='138px'></center>
                    
                    <br><br><br>

                    <center><span style='font-size:2.5em; font-weight:600;'>CERTIFICADO DE CONCLUSÃO</span></center>

                    <br>

                    <center><span style='font-size:1.6em; font-weight:600;'>CONCEDIDO A</span></center>

                    <br><br><br>

                    <center><span style='font-size:2.8em; font-weight:600;'>$nome_usuario</span></center>

                    <br><br><br><br><br>
                    
                    <center>
                        <span style='font-size:1.6em;'>CERTIFICA-SE A CONCLUSÃO DO CURSO<br><br>
                            <span style='font-weight:600; font-size:1.5em;'>$nome_curso</span>
                        </span>
                    </center>

                    <br><br><br>

                    <center><span style='font-weight:600; font-size:2.3em;'>$carga_horaria horas</span></center>
                </div>
            </body>
        </html>
    
    ");
    $dompdf -> setPaper("A4", "landscape");
    $dompdf -> render();
    $dompdf -> stream();

?>