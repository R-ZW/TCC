<?php
    
    include "../_______necessarios/.conexao_bd.php";

    $id_modulo = $_GET['id_modulo'];

    //obtendo o id_curso
    $sql = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $resultado = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($resultado);

    $id_curso = $linha['id_curso'];
    //obtido o id_curso


    //obtendo o id_aula
    $sql_1 = "SELECT id_aula FROM aulas WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao,$sql_1);

    while($linha_1 = mysqli_fetch_assoc($resultado_1))
    {

        $id_aula[]= $linha_1['id_aula']; 

    }
    //obtido o id_aula
    

    //obtendo os questionarios
    if(isset($id_aula) or isset($linha_1)){

        for($a=0 ; $a<count($id_aula) ; $a++){
            
            $sqla[$a] = "SELECT id_questionario FROM questionarios WHERE id_aula=".$id_aula[$a];
            $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);

            while ($linhaa = mysqli_fetch_assoc($resultadoa[$a]))
            {

                $id_questionario[] = $linhaa['id_questionario'];

            }

        }

    }
    //obtidos os questionarios


    //obtendo as questões
    if(isset($id_questionario) or isset($linhaa)){

        for($b=0 ; $b<count($id_questionario) ; $b++){

            $sqlb[$b] = "SELECT id_questao FROM questoes WHERE id_questionario=".$id_questionario[$b];
            $resultadob[$b] = mysqli_query($conexao, $sqlb[$b]);

            while ($linhab = mysqli_fetch_assoc($resultadob[$b]))
            {
                $id_questao[] = $linhab['id_questao'];
            }

        }

    }
    //obtidas as questões


    //deletando as alternativas
    if(isset($id_questao) or isset($linhab)){

        for($c=0 ; $c<count($id_questao) ; $c++){

            $sqlc[$c] = "DELETE FROM alternativas WHERE id_questao=".$id_questao[$c];
            $resultadoc[$c] = mysqli_query($conexao, $sqlc[$c]);

        }

    }
    //deletadas as alternativas


    if(isset($id_questionario) or isset($linhaa)){

        //deletando as questões-
        for($d=0 ; $d<count($id_questionario) ; $d++){

            $sqld[$d] = "DELETE FROM questoes WHERE id_questionario=".$id_questionario[$d];
            $resultadod[$d] = mysqli_query($conexao, $sqld[$d]);

        }
        //-


        //deletando as relações de usuários com os questionários-
        for($e=0 ; $e<count($id_questionario) ; $e++){

            $sqle[$e] = "DELETE FROM relacao_usuario_questionario WHERE id_questionario=".$id_questionario[$e];
            $resultadoe[$e] = mysqli_query($conexao, $sqle[$e]);

        }
        //-

    }


    //deletando os questionários
    if(isset($id_aula) or isset($linha_1)){

        for($f=0 ; $f<count($id_aula) ; $f++){

            $sqlf[$f] = "DELETE FROM questionarios WHERE id_aula=".$id_aula[$f];
            $resultadof[$f] = mysqli_query($conexao,$sqlf[$f]);

        }

    }
    //deletados os questionários


    //deletando os materiais da aula
    if(isset($id_aula) or isset($linha_1)){

        for($g=0 ; $g<count($id_aula) ; $g++){

            $sqlg[$g] = "DELETE FROM materiais WHERE id_aula=".$id_aula[$g];
            $resultadog[$g] = mysqli_query($conexao,$sqlg[$g]);

        }

    }
    //delatados os materiais


    //deletando a aula
    $sql_2 = "DELETE FROM aulas WHERE id_modulo=$id_modulo";
    $resultado_2 = mysqli_query($conexao,$sql_2);
    //delatada a aula

    
    //deletando o módulo
    $sql_3 = "DELETE FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_3 = mysqli_query($conexao,$sql_3);
    //delatada o módulo


    mysqli_close($conexao);

    if($resultado and $resultado_1 and $resultado_3){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    }

?>