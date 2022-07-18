<?php

    include_once ".conexao_bd.php";

    $id_curso = $_POST['id_curso'];

    $nome_modulo= $_POST['nome_modulo'];
    $descricao_modulo= $_POST['descricao_modulo'];
    
    if(isset($_FILES['endereco_imagem_modulo'])){

        $ext = strrchr($_FILES['endereco_imagem_modulo']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "arquivos/___imgs_modulo/";
    
        move_uploaded_file($_FILES['endereco_imagem_modulo']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_modulo = $dir.$nome;
    
    }else{
    
        $endereco_imagem_modulo = "arquivos/_imgs_default/sem_imagem.png";
    
    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //inserindo os dados do modulo-
    $sql = "INSERT INTO modulos(id_curso, nome_modulo, descricao_modulo, endereco_imagem_modulo, data_criacao_modulo) 
    VALUES ('$id_curso', '$nome_modulo', '$descricao_modulo', '$endereco_imagem_modulo', '$data')";

    $resultado = mysqli_query($conexao,$sql);
    // -


    mysqli_close($conexao);

    if($resultado)
    {
	    header("Location:1____modificacao_curso.php?id_curso=$id_curso");
    }

?>
