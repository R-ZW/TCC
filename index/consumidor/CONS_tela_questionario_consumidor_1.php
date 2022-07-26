<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Tela de Questionário</title>
    
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Another Icon Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../***/_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../../_.materialize/css/configs.css">
    
</head>
<body class="container">
    
    <?php

            date_default_timezone_set('America/Sao_Paulo');

        include_once "../../_______necessarios/.conexao_bd.php";

        $id_questionario = $_GET['id_questionario'];
        $id_aula = $_GET['id_aula'];
        $email = $_SESSION['email'];


        //----------------------
        //obtendo o questionario-
        $sq = "SELECT * FROM questionarios WHERE id_questionario=$id_questionario";
        $res = mysqli_query($conexao, $sq);

        $li = mysqli_fetch_assoc($res);

        $nome_questionario = $li['nome_questionario'];
        $distribuicao_questoes = $li['distribuicao_questoes'];
        //-


        //obtendo as questões-
        $sql = "SELECT * FROM questoes WHERE id_questionario=$id_questionario";
        $resultado = mysqli_query($conexao, $sql);

        while ($linha = mysqli_fetch_assoc($resultado)){

            $id_questao[] = $linha['id_questao']; 

        }
        //-


        //obtendo as alternativas válidas-
        for($a=0 ; $a<count($id_questao) ; $a++){

            $sqla[$a] = "SELECT id_alternativa FROM alternativas WHERE validade_alternativa='correta' AND id_questao=".$id_questao[$a];
            $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);

            while ($linhaa = mysqli_fetch_assoc($resultadoa[$a])){

                $id_alternativa_valida0[] = $linhaa['id_alternativa'];

            }

        }
        //-


        //obtendo as questões válidas-
        for($b=0 ; $b<count($id_alternativa_valida0) ; $b++){

            $sqlb[$b] = "SELECT id_questao FROM alternativas WHERE id_alternativa=".$id_alternativa_valida0[$b];
            $resultadob[$b] = mysqli_query($conexao, $sqlb[$b]);

            while ($linhab = mysqli_fetch_assoc($resultadob[$b])){

                $id_questao_valida[] = $linhab['id_questao'];

            }

        }
        //-


        for($d=0 ; $d<count($id_questao_valida) ; $d++){

            //obtendo as questões válidas-
            $sqld[$d] = "SELECT * FROM questoes WHERE id_questao=".$id_questao_valida[$d];
            $resultadod[$d] = mysqli_query($conexao, $sqld[$d]);

            $linhad = mysqli_fetch_assoc($resultadod[$d]);

            $questoes[$d]['id_questao'] = $linhad['id_questao'];
            $questoes[$d]['desenvolvimento_questao'] = $linhad['desenvolvimento_questao'];
            $questoes[$d]['distribuicao_alternativas'] = $linhad['distribuicao_alternativas'];
            //-

            //obtendo as alternativas das questões válidas-
            $sqle[$d] = "SELECT * FROM alternativas WHERE id_questao=".$id_questao_valida[$d];
            $resultadoe[$d] = mysqli_query($conexao, $sqle[$d]);

            $e=0;
            while ($linhae = mysqli_fetch_assoc($resultadoe[$d])){

                $questoes[$d]['alternativas'][$e]['id_alternativa'] = $linhae['id_alternativa'];
                $questoes[$d]['alternativas'][$e]['desenvolvimento_alternativa'] = $linhae['desenvolvimento_alternativa'];
                $questoes[$d]['alternativas'][$e]['validade_alternativa'] = $linhae['validade_alternativa'];

                $e++;

            }
            //-


            //obtendo as informações da relação do usuário com o questionário-
            $sql_1 = "SELECT * FROM relacao_usuario_questionario WHERE id_questionario=$id_questionario AND email='$email'";
            $resultado_1 = mysqli_query($conexao, $sql_1);

            $linha_1 = mysqli_fetch_assoc($resultado_1);
        }
        //----------------------


        $data_hoje= new DateTime();
        $data_proxima_realizacao = new DateTime($linha_1['data_proxima_realizacao']);


        if($data_proxima_realizacao > $data_hoje){

            header("Location: CONS__tela_aula_consumidor.php?id_aula=$id_aula");  
            
            die;
        
        } else {

            echo "<h3><center>$nome_questionario</center></h3><br>";

            echo "<form action='CONS_tela_questionario_consumidor_2.php' method='post'>";


            if($distribuicao_questoes == "aleatoria"){

                shuffle($questoes);

            } 


            for($f=0 ; $f<count($questoes) ; $f++){

                echo "<big>" . $questoes[$f]['desenvolvimento_questao'] . "</big><br><br>";


                if($questoes[$f]['distribuicao_alternativas'] == "aleatoria"){

                    shuffle($questoes[$f]['alternativas']);

                }


                for($g=0 ; $g<count($questoes[$f]['alternativas']) ; $g++){


                echo "<input type='radio'
                    id='" .$questoes[$f]['alternativas'][$g]['id_alternativa']. "'
                    name='" . $questoes[$f]['id_questao'] . "'
                    value='" . $questoes[$f]['alternativas'][$g]['validade_alternativa'] . "'
                    required>
                    <label for='" .$questoes[$f]['alternativas'][$g]['id_alternativa']. "'>"
                    . $questoes[$f]['alternativas'][$g]['desenvolvimento_alternativa'] . "
                    </label><br>";

                }
                echo "<br><br>";
            }


            echo "<input type='hidden' name='id_questionario' value='$id_questionario'>
                  <input type='hidden' name='id_aula' value='$id_aula'>
                  <input type='submit' value='ENVIAR'>
                  <input type='reset' value='REDEFINIR'>  
                  </form>";

            $_SESSION['questoes'] = $questoes;

        }

    ?>
</body>
</html>