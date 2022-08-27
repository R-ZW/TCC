<?php
    session_start();
    
    echo '<meta charset="UTF-8">';

    include_once "../_______necessarios/.conexao_bd.php";

    $id_curso = $_POST['id_curso'];
    $endereco_imagem_curso_pre_alteracao = $_POST['endereco_imagem_curso_pre_alteracao'];
    $endereco_certificado_curso_pre_alteracao = $_POST['endereco_certificado_curso_pre_alteracao'];
    $i = $_POST['i'];
    $email = $_POST['email'];

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

    if(isset($_FILES['endereco_certificado_curso'])){

        $ext_1 = strrchr($_FILES['endereco_certificado_curso']['name'], '.');
        $nome_1 = md5(time()).$ext_1;
        $dir_1 = "certificados_curso/";
    
        move_uploaded_file($_FILES['endereco_certificado_curso']['tmp_name'], $dir_1.$nome_1);
    
    }
    if($ext_1 != ""){
    
        $endereco_certificado_curso = "../../_____cursos/".$dir_1.$nome_1;

        $endereco_certificado_c = explode("/", $endereco_certificado_curso_pre_alteracao);
        $endereco_certificado_cur = array_reverse($endereco_certificado_c);
        $endereco_certificado_curs = $endereco_certificado_cur[1] ."/". $endereco_certificado_cur[0];
        unlink($endereco_certificado_curs);
    
    } else {
    
        $endereco_certificado_curso = $endereco_certificado_curso_pre_alteracao;
    
    }

    if(isset($_POST['visibilidade_curso'])){

        $visibilidade_curso = "não-visível";

    } else {

        $visibilidade_curso = "visível";

    }

    $sql = "UPDATE cursos SET nome_curso='$nome_curso', descricao_curso='$descricao_curso', endereco_imagem_curso='$endereco_imagem_curso', endereco_certificado_curso='$endereco_certificado_curso', visibilidade_curso='$visibilidade_curso' WHERE id_curso=$id_curso"; 
    $resultado = mysqli_query($conexao,$sql);

    mysqli_close($conexao);

    if($resultado and $i==0){

        header("Location: ../index/produtor/PROD____home_produtor.php");

    } elseif($i==1 and $resultado) {

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    }
?>