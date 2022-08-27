<?php

    include "../_______necessarios/.conexao_bd.php";

    $id_curso = $_GET['id_curso'];

    //obtendo as relações do banco-
    $sq = "SELECT email FROM relacao_usuario_curso WHERE tipo_relacao='consumidor' AND id_curso=$id_curso";
    $result = mysqli_query($conexao, $sq);
    $li = mysqli_fetch_assoc($result);
    //-

    
    //obtendo o email do produtor-
    $sql = "SELECT email FROM relacao_usuario_curso WHERE id_curso=$id_curso AND tipo_relacao='produtor'";
    $resultado = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($resultado);

    $email = $linha['email'];
    //-

    if(isset($li)){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");
        
        die;

    } else {
        
        //obtendo os id_modulo-
        $sql_1 = "SELECT * FROM modulos WHERE id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao,$sql_1);

        $ind1=0;
        while($linha_1 = mysqli_fetch_assoc($resultado_1))
        {

            $id_modulo[]= $linha_1['id_modulo']; 

            $endereco_imagemm[$ind1]= $linha_1['endereco_imagem_modulo'];
            $endereco_imagem_m[$ind1]= explode("/", $endereco_imagemm[$ind1]);
            $endereco_imagem_mo[$ind1]= array_reverse($endereco_imagem_m[$ind1]);
            $endereco_imagem_modulo[$ind1]= $endereco_imagem_mo[$ind1][0];
            unlink("../____modulos/imgs_modulo/".$endereco_imagem_modulo[$ind1]);

        }
        //-


        //obtendo os id_aula-
        if(isset($id_modulo) or isset($linha_1)){

            for($a=0 ; $a<count($id_modulo) ; $a++){

                $sqla[$a]= "SELECT * FROM aulas WHERE id_modulo=".$id_modulo[$a];
                $resultadoa[$a] = mysqli_query($conexao,$sqla[$a]);

                $ind=0;
                while($linhaa = mysqli_fetch_assoc($resultadoa[$a]))
                {

                    $id_aula[] = $linhaa['id_aula'];

                    $endereco_imagema[$ind]= $linhaa['endereco_imagem_aula'];
                    $endereco_imagem_a[$ind]= explode("/", $endereco_imagema[$ind]);
                    $endereco_imagem_au[$ind]= array_reverse($endereco_imagem_a[$ind]);
                    $endereco_imagem_aula[$ind]= $endereco_imagem_au[$ind][0];
                    unlink("../___aulas/imgs_aula/".$endereco_imagem_aula[$ind]);

                    $ind++;

                }

            }

        }
        //-


        //obtendo os questionarios-
        if(isset($id_aula) or isset($linhaa)){

            for($b=0 ; $b<count($id_aula) ; $b++){
                
                $sqlb[$b] = "SELECT id_questionario FROM questionarios WHERE id_aula=".$id_aula[$b];
                $resultadob[$b] = mysqli_query($conexao, $sqlb[$b]);

                while ($linhab = mysqli_fetch_assoc($resultadob[$b]))
                {

                    $id_questionario[] = $linhab['id_questionario'];

                }

            }

        }
        //-


        //obtendo as questões-
        if(isset($id_questionario) or isset($linhab)){

            for($c=0 ; $c<count($id_questionario) ; $c++){

                $sqlc[$c] = "SELECT id_questao FROM questoes WHERE id_questionario=".$id_questionario[$c];
                $resultadoc[$c] = mysqli_query($conexao, $sqlc[$c]);

                while ($linhac = mysqli_fetch_assoc($resultadoc[$c]))
                {
                    $id_questao[] = $linhac['id_questao'];
                }

            }

        }
        //-


        //deletando as alternativas-
        if(isset($id_questao) or isset($linhac)){

            for($d=0 ; $d<count($id_questao) ; $d++){

                $sqld[$d] = "DELETE FROM alternativas WHERE id_questao=".$id_questao[$d];
                $resultadod[$d] = mysqli_query($conexao, $sqld[$d]);

            }

        }
        //-


        //deletando as questões-
        if(isset($id_questionario) or isset($linhab)){

            for($e=0 ; $e<count($id_questionario) ; $e++){

                $sqle[$e] = "DELETE FROM questoes WHERE id_questionario=".$id_questionario[$e];
                $resultadoe[$e] = mysqli_query($conexao, $sqle[$e]);

            }

        }
        //-


        //deletando os questionários-
        if(isset($id_aula) or isset($linhaa)){

            for($f=0 ; $f<count($id_aula) ; $f++){

                $sqlf[$f] = "DELETE FROM questionarios WHERE id_aula=".$id_aula[$f];
                $resultadof[$f] = mysqli_query($conexao,$sqlf[$f]);

            }

        }
        //-


        //deletando os materiais-
        if(isset($id_aula) or isset($linhaa)){

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


        //deletando as aulas-
        if(isset($id_modulo) or isset($linha_1)){

            for($k=0 ; $k<count($id_modulo) ; $k++){

                $sqlk[$k] = "DELETE FROM aulas WHERE id_modulo=".$id_modulo[$k];
                $resultadok[$k] = mysqli_query($conexao,$sqlk[$k]);

            }

        }
        //-


        //deletando os módulos
        $sql_2 = "DELETE FROM modulos WHERE id_curso=$id_curso";
        $resultado_2 = mysqli_query($conexao,$sql_2);
        //-


        //deletando a relação do produtor-
        $sql_3 = "DELETE FROM relacao_usuario_curso WHERE id_curso=$id_curso AND tipo_relacao='produtor'";
        $resultado_3 = mysqli_query($conexao,$sql_3);
        //-


        //deletando o curso-
        $sql_4 = "SELECT * FROM cursos WHERE id_curso=$id_curso";
        $resultado_4 = mysqli_query($conexao,$sql_4);
        $linha_4 = mysqli_fetch_assoc($resultado_4);

        $endereco_imagemc= $linha_4['endereco_imagem_curso'];
        $endereco_imagem_c= explode("/", $endereco_imagemc);
        $endereco_imagem_cur= array_reverse($endereco_imagem_c);
        $endereco_imagem_curso= $endereco_imagem_cur[1] ."/". $endereco_imagem_cur[0];
        unlink($endereco_imagem_curso);

        if($linha_4['endereco_certificado_curso'] != "sem-certificado"){

            $endereco_certificadoc= $linha_4['endereco_certificado_curso'];
            $endereco_certificado_c= explode("/", $endereco_certificadoc);
            $endereco_certificado_cur= array_reverse($endereco_certificado_c);
            $endereco_certificado_curso= $endereco_certificado_cur[1] ."/". $endereco_certificado_cur[0];
            unlink($endereco_certificado_curso);

        }

        $sql_5 = "DELETE FROM cursos WHERE id_curso=$id_curso";
        $resultado_5 = mysqli_query($conexao,$sql_5);
        //-


        mysqli_close($conexao);

        if($resultado and $resultado_1 and $resultado_2 and $resultado_3){

            header("Location: ../index/produtor/PROD____home_produtor.php");

        }
    }

?>

</body>
</html>
