<?php
session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $id_questao = mysqli_real_escape_string($conexao,$_POST['id_questao']);
    $id_questionario = mysqli_real_escape_string($conexao,$_POST['id_questionario']);
    $desenvolvimento_alternativa = mysqli_real_escape_string($conexao,$_POST['desenvolvimento_alternativa']);

    if(isset($_POST['validade_alternativa'])){

        $validade_alternativa = "correta";

    } else {

        $validade_alternativa = "incorreta";

    }
    

    //obtendo as alternativas da questão-
    $sql = "SELECT * FROM alternativas WHERE id_questao=$id_questao";
    $resultado = mysqli_query($conexao, $sql);

    while ($linha = mysqli_fetch_assoc($resultado))
    {

        $validade_alternativa1[] = $linha['validade_alternativa'];

    }
    //-


    //verificando se há outra alternativa correta cadastrada no sistema
    if(isset($validade_alternativa1) or isset($linha)){

        for($a=0 ; $a<count($validade_alternativa1) ; $a++){

            if($validade_alternativa1[$a] == $validade_alternativa and $validade_alternativa=="correta"){

                $_SESSION['mensagem'] = "Só pode haver uma alternativa correta por questão!";

                header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

                die;

            }

        }

    }
    //-


    //inserindo os dados da alternativa-
    $sql_1 = "INSERT INTO alternativas(id_questao, desenvolvimento_alternativa, validade_alternativa) 
    VALUES ('$id_questao', '$desenvolvimento_alternativa', '$validade_alternativa')";

    $resultado_1 = mysqli_query($conexao,$sql_1);
    //-

    if($resultado and $resultado_1)
    {

        $_SESSION['mensagem'] = "Alternativa cadastrada com sucesso!";
	    header("Location: ../index/produtor/PROD_tela_questionario_produtor.php?id_questionario=$id_questionario");

    }

?>
