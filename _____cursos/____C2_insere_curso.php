<?php

    include_once ".conexao_bd.php";

    $email = $_POST['email'];

    $nome_curso= $_POST['nome_curso'];
    $descricao_curso= $_POST['descricao_curso'];

    if(isset($_FILES['endereco_imagem_curso'])){

        $ext = strrchr($_FILES['endereco_imagem_curso']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "arquivos/____imgs_curso/";
    
        move_uploaded_file($_FILES['endereco_imagem_curso']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_curso = $dir.$nome;
    
    }else{
    
        $endereco_imagem_curso = "arquivos/_imgs_default/sem_imagem.png";
    
    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //inserindo os dados do curso-
    $sql = "INSERT INTO cursos(nome_curso, descricao_curso, endereco_imagem_curso, data_criacao_curso) 
    VALUES ('$nome_curso', '$descricao_curso', '$endereco_imagem_curso', '$data')";

    $resultado = mysqli_query($conexao,$sql);
    // -


    //selecionando o id_curso do curso que possua o mesmo nome, descrição e data de criação do cadastrado (ou seja, o curso cadastrado)-
    $sql_1 = "SELECT id_curso FROM cursos WHERE nome_curso=" . '"' . $nome_curso . '"' . "AND descricao_curso=" . '"' . $descricao_curso . '"' . "AND data_criacao_curso=" . '"' . $data . '"';
    $resultado_1 = mysqli_query($conexao,$sql_1);
    $linha_1 = mysqli_fetch_assoc($resultado_1);

    $id_curso = $linha_1['id_curso'];
    // -


    //inserindo os dados na relação
    $sql_2 = "INSERT INTO relacao_usuario_curso(email, id_curso, tipo_relacao, data_relacao) 
    VALUES ('$email', '$id_curso', 'produtor', '$data')";

    $resultado_2 = mysqli_query($conexao,$sql_2);
    // - 

    mysqli_close($conexao);

    if($resultado and $resultado_1 and $resultado_2)
    {
        header("Location:1____modificacao_curso.php?id_curso=$id_curso");
    }

?>
