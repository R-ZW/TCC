<?php
    
    include "../_______necessarios/.conexao_bd.php";

    $id_aula = $_GET['id_aula'];

    //obtendo o id_modulo para obter o id_curso
    $sql = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
    $resultado = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($resultado);

    $id_modulo = $linha['id_modulo'];
    //obtido o id_modulo


    //obtendo o id_curso
    $sql_1 = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao,$sql_1);
    $linha_1 = mysqli_fetch_assoc($resultado_1);

    $id_curso = $linha_1['id_curso'];
    //obtido o id_curso


    //obtendo os questionarios associados a aula
    $sql_2 = "SELECT id_questionario FROM questionarios WHERE id_aula=$id_aula";
    $resultado_2 = mysqli_query($conexao, $sql_2);
    
    while($linha_2 = mysqli_fetch_assoc($resultado_2))
    {

        $id_questionario[] = $linha_2['id_questionario'];

    }
    //obtidos os questionarios associados a aula

    
    if(isset($id_questionario) or isset($linha_2)){

        //obtendo as questões associadas aos questionarios
        for($a=0 ; $a<count($id_questionario) ; $a++){

            $sqla[$a] = "SELECT id_questao FROM questoes WHERE id_questionario=" . $id_questionario[$a];
            $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);

            while($linhaa = mysqli_fetch_assoc($resultadoa[$a]))
            {

                $id_questao[] = $linhaa['id_questao'];

            }

        }
        //obtido as questões associadas aos questionarios

    }


    if(isset($id_questao) or isset($linhaa)){

        //deletando as alternativas
        for($b=0 ; $b<count($id_questao) ; $b++){

            $sqlb[$b] = "DELETE FROM alternativas WHERE id_questao=".$id_questao[$b];
            $resultadob[$b] = mysqli_query($conexao, $sqlb[$b]);

        }
        //deletadas as alternativas
    }


    if(isset($id_questionario) or isset($linha_2)){

        //deletando as questões
        for($c=0 ; $c<count($id_questionario) ; $c++){

            $sqlc[$c] = "DELETE FROM questoes WHERE id_questionario=".$id_questionario[$c];
            $resultadoc[$c] = mysqli_query($conexao, $sqlc[$c]);

        }
        //deletadas as questões

    }


    //deletando os questionários
    $sql_3 = "DELETE FROM questionarios WHERE id_aula=$id_aula";
    $resultado_3 = mysqli_query($conexao, $sql_3);
    //deletados os questionários


    //deletando os materiais da aula
    $sql_4 = "DELETE FROM materiais WHERE id_aula=$id_aula";
    $resultado_4 = mysqli_query($conexao,$sql_4);
    //delatados os materiais


    //deletando a aula
    $sql_5 = "DELETE FROM aulas WHERE id_aula=$id_aula";
    $resultado_5 = mysqli_query($conexao,$sql_5);
    //delatada a aula

    mysqli_close($conexao);

    if($resultado and $resultado_1 and $resultado_2 and $resultado_3 and $resultado_4 and $resultado_5){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    }

?>


</body>

</html>
