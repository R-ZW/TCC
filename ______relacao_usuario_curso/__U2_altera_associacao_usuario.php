<?php
    echo '<meta charset="UTF-8">';

    include ".conexao_bd.php";

    $email_antigo = $_POST['email_antigo'];
    $email_novo = $_POST['email_novo'];
    $id_curso = $_POST['id_curso'];

    if($email_antigo == $email_novo){

        header("Location: 1____modificacao_curso.php?id_curso=$id_curso");

    } else {

        $sql = "SELECT  FROM relacao_usuario_curso WHERE email='$email_novo' AND tipo_relacao='consumidor'";
        $resultado = mysqli_query($conexao,$sql);

        $linha = mysqli_fetch_array($resultado);


        if(isset($linha)){

            header("Location: 1____modificacao_curso.php?id_curso=$id_curso");

        } else {

            $sql_1 = "UPDATE relacao_usuario_curso SET email='$email_novo' WHERE email='$email_antigo' AND tipo_relacao='consumidor'"; 
            $resultado_1 = mysqli_query($conexao,$sql_1);

            header("Location: 1____modificacao_curso.php?id_curso=$id_curso");

        }

    }
    ?>