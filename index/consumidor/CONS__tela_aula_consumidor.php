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
    <link type="text/css" rel="stylesheet" href="../../_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../../_.materialize/css/configs.css">
    
</head>

<body class="container">
    
    <?php
    
        include_once "../../_______necessarios/.conexao_bd.php";

        $id_aula= $_GET['id_aula'];
        $email = $_SESSION['email'];

        
        //obtenção do id_modulo-
        $s = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
        $r = mysqli_query($conexao,$s);
        $l = mysqli_fetch_assoc($r);
        $id_modulo = $l['id_modulo'];
        //-


        //obtenção do id_curso-
        $sq = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
        $re = mysqli_query($conexao,$sq);
        $li = mysqli_fetch_assoc($re);
        $id_curso = $li['id_curso'];
        //-


        //obtenção dos dados da aula-
        $sql = "SELECT * FROM aulas WHERE id_aula=$id_aula";
        $resultado = mysqli_query($conexao,$sql); 

        while($linha = mysqli_fetch_assoc($resultado))
        {

            $nome_aula= $linha['nome_aula'];
	        $descricao_aula = $linha['descricao_aula'];
	        $endereco_imagem_aula = $linha['endereco_imagem_aula'];

        } 
        //-


        //obtenção dos dados dos materiais-
        $sql_1 = "SELECT * FROM materiais WHERE id_aula=$id_aula";
        $resultado_1 = mysqli_query($conexao,$sql_1); 

        while($linha_1 = mysqli_fetch_assoc($resultado_1))
        {

            $id_material[] = $linha_1['id_material'];
            $nome_material[] = $linha_1['nome_material'];
            $endereco_material[] = $linha_1['endereco_material'];

        }
        //-


        //obtendo os questionários da aula-
        $sql_2 = "SELECT id_questionario FROM questionarios WHERE id_aula=$id_aula";
        $resultado_2 = mysqli_query($conexao, $sql_2);
        while ($linha_2 = mysqli_fetch_assoc($resultado_2))
        {

            $id_questionario[] = $linha_2['id_questionario'];

        }
        //-


        //obtendo as questões-
        if(isset($id_questionario) or isset($linha_2)){

            for($a=0 ; $a<count($id_questionario) ; $a++){

                $sqla[$a] = "SELECT id_questao FROM questoes WHERE id_questionario=".$id_questionario[$a];
                $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);
                while ($linhaa = mysqli_fetch_assoc($resultadoa[$a]))
                {

                    $id_questao[] = $linhaa['id_questao'];

                }

            }

        }
        //-


        //obtendo as alternativas válidas, para obter as questões válidas-
        if(isset($id_questao) or isset($linhaa)){

            for($b=0 ; $b<count($id_questao) ; $b++){

                $sqlb[$b] = "SELECT id_alternativa FROM alternativas WHERE validade_alternativa='correta' AND id_questao=".$id_questao[$b];
                $resultadob[$b] = mysqli_query($conexao, $sqlb[$b]);
                while ($linhab = mysqli_fetch_assoc($resultadob[$b]))
                {

                    $id_alternativa_valida[] = $linhab['id_alternativa'];

                }

            }

        }
        //-


        //obtendo as questões válidas-
        if(isset($id_alternativa_valida) or isset($linhab)){

            for($c=0 ; $c<count($id_alternativa_valida) ; $c++){

                $sqlc[$c] = "SELECT id_questao FROM alternativas WHERE id_alternativa=".$id_alternativa_valida[$c];
                $resultadoc[$c] = mysqli_query($conexao, $sqlc[$c]);
                $linhac = mysqli_fetch_assoc($resultadoc[$c]);
                
                $id_questao_valida[] = $linhac['id_questao'];

            }

        }
        //-

        
        //obtendo os questionários válidos-
        if(isset($id_questao_valida) or isset($linhac)){

            $x=0;

            for($d=0 ; $d<count($id_questao_valida) ; $d++){

                $sqld[$d] = "SELECT id_questionario FROM questoes WHERE id_questao=".$id_questao_valida[$d];
                $resultadod[$d] = mysqli_query($conexao, $sqld[$d]);
                $linhad = mysqli_fetch_assoc($resultadod[$d]);

                $id_questionario_valido1[] = $linhad['id_questionario'];

            }

            $id_questionario_valido = array_unique($id_questionario_valido1);

            sort($id_questionario_valido);

        }
        //-


        //obtendo o nome dos questionarios válidos-
        if(isset($id_questionario_valido) or isset($linhad)){

            for($e=0 ; $e<count($id_questionario_valido) ; $e++){

                $sqle[$e] = "SELECT nome_questionario FROM questionarios WHERE id_questionario=".$id_questionario_valido[$e];
                $resultadoe[$e] = mysqli_query($conexao, $sqle[$e]);

                $linhae = mysqli_fetch_assoc($resultadoe[$e]);

                $nome_questionario[] = $linhae['nome_questionario'];

            }
        }
        //-


        echo "<h2 class='center-align bold'>$nome_aula</h2><br>"; 
        echo "<center><img  class='materialboxed' src='$endereco_imagem_aula'></center><br><br>";
        echo "<h5>$descricao_aula</h5><br><br>";

        echo "<big>Materiais:</big><br><br>";

        if(isset($id_material)){
            for($i=0 ; $i<count($id_material) ; $i++){

                $arq= explode(".",$endereco_material[$i]);
                $ext= $arq[count($arq)-1];
        
                if($ext == "mp4"){

                    echo "<h5><center>".$nome_material[$i]."</center></h5><video src='".$endereco_material[$i]."' controls width='100%'></video><br><br>";

                } elseif($ext == "jpg" or $ext == "jpeg" or $ext == "png" or $ext == "gif" or $ext == "webp" or $ext == "psd"){

                    echo "<h5><center>".$nome_material[$i]."</center></h5><img src='".$endereco_material[$i]."' width='100%' download></img><br><br>";

                } else {
            
                    echo "<h5>".$nome_material[$i]." <a href='".$endereco_material[$i]."' download class='white-text'><div class='waves-effect waves-light btn btn-floating'><i class='material-icons right'>download</i></div></a></h5><br>";

                }

            }
        } else {

            echo "- Não existem materiais cadastrados nesta aula.<br><br>";

        }


        echo "<big>Questionários:</big><br><br>";

        if(isset($id_questionario_valido) or isset($linhad)){

            for($f=0 ; $f<count($id_questionario_valido) ; $f++){

                echo "<a href='CONS_tela_questionario_consumidor_1.php?id_questionario=".$id_questionario_valido[$f]."&id_aula=$id_aula'>".$nome_questionario[$f]."</a><br>";

            }

        } else {

            echo "- Não existem questionários válidos cadastrados nesta aula.<br>";

        }


        echo "<br><br><center><a href='CONS___tela_curso_consumidor.php?id_curso=$id_curso'class='white-text'><div class='waves-effect waves-light btn bold'>Voltar<i class='material-icons left'>keyboard_backspace</i></div></a></center><br><br>";
    ?>
    
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>