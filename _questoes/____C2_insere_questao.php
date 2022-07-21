<?php

    include_once "../_______necessarios/.conexao_bd.php";

    $id_questionario = $_POST['id_questionario'];
    $desenvolvimento_questao = $_POST['desenvolvimento_questao'];

    if(isset($_POST['distribuicao_alternativas'])){

        $distribuicao_alternativas = "aleatoria";

    } else {

        $distribuicao_alternativas = "padronizada";

    }


    //inserindo os dados do material-
    $sql = "INSERT INTO questoes(id_questionario, desenvolvimento_questao, distribuicao_alternativas) 
    VALUES ('$id_questionario', '$desenvolvimento_questao', '$distribuicao_alternativas')";

    $resultado = mysqli_query($conexao,$sql);
    // -


    if($resultado)
    {

	    header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

    mysqli_close($conexao);

?>
