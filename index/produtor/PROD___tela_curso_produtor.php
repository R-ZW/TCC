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
        $email_produtor= $_SESSION['email'];

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
        $sql_1 = "SELECT * FROM modulos WHERE id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao,$sql_1); 

        while($linha_1 = mysqli_fetch_assoc($resultado_1))
        {

            $id_modulo[]= $linha_1['id_modulo'];
            $nome_modulo[]= $linha_1['nome_modulo'];
            $descricao_modulo[]= $linha_1['descricao_modulo'];
            $endereco_imagem_modulo[]= $linha_1['endereco_imagem_modulo'];

        }
        //-


        if(isset($id_modulo) or isset($linha_1)){

            //obtenção dos dados das aulas-
            $i=0;
            while($i<count($id_modulo)){

                $sqli[$i] = "SELECT * FROM aulas WHERE id_modulo=$id_modulo[$i]";
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

                    $sqla[$a] = "SELECT id_questionario FROM questionarios WHERE id_aula=".$id_aula_alt[$a];
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
            //----------------------


            echo "<h2 class='center-align bold'>$nome_curso
            <a href='../../_____cursos/__U1_form_altera_curso.php?id_curso=$id_curso&i=1' class='link-curso'><i class='material-icons small'>edit</i></a>
            <a href='../../_____cursos/_D1_excluir_curso.php?id_curso=$id_curso' class='link-curso'><i class='material-icons small'>delete</i></a>
            </h2><br>";
            echo "<center><img src=$endereco_imagem_curso class='materialboxed' width='50%'></center><br><br>";
            echo "<h5 class='justify'>$descricao_curso</h4><br>";

            if(!isset($id_alternativa_valida) and $endereco_certificado_curso=="sem-certificado"){

                echo "ESTE CURSO NÃO POSSUI CERTIFICADO, E SE POSSUI-SE NÃO ESTARIA VÁLIDO PARA DOWNLOAD";

            } elseif(!isset($id_alternativa_valida) and $endereco_certificado_curso!="sem-certificado"){

                echo "ESTE CURSO POSSUI CERTIFICADO, PORÉM NÃO ESTÁ VÁLIDO PARA DOWNLOAD";

            } elseif(isset($id_alternativa_valida) and $endereco_certificado_curso=="sem-certificado"){

                echo "ESTE CURSO NÃO POSSUI CERTIFICADO, PORÉM, CASO POSSUI-SE ESTARIA VÁLIDO PARA DOWNLOAD";

            } elseif(isset($id_alternativa_valida) and $endereco_certificado_curso!="sem-certificado"){

                echo "<a href='$endereco_certificado_curso' download class='white-text'><div class='waves-effect waves-light btn bold'>BAIXAR CERTIFICADO<i class='material-icons right'>download</i></div></a></h5><br>";

            }
            
            echo "<br><br>";
        
            if(isset($id_modulo) or isset($linha_1)){

                for($i=0 ; $i<count($id_modulo) ; $i++){

                    echo "<br>
                    <div class='card-panel'>
                        <div class='row'>
                            <h4 class='bold center-align'>" . $nome_modulo[$i] . " 
                            <a href='../../____modulos/__U1_form_altera_modulo.php?id_modulo=".$id_modulo[$i]."' class='link-curso'> <i class='material-icons small'>edit</i></a>
                            <a href='../../____modulos/_D1_excluir_modulo.php?id_modulo=".$id_modulo[$i]."' class='link-curso'><i class='material-icons small'>delete</i></a>
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

                            echo "<big>- <a href='PROD__tela_aula_produtor.php?id_aula=".$id_aula[$i][$j]."'>".$nome_aula[$i][$j]."</a> </big> 
                            <a href='../../___aulas/__U1_form_altera_aula.php?id_aula=".$id_aula[$i][$j]."&i=0'class='link-curso'><i class='material-icons'>edit</i></a>
                            <a href='../../___aulas/_D1_excluir_aula.php?id_aula=".$id_aula[$i][$j]."'class='link-curso'><i class='material-icons'>delete</i></a><br>";

                        }

                    } else {

                            echo "<big>Não existem aulas cadastradas neste módulo.</big><br>";

                    }

                    echo "<br><a href='../../___aulas/____C1_form_insere_aula.php?id_modulo=" . $id_modulo[$i] . "'class='white-text'><div class='waves-effect waves-light btn bold'>ADICIONAR AULA<i class='material-icons left'>add</i></div></a><br><br>";
                    echo "</div><br>";
                    
                } 

            } else {

                echo "<h5>Não existem módulos cadastrados neste curso.</h5><br><br>";

            }


    ?>

    <center><a href='../../____modulos/____C1_form_insere_modulo.php?id_curso=<?php echo $id_curso;?>'class='white-text'><div class='waves-effect waves-light btn bold'>ADICIONAR MÓDULO<i class='material-icons left'>add</i></div></a></center><br>

    <br> 
    <br>

    <div class="card-panel">
    <center><h4 class="bold">USUÁRIOS ASSOCIADOS AO CURSO</h4></center><br><br>

    <?php
    
        //obtenção dos consumidores associados ao curso
        $sql_3 = "SELECT * FROM relacao_usuario_curso WHERE id_curso=$id_curso AND tipo_relacao='consumidor'";
        $resultado_3 = mysqli_query($conexao,$sql_3); 

        while($linha_3 = mysqli_fetch_assoc($resultado_3))
        {

            $email_consumidor[]= $linha_3['email'];
	        $data_relacao[]= $linha_3['data_relacao'];

        } 
        //fim da obtenção dos consumidores associados ao curso
    
        if(isset($email_consumidor)){

            for($h=0 ; $h<count($email_consumidor) ; $h++){

                $d[$h]= date('d/m/Y',strtotime($data_relacao[$h]));

                echo "<big>- ".$email_consumidor[$h] . " desde " . $d[$h] . " </big>";
                echo "<a href='../../______relacao_usuario_curso/__U1_form_altera_associacao_usuario.php?email=".$email_consumidor[$h]."&id_curso=$id_curso'class='link-curso'><i class='material-icons'>edit</i></a>
                      <a href='../../______relacao_usuario_curso/_D1_excluir_associacao_usuario.php?email=".$email_consumidor[$h]."&id_curso=$id_curso'class='link-curso'><i class='material-icons'>delete</i></a><br>";

            }

        } else {

            echo "Não existem usuários associados a este curso<br><br>";

        }

    ?>
    <br>

    <a href="../../______relacao_usuario_curso/____C1_form_insere_associacao_usuario.php?id_curso=<?php echo $id_curso;?>"class='white-text'><div class='waves-effect waves-light btn bold'>ASSOCIAR USUÁRIO<i class='material-icons left'>add</i></div></a>

    <br>
    <br>
    </div>

    <br>
    <br>

    <center><a href='PROD____home_produtor.php?email=<?php echo $email_produtor; ?>'class='white-text'><div class='waves-effect waves-light btn bold'>Voltar<i class='material-icons left'>keyboard_backspace</i></div></a></center><br><br> 

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>