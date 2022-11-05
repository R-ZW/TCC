<?php
session_start();
    include "../_______necessarios/.conexao_bd.php";

    $id_questionario = mysqli_real_escape_string($conexao,$_GET['id_questionario']);

    //obtendo o id_aula-
    $sq = "SELECT id_aula FROM questionarios WHERE id_questionario=$id_questionario";
    $res = mysqli_query($conexao, $sq);

    $li = mysqli_fetch_assoc($res);

    $id_aula = $li['id_aula'];
    //-


    //obtendo todas as questões do questionário-
    $sql = "SELECT id_questao FROM questoes WHERE id_questionario=$id_questionario";
    $resultado = mysqli_query($conexao,$sql);

    while($linha = mysqli_fetch_assoc($resultado))
    {

        $id_questao[]= $linha['id_questao']; 

    }
    //-


    if(isset($linha) or isset($id_questao)){

        for($a=0 ; $a<count($id_questao) ; $a++){

            //deletando as alternativas-
            $sqla[$a] = "DELETE FROM alternativas WHERE id_questao=".$id_questao[$a];
            $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);
            //-

        }

    }

    //deletando as questões-
    $sql_1 = "DELETE FROM questoes WHERE id_questionario=$id_questionario";
    $resultado_1 = mysqli_query($conexao, $sql_1);
    //-


    //deletando o questionário-
    $sql_2 = "DELETE FROM questionarios WHERE id_questionario=$id_questionario";
    $resultado_2 = mysqli_query($conexao, $sql_2);
    //-


    //deletando a relação dos usuários com o questionário-
    $sql_3 = "DELETE FROM relacao_usuario_questionario WHERE id_questionario=$id_questionario";
    $resultado_3 = mysqli_query($conexao, $sql_3);
    //-

    if($resultado and $resultado_1 and $resultado_2 and $resultado_3){

        $_SESSION['mensagem'] = "Questionário excluído com sucesso!";
        header("Location: ../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula");

    }

?>
