<?php
session_start();
    require_once "conexao_bd.php";

    $id_usuario = $_SESSION['id_usuario'];

    $nome_usuario = $_POST['nome_usuario'];
    $email = $_POST['email'];
    $senha_antiga = $_POST['senha_antiga'];
    $senha_nova = $_POST['senha_nova'];
    $confirmar_senha = $_POST['confirmar_senha'];

    $senha_antiga_MD5 = md5($senha_antiga);
    $senha_nova_MD5 = md5($senha_nova);

    
    $s = "SELECT * FROM usuarios WHERE email='$email'";
    $r = mysqli_query($conexao, $s);
    $l = mysqli_fetch_assoc($r);

    
    $sq = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
    $re = mysqli_query($conexao, $sq);
    $li = mysqli_fetch_assoc($re);


    if($l['email']!="" and $l['email']!=$li['email']){

        $_SESSION['mensagem'] = 'Este email já está cadastrado no sistema!';
        
        header("Location: 00__form_altera_usuario.php");

        die;

    }
    
    if($senha_antiga!="" and $senha_nova!=""){
    
        if($confirmar_senha!=""){

            if($senha_antiga_MD5 == $li['senha']){

                $sql = "UPDATE usuarios SET nome_usuario='$nome_usuario', email='$email', senha='$senha_nova_MD5' WHERE id_usuario=$id_usuario";
                $resultado = mysqli_query($conexao, $sql);

            } else {

                $_SESSION['mensagem'] = 'A senha antiga submetida está incorreta!';
            
                header("Location: 00__form_altera_usuario.php");

                die;

            }

        } else {

            $_SESSION['mensagem'] = 'Não houve confirmação da nova senha!';
        
            header("Location: 00__form_altera_usuario.php");

            die;
        }

    } else {
        
        $sql = "UPDATE usuarios SET nome_usuario='$nome_usuario', email='$email' WHERE id_usuario=$id_usuario";
        $resultado = mysqli_query($conexao, $sql);

    }

    if($resultado){

        header("Location: 01_capa.php");

    }
?>