<?php
session_start();
    echo '<meta charset="UTF-8">';

    include "../_______necessarios/.conexao_bd.php";

    $id_material = mysqli_real_escape_string($conexao,$_POST['id_material']);
    $id_aula = mysqli_real_escape_string($conexao,$_POST['id_aula']);
    $endereco_material_pre_alteracao = mysqli_real_escape_string($conexao,$_POST['endereco_material_pre_alteracao']);

    $nome_material = mysqli_real_escape_string($conexao,$_POST['nome_material']);

    if(isset($_FILES['endereco_material'])){

        $ext = strrchr($_FILES['endereco_material']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "materiais/";
    
        move_uploaded_file($_FILES['endereco_material']['tmp_name'], $dir.$nome);
    
    } 
    if($ext != ""){

        $endereco_material = "../../__materiais/".$dir.$nome;

        $endereco_m = explode("/", $endereco_material_pre_alteracao);
        $endereco_ma = array_reverse($endereco_m);
        $endereco_mat = $endereco_ma[1] ."/". $endereco_ma[0];
        unlink($endereco_mat);

    } else {
    
        $endereco_material = $endereco_material_pre_alteracao;
    
    }

    if(isset($_POST['visibilidade_material'])){

        $visibilidade_material = "visível";

    } else {

        $visibilidade_material = "não-visível";

    }


    $sql = "UPDATE materiais SET nome_material='$nome_material', endereco_material='$endereco_material', visibilidade_material='$visibilidade_material' WHERE id_material=$id_material"; 
    $resultado = mysqli_query($conexao,$sql);

    if($resultado){

        $_SESSION['mensagem'] = "Alterações salvas com sucesso!";
        echo "<script>window.history.go(-1);</script>";

    }
?>