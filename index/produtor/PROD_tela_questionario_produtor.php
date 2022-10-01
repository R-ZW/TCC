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
    <link type="text/css" rel="stylesheet" href="../../_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../../_.materialize/css/configs.css">
    
</head>

<body class="container">

    <main>

        <?php
            
            include_once "../../_______necessarios/.conexao_bd.php";

            $id_questionario= $_GET['id_questionario'];


            //obtenção do questionario-
            $sql = "SELECT * FROM questionarios WHERE id_questionario=$id_questionario";
            $resultado = mysqli_query($conexao,$sql);

            $linha = mysqli_fetch_assoc($resultado);

            $id_aula = $linha['id_aula'];
            $nome_questionario = $linha['nome_questionario'];
            $distribuicao_questoes = $linha['distribuicao_questoes'];
            $visibilidade_questionario = $linha['visibilidade_questionario'];
            //-


            //obtenção das questões-
            $sql_1 = "SELECT * FROM questoes WHERE id_questionario=$id_questionario";
            $resultado_1 = mysqli_query($conexao, $sql_1);

            while($linha_1 = mysqli_fetch_assoc($resultado_1))
            {

                $id_questao[] = $linha_1['id_questao'];
                $desenvolvimento_questao[] = $linha_1['desenvolvimento_questao'];

            }
            //-


            //obtendo as alternativas válidas, para obter as questões válidas-
            if(isset($id_questao)){

                for($a=0 ; $a<count($id_questao) ; $a++){

                    $sqla[$a] = "SELECT id_alternativa FROM alternativas WHERE validade_alternativa='correta' AND id_questao=".$id_questao[$a];
                    $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);
                    while ($linhaa = mysqli_fetch_assoc($resultadoa[$a]))
                    {

                        $id_alternativa_valida[] = $linhaa['id_alternativa'];

                    }

                }

            }
            //-

            echo "
            <div id='informacao' class='modal'>
                <div class='modal-content'>
                    <h4>Validade de Questionário</h4>
                    <p>O questionário só é considerado válido quando há pelo menos uma questão válida, ou seja, uma questão que possua pelo menos uma resposta correta.</p>
                    <br>
                    <p><i class='material-icons left'>lens</i> Questionário Válido</p>
                    <p><i class='material-icons left'>panorama_fish_eye</i> Questionário Inválido</p>
                </div>
                <div class='modal-footer'>
                    <a href='#!' class='modal-close waves-effect waves-green btn-flat'>Ok</a>
                </div>
            </div>
            <center><h3>
            
            <a class='waves-effect waves-light btn btn-floating modal-trigger' href='#informacao'><i class='fa fa-info'></i></a> ";

            if(isset($id_alternativa_valida)){

                echo "<i class='material-icons'>lens</i> ";

            } else {

                echo "<i class='material-icons'>panorama_fish_eye</i> ";

            }

            echo "$nome_questionario
                   <a href='../../__questionarios/__U1_form_altera_questionario.php?id_questionario=$id_questionario&i=1' class='link-curso'><i class='material-icons small'>edit</i></a>
                   <a href='../../__questionarios/_D1_excluir_questionario.php?&id_questionario=$id_questionario' class='link-curso'><i class='material-icons small'>delete</i></a> ";
                   
            if($visibilidade_questionario == "visível"){

                echo "<a href='../../__questionarios/inversao_situacao_visibilidade_questionario.php?id_aula=$id_aula&id_questionario=$id_questionario&i=1' class='link-curso'><i class='fa fa-eye'></i></a><br>";

            } else {

                echo "<a href='../../__questionarios/inversao_situacao_visibilidade_questionario.php?id_aula=$id_aula&id_questionario=$id_questionario&i=1' class='link-curso'><i class='fa fa-eye-slash'></i></a><br>";
                
            } 
                   
echo "
                   </center></h3><br><br><br><br>";
            
        
            if(isset($id_questao)){

                for($i=0 ; $i<count($id_questao) ; $i++){

                    //obtenção das alternativas
                    $sqli[$i] = "SELECT * FROM alternativas WHERE id_questao=".$id_questao[$i];
                    $resultadoi[$i] = mysqli_query($conexao, $sqli[$i]);

                    $j=0;
                    while($linhai[$i] = mysqli_fetch_assoc($resultadoi[$i])){

                        $id_alternativa[$i][$j] = $linhai[$i]['id_alternativa'];
                        $desenvolvimento_alternativa[$i][$j] = $linhai[$i]['desenvolvimento_alternativa'];
                        $validade_alternativa[$i][$j] = $linhai[$i]['validade_alternativa'];

                        $j++;

                    }
                    //-

                    if(isset($id_alternativa[$i])){

                        for($l=0 ; $l<count($id_alternativa[$i]) ; $l++){

                            if($validade_alternativa[$i][$l] == "correta"){

                                $validade_questao[$i] = 1;

                            }

                        }
                    
                    }

                    if(isset($validade_questao[$i])){

                        echo "<i class='material-icons left'>lens</i> ";
        
                    } else {
        
                        echo "<i class='material-icons left'>panorama_fish_eye</i> ";
        
                    }

                    $k=$i+1;

                    echo "<big>$k)";

                    echo $desenvolvimento_questao[$i]."</big>".
                         " <a href='../../_questoes/__U1_form_altera_questao.php?id_questao=" . $id_questao[$i] . "&id_questionario=$id_questionario' class='link-curso'><i class='material-icons'>edit</i></a>
                           <a href='../../_questoes/_D1_excluir_questao.php?id_questao=" .$id_questao[$i] . "&id_questionario=$id_questionario' class='link-curso'><i class='material-icons'>delete</i></a><br><br>";


                    if(isset($id_alternativa[$i])){

                        for($l=0 ; $l<count($id_alternativa[$i]) ; $l++){

                            echo $desenvolvimento_alternativa[$i][$l];
                            echo " <a href='../../alternativas/__U1_form_altera_alternativa.php?id_alternativa=" . $id_alternativa[$i][$l] . "&id_questionario=$id_questionario' class='link-curso'><i class='tiny material-icons'>edit</i></a>
                                   <a href='../../alternativas/_D1_excluir_alternativa.php?id_alternativa=" .$id_alternativa[$i][$l] . "&id_questionario=$id_questionario' class='link-curso'><i class='tiny material-icons'>delete</i></a><br>";

                        }

                    } else {

                        echo "Não existem alternativas cadastradas nesta questão.<br>";

                    }

                    echo "<br><a href='../../alternativas/____C1_form_insere_alternativa.php?id_questao=" . $id_questao[$i] . "&id_questionario=$id_questionario' class='white-text'><div class='waves-effect waves-light btn bold'>ADICIONAR ALTERNATIVA<i class='material-icons left'>add</i></div></a><br><br>";
                
                }

            } else {

                echo "Não existem questões cadastradas neste questionário.<br><br><br>";

            }

            echo "<br><a href='../../_questoes/____C1_form_insere_questao.php?id_questionario=$id_questionario' class='white-text'><div class='waves-effect waves-light btn bold'>ADICIONAR QUESTÃO<i class='material-icons left'>add</i></div></a><br><br><br>";
        
        ?>

        <center><a href='PROD__tela_aula_produtor.php?id_aula=<?php echo $id_aula; ?>' class="white-text"><div class='waves-effect waves-light btn bold'>Voltar<i class='material-icons left'>keyboard_backspace</i></div></a></center><br><br>



    </main>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>
    <script>
    $(document).ready(function(){
    $('.modal').modal();
    });
    </script>
    
</body>

</html>