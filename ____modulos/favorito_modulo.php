<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $email = $_SESSION['email'];
    $id_modulo = mysqli_real_escape_string($conexao,$_GET['id_modulo']);

    $sql = "SELECT * FROM favoritos_modulo WHERE email='$email' AND id_modulo=$id_modulo";
    $resultado = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_assoc($resultado);
    $situacao_favorito_modulo = $linha['situacao_favorito_modulo'];


    if(is_null($situacao_favorito_modulo)){

        $sql_1 = "INSERT INTO favoritos_modulo (email, id_modulo, situacao_favorito_modulo) 
                                       VALUES ('$email','$id_modulo','favorito')";
        $resultado_1 = mysqli_query($conexao, $sql_1);

        echo "<script>window.history.go(-1);</script>";

        die;

    }

    if($situacao_favorito_modulo == "favorito"){

        $sql_1 = "UPDATE favoritos_modulo SET situacao_favorito_modulo='não-favorito' WHERE email='$email' AND id_modulo=$id_modulo";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    } elseif($situacao_favorito_modulo == "não-favorito"){

        $sql_1 = "UPDATE favoritos_modulo SET situacao_favorito_modulo='favorito' WHERE email='$email' AND id_modulo=$id_modulo";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    }

    echo "<script>window.history.go(-1);</script>";

?>