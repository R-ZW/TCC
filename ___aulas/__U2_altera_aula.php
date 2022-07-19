<?php
    echo '<meta charset="UTF-8">';

    include ".conexao_bd.php";

    $id_aula = $_POST['id_aula'];

    //obtendo o id_modulo
    $sql = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    $id_modulo = $linha['id_modulo'];
    //obtido o id_modulo


    //obtendo o id_curso
    $sql_1 = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao, $sql_1);
    $linha_1 = mysqli_fetch_assoc($resultado_1);

    $id_curso = $linha_1['id_curso'];
    //obtido o id_curso

    $endereco_imagem_aula_pre_alteracao = $_POST['endereco_imagem_aula_pre_alteracao'];
    $i = $_POST['i'];

    $nome_aula = $_POST['nome_aula'];
    $descricao_aula = $_POST['descricao_aula'];
    
    if(isset($_FILES['endereco_imagem_aula'])){

        $ext = strrchr($_FILES['endereco_imagem_aula']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "arquivos/__imgs_aula/";
    
        move_uploaded_file($_FILES['endereco_imagem_aula']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_aula = $dir.$nome;
    
    } else {
    
        $endereco_imagem_aula = $endereco_imagem_aula_pre_alteracao;
    
    }


    $sql_2 = "UPDATE aulas SET nome_aula='$nome_aula', descricao_aula='$descricao_aula', endereco_imagem_aula='$endereco_imagem_aula' WHERE id_aula=$id_aula"; 
    $resultado_2 = mysqli_query($conexao,$sql_2);

    mysqli_close($conexao);

    if($resultado and $resultado_1 and $resultado_2 and $i==0){

        header("Location: 1____modificacao_curso.php?id_curso=$id_curso");

    }elseif($resultado and $resultado_1 and $resultado_2 and $i==1){

        header("Location: 1__modificacao_aula.php?id_aula=$id_aula");

    }
?>