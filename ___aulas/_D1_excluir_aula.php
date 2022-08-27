<?php
    
    include "../_______necessarios/.conexao_bd.php";

    $id_aula = $_GET['id_aula'];

    //obtendo o id_modulo para obter o id_curso-
    $sql = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
    $resultado = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($resultado);

    $id_modulo = $linha['id_modulo'];
    //-


    //obtendo o id_curso-
    $sql_1 = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao,$sql_1);
    $linha_1 = mysqli_fetch_assoc($resultado_1);

    $id_curso = $linha_1['id_curso'];
    //-


    //obtendo os questionarios associados a aula-
    $sql_2 = "SELECT id_questionario FROM questionarios WHERE id_aula=$id_aula";
    $resultado_2 = mysqli_query($conexao, $sql_2);
    
    while($linha_2 = mysqli_fetch_assoc($resultado_2))
    {

        $id_questionario[] = $linha_2['id_questionario'];

    }
    //-

    
    if(isset($id_questionario) or isset($linha_2)){

        //obtendo as questões associadas aos questionarios-
        for($a=0 ; $a<count($id_questionario) ; $a++){

            $sqla[$a] = "SELECT id_questao FROM questoes WHERE id_questionario=" . $id_questionario[$a];
            $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);

            while($linhaa = mysqli_fetch_assoc($resultadoa[$a]))
            {

                $id_questao[] = $linhaa['id_questao'];

            }

        }
        //-

    }


    if(isset($id_questao) or isset($linhaa)){

        //deletando as alternativas-
        for($b=0 ; $b<count($id_questao) ; $b++){

            $sqlb[$b] = "DELETE FROM alternativas WHERE id_questao=".$id_questao[$b];
            $resultadob[$b] = mysqli_query($conexao, $sqlb[$b]);

        }
        //-
    }


    if(isset($id_questionario) or isset($linha_2)){

        //deletando as questões-
        for($c=0 ; $c<count($id_questionario) ; $c++){

            $sqlc[$c] = "DELETE FROM questoes WHERE id_questionario=".$id_questionario[$c];
            $resultadoc[$c] = mysqli_query($conexao, $sqlc[$c]);

        }
        //-


        //deletando as relações de usuários com os questionários-
        for($d=0 ; $d<count($id_questionario) ; $d++){

            $sqld[$d] = "DELETE FROM relacao_usuario_questionario WHERE id_questionario=".$id_questionario[$d];
            $resultadod[$d] = mysqli_query($conexao, $sqld[$d]);

        }
        //-

    }


    //deletando os questionários-
    $sql_3 = "DELETE FROM questionarios WHERE id_aula=$id_aula";
    $resultado_3 = mysqli_query($conexao, $sql_3);
    //-


    //deletando os materiais da aula-
    $sql_4 = "SELECT * FROM materiais WHERE id_aula=$id_aula";
    $resultado_4 = mysqli_query($conexao,$sql_4);
    $e=0;
    while ($linha_4 = mysqli_fetch_assoc($resultado_4)){

        $enderecom[$e]= $linha_4['endereco_material'];
        $endereco_m[$e]= explode("/", $enderecom[$e]);
        $endereco_ma[$e]= array_reverse($endereco_m[$e]);
        $endereco_material[$e]= $endereco_ma[$e][0];
        unlink("../__materiais/materiais/".$endereco_material[$e]);

        $e++;

    }

    $sql_5 = "DELETE FROM materiais WHERE id_aula=$id_aula";
    $resultado_5 = mysqli_query($conexao,$sql_5);
    //-


    //deletando a aula-
    $sql_6 = "SELECT * FROM aulas WHERE id_aula=$id_aula";
    $resultado_6 = mysqli_query($conexao,$sql_6);
    $linha_6 = mysqli_fetch_assoc($resultado_6);

    if(isset($linha_6)){

        $endereco_imagema= $linha_6['endereco_imagem_aula'];
        $endereco_imagem_a= explode("/", $endereco_imagema);
        $endereco_imagem_au= array_reverse($endereco_imagem_a);
        $endereco_imagem_aula= $endereco_imagem_au[1] ."/". $endereco_imagem_au[0];
        unlink($endereco_imagem_aula);

    }

    $sql_7 = "DELETE FROM aulas WHERE id_aula=$id_aula";
    $resultado_7 = mysqli_query($conexao,$sql_7);
    //-


    //excluindo o favorito dessa aula-
    $sql_8 = "DELETE FROM favoritos_aula WHERE id_aula=$id_aula";
    $resultado_8 = mysqli_query($conexao, $sql_8);
    //-

    mysqli_close($conexao);

    if($resultado and $resultado_1 and $resultado_2 and $resultado_3 and $resultado_4 and $resultado_5 and $resultado_6 and $resultado_7){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    }

?>