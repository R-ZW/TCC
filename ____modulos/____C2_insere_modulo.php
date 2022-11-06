<?php
session_start();
include_once "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $id_curso = mysqli_real_escape_string($conexao,$_POST['id_curso']);

    $nome_modulo= mysqli_real_escape_string($conexao,$_POST['nome_modulo']);
    $descricao_modulo= mysqli_real_escape_string($conexao,$_POST['descricao_modulo']);
    
    if(isset($_FILES['endereco_imagem_modulo'])){

        $ext = strrchr($_FILES['endereco_imagem_modulo']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "imgs_modulo/";
    
        move_uploaded_file($_FILES['endereco_imagem_modulo']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_modulo = "../../____modulos/".$dir.$nome;
    
    }else{
    
        $endereco_imagem_modulo = "../../_.imgs_default/sem_imagem.png";
    
    }

    if(isset($_POST['visibilidade_modulo'])){

        $visibilidade_modulo = "visível";

    } else {

        $visibilidade_modulo = "não-visível";

    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //inserindo os dados do modulo-
    $sql = "INSERT INTO modulos(id_curso, nome_modulo, descricao_modulo, endereco_imagem_modulo, visibilidade_modulo, data_criacao_modulo) 
    VALUES ('$id_curso', '$nome_modulo', '$descricao_modulo', '$endereco_imagem_modulo', '$visibilidade_modulo', '$data')";

    $resultado = mysqli_query($conexao,$sql);
    // -

    if($resultado)
    {
        $_SESSION['mensagem'] = "Módulo cadastrado com sucesso!";
        echo "<script>window.history.go(-1);</script>";
    }

?>
