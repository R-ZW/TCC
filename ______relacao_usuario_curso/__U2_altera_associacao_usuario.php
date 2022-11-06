<?php
session_start();
include "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $email_antigo = mysqli_real_escape_string($conexao,$_POST['email_antigo']);
    $email_novo = strtolower(mysqli_real_escape_string($conexao,$_POST['email_novo']));
    $id_curso = mysqli_real_escape_string($conexao,$_POST['id_curso']);

    if($email_antigo == $email_novo){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    } else {

        //verificando se o email existe no banco-
        $s= "SELECT * FROM usuarios WHERE email='$email_novo'";
        $r= mysqli_query($conexao, $s);
        $l= mysqli_fetch_assoc($r);
        //-

        //obtendo id_relacao_usuario_curso
        $sq = "SELECT id_relacao_usuario_curso FROM relacao_usuario_curso WHERE email='$email_novo' AND id_curso=$id_curso AND tipo_relacao='consumidor'";
        $result = mysqli_query($conexao, $sq);
        $linha = mysqli_fetch_assoc($result);
        //-


        if(!isset($l)){

            $_SESSION['mensagem'] = "O usuário informado não existe!";
            header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");
            die;
    
        }
        if(isset($linha)){

            $_SESSION['mensagem'] = "O usuário já está associado ao curso!";
            header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");
            die;

        } else {

            //editando a relação do usuário com o curso-
            $sql_1 = "UPDATE relacao_usuario_curso SET email='$email_novo' WHERE email='$email_antigo' AND id_curso='$id_curso' AND tipo_relacao='consumidor'"; 
            $resultado_1 = mysqli_query($conexao,$sql_1);
            //-


            //editando a relação do usuário com os questionários-
            $sql_2 = "UPDATE relacao_usuario_questionario SET email='$email_novo' WHERE email='$email_antigo' AND id_curso='$id_curso'"; 
            $resultado_2 = mysqli_query($conexao,$sql_2);
            //-

            $_SESSION['mensagem'] = "Usuário associado com sucesso!";
            header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

        }

    }
    ?>