<?php
session_start();

    echo '<meta charset="UTF-8">';

    include "../_______necessarios/.conexao_bd.php";

    $id_aula = mysqli_real_escape_string($conexao,$_POST['id_aula']);

    //obtendo o id_modulo-
    $sql = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    $id_modulo = $linha['id_modulo'];
    //-

    //obtendo o id_curso-
    $sql_1 = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao, $sql_1);
    $linha_1 = mysqli_fetch_assoc($resultado_1);

    $id_curso = $linha_1['id_curso'];
    //-

    $endereco_imagem_aula_pre_alteracao = mysqli_real_escape_string($conexao,$_POST['endereco_imagem_aula_pre_alteracao']);
    
    $nome_aula = mysqli_real_escape_string($conexao,$_POST['nome_aula']);
    $descricao_aula = mysqli_real_escape_string($conexao,$_POST['descricao_aula']);
    
    if(isset($_FILES['endereco_imagem_aula'])){

        $ext = strrchr($_FILES['endereco_imagem_aula']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "imgs_aula/";
    
        move_uploaded_file($_FILES['endereco_imagem_aula']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_aula = "../../___aulas/".$dir.$nome;

        $endereco_imagem_a = explode("/", $endereco_imagem_aula_pre_alteracao);
        $endereco_imagem_au = array_reverse($endereco_imagem_a);
        $endereco_imagem_aul = $endereco_imagem_au[1] ."/". $endereco_imagem_au[0];
        unlink($endereco_imagem_aul);
    
    } else {
    
        $endereco_imagem_aula = $endereco_imagem_aula_pre_alteracao;
    
    }

    if(isset($_POST['visibilidade_aula'])){

        $visibilidade_aula = "visível";

    } else {

        $visibilidade_aula = "não-visível";

    }


    $sql_2 = "UPDATE aulas SET nome_aula='$nome_aula', descricao_aula='$descricao_aula', endereco_imagem_aula='$endereco_imagem_aula', visibilidade_aula='$visibilidade_aula' WHERE id_aula=$id_aula"; 
    $resultado_2 = mysqli_query($conexao,$sql_2);

    if($resultado and $resultado_1 and $resultado_2){

        $_SESSION['mensagem'] = "Alterações salvas com sucesso!";
        echo "<script>window.history.go(-1);</script>";

    }
?>