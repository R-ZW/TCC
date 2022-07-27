<?php
    session_start();
    
    echo '<meta charset="UTF-8">';

    include_once "../_______necessarios/.conexao_bd.php";

    $email = $_POST['email'];

    $nome_curso= $_POST['nome_curso'];
    $descricao_curso= $_POST['descricao_curso'];

    if(isset($_FILES['endereco_imagem_curso'])){

        $ext = strrchr($_FILES['endereco_imagem_curso']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "imgs_curso/";
    
        move_uploaded_file($_FILES['endereco_imagem_curso']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_curso = "../../_____cursos/".$dir.$nome;
    
    } else {
    
        $endereco_imagem_curso = "../../_.imgs_default/sem_imagem.png";
    
    }

    if(isset($_FILES['endereco_certificado_curso'])){

        $ext_1 = strrchr($_FILES['endereco_certificado_curso']['name'], '.');
        $nome_1 = md5(time()).$ext_1;
        $dir_1 = "certificados_curso/";
    
        move_uploaded_file($_FILES['endereco_certificado_curso']['tmp_name'], $dir_1.$nome_1);
    
    }
    if($ext_1 != ""){
    
        $endereco_certificado_curso = "../../_____cursos/".$dir_1.$nome_1;
    
    } else {
    
        $endereco_certificado_curso = "sem-certificado";
    
    }

    if(isset($_POST['visibilidade_curso'])){

        $visibilidade_curso = "não-visível";

    } else {

        $visibilidade_curso = "visível";

    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //inserindo os dados do curso-
    $sql = "INSERT INTO cursos(nome_curso, descricao_curso, endereco_imagem_curso, endereco_certificado_curso, visibilidade_curso, data_criacao_curso) 
    VALUES ('$nome_curso', '$descricao_curso', '$endereco_imagem_curso', '$endereco_certificado_curso', '$visibilidade_curso', '$data')";

    $resultado = mysqli_query($conexao,$sql);
    //-


    //obtendo o id_curso do curso gerado-
    $id_curso = mysqli_insert_id($conexao);
    //-


    //inserindo os dados na relação
    $sql_1 = "INSERT INTO relacao_usuario_curso(email, id_curso, tipo_relacao, data_relacao) 
    VALUES ('$email', '$id_curso', 'produtor', '$data')";

    $resultado_1 = mysqli_query($conexao,$sql_1);
    // - 

    mysqli_close($conexao);

    if($resultado and $resultado_1)
    {
        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");
    }

?>
