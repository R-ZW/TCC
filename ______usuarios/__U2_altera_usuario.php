<?php
session_start();
    require_once "../_______necessarios/.conexao_bd.php";

    $id_usuario = $_SESSION['id_usuario'];

    $endereco_imagem_usuario_pre_alteracao = $_POST['endereco_imagem_usuario_pre_alteracao'];

    $nome_usuario = $_POST['nome_usuario'];
    if(isset($_FILES['endereco_imagem_usuario'])){

        $ext = strrchr($_FILES['endereco_imagem_usuario']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "imgs_usuarios/";
    
        move_uploaded_file($_FILES['endereco_imagem_usuario']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_usuario = "../../______usuarios/".$dir.$nome;

        $endereco_imagem_u = explode("/", $endereco_imagem_usuario_pre_alteracao);
        $endereco_imagem_us = array_reverse($endereco_imagem_u);
        $endereco_imagem_user = $endereco_imagem_us[1] ."/". $endereco_imagem_us[0];
        unlink($endereco_imagem_user);
    
    } else {
    
        $endereco_imagem_usuario = $endereco_imagem_usuario_pre_alteracao;
    
    }

    if($_POST['senha'] != ""){
        
        $senha = mysqli_real_escape_string($conexao,$_POST['senha']);
        $senha_MD5 = md5($senha);

    } else {

        $senha_MD5 = mysqli_real_escape_string($conexao,$_POST['senha_antiga']);

    }
        
    $sql = "UPDATE usuarios SET nome_usuario='$nome_usuario', endereco_imagem_usuario='$endereco_imagem_usuario', senha='$senha_MD5' WHERE id_usuario='$id_usuario'";
    $resultado = mysqli_query($conexao, $sql);

    if($resultado){

        echo "<script>window.history.go(-1);</script>";

    }
?>