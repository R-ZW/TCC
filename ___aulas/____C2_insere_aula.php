<?php

    include_once ".conexao_bd.php";

    $id_modulo = $_POST['id_modulo'];

    $nome_aula= $_POST['nome_aula'];
    $descricao_aula= $_POST['descricao_aula'];

    if(isset($_FILES['endereco_imagem_aula'])){

        $ext = strrchr($_FILES['endereco_imagem_aula']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "arquivos/__imgs_aula/";
    
        move_uploaded_file($_FILES['endereco_imagem_aula']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_aula = $dir.$nome;
    
    }else{
    
        $endereco_imagem_aula = "arquivos/_imgs_default/sem_imagem.png";
    
    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //inserindo os dados da aula-
    $sql = "INSERT INTO aulas(id_modulo, nome_aula, descricao_aula, endereco_imagem_aula, data_criacao_aula) 
    VALUES ('$id_modulo', '$nome_aula', '$descricao_aula', '$endereco_imagem_aula', '$data')";

    $resultado = mysqli_query($conexao,$sql);
    // -


    //selecionando o id_aula da aula que possua o mesmo nome, descrição e data de criação da cadastrada (ou seja, a aula cadastrada)-
    $sql_1 = "SELECT id_aula FROM aulas WHERE nome_aula=" . '"' . $nome_aula . '"' . "AND descricao_aula=" . '"' . $descricao_aula . '"' . "AND data_criacao_aula=" . '"' . $data . '"';
    $resultado_1 = mysqli_query($conexao,$sql_1);
    $linha_1 = mysqli_fetch_assoc($resultado_1);

    $id_aula = $linha_1['id_aula'];
    // -


    mysqli_close($conexao);

    if($resultado and $resultado_1)
    {
	    header("Location:1__modificacao_aula.php?id_aula=$id_aula");
    }

?>
