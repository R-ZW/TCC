<?php
session_start();
require_once "../../_______necessarios/.conexao_bd.php";
require_once "../../_______necessarios/.funcoes.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../entrada.php");
    die;
}

$email = $_SESSION['email'];

$sql_1 = "SELECT * FROM usuarios WHERE id_usuario='".$_SESSION['id_usuario']."'";
$resultado_1 = mysqli_query($conexao, $sql_1);
$linha_1 = mysqli_fetch_assoc($resultado_1);
$nome_usuario = $linha_1['nome_usuario'];
$endereco_imagem_usuario = $linha_1['endereco_imagem_usuario'];

?>
<!DOCTYPE html>
<html lang="pt">
  
<head>
    <meta charset="UTF-8">
    <title>(C) CURSO</title>

    <!--Definindo icone da página-->
    <link rel="icon" href="../../_.imgs_default/logo_nebula.png">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Another Icon Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../.assets/css_home.css">
    <link rel="stylesheet" type="text/css" href="../../_.materialize/css/configs.css">
    
</head>

<body>

    <div id="mensagem" class="modal">
        <div class="modal-content justify">
        
            <h4 class="center-align">Mensagem</h4>

            <br>

            <h6 style='font-size:1.5em;'><?php echo $_SESSION['mensagem'];?></h6>

        </div>
        <div class='modal-footer'>
            <a href='#!' class='modal-close waves-effect waves-purple btn-flat'>ok</a>
        </div>
    </div>

    <div id="info" class="modal">
        <div class="modal-content justify" style="font-size:1.25em;">
        
            <p style="margin-bottom:0px;">O certificado é dedicado aos consumidores que concluíram o curso,
            contendo o <span class="bold">nome do consumidor</span>, o
            <span class="bold">nome do curso</span> e a <span class="bold">carga horária</span> do mesmo.
            Para que o certificado fique disponível para os consumidores, além de ter sido adicionado, é necessário que
            o curso possua forma de avaliação válida, sendo isso, no caso, questionário(s) válido(s).</p>

            <br>

            <p style="margin-top:13px;">Caso o curso possua certificado, no interior do botão de gerar certificado
            será mostrado o ícone: <i class="material-icons deep-purple-text" style="vertical-align: middle;">check</i></p>

            <p style="margin-bottom:0px;">Caso não possua, será mostrado: <i class="material-icons deep-purple-text" style="vertical-align: middle;">clear</i> e o botão estará desabilitado.</p>

            <br>

            <p style="margin-top:13px;">Caso o curso possua questionários válidos, ao lado do botão de gerar
            certificado será mostrado o ícone: <i class="material-icons deep-purple-text" style="vertical-align: middle;">check_circle</i></p>

            <p style="margin-bottom:0px;">Caso o curso não possua, será mostrado: <i class="material-icons deep-purple-text" style="vertical-align: middle;">cancel</i> e o botão estará desabilitado.</p>

            <br>

            <p style="margin-top:13px;">Caso você tenha realizado todos os questionários e alcançado uma nota maior ou igual a 70% em todos eles, ao lado da validação dos
            questionários será mostrado o ícone: <i class="material-icons deep-purple-text" style="vertical-align: middle;">lens</i></p>

            <p style="margin-bottom:0px;">Caso não, será mostrado: <i class="material-icons deep-purple-text" style="vertical-align: middle;">panorama_fish_eye</i> 
            e o botão estará desabilitado (caso o curso não possua questionários válidos, não será mostrado nada).</p>

            <br>

            <p style="margin-top:13px;">Ou seja, para ser possível gerar um certificado é necessário que o curso possua um certificado, que o mesmo seja válido (por meio dos questionários) e
              que você tenha os realizados e obtido a nota mínima (70%).</p>

        </div>
        <div class='modal-footer'>
            <a href='#!' class='modal-close waves-effect waves-purple btn-flat'>Ok</a>
        </div>
    </div>
    
    <div id="configs" class="modal">
        <div class="modal-content">
        
            <?php include "../../______usuarios/__U1_form_altera_usuario.php";?>

        </div>
    </div>
    <div id="excluir" class="modal">
        <div class="modal-content">
        
            <h5 class="center-align">Deseja realmente excluir sua conta?</h5>
            <br><br><br>

            <div class="center-align">

                <a href="../../______usuarios/_D1_excluir_usuario.php" class="modal-trigger waves-effect waves-light btn bold"
                style="background-color: #e53935 !important;">CONFIRMAR<i class="material-icons right">delete_forever</i>
                </a>

                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                <a href="#!" class="modal-close waves-effect waves-light btn bold"
                style="background-color: #212121 !important;">CANCELAR<i class="material-icons right">close</i>
                </a>

            </div>
            <br>

        </div>
    </div>

    <nav>
        <div class="nav-wrapper grey darken-4">

        <a href="CONS____home_consumidor.php" class="breadcrumb bold" style='margin-left:30px;'>HOME CONSUMIDOR</a>
        <a href="#!" class="breadcrumb bold">CURSO</a>

        <a href="CONS____home_consumidor.php" class="brand-logo center"><img src='../../_.imgs_default/logo_n2.png' height="70px" style="margin-top:10px;"></a>

        <ul class="right valign-wrapper" style="height:90px;">

            <a href="#" data-target="slide-out" class="sidenav-trigger" style="width:auto; height:90px;">
                <i class="material-icons" style="margin-top:13.5px">chevron_left</i>
                <div class="center-align" style="font-size:large; font-weight:500; margin-top:12px; width:auto;">
                    <?=$nome_usuario;?>
                </div>
                <div class="right">
                    <img style="border-radius: 100%; width: 50px; height: 50px; margin-top:19px; margin-left:13px;" src="<?= $endereco_imagem_usuario;?>">
                </div>
            </a>
    
        </ul>
        </div>
    </nav>

    <ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">

              <div class="background">
                <img src="../../_.imgs_default/nebulosas/1.png">
              </div>

              <a href="#user"><img class="circle" src="<?= $endereco_imagem_usuario;?>"></a>
              <a href="#name"><span class="white-text name"><?= $nome_usuario;?></span></a>
              <a href="#email"><span class="white-text email"><?= $_SESSION['email'];?></span></a>
            
            </div>
        </li>
        <li>
            <a href="#configs" class="modal-trigger waves-effect">Configurações de Conta
            <i class="material-icons right" style="margin:0px;">build</i></a>
        </li>
        <li>
            <a href='../produtor/PROD____home_produtor.php' class="waves-effect">Permutar Conta
            <i class="material-icons right" style="margin:0px;">sync</i></a>
        </li>
        <li>
            <a href='../../______usuarios/logout.php' class="waves-effect">Fazer Logout
            <i class="material-icons right" style="margin:0px;">exit_to_app</i></a>
        </li>

        <li><div class="divider"></div></li>

        <br> 
    </ul>

    <main class="container">	

        <br>
        <br>

        <?php 

            $id_curso= mysqli_real_escape_string($conexao,$_GET['id_curso']);

            $s = "SELECT email FROM relacao_usuario_curso WHERE id_curso=$id_curso AND tipo_relacao='produtor'";
            $r = mysqli_query($conexao, $s);
            $l = mysqli_fetch_assoc($r);

            $s1 = "SELECT * FROM usuarios WHERE email='".$l['email']."'";
            $r1 = mysqli_query($conexao, $s1);
            $l1 = mysqli_fetch_assoc($r1);

            //----------------------
            //obtenção dos dados do curso-
            $sql = "SELECT * FROM cursos WHERE id_curso=$id_curso";
            $resultado = mysqli_query($conexao,$sql); 

            while($linha = mysqli_fetch_assoc($resultado))
            {

                $nome_curso= $linha['nome_curso'];
                $descricao_curso = $linha['descricao_curso'];
                $endereco_imagem_curso = $linha['endereco_imagem_curso'];
                $certificado_curso = $linha['certificado_curso'];

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


            echo "
                <div class='col s12' style='padding:0px;'>
                    <div class='card meddium'>

                        <div class='card-image'>
                            <img src='$endereco_imagem_curso' style='filter: brightness(80%);' width='1200em' height='675em'>
                            <div class='card-title' style='width:100%; font-weight:400; font-size:3em; text-align: -webkit-center; backdrop-filter: brightness(70%)'>
                            $nome_curso
                            </div>
                        </div>
                        <div class='card-content'>
                            <h6 style='text-align: justify; font-size:1.5em;'>$descricao_curso</h6>
                        </div>

                        <div class='card-action' style='padding-bottom:0px;'>
                            <br>
                            <div class='row'>
                                <span>";

                                    if($certificado_curso=="sem-certificado" and !isset($id_alternativa_valida)){

                                        echo "<a href='#!' class='waves-effect waves-light bold btn disabled' style='color:#000; font-size:1.1em; vertical-align: middle; text-align:center;'>
                                                <i class='material-icons left' style='color:#000;'>clear</i>
                                                <span style='color:#000;'>GERAR CERTIFICADO</span>
                                                <i class='material-icons right' style='color:#000;'>chrome_reader_mode</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle; margin-left:8px;'>cancel</i>";

                                    }
                                    elseif($certificado_curso=="sem-certificado" and isset($id_alternativa_valida) and $validade=="não-baixável"){

                                        echo "<a href='#!' class='waves-effect waves-light bold btn disabled' style='color:#000; font-size:1.1em; vertical-align: middle; text-align:center;'>
                                                <i class='material-icons left' style='color:#000;'>clear</i>
                                                <span style='color:#000;'>GERAR CERTIFICADO</span>
                                                <i class='material-icons right' style='color:#000;'>chrome_reader_mode</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle; margin-left:8px;'>check_circle</i>
                                            <i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle;'>panorama_fish_eye</i>";

                                    }
                                    elseif($certificado_curso=="sem-certificado" and isset($id_alternativa_valida) and $validade=="baixável"){

                                        echo "<a href='#!' class='waves-effect waves-light bold btn disabled' style='color:#000; font-size:1.1em; vertical-align: middle; text-align:center;'>
                                                <i class='material-icons left' style='color:#000;'>clear</i>
                                                <span style='color:#000;'>GERAR CERTIFICADO</span>
                                                <i class='material-icons right' style='color:#000;'>chrome_reader_mode</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle; margin-left:8px;'>check_circle</i>
                                            <i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle;'>lens</i>";

                                    }
                                    
                                    elseif($certificado_curso!="certificado" and !isset($id_alternativa_valida)){

                                        echo "<a href='#!' class='waves-effect waves-light bold btn disabled' style='color:#000; font-size:1.1em; vertical-align: middle; text-align:center;'>
                                                <i class='material-icons left' style='color:#000;'>check</i>
                                                <span style='color:#000;'>GERAR CERTIFICADO</span>
                                                <i class='material-icons right' style='color:#000;'>chrome_reader_mode</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle; margin-left:8px;'>cancel</i>";

                                    }
                                    elseif($certificado_curso!="certificado" and isset($id_alternativa_valida) and $validade=="não-baixável"){

                                        echo "<a href='#!' class='waves-effect waves-light bold btn disabled' style='color:#000; font-size:1.1em; vertical-align: middle; text-align:center;'>
                                                <i class='material-icons left' style='color:#000;'>check</i>
                                                <span style='color:#000;'>GERAR CERTIFICADO</span>
                                                <i class='material-icons right' style='color:#000;'>chrome_reader_mode</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle; margin-left:8px;'>check_circle</i>
                                            <i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle;'>panorama_fish_eye</i>";

                                    }
                                    elseif($certificado_curso!="certificado" and isset($id_alternativa_valida) and $validade=="baixável"){

                                        echo "<a href='../../_____cursos/certificados_curso/gerar_certificado.php?id_curso=$id_curso' class='waves-effect waves-light bold btn black' style='color:#000; font-size:1.1em; vertical-align: middle; text-align:center;'>
                                                <i class='material-icons left' style='color:#FFF;'>check</i>
                                                <span style='color:#FFF;'>GERAR CERTIFICADO</span>
                                                <i class='material-icons right' style='color:#FFF;'>chrome_reader_mode</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle; margin-left:8px;'>check_circle</i>
                                            <i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle;'>lens</i>";

                                    }

                                    echo "<a href='#info' class='modal-trigger' style='color:#212121; vertical-align: middle; margin-left:5px;'><i class='material-icons' style='font-size:2.5em; vertical-align: middle;'>info</i></a>
                                </span>

                                <span class='right'>";

                                    if(isset($situacao_favorito_curso)){

                                        if($situacao_favorito_curso == "favorito"){
                        
                                            echo "<a href='../../_____cursos/favorito_curso.php?id_curso=$id_curso' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                                    <i class='fa fa-star' style='padding-bottom:15px;'></i>
                                                </a>";
                            
                                        } else {
                        
                                            echo "<a href='../../_____cursos/favorito_curso.php?id_curso=$id_curso' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                                    <i class='fa fa-star-o' style='padding-bottom:15px;'></i>
                                                </a>";
                        
                                        }
                        
                                    } else {
                        
                                        echo "<a href='../../_____cursos/favorito_curso.php?id_curso=$id_curso' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                                <i class='fa fa-star-o'></i>
                                            </a>";
                        
                                    }
    echo"                           

                                </span>
                            </div>
                            <div class='row' style='margin-bottom:0px; margin-top:15px; margin-left:0px; height:100%; width:100%;'>
                                <span class='right'>
                                    <span class='bold' style='vertical-align:middle; font-size:1.5em'>
                                        ".$l1['nome_usuario']."
                                    </span>
                                    <img src='".$l1['endereco_imagem_usuario']."' width='50px' height='50px' style='border-radius:100%; margin-left:10px; margin-right:5px; vertical-align:middle;'>
                                </span>
                            </div>
                        </div>
                    <br>
                    </div>
                </div>
                <br><br>
                ";

            echo "
                    <ul class='collapsible' 
                    style='border:1px solid #DCDCDC; border-radius:10px; 
                    box-shadow: 0 0 0 0 rgb(0 0 0), 0 0 0 -0 rgb(0 0 0), 0 0 0 0 rgb(0 0 0);'>
                    <li>
                        <div class='collapsible-header valign-wrapper' style='border:0px; border-radius:10px; border-color:#DCDCDC;'>
                            <div class='row valign-wrapper' style='margin:0px; width:100%;'>

                                <div class='col s12 valign-wrapper'>
                                    <i class='material-icons left' style='font-size:2.5em;'>arrow_drop_down</i>    
                                    <div style='font-size:2.5em; font-weight:500;'>Módulos</div> 
                                </div>

                            </div>
                        </div>
                        <div class='collapsible-body' style='border:0px; border-radius:10px;'>";
            if(isset($id_modulo) or isset($linha_1)){
            
                for($i=0 ; $i<count($id_modulo) ; $i++){

                    echo "
                    <div class='row' style='margin-bottom:30px; border-radius:10px;'>
                    <ul class='collapsible hoverable' style='border-radius:10px; border: 1.5px solid #7e57c2;'>
                        <li> 
                            <div class='collapsible-header' style='border-radius:10px; border:0px white;'>

                                <div class='col s3' style='margin-left:0px;'>
                                    <img src='".$endereco_imagem_modulo[$i]."' width='300em' height='169em' class='left' style='border-radius:4%;'>
                                </div>

                                <div class='col s1 valign-wrapper' style='margin-left:0px;'>
                                    <i class='material-icons' style='vertical-align: middle; font-size:3.2em !important;'>arrow_drop_down</i>
                                </div>

                                <div class='col s8 valign-wrapper' style='margin-left:0px; padding-left:0px;'>
                                    <span style='font-size:2em; font-weight:400;'>" . $nome_modulo[$i] . "
                                    </span>
                                </div>
                                
                                <div class='col s1 valign-wrapper' style='margin-left:0px;'>";

                                $sqli_2[$i] = "SELECT * FROM favoritos_modulo WHERE email='$email' AND id_modulo=".$id_modulo[$i];
                                $resultadoi_2[$i] = mysqli_query($conexao, $sqli_2[$i]);

                                if($resultadoi_2[$i] == true){

                                    if($linhai_2[$i] = mysqli_fetch_assoc($resultadoi_2[$i])){

                                        $situacao_favorito_modulo[$i] = $linhai_2[$i]['situacao_favorito_modulo'];

                                    }

                                }

                                if(isset($situacao_favorito_modulo[$i])){

                                    if($situacao_favorito_modulo[$i] == "favorito"){

                                        echo "<a href='../../____modulos/favorito_modulo.php?id_modulo=".$id_modulo[$i]."' style='vertical-align: middle; color:#212121;'>
                                                <i class='fa fa-star' style='font-size:2.3em !important;'></i>
                                              </a>";

                                    } else {

                                        echo "<a href='../../____modulos/favorito_modulo.php?id_modulo=".$id_modulo[$i]."' style='vertical-align: middle; color:#212121;'>
                                                <i class='fa fa-star-o' style='font-size:2.3em !important;'></i>
                                              </a>";

                                    }

                                } else {

                                    echo "<a href='../../____modulos/favorito_modulo.php?id_modulo=".$id_modulo[$i]."' style='vertical-align: middle; color:#212121;'>
                                            <i class='fa fa-star-o' style='font-size:2.3em !important;'></i>
                                          </a>";

                                }

                echo"           </div>
                            </div>
                            <div class='collapsible-body' style='border-radius:10px;'>
                                
                                <div class='justify'>
                                    <span style='font-size:1.3em;'>" . $descricao_modulo[$i] . "<br><br></span>
                                </div>

                                <hr style='border-color:#ffffff8a; width:100%; margin-top:5px; margin-bottom:8px;'>
                                <br>

                                <div class='card-action'>                                    
                        ";

                        if(isset($id_aula[$i])){

                            for($j=0 ; $j<count($id_aula[$i]) ; $j++){

                                echo "
                                    <div class='row' style='margin-bottom:20px; border: 1px solid #9575cd; border-radius:10px;'>
                                        <div class='col s12 hoverable' style='padding-left:35px; padding-top:10px; padding-bottom:10px; border-radius:10px;'> 
                                            <div class='col s1 valign-wrapper' style='margin:0px; padding:0px; height:112.5px;'>";

                                                $sq[$i][$j] = "SELECT * FROM questionarios WHERE id_aula=".$id_aula[$i][$j];
                                                $result[$i][$j] = mysqli_query($conexao, $sq[$i][$j]);
                                                $l[$i][$j] = mysqli_fetch_assoc($result[$i][$j]);
                                                
                                                if(isset($l[$i][$j])){
                                                    $id_questionario1[$i][$j][] = $l[$i][$j]['id_questionario'];
                                                }

                                                $sqlij[$i][$j] = "SELECT * FROM favoritos_aula WHERE email='$email' AND id_aula=".$id_aula[$i][$j];
                                                $resultadoij[$i][$j] = mysqli_query($conexao, $sqlij[$i][$j]);
                
                                                if($resultadoij[$i][$j] == true){
                
                                                    if($linhaij[$i][$j] = mysqli_fetch_assoc($resultadoij[$i][$j])){
                
                                                        $situacao_favorito_aula[$i][$j] = $linhaij[$i][$j]['situacao_favorito_aula'];
                
                                                    }
                
                                                }

                                                if(isset($situacao_favorito_aula[$i][$j])){

                                                    if($situacao_favorito_aula[$i][$j] == "favorito"){
                
                                                        echo "<a href='../../___aulas/favorito_aula.php?id_aula=".$id_aula[$i][$j]."' style='color:#000; margin-right:20px;''>
                                                                <i class='fa fa-star fa-2x'></i>
                                                              </a>";
                
                                                    } else {
                
                                                        echo "<a href='../../___aulas/favorito_aula.php?id_aula=".$id_aula[$i][$j]."'style='color:#000; margin-right:20px;'>
                                                                <i class='fa fa-star-o fa-2x'></i>
                                                              </a>";
                
                                                    }
                
                                                } else {
                
                                                    echo "<a href='../../___aulas/favorito_aula.php?id_aula=".$id_aula[$i][$j]."' style='color:#000; margin-right:20px;''>
                                                            <i class='fa fa-star-o fa-2x'></i>
                                                          </a>";
                
                                                }

                                                if(isset($id_questionario1[$i][$j]) and isset($id_questionario_valido)){

                                                    $u = array_intersect($id_questionario1[$i][$j], $id_questionario_valido);

                                                    if(isset($u)){

                                                        echo "                                                           
                                                            <div id='info_quest__$i".'_'."$j' class='modal'>
                                                                <div class='modal-content'>  
                                                                    <br><br>                                                    
                                                                    <h6 class='center' style='font-size:1.5em;'>
                                                                        A aula <span class='bold'>".$nome_aula[$i][$j]."</span> possui questionário. 
                                                                    </h6>
                                                                </div>

                                                                <div class='modal-footer'>
                                                                    <a href='#!' class='modal-close waves-effect waves-purple btn-flat'>Ok</a>
                                                                </div>
                                                            </div>
                                                        
                                                            <a class='modal-trigger' href='#info_quest__$i".'_'."$j' style='color:#000;'>
                                                                <i class='fa fa-question-circle-o' style='font-size:1.4em;'></i>
                                                            <a>";
                                                    }

                                                }
                                               
                    echo "
                                            </div>

                                            <a href='CONS__tela_aula_consumidor.php?id_aula=".$id_aula[$i][$j]."' style='color:#000;'>
                                                <div class='col s8 center-align valign-wrapper' style='margin:0px; padding:0px; height:112.5px;'>
                                                    <span style='font-size:1.5em;'>".$nome_aula[$i][$j]."</span>
                                                </div>
                                                <div class='col s3 right-align' style='margin:0px; padding:0px; height:112.5px;'>                     
                                                    <img src='".$endereco_imagem_aula[$i][$j]."' width='190em' height='112.5em' style='border-radius:4%;'>
                                                    <i class='material-icons right valign-wrapper' style='height:112.5px;'>play_circle_filled</i>
                                                </div>
                                            </a>
                                            
                                        </div>
                                    </div>
                                ";
                                                                                                                       
                            }

                        } else {

                            echo "<div style='font-size:1.4em; font-weight:500;'>Não existem aulas cadastradas neste módulo.</div><br>";

                        }      
                        
echo "
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                        ";

                }

            } else {

                echo "<div style='font-size:1.8em; font-weight:500;'>Não existem módulos cadastrados neste curso.</div><br><br>";

            }

            echo "
                                    </div>
                                    </li>
                                </ul>";
        ?>
    <br>
    <br>
    <div class='center-align'>
        <a href='CONS____home_consumidor.php' class='waves-effect waves-light btn deep-purple bold' style='font-size:1.1em;'>
            Voltar<i class='material-icons left'>keyboard_backspace</i>
        </a>    
    </div>
    </main>
    <br>
    <br>
    <br>
    <footer class="page-footer grey darken-4" style="padding-top:10px;">
        <div class="container">
        <div class="row" style="margin-bottom:0px;">
            <div class="col s11">
            <h5 class="grey-text text-lighten-4">TRABALHO DE CONCLUSÃO DE CURSO</h5>
            <p class="grey-text text-lighten-2" style="font-size:1.4em;">Sistema de acesso e manutenção de cursos online.</p>
            </div>
            <div class="col s1" style="height:117px;">
            <ul class="right-align">
                <li style="padding-bottom:7px;"><img src="../../_.imgs_default/logo_iffar.png" width="60px" height="91px"></li>
            </ul>
            </div>
        </div>
        </div>
        <div class="footer-copyright grey darken-4" style="padding-top:0px">
        <div class="container">
        © 2022 NEBULA
        <div class="grey-text text-lighten-4 right right-align" href="#!">Todos os direitos reservados</div>
        </div>
        </div>
    </footer>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $('.sidenav').sidenav({
            edge: 'right'
        });

        $('.modal').modal();

        <?php
        if(isset($_SESSION['mensagem'])){
            echo "$('#mensagem').modal('open');"; 
            unset($_SESSION['mensagem']);
        }
        ?>

        $('.collapsible').collapsible();

        });

        function validarSenha() {
            senha = document.getElementById("senha").value;
            rs = document.getElementById("confirmar_senha");
            repetirSenha = document.getElementById("confirmar_senha").value;

            if (senha == repetirSenha) {
                
                rs.setCustomValidity('');
                rs.checkValidity();
                return true;

            } else {

                rs.setCustomValidity('As senhas não conferem');
                rs.checkValidity();
                rs.reportValidity();
                return false;

            }
        }

        function previewImagem(){
            let imagem = document.querySelector('input[name=endereco_imagem_usuario]').files[0];
            let preview = document.querySelector('#imagem_usuario');

            let reader = new FileReader();

            reader.onloadend = function(){

                preview.src=reader.result;

            }

            if(imagem){

                reader.readAsDataURL(imagem);

            } else {

                preview.src="";

            }
        }

        function previewImagemEditar(){
            let imagem = document.querySelector('input[id=endereco_imagem_curso_edicao]').files[0];
            let preview = document.querySelector('#imagem_curso_edicao');
            let preview1 = document.querySelector('#imagem_curso_edicao_1');

            let reader = new FileReader();

            reader.onloadend = function(){

                preview.src=reader.result;
                preview1.src=reader.result;

            }

            if(imagem){

                reader.readAsDataURL(imagem);

            } else {

                preview.src="";
                preview1.src="";

            }
        }

        function mostrar() {
            var senha = document.getElementById("senha");
            if (senha.type === "password") {
                senha.type = "text";
            } else {
                senha.type = "password";
            }
        }
        function mostrar_confirmacao() {
            var senha = document.getElementById("confirmar_senha");
            if (senha.type === "password") {
                senha.type = "text";
            } else {
                senha.type = "password";
            }
        }
        
    </script>
    
</body>

</html>