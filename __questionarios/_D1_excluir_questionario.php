<?php
    
    include "../_______necessarios/.conexao_bd.php";

    $id_questionario = $_GET['id_questionario'];


    //obtendo o id_aula
    $sq = "SELECT id_aula FROM questionarios WHERE id_questionario=$id_questionario";
    $res = mysqli_query($conexao, $sq);

    $li = mysqli_fetch_assoc($res);

    $id_aula = $li['id_aula'];
    //obtido o id_aula


    //obtendo todas as questões do questionário
    $sql = "SELECT id_questao FROM questoes WHERE id_questionario=$id_questionario";
    $resultado = mysqli_query($conexao,$sql);

    while($linha = mysqli_fetch_assoc($resultado))
    {

        $id_questao[]= $linha['id_questao']; 

    }
    //


    if(isset($linha) or isset($id_questao)){

        for($a=0 ; $a<count($id_questao) ; $a++){

            //deletando as alternativas
            $sqla[$a] = "DELETE FROM alternativas WHERE id_questao=".$id_questao[$a];
            $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);
            //deletadas as alternativas

        }

    }

    //deletando as questões
    $sql_1 = "DELETE FROM questoes WHERE id_questionario=$id_questionario";
    $resultado_1 = mysqli_query($conexao, $sql_1);
    //deletadas as questões


    //deletando o questionário
    $sql_2 = "DELETE FROM questionarios WHERE id_questionario=$id_questionario";
    $resultado_2 = mysqli_query($conexao, $sql_2);
    //deletado o questionário

    mysqli_close($conexao);

    if($resultado and $resultado_1){

        header("Location: ../index/produtor/PROD__tela_aula_produtor.php?id_aula=$id_aula");

    }

?>
