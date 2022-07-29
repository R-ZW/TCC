<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $email = $_SESSION['email'];
    $id_aula = $_GET['id_aula'];

    $sql = "SELECT * FROM favoritos_aula WHERE email='$email' AND id_aula=$id_aula";
    $resultado = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_assoc($resultado);
    $situacao_favorito_aula = $linha['situacao_favorito_aula'];


    if(is_null($situacao_favorito_aula)){

        $sql_1 = "INSERT INTO favoritos_aula (email, id_aula, situacao_favorito_aula) 
                                       VALUES ('$email','$id_aula','favorito')";
        $resultado_1 = mysqli_query($conexao, $sql_1);

        header("Location: ../index/consumidor/CONS__tela_aula_consumidor.php?id_aula=$id_aula");

        die;

    }

    if($situacao_favorito_aula == "favorito"){

        $sql_1 = "UPDATE favoritos_aula SET situacao_favorito_aula='não-favorito' WHERE email='$email' AND id_aula=$id_aula";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    } elseif ($situacao_favorito_aula == "não-favorito"){

        $sql_1 = "UPDATE favoritos_aula SET situacao_favorito_aula='favorito' WHERE email='$email' AND id_aula=$id_aula";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    }

    header("Location: ../index/consumidor/CONS__tela_aula_consumidor.php?id_aula=$id_aula");

?>