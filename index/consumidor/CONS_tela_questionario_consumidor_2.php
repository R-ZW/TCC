<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Tela de Aula</title>
    
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Another Icon Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../**/_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../../_.materialize/css/configs.css">
    
</head>
<body class="container">
    
    <?php

        include_once "../../_______necessarios/.conexao_bd.php";

        $id_questionario = $_POST['id_questionario'];
        $id_aula = $_POST['id_aula'];
        $questoes = $_SESSION['questoes'];
        $email = $_SESSION['email'];


        $acertos=0;

        for($a=0 ; $a<count($questoes) ; $a++){

            $x = $questoes[$a]['id_questao'];


            if($_POST[$x] == "correta"){

                $acertos++;

            }

        }

        $nota_usuario = ($acertos/count($questoes))*100;

        
        //obtendo as informações do questionário-
        $sql = "SELECT * FROM questionarios WHERE id_questionario=$id_questionario";
        $resultado = mysqli_query($conexao, $sql);

        $linha = mysqli_fetch_assoc($resultado);

        $tempo = explode("-",$linha['tempo_proxima_realizacao']);
        
        $tempo_numero = $tempo[0];
        $tempo_unidade = $tempo[1];

        if($tempo_unidade == "M"){

            $nome_unidade = "minuto";

        }

        if($tempo_unidade == "H"){

            $nome_unidade = "hora";

        }

        if($tempo_unidade == "D"){

            $nome_unidade = "dia";

        }

        if($tempo_numero >= 2){

            $nome_unidade = $nome_unidade."s";

        }
        //-


        date_default_timezone_set('America/Sao_Paulo');
        $data_proxima_realizacao = new DateTime();

        if($tempo_unidade == "M" or $tempo_unidade == "H"){

            $data_proxima_realizacao->add(new DateInterval("PT".$tempo_numero.$tempo_unidade));

        } elseif ($tempo_unidade == "D"){

            $data_proxima_realizacao->add(new DateInterval("P".$tempo_numero.$tempo_unidade));

        }


        //inserindo a resolução do questionário na relação do usuário com ele-
        $sql_1 = "UPDATE `relacao_usuario_questionario`
        SET `nota_usuario`='$nota_usuario',`data_proxima_realizacao`= \"" . $data_proxima_realizacao->format('Y-m-d H:i:s') . "\"
        WHERE id_questionario=$id_questionario AND email='$email'";
        $resultado_1 = mysqli_query($conexao, $sql_1); 
        //-


        if($nota_usuario >= 70){

            echo "Parabéns! Sua nota foi de $nota_usuario%! <br><br>";

            echo "<big><center>Gabarito</center></big>";

            for($b=0 ; $b<count($questoes) ; $b++){

                echo "<big>" . $questoes[$b]['desenvolvimento_questao'] . "</big><br><br>";
    
                for($c=0 ; $c<count($questoes[$b]['alternativas']) ; $c++){
    
                    if($questoes[$b]['alternativas'][$c]['validade_alternativa'] == "correta"){

                        echo "<input type='radio'
                              id='" .$questoes[$b]['alternativas'][$c]['id_alternativa']. "'
                              name='" . $questoes[$b]['id_questao'] . "'
                              value='" . $questoes[$b]['alternativas'][$c]['validade_alternativa'] . "'
                              checked>
                              <label for='" .$questoes[$b]['alternativas'][$c]['id_alternativa']. "'>"
                              . $questoes[$b]['alternativas'][$c]['desenvolvimento_alternativa'] . "
                              correta!</label><br>";
                        
                    } else {
    
                        echo "<input type='radio'
                                id='" .$questoes[$b]['alternativas'][$c]['id_alternativa']. "'
                                name='" . $questoes[$b]['id_questao'] . "'
                                value='" . $questoes[$b]['alternativas'][$c]['validade_alternativa'] . "'
                                >
                                <label for='" .$questoes[$b]['alternativas'][$c]['id_alternativa']. "'>"
                                . $questoes[$b]['alternativas'][$c]['desenvolvimento_alternativa'] . "
                                </label><br>";

                    }
    
                }
                echo "<br><br>";
            }

        } else {

            echo "A sua nota foi de $nota_usuario%, infelizmente você não conseguiu atingir a nota requerida. O questionário estara diponível novamente em $tempo_numero $nome_unidade.";

        }
    ?>

    <a href="CONS__tela_aula_consumidor.php?id_aula=<?php echo $id_aula;?>">Voltar</a>
</body>
</html>