<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
</head>

<body>

    <?php
    
    include ".conexao_bd.php";

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

        header("Location: 1____modificacao_curso.php?id_curso=$id_curso");

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
        if(isset($linha_1) or isset($id_modulo)){

            for($i=0 ; $i<count($id_modulo) ; $i++){

                $sqli[$i]= "SELECT id_aula FROM aulas WHERE id_modulo=".$id_modulo[$i];
                $resultadoi[$i] = mysqli_query($conexao,$sqli[$i]);

                while($linhai = mysqli_fetch_assoc($resultadoi[$i])){

                    $id_aula[] = $linhai['id_aula'];

                }

            }

        }
        //obtidos os id_aula


        //deletando os materiais
        if(isset($linhai) or isset($id_aula)){

            for($j=0 ; $j<count($id_aula) ; $j++){

                $sqlj[$j] = "DELETE FROM materiais WHERE id_aula=".$id_aula[$j];
                $resultadoj[$j] = mysqli_query($conexao,$sqlj[$j]);

            }

        }
        //deletados os materiais


        //deletando as aulas
        if(isset($linha_1) or isset($id_modulo)){

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

            header("Location: 1_____home_produtor.php?email=$email");

        }
    }

?>

</body>
</html>
