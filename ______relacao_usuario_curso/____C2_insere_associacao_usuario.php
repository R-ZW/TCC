<?php
session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $email= mysqli_real_escape_string($conexao,$_POST['email']);
    $id_curso = mysqli_real_escape_string($conexao,$_POST['id_curso']);

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");

    //verificando se o email existe no banco-
    $s= "SELECT * FROM usuarios WHERE email='$email'";
    $r= mysqli_query($conexao, $s);
    $l= mysqli_fetch_assoc($r);
    //-

    //obtendo id_relacao_usuario_curso
    $sq = "SELECT id_relacao_usuario_curso FROM relacao_usuario_curso WHERE email='$email' AND id_curso=$id_curso AND tipo_relacao='consumidor'";
    $result = mysqli_query($conexao, $sq);
    $linha = mysqli_fetch_assoc($result);
    //-

    if(!isset($l)){

        $_SESSION['mensagem'] = "O usuário informado não existe!";
        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");
        die;

    }
    if(isset($linha)){
   
        $_SESSION['mensagem'] = "O usuário já está associado ao curso!";
        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");
        die;

    } else {

        //relacionando o consumidor ao curso-
        $sql = "INSERT INTO relacao_usuario_curso(email, id_curso, tipo_relacao, data_relacao) 
        VALUES ('$email', '$id_curso', 'consumidor', '$data')";

        $resultado = mysqli_query($conexao,$sql);
        // -

        //obtendo os módulos que pertencem ao curso-
        $sql_1 = "SELECT id_modulo FROM modulos WHERE id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao, $sql_1);

        while ($linha_1 = mysqli_fetch_assoc($resultado_1))
        {

            $id_modulo[] = $linha_1['id_modulo'];

        }
        //-

        //obtendo as aulas que pertencem ao curso-
        if(isset($id_modulo) or isset($linha_1)){

            for($a=0 ; $a<count($id_modulo) ; $a++){

                $sqla[$a] = "SELECT id_aula FROM aulas WHERE id_modulo=".$id_modulo[$a];
                $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);

                while ($linhaa = mysqli_fetch_assoc($resultadoa[$a]))
                {

                    $id_aula[] = $linhaa['id_aula'];

                }

            }

        }
        //-

        //obtendo os questionários que pertencem ao curso-
        if(isset($id_aula) or isset($linhaa)){

            for($b=0 ; $b<count($id_aula) ; $b++){

                $sqlb[$b] = "SELECT id_questionario FROM questionarios WHERE id_aula=".$id_aula[$b];
                $resultadob[$b] = mysqli_query($conexao, $sqlb[$b]);

                while ($linhab = mysqli_fetch_assoc($resultadob[$b])){

                    $id_questionario[] = $linhab['id_questionario']; 

                }

            }

        }
        //-


        //relacionando o consumidor com os questionários-
        if(isset($id_questionario) or isset($linhab)){

            for($c=0 ; $c<count($id_questionario) ; $c++){

                $sqlc[$c] = "INSERT INTO relacao_usuario_questionario(email, id_questionario, id_curso, nota_usuario, data_proxima_realizacao) 
                VALUES ('$email', '".$id_questionario[$c]."', '$id_curso', 'não-realizado', '$data')";
                
                $resultadoc[$c] = mysqli_query($conexao, $sqlc[$c]);

            }

        }
        // -

    }

    if($resultado)
    {
        $_SESSION['mensagem'] = "Usuário associado com sucesso!";
	    header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");
    }

?>
