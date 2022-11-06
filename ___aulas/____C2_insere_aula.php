<?php
session_start();
include_once "../_______necessarios/.conexao_bd.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../nebula.php");
    die;
}

    $id_modulo = mysqli_real_escape_string($conexao,$_POST['id_modulo']);

    $nome_aula= mysqli_real_escape_string($conexao,$_POST['nome_aula']);
    $descricao_aula= mysqli_real_escape_string($conexao,$_POST['descricao_aula']);

    if(isset($_FILES['endereco_imagem_aula'])){

        $ext = strrchr($_FILES['endereco_imagem_aula']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "imgs_aula/";
    
        move_uploaded_file($_FILES['endereco_imagem_aula']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_aula = "../../___aulas/".$dir.$nome;
    
    }else{
    
        $endereco_imagem_aula = "../../_.imgs_default/sem_imagem.png";
    
    }

    if(isset($_POST['visibilidade_aula'])){

        $visibilidade_aula = "visível";

    } else {

        $visibilidade_aula = "não-visível";

    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //inserindo os dados da aula-
    $sql = "INSERT INTO aulas(id_modulo, nome_aula, descricao_aula, endereco_imagem_aula, visibilidade_aula, data_criacao_aula) 
    VALUES ('$id_modulo', '$nome_aula', '$descricao_aula', '$endereco_imagem_aula', '$visibilidade_aula', '$data')";

    $resultado = mysqli_query($conexao,$sql);
    // -


    //selecionando o id_aula da aula que possua o mesmo nome, descrição e data de criação da cadastrada (ou seja, a aula cadastrada)-
    $sql_1 = "SELECT id_aula FROM aulas WHERE nome_aula=" . '"' . $nome_aula . '"' . "AND descricao_aula=" . '"' . $descricao_aula . '"' . "AND data_criacao_aula=" . '"' . $data . '"';
    $resultado_1 = mysqli_query($conexao,$sql_1);
    $linha_1 = mysqli_fetch_assoc($resultado_1);

    $id_aula = $linha_1['id_aula'];
    // -

    if($resultado and $resultado_1)
    {
        $_SESSION['mensagem'] = "Aula cadastrada com sucesso!";
	    header("Location: ../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula");
    }

?>
