<?php
session_start();
    include_once "../_______necessarios/.conexao_bd.php";

    $id_aula = mysqli_real_escape_string($conexao,$_POST['id_aula']);

    $nome_material= mysqli_real_escape_string($conexao,$_POST['nome_material']);
    
    if(isset($_FILES['endereco_material'])){

        $ext = strrchr($_FILES['endereco_material']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "materiais/";
    
        move_uploaded_file($_FILES['endereco_material']['tmp_name'], $dir.$nome);

        $endereco_material = "../../__materiais/".$dir.$nome;
    
    }

    if(isset($_POST['visibilidade_material'])){

        $visibilidade_material = "visível";

    } else {

        $visibilidade_material = "não-visível";

    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //inserindo os dados do material-
    $sql = "INSERT INTO materiais(id_aula, nome_material, endereco_material, visibilidade_material, data_criacao_material) 
    VALUES ('$id_aula', '$nome_material', '$endereco_material', '$visibilidade_material', '$data')";

    $resultado = mysqli_query($conexao,$sql);
    // -


    if($resultado)
    {
        $_SESSION['mensagem'] = "Material cadastrado com sucesso!";
        echo "<script>window.history.go(-1);</script>";
    }

?>
