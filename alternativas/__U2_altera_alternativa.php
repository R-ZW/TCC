<?php

    include_once "../_______necessarios/.conexao_bd.php";

    $id_alternativa = $_POST['id_alternativa'];
    $id_questionario = $_POST['id_questionario'];
    $desenvolvimento_alternativa = $_POST['desenvolvimento_alternativa'];

    if(isset($_POST['validade_alternativa'])){

        $validade_alternativa = "correta";

    } else {

        $validade_alternativa = "incorreta";

    }


    $sql = "UPDATE alternativas SET desenvolvimento_alternativa='$desenvolvimento_alternativa', validade_alternativa='$validade_alternativa' WHERE id_alternativa=$id_alternativa"; 
    $resultado = mysqli_query($conexao,$sql);



    if($resultado)
    {

        header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

    mysqli_close($conexao);

?>