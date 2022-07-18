<?php

    include_once ".conexao_bd.php";

    $id_aula = $_POST['id_aula'];

    $nome_material= $_POST['nome_material'];
    
    if(isset($_FILES['endereco_material'])){

        $ext = strrchr($_FILES['endereco_material']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "arquivos/materiais/";
    
        move_uploaded_file($_FILES['endereco_material']['tmp_name'], $dir.$nome);

        $endereco_material = $dir.$nome;
    
    }

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //inserindo os dados do material-
    $sql = "INSERT INTO materiais(id_aula, nome_material, endereco_material, data_criacao_material) 
    VALUES ('$id_aula', '$nome_material', '$endereco_material', '$data')";

    $resultado = mysqli_query($conexao,$sql);
    // -


    mysqli_close($conexao);

    if($resultado)
    {
	    header("Location:1__modificacao_aula.php?id_aula=$id_aula");
    }

?>
