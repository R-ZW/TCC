<?php

    include "../_______necessarios/.conexao_bd.php";

    $id_curso = $_GET['id_curso'];

    //obtendo as relações do banco
    $sq = "SELECT email FROM relacao_usuario_curso WHERE tipo_relacao='consumidor' AND id_curso=$id_curso";
    $result = mysqli_query($conexao, $sq);
    $li = mysqli_fetch_assoc($result);
    //obtidas as relações do banco

    
    //obtendo o email do produtor
    $sql = "SELECT email FROM relacao_usuario_curso WHERE id_curso=$id_curso AND tipo_relacao='produtor'";
    $resultado = mysqli_query($conexao,$sql);
    $linha = mysqli_fetch_assoc($resultado);

    $email = $linha['email'];
    //obtido o email do produtor

    if(isset($li)){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    } else {
        
        //obtendo os id_modulo
        $sql_1 = "SELECT id_modulo FROM modulos WHERE id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao,$sql_1);

        while($linha_1 = mysqli_fetch_assoc($resultado_1))
        {

            $id_modulo[]= $linha_1['id_modulo']; 

        }
        //obtido os id_modulo


        //obtendo os id_aula
        if(isset($id_modulo) or isset($linha_1)){

            for($a=0 ; $a<count($id_modulo) ; $a++){

                $sqla[$a]= "SELECT id_aula FROM aulas WHERE id_modulo=".$id_modulo[$a];
                $resultadoa[$a] = mysqli_query($conexao,$sqla[$a]);

                while($linhaa = mysqli_fetch_assoc($resultadoa[$a]))
                {

                    $id_aula[] = $linhaa['id_aula'];

                }

            }

        }
        //obtidos os id_aula


        //obtendo os questionarios
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
        //obtidos os questionarios


        //obtendo as questões
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
        //obtidas as questões


        //deletando as alternativas
        if(isset($id_questao) or isset($linhac)){

            for($d=0 ; $d<count($id_questao) ; $d++){

                $sqld[$d] = "DELETE FROM alternativas WHERE id_questao=".$id_questao[$d];
                $resultadod[$d] = mysqli_query($conexao, $sqld[$d]);

            }

        }
        //deletadas as alternativas


        //deletando as questões
        if(isset($id_questionario) or isset($linhab)){

            for($e=0 ; $e<count($id_questionario) ; $e++){

                $sqle[$e] = "DELETE FROM questoes WHERE id_questionario=".$id_questionario[$e];
                $resultadoe[$e] = mysqli_query($conexao, $sqle[$e]);

            }

        }
        //deletadas as questões


        //deletando os questionários
        if(isset($id_aula) or isset($linhaa)){

            for($f=0 ; $f<count($id_aula) ; $f++){

                $sqlf[$f] = "DELETE FROM questionarios WHERE id_aula=".$id_aula[$f];
                $resultadof[$f] = mysqli_query($conexao,$sqlf[$f]);

            }

        }
        //deletados os questionários


        //deletando os materiais
        if(isset($id_aula) or isset($linhaa)){

            for($g=0 ; $g<count($id_aula) ; $g++){

                $sqlg[$g] = "DELETE FROM materiais WHERE id_aula=".$id_aula[$g];
                $resultadog[$g] = mysqli_query($conexao,$sqlg[$g]);

            }

        }
        //deletados os materiais


        //deletando as aulas
        if(isset($id_modulo) or isset($linha_1)){

            for($k=0 ; $k<count($id_modulo) ; $k++){

                $sqlk[$k] = "DELETE FROM aulas WHERE id_modulo=".$id_modulo[$k];
                $resultadok[$k] = mysqli_query($conexao,$sqlk[$k]);

            }

        }
        //deletadas as aulas


        //deletando os módulos
        $sql_2 = "DELETE FROM modulos WHERE id_curso=$id_curso";
        $resultado_2 = mysqli_query($conexao,$sql_2);
        //delatados os módulos


        //deletando a relação do produtor
        $sql_3 = "DELETE FROM relacao_usuario_curso WHERE id_curso=$id_curso AND tipo_relacao='produtor'";
        $resultado_3 = mysqli_query($conexao,$sql_3);
        //deletada a relação do produtor


        //deletando o curso
        $sql_4 = "DELETE FROM cursos WHERE id_curso=$id_curso";
        $resultado_4 = mysqli_query($conexao,$sql_4);
        //delatado o curso


        mysqli_close($conexao);

        if($resultado and $resultado_1 and $resultado_2 and $resultado_3){

            header("Location: ../index/produtor/PROD____home_produtor.php");

        }
    }

?>

</body>
</html>
