<?php
    echo '<meta charset="UTF-8">';

    include ".conexao_bd.php";

    $id_curso = $_POST['id_curso'];
    $endereco_imagem_curso_pre_alteracao = $_POST['endereco_imagem_curso_pre_alteracao'];
    $i = $_POST['i'];
    $email = $_POST['email'];

    $nome_curso = $_POST['nome_curso'];
    $descricao_curso = $_POST['descricao_curso'];

    if(isset($_FILES['endereco_imagem_curso'])){

        $ext = strrchr($_FILES['endereco_imagem_curso']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "arquivos/____imgs_curso/";
    
        move_uploaded_file($_FILES['endereco_imagem_curso']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_curso = $dir.$nome;
    
    } else {
    
        $endereco_imagem_curso = $endereco_imagem_curso_pre_alteracao;
    
    }


    $sql = "UPDATE cursos SET nome_curso='$nome_curso', descricao_curso='$descricao_curso', endereco_imagem_curso='$endereco_imagem_curso' WHERE id_curso=$id_curso"; 
    $resultado = mysqli_query($conexao,$sql);

    mysqli_close($conexao);

    if($resultado and $i==0){

        header("Location: 1_____home_produtor.php?email=$email");

    } elseif($i==1 and $resultado) {

        header("Location: 1____modificacao_curso.php?id_curso=$id_curso");

    }
?>