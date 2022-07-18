<?php
    echo '<meta charset="UTF-8">';

    include ".conexao_bd.php";

    $id_modulo = $_POST['id_modulo'];
    $endereco_imagem_modulo_pre_alteracao = $_POST['endereco_imagem_modulo_pre_alteracao'];

    $nome_modulo = $_POST['nome_modulo'];
    $descricao_modulo = $_POST['descricao_modulo'];
    
    if(isset($_FILES['endereco_imagem_modulo'])){

        $ext = strrchr($_FILES['endereco_imagem_modulo']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "arquivos/___imgs_modulo/";
    
        move_uploaded_file($_FILES['endereco_imagem_modulo']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_modulo = $dir.$nome;
    
    } else {
    
        $endereco_imagem_modulo = $endereco_imagem_modulo_pre_alteracao;
    
    }


    $sql = "UPDATE modulos SET nome_modulo='$nome_modulo', descricao_modulo='$descricao_modulo', endereco_imagem_modulo='$endereco_imagem_modulo' WHERE id_modulo=$id_modulo"; 
    $resultado = mysqli_query($conexao,$sql);

    $sql_1 = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao,$sql_1);
    $linha_1 = mysqli_fetch_array($resultado_1);

    $id_curso = $linha_1['id_curso'];

    mysqli_close($conexao);

    if($resultado){

        header("Location: 1____modificacao_curso.php?id_curso=$id_curso");

    }
?>