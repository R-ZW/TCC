<?php
    echo '<meta charset="UTF-8">';

    include ".conexao_bd.php";

    $id_material = $_POST['id_material'];
    $id_aula = $_POST['id_aula'];
    $endereco_material_pre_alteracao = $_POST['endereco_material_pre_alteracao'];

    $nome_material = $_POST['nome_material'];

    if(isset($_FILES['endereco_material'])){

        $ext = strrchr($_FILES['endereco_material']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "arquivos/materiais/";
    
        move_uploaded_file($_FILES['endereco_material']['tmp_name'], $dir.$nome);
    
    } 
    if($ext != ""){

        $endereco_material = $dir.$nome;

    } else {
    
        $endereco_material = $endereco_material_pre_alteracao;
    
    }


    $sql = "UPDATE materiais SET nome_material='$nome_material', endereco_material='$endereco_material' WHERE id_material=$id_material"; 
    $resultado = mysqli_query($conexao,$sql);

    mysqli_close($conexao);

    if($resultado){

        header("Location: 1__modificacao_aula.php?id_aula=$id_aula");

    }
?>