<?php
session_start();
    
    echo '<meta charset="UTF-8">';

    include_once "../_______necessarios/.conexao_bd.php";

    $email = $_SESSION['email'];

    $id_curso = $_POST['id_curso'];
    $endereco_imagem_curso_pre_alteracao = $_POST['endereco_imagem_curso_pre_alteracao'];

    $nome_curso = $_POST['nome_curso'];
    $descricao_curso = $_POST['descricao_curso'];

    if(isset($_FILES['endereco_imagem_curso'])){

        $ext = strrchr($_FILES['endereco_imagem_curso']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "imgs_curso/";
    
        move_uploaded_file($_FILES['endereco_imagem_curso']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_curso = "../../_____cursos/".$dir.$nome;

        $endereco_imagem_c = explode("/", $endereco_imagem_curso_pre_alteracao);
        $endereco_imagem_cur = array_reverse($endereco_imagem_c);
        $endereco_imagem_curs = $endereco_imagem_cur[1] ."/". $endereco_imagem_cur[0];
        unlink($endereco_imagem_curs);
    
    } else {
    
        $endereco_imagem_curso = $endereco_imagem_curso_pre_alteracao;
    
    }
    if(isset($_POST['visibilidade_curso'])){

        $visibilidade_curso = "visível";

    } else {

        $visibilidade_curso = "não-visível";

    }

    $sql = "UPDATE cursos SET nome_curso='$nome_curso', descricao_curso='$descricao_curso', endereco_imagem_curso='$endereco_imagem_curso', visibilidade_curso='$visibilidade_curso' WHERE id_curso=$id_curso"; 
    $resultado = mysqli_query($conexao,$sql);

    if($resultado){

        $_SESSION['mensagem'] = "Alterações salvas com sucesso!";
        echo "<script>window.history.go(-1);</script>";

    }
?>