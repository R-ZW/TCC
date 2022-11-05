<?php
session_start();
   
    include "../_______necessarios/.conexao_bd.php";

    $id_modulo = mysqli_real_escape_string($conexao,$_GET['id_modulo']);


    //obtendo o id_curso-
    $sql = "SELECT * FROM modulos WHERE id_modulo=$id_modulo";
    $resultado = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($resultado);

    $id_curso = $linha['id_curso'];
    $endereco_imagemm= $linha['endereco_imagem_modulo'];
    $endereco_imagem_m= explode("/", $endereco_imagemm);
    $endereco_imagem_mo= array_reverse($endereco_imagem_m);
    $endereco_imagem_modulo= $endereco_imagem_mo[1] ."/". $endereco_imagem_mo[0];
    if($endereco_imagem_modulo != "../___aulas/imgs_aula/sem_imagem.png"){
        unlink($endereco_imagem_modulo);
    }
    //-


    //obtendo o id_aula-
    $sql_1 = "SELECT * FROM aulas WHERE id_modulo=$id_modulo";
    $resultado_1 = mysqli_query($conexao,$sql_1);

    $ind=0;
    while($linha_1 = mysqli_fetch_assoc($resultado_1))
    {

        $id_aula[]= $linha_1['id_aula']; 

        $endereco_imagema[$ind]= $linha_1['endereco_imagem_aula'];
        $endereco_imagem_a[$ind]= explode("/", $endereco_imagema[$ind]);
        $endereco_imagem_au[$ind]= array_reverse($endereco_imagem_a[$ind]);
        $endereco_imagem_aula[$ind]= "../___aulas/imgs_aula/".$endereco_imagem_au[$ind][0];
        unlink($endereco_imagem_aula[$ind]);

    }
    //-
    

    //obtendo os questionarios-
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
    //-


    //obtendo as questões-
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
    //-


    //deletando as alternativas-
    if(isset($id_questao) or isset($linhab)){

        for($c=0 ; $c<count($id_questao) ; $c++){

            $sqlc[$c] = "DELETE FROM alternativas WHERE id_questao=".$id_questao[$c];
            $resultadoc[$c] = mysqli_query($conexao, $sqlc[$c]);

        }

    }
    //-


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


    //deletando os questionários-
    if(isset($id_aula) or isset($linha_1)){

        for($f=0 ; $f<count($id_aula) ; $f++){

            $sqlf[$f] = "DELETE FROM questionarios WHERE id_aula=".$id_aula[$f];
            $resultadof[$f] = mysqli_query($conexao,$sqlf[$f]);

        }

    }
    //-


    //deletando os materiais da aula-
    if(isset($id_aula) or isset($linha_1)){

        for($g=0 ; $g<count($id_aula) ; $g++){

            $sqlg_1[$g] = "SELECT * FROM materiais WHERE id_aula=".$id_aula[$g];
            $resultadog_1[$g] = mysqli_query($conexao,$sqlg_1[$g]);
            $i=0;
            while($linhag = mysqli_fetch_assoc($resultadog_1[$g])){

                $enderecom[$i]= $linhag['endereco_material'];
                $endereco_m[$i]= explode("/", $enderecom[$i]);
                $endereco_ma[$i]= array_reverse($endereco_m[$i]);
                $endereco_material[$i]= $endereco_ma[$i][0];
                unlink("../__materiais/materiais/".$endereco_material[$i]);

                $i++;

            }

            $sqlg_2[$g] = "DELETE FROM materiais WHERE id_aula=".$id_aula[$g];
            $resultadog_2[$g] = mysqli_query($conexao,$sqlg_2[$g]);

        }

    }
    //-


    //deletando a aula-
    $sql_2 = "DELETE FROM aulas WHERE id_modulo=$id_modulo";
    $resultado_2 = mysqli_query($conexao,$sql_2);
    //-

    
    //deletando o módulo-
    $sql_3 = "DELETE FROM modulos WHERE id_modulo=$id_modulo";
    $resultado_3 = mysqli_query($conexao,$sql_3);
    //-


    //excluindo os favoritos do módulo-
    $sql_4 = "DELETE FROM favoritos_modulo WHERE id_modulo=$id_modulo";
    $resultado_4 = mysqli_query($conexao,$sql_4);
    //-


    for($h=0 ; $h<count($id_aula) ; $h++){

        //excluindo o favorito do usuário com as aulas do módulo-
        $sqlh[$h] = "DELETE FROM favoritos_aula WHERE id_aula=".$id_aula[$h];
        $resultadoh[$h] = mysqli_query($conexao, $sqlh[$h]);
        //-

    }

    if($resultado and $resultado_1 and $resultado_3){

        $_SESSION['mensagem'] = "Módulo excluído com sucesso!";
        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    }

?>