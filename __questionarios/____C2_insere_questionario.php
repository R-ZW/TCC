<?php

    include_once "../_______necessarios/.conexao_bd.php";

    $id_aula = $_POST['id_aula'];
    $nome_questionario = $_POST['nome_questionario'];

    if(isset($_POST['distribuicao_questoes'])){

        $distribuicao_questoes = "aleatoria";

    } else {

        $distribuicao_questoes = "padronizada";

    }
    

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");


    //inserindo os dados do material-
    $sql = "INSERT INTO questionarios(id_aula, nome_questionario, distribuicao_questoes, data_criacao_questionario) 
    VALUES ('$id_aula', '$nome_questionario', '$distribuicao_questoes', '$data')";

    $resultado = mysqli_query($conexao,$sql);
    // -


    if($resultado)
    {
        // pegar o id gerado
        $id_questionario = mysqli_insert_id($conexao);

	    header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

    mysqli_close($conexao);

?>
