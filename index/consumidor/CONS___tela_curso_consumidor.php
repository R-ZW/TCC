<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
  
<head>
    <meta charset="UTF-8">
    <title>Tela de Curso</title>

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

        $id_curso= $_GET['id_curso'];
        $email = $_SESSION['email'];


        //----------------------
        //obtenção dos dados do curso-
        $sql = "SELECT * FROM cursos WHERE id_curso=$id_curso";
        $resultado = mysqli_query($conexao,$sql); 

        while($linha = mysqli_fetch_assoc($resultado))
        {

            $nome_curso= $linha['nome_curso'];
	        $descricao_curso = $linha['descricao_curso'];
	        $endereco_imagem_curso = $linha['endereco_imagem_curso'];
            $endereco_certificado_curso = $linha['endereco_certificado_curso'];

        } 
        //-


        //obtenção dos dados dos módulos-
        $sql_1 = "SELECT * FROM modulos WHERE visibilidade_modulo='visível' AND id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao,$sql_1); 

        while($linha_1 = mysqli_fetch_assoc($resultado_1))
        {

            $id_modulo[]= $linha_1['id_modulo'];
            $nome_modulo[]= $linha_1['nome_modulo'];
            $descricao_modulo[]= $linha_1['descricao_modulo'];
            $endereco_imagem_modulo[]= $linha_1['endereco_imagem_modulo'];

        }
        //-


        if(isset($id_modulo)){

            //obtenção dos dados das aulas-
            $i=0;
            while($i<count($id_modulo)){

                $sqli[$i] = "SELECT * FROM aulas WHERE visibilidade_aula='visível' AND id_modulo=$id_modulo[$i]";
                $resultadoi[$i] = mysqli_query($conexao,$sqli[$i]);
    
                while($linhai[$i] = mysqli_fetch_assoc($resultadoi[$i])){

                    $id_aula[$i][]= $linhai[$i]['id_aula'];
                    $id_aula_alt[] = $linhai[$i]['id_aula'];
                    $z=$linhai[$i]['id_aula'];
                    $nome_aula[$i][]= $linhai[$i]['nome_aula'];
                    $descricao_aula[$i][]= $linhai[$i]['descricao_aula'];
                    $endereco_imagem_aula[$i][]= $linhai[$i]['endereco_imagem_aula'];

                }
            $i++;
            }
            //-
        }


        //obtendo os questionários do curso-
        if(isset($z)){

            for($a=0 ; $a<count($id_aula_alt) ; $a++){

                $sqla[$a] = "SELECT id_questionario FROM questionarios WHERE visibilidade_questionario='visível' AND id_aula=".$id_aula_alt[$a];
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


        //obtendo as alternativas válidas-
        if(isset($id_questao) or isset($linhab)){

            for($c=0 ; $c<count($id_questao) ; $c++){

                $sqlc[$c] = "SELECT id_alternativa FROM alternativas WHERE validade_alternativa='correta' AND id_questao=".$id_questao[$c];
                $resultadoc[$c] = mysqli_query($conexao, $sqlc[$c]);
                while ($linhac = mysqli_fetch_assoc($resultadoc[$c]))
                {

                    $id_alternativa_valida[] = $linhac['id_alternativa'];

                }

            }

        }
        //-

        
        //obtendo as questões válidas-
        if(isset($id_alternativa_valida) or isset($linhac)){

            for($d=0 ; $d<count($id_alternativa_valida) ; $d++){

                $sqld[$d] = "SELECT id_questao FROM alternativas WHERE id_alternativa=".$id_alternativa_valida[$d];
                $resultadod[$d] = mysqli_query($conexao, $sqld[$d]);
                $linhad = mysqli_fetch_assoc($resultadod[$d]);
                
                $id_questao_valida[] = $linhad['id_questao'];

            }

        }
        //-

        
        //obtendo os questionários válidos-
        if(isset($id_questao_valida) or isset($linhad)){

            $x=0;

            for($e=0 ; $e<count($id_questao_valida) ; $e++){

                $sqle[$e] = "SELECT id_questionario FROM questoes WHERE id_questao=".$id_questao_valida[$e];
                $resultadoe[$e] = mysqli_query($conexao, $sqle[$e]);
                $linhae = mysqli_fetch_assoc($resultadoe[$e]);

                $id_questionario_valido1[] = $linhae['id_questionario'];

            }

            $id_questionario_valido = array_unique($id_questionario_valido1);

            sort($id_questionario_valido);

        }
        //-


        //obtendo a relação do usuário com os questionários-
        $sql_2 = "SELECT * FROM relacao_usuario_questionario WHERE id_curso=$id_curso AND email='$email'";
        $resultado_2 = mysqli_query($conexao, $sql_2);

        while ($linha_2 = mysqli_fetch_assoc($resultado_2)){

            $id_relacao_usuario_questionario[] = $linha_2['id_relacao_usuario_questionario'];
            $id_questionario[] = $linha_2['id_questionario'];
            $nota_usuario[] = $linha_2['nota_usuario'];
            
        }
        //-


        if(isset($nota_usuario) or isset($linha_2)){

            $qtd_media=0;

            for($f=0 ; $f<count($id_relacao_usuario_questionario) ; $f++){

                $sqlf[$f] = "SELECT * FROM questionarios WHERE id_questionario=".$id_questionario[$f];
                $resultadof[$f] = mysqli_query($conexao,$sqlf[$f]);
                while ($linhaf = mysqli_fetch_assoc($resultadof[$f])){

                    $nome_questionario[$f] = $linhaf['nome_questionario']; 

                }

                if($nota_usuario[$f]>=70){

                    $qtd_media++;

                } elseif($nota_usuario[$f]<70){

                    $nome_questionarios_abaixo[] = $nome_questionario[$f];

                } elseif($nota_usuario[$f]=="não-realizado"){

                    $nome_questionarios_nao_realizados[] = $nome_questionario[$f];

                }   

            }

        }

        if(isset($id_questionario_valido)){

            if($qtd_media == count($id_questionario_valido)){

                $validade = "baixável";

            } else {

                $validade = "não-baixável";

            }
            
        }

        //obtendo os dados de favorito do curso para com o usuário-
        $sql_3 = "SELECT * FROM favoritos_curso WHERE email='$email' AND id_curso=$id_curso";
        $resultado_3 = mysqli_query($conexao, $sql_3);

        if($resultado_3 == true){

            if($linha_3 = mysqli_fetch_assoc($resultado_3)){

                $situacao_favorito_curso = $linha_3['situacao_favorito_curso'];

            }

        }
        //-
        //----------------------


        echo "<h3 class='center-align bold'>$nome_curso ";
        
        if(isset($situacao_favorito_curso)){

            if($situacao_favorito_curso == "favorito"){

                echo "<a href='../../_____cursos/favorito_curso.php?id_curso=$id_curso&i=1' class='link-curso'><i class='fa fa-star'></i></a>";

            } else {

                echo "<a href='../../_____cursos/favorito_curso.php?id_curso=$id_curso&i=1' class='link-curso'><i class='fa fa-star-o'></i></a>";

            }

        } else {

            echo "<a href='../../_____cursos/favorito_curso.php?id_curso=$id_curso&i=1' class='link-curso'><i class='fa fa-star-o'></i></a>";

        }

echo "
        </h3><br>";
        echo "<center><img src=$endereco_imagem_curso class='materialboxed' width=50%></center><br><br>";
        echo "<h5 class='justify'>$descricao_curso</h4><br>";

        if(!isset($id_alternativa_valida) and $endereco_certificado_curso=="sem-certificado"){

            echo "ESTE CURSO NÃO POSSUI CERTIFICADO, E SE POSSUI-SE NÃO ESTARIA VÁLIDO PARA DOWNLOAD";

        } elseif(!isset($id_alternativa_valida) and $endereco_certificado_curso!="sem-certificado"){

            echo "ESTE CURSO POSSUI CERTIFICADO, PORÉM NÃO ESTÁ VÁLIDO PARA DOWNLOAD";

        } elseif(isset($id_alternativa_valida) and $endereco_certificado_curso=="sem-certificado"){

            echo "ESTE CURSO NÃO POSSUI CERTIFICADO, PORÉM, CASO POSSUI-SE ESTARIA VÁLIDO PARA DOWNLOAD";

        } elseif(isset($id_alternativa_valida) and $endereco_certificado_curso!="sem-certificado" and $validade=="não-baixável"){

            echo "VOCÊ NÃO PODE BAIXAR O CERTIFICADO PQ VC É BURRO";

        } elseif(isset($id_alternativa_valida) and $endereco_certificado_curso!="sem-certificado" and $validade=="baixável"){

            echo "<a href='$endereco_certificado_curso' download class='white-text'><div class='waves-effect waves-light btn bold'>BAIXAR CERTIFICADO<i class='material-icons right'>download</i></div></a></h5><br>";

        }

        echo "<br><br>";
        
        if(isset($id_modulo) or isset($linha_1)){
        
            for($i=0 ; $i<count($id_modulo) ; $i++){

                echo "<br>
                <div class='card-panel'>
                    <div class='row'>
                    <h4 class='bold center-align'>" . $nome_modulo[$i] . " ";
                    
                    $sqli_2[$i] = "SELECT * FROM favoritos_modulo WHERE email='$email' AND id_modulo=".$id_modulo[$i];
                    $resultadoi_2[$i] = mysqli_query($conexao, $sqli_2[$i]);

                    if($resultadoi_2[$i] == true){

                        if($linhai_2[$i] = mysqli_fetch_assoc($resultadoi_2[$i])){

                            $situacao_favorito_modulo[$i] = $linhai_2[$i]['situacao_favorito_modulo'];

                        }

                    }

                    if(isset($situacao_favorito_modulo[$i])){

                        if($situacao_favorito_modulo[$i] == "favorito"){

                            echo "<a href='../../____modulos/favorito_modulo.php?id_curso=$id_curso&id_modulo=".$id_modulo[$i]."' class='link-curso'><i class='fa fa-star'></i></a>";

                        } else {

                            echo "<a href='../../____modulos/favorito_modulo.php?id_curso=$id_curso&id_modulo=".$id_modulo[$i]."' class='link-curso'><i class='fa fa-star-o'></i></a>";

                        }

                    } else {

                        echo "<a href='../../____modulos/favorito_modulo.php?id_curso=$id_curso&id_modulo=".$id_modulo[$i]."' class='link-curso'><i class='fa fa-star-o'></i></a>";

                    }

echo "
                    </h4><br><br>
                        <div class='col s4 m4 l4 flow-text'>
                        
                            <img src=" . $endereco_imagem_modulo[$i] ." class='img-curso'>
                    
                        </div>
                    
                        <div class='center-align'>
                            <h5 class='descricao-modulo'>" . $descricao_modulo[$i] . "<br><br>
                        </div>
                    </div>";

                    if(isset($id_aula[$i])){

                        for($j=0 ; $j<count($id_aula[$i]) ; $j++){

                            echo "<big>- <a href='CONS__tela_aula_consumidor.php?id_aula=".$id_aula[$i][$j]."'>".$nome_aula[$i][$j]."</a> ";
                            
                            $sqlij[$i][$j] = "SELECT * FROM favoritos_aula WHERE email='$email' AND id_aula=".$id_aula[$i][$j];
                            $resultadoij[$i][$j] = mysqli_query($conexao, $sqlij[$i][$j]);

                            if($resultadoij[$i][$j] == true){

                                if($linhaij[$i][$j] = mysqli_fetch_assoc($resultadoij[$i][$j])){

                                    $situacao_favorito_aula[$i][$j] = $linhaij[$i][$j]['situacao_favorito_aula'];

                                }

                            }
                        
                            if(isset($situacao_favorito_aula[$i][$j])){

                                if($situacao_favorito_aula[$i][$j] == "favorito"){
        
                                    echo "<i class='fa fa-star'></i>";
        
                                } 
        
                            }
                            
echo "
                            </big><br>";

                        }

                    } else {

                            echo "<big>Não existem aulas cadastradas neste módulo.</big><br><br>";

                    }

                echo "</div>";
                

            }

        } else {

            echo "<br><h5>- Não existem módulos cadastrados neste curso.</h5><br><br>";

        }

        echo "<br><br><center><a href='CONS____home_consumidor.php' class='white-text'><div class='waves-effect waves-light btn bold'>Voltar<i class='material-icons left'>keyboard_backspace</i></div></a></center><br><br>";

    ?>

    <br> 

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>