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

    //obtendo a questão da alternativa-
    $sql = "SELECT id_questao FROM alternativas WHERE id_alternativa=$id_alternativa";
    $resultado = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_assoc($resultado);
    $id_questao = $linha['id_questao'];
    //-


    //obtendo as alternativas da questão-
    $sql_1 = "SELECT * FROM alternativas WHERE id_questao=$id_questao";
    $resultado_1 = mysqli_query($conexao, $sql_1);

    while ($linha_1 = mysqli_fetch_assoc($resultado_1))
    {

        $validade_alternativa1[] = $linha_1['validade_alternativa'];

    }
    //-


    //verificando se há outra alternativa correta cadastrada no sistema-
    if(isset($validade_alternativa1) or isset($linha_1)){

        for($a=0 ; $a<count($validade_alternativa1) ; $a++){

            if($validade_alternativa1[$a] == $validade_alternativa and $validade_alternativa=="correta"){

                header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

                die;

            }

        }

    }
    //-


    //alterando a alternativa no sistema-
    $sql_2 = "UPDATE alternativas SET desenvolvimento_alternativa='$desenvolvimento_alternativa', validade_alternativa='$validade_alternativa' WHERE id_alternativa=$id_alternativa"; 
    $resultado_2 = mysqli_query($conexao,$sql_2);
    //-


    if($resultado)
    {

        header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

    mysqli_close($conexao);

?>