<?php

    include_once "../_______necessarios/.conexao_bd.php";

    $email= $_POST['email'];

    $id_curso = $_POST['id_curso'];

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");

    //obtendo id_relacao_usuario_curso_usuario_curso
    $sq = "SELECT id_relacao_usuario_curso FROM relacao_usuario_curso WHERE email='$email' AND id_curso=$id_curso AND tipo_relacao='consumidor'";
    $result = mysqli_query($conexao, $sq);
    $linha = mysqli_fetch_assoc($result);
    //obtido id_relacao_usuario_curso

    if(isset($linha)){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    } else {

        //inserindo os dados da relação-
        $sql = "INSERT INTO relacao_usuario_curso(email, id_curso, tipo_relacao, data_relacao) 
        VALUES ('$email', '$id_curso', 'consumidor', '$data')";

        $resultado = mysqli_query($conexao,$sql);
        // -

    }

    mysqli_close($conexao);

    if($resultado)
    {
	    header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");
    }

?>
