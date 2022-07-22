<?php
    
    include "../_______necessarios/.conexao_bd.php";

    $email = $_GET['email'];
    $id_curso = $_GET['id_curso'];

    //excluindo a relação do usuário com o curso-
    $sql = "DELETE FROM relacao_usuario_curso WHERE email='$email' AND tipo_relacao='consumidor' AND id_curso=$id_curso";
    $resultado = mysqli_query($conexao,$sql);
    //-


    //excluindo a relação do usuário com os questionários-
    $sql_1 = "DELETE FROM relacao_usuario_questionario WHERE email='$email' AND id_curso=$id_curso";
    $resultado_1 = mysqli_query($conexao,$sql_1);
    //-

    mysqli_close($conexao);

    if($resultado){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    }

?>