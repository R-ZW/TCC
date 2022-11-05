<?php
session_start();
require_once "../../_______necessarios/.conexao_bd.php";
require_once "../../_______necessarios/.funcoes.php";

if (!isset($_SESSION['id_usuario'])) {
$_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
header("Location: ../entrada.php");
}

$email= $_SESSION['email'];
$id_aula= mysqli_real_escape_string($conexao,$_GET['id_aula']);

$sql_1 = "SELECT * FROM usuarios WHERE id_usuario='".$_SESSION['id_usuario']."'";
$resultado_1 = mysqli_query($conexao, $sql_1);
$linha_1 = mysqli_fetch_assoc($resultado_1);
$nome_usuario = $linha_1['nome_usuario'];
$endereco_imagem_usuario = $linha_1['endereco_imagem_usuario'];

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
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>(C) AULA</title>
    
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
        <a href="CONS___tela_curso_consumidor.php?id_curso=<?=$id_curso;?>" class="breadcrumb bold">CURSO</a>
        <a href="#!" class="breadcrumb bold">AULA</a>

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
            
            //----------------------
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
            $sql_1 = "SELECT * FROM materiais WHERE visibilidade_material='visível' AND id_aula=$id_aula";
            $resultado_1 = mysqli_query($conexao,$sql_1); 

            while($linha_1 = mysqli_fetch_assoc($resultado_1))
            {

                $id_material[] = $linha_1['id_material'];
                $nome_material[] = $linha_1['nome_material'];
                $endereco_material[] = $linha_1['endereco_material'];

            }
            //-


            //obtendo os questionários da aula-
            $sql_2 = "SELECT id_questionario FROM questionarios WHERE visibilidade_questionario='visível' AND id_aula=$id_aula";
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


            //obtendo os dados de favorito do curso para com o usuário-
            $sql_3 = "SELECT * FROM favoritos_aula WHERE email='$email' AND id_aula=$id_aula";
            $resultado_3 = mysqli_query($conexao, $sql_3);

            if($resultado_3 == true){

                if($linha_3 = mysqli_fetch_assoc($resultado_3)){

                    $situacao_favorito_aula = $linha_3['situacao_favorito_aula'];

                }

            }
            //-
            //----------------------

            echo "
                <div class='col s12' style='padding:0px;'>
                    <div class='card meddium'>

                        <div class='card-image'>
                            <img src='$endereco_imagem_aula' style='filter: brightness(80%);' width='1200em' height='675em'>
                            <div class='card-title' style='width:100%; font-weight:400; font-size:3em; text-align: -webkit-center; backdrop-filter: brightness(70%)'>
                            $nome_aula
                            </div>
                        </div>
                        <div class='card-content'>
                            <h6 style='text-align: justify; font-size:1.5em;'>$descricao_aula</h6>
                        </div>

                        <div class='card-action' style='padding-bottom:27px;'>
                            <br>
                            <span class='right'>";

                            if(isset($situacao_favorito_aula)){

                                if($situacao_favorito_aula == "favorito"){
                
                                    echo "<a href='../../___aulas/favorito_aula.php?id_aula=$id_aula' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                            <i class='fa fa-star' style='padding-bottom:15px;'></i>
                                        </a>";
                    
                                } else {
                
                                    echo "<a href='../../___aulas/favorito_aula.php?id_aula=$id_aula' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                            <i class='fa fa-star-o' style='padding-bottom:15px;'></i>
                                        </a>";
                
                                }
                
                            } else {
                
                                echo "<a href='../../___aulas/favorito_aula.php?id_aula=$id_aula' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                        <i class='fa fa-star-o'></i>
                                    </a>";
                
                            }
echo"                           

                            </span>
                            <br>
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
                                <div style='font-size:2.5em; font-weight:500;'>Materiais</div> 
                            </div>
                            
                        </div>
                    </div>
                    <div class='collapsible-body' style='border:0px; border-radius:10px;'>";
            if(isset($id_material)){

                for($i=0 ; $i<count($id_material) ; $i++){

                    $arq= explode(".",$endereco_material[$i]);
                    $ext= $arq[count($arq)-1];

                    echo "
                        <div class='row' style='margin-bottom:20px; border: 1px solid #9575cd; border-radius:10px;'>
                            <div class='col s12 hoverable' style='padding-top:10px; padding-left:30px; padding-bottom:10px; border-radius:10px;'>";
            
                    if($ext == "mp4"){

                        echo " 
                                <div id='video_$i' class='modal'>
                                    <div class='modal-content'>
                                
                                        <h4 class='center-align bold'>".$nome_material[$i]."</h4>
                                        <br>
                            
                                        <div class='center-align'>
                            
                                            <video width='100%' controls>
                                                <source src='".$endereco_material[$i]."' type='video/mp4'>
                                            </video>
                            
                                        </div>
                                        
                                        <br>

                                        <div class='center'>
                                            <div class='btn modal-close black bold'>
                                                Fechar <i class='material-icons right'>close</i>    
                                            </div>
                                            </a>
                                        </div>

                                        <br>
                                        
                                    </div>
                                </div>
                                <a class='modal-trigger' href='#video_$i'>
                                    <div class='col s11 valign-wrapper' style='margin:0px; padding:0px; height:42px; color:#000;'>
                                        <span style='font-size:1.5em;'>".$nome_material[$i]."</span>
                                    </div>
                                    <div class='col s1 center valign-wrapper btn btn-floating deep-purple' style='margin:0px; padding:0px; width:3em; height:3em;'>
                                        <i class='material-icons'>open_in_new</i>
                                    </div>
                                </a>
                            ";

                    } elseif($ext == "jpg" or $ext == "jpeg" or $ext == "png" or $ext == "gif" or $ext == "webp" or $ext == "psd"){

                        echo "
                                <div id='imagem_$i' class='modal'>
                                    <div class='modal-content'>
                                
                                        <h4 class='center-align bold'>".$nome_material[$i]."</h4>
                                        <br>
                            
                                        <div class='center-align'>
                            
                                            <img src='".$endereco_material[$i]."' class='materialboxed' width='100%'>
                            
                                        </div>

                                        <br>
                                        
                                        <div class='center'>
                                            <a href='".$endereco_material[$i]."' download>
                                                <div class='btn btn-floating deep-purple'>
                                                    <i class='material-icons'>download</i>    
                                                </div>
                                            </a>
                                        </div>

                                        <br>

                                        <div class='center'>
                                            <div class='btn modal-close black bold'>
                                                Fechar <i class='material-icons right'>close</i>    
                                            </div>
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>                                
                                <a class='modal-trigger' href='#imagem_$i'>
                                    <div class='col s11 valign-wrapper' style='margin:0px; padding:0px; height:42px; color:#000;'>
                                        <span style='font-size:1.5em;'>".$nome_material[$i]."</span>
                                    </div>
                                    <div class='col s1 center valign-wrapper btn btn-floating deep-purple' style='margin:0px; padding:0px; width:3em; height:3em;'>
                                        <i class='material-icons'>open_in_new</i>
                                    </div>
                                </a>
                            ";                

                    } else {
                
                        echo "
                                <a href='".$endereco_material[$i]."' target='_blank'>
                                    <div class='col s11 valign-wrapper' style='margin:0px; padding:0px; height:42px; color:#000;'>
                                        <span style='font-size:1.5em;'>".$nome_material[$i]."</span>
                                    </div>
                                    <div class='col s1 center valign-wrapper btn btn-floating deep-purple' style='margin:0px; padding:0px; width:3em; height:3em;'>
                                        <i class='material-icons'>download</i>
                                    </div>
                                </a>
                        ";
                    }

                    echo "                            
                            </div>
                        </div>
                    ";
                }

            } else {

                echo "<div style='font-size:1.8em; font-weight:500;'>Não existem materiais cadastrados nesta aula</div><br><br>";

            }
        echo "
                </li>
            </ul>
        </div>
        <br>
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
                                <div style='font-size:2.5em; font-weight:500;'>Questionários</div> 
                            </div>

                        </div>
                    </div>
                    <div class='collapsible-body' style='border:0px; border-radius:10px;'>";

            if(isset($id_questionario_valido) or isset($linhad)){

                for($i=0 ; $i<count($id_questionario_valido) ; $i++){

                    $sqli[$i] = "SELECT * FROM relacao_usuario_questionario WHERE email='$email' AND id_questionario=".$id_questionario_valido[$i];
                    $resultadoi[$i] = mysqli_query($conexao,$sqli[$i]);
                    $linhai[$i] = mysqli_fetch_assoc($resultadoi[$i]);

                    if(isset($linhai[$i])){
                        $nota_questionario[$i] = $linhai[$i]['nota_usuario'];
                    }
                    echo "
                        <div class='row' style='margin-bottom:20px; border: 1px solid #9575cd; border-radius:10px;'>
                            <div class='col s12 hoverable' style='padding-top:10px; padding-left:30px; padding-bottom:10px; border-radius:10px;'>";
                            
                            if($nota_questionario[$i] >= 70){

                                echo "
                                <div id='confirmar_$i' class='modal'>
                                    <div class='modal-content'>  
                                        <h4 class='center'>Confirmar</h4><br>                                     
                                        <h6 style='font-size:1.5em;' class='justify'>
                                            Você já realizou e <span style='color:#388e3c;'>conseguiu a nota requerida</span> no questionário
                                            <span class='bold'>".$nome_questionario[$i]."</span>, deseja realizá-lo novamente? Caso sim, a nota computada será a mais recente. 
                                        </h6><br>
                                        <div class='right-align'>

                                        <a href='#!' class='modal-close waves-effect waves-light btn bold'
                                        style='background-color: #212121 !important;'>CANCELAR<i class='material-icons right'>close</i>
                                        </a>

                                        <a href='CONS_tela_questionario_consumidor_1.php?id_questionario=".$id_questionario_valido[$i]."' class='modal-trigger waves-effect waves-light btn bold'
                                        style='background-color: #212121 !important;'>SIM<i class='material-icons right'>check</i>
                                        </a>
                                        
                                        </div>
                                    </div>
                                </div>

                                <a class='modal-trigger' href='#confirmar_$i'>
                                    <div class='col s11 valign-wrapper' style='margin:0px; padding:0px; height:42px; color:#000;'>
                                        <span style='font-size:1.5em;'>".$nome_questionario[$i]."</span>
                                    </div>
                                    <div class='col s1 center valign-wrapper btn btn-floating green darken-2' style='margin:0px; padding:0px; width:3em; height:3em;'>
                                        <i class='material-icons'>check</i>
                                    </div>
                                ";

                            } else {

                                echo "
                                <a class='modal-trigger' href='CONS_tela_questionario_consumidor_1.php?id_questionario=".$id_questionario_valido[$i]."'>
                                    <div class='col s11 valign-wrapper' style='margin:0px; padding:0px; height:42px; color:#000;'>
                                        <span style='font-size:1.5em;'>".$nome_questionario[$i]."</span>
                                    </div>
                                    <div class='col s1 left valign-wrapper btn btn-floating red darken-2' style='margin:0px; padding:0px; width:3em; height:3em;'>
                                        <i class='material-icons'>close</i>
                                    </div>
                                ";

                            }

                echo "   
                                    <div class='col s1 right valign-wrapper btn btn-floating deep-purple' style='margin:0px; padding:0px; width:3em; height:3em;'>
                                        <i class='material-icons'>chevron_right</i>
                                    </div>
                                </a>
                            </div>
                        </div>";

                }

            } else {

                echo "<div style='font-size:1.8em; font-weight:500;'>Não existem questionários válidos cadastrados nesta aula</div><br><br>";

            }
        echo "
                </li>
                </ul>
            </div>
        ";        
        ?>
        <br>
        <br>
        <div class='center-align'>
            <a href='CONS___tela_curso_consumidor.php?id_curso=<?=$id_curso;?>' class='waves-effect waves-light btn deep-purple bold' style='font-size:1.1em;'>
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

        $('.materialboxed').materialbox();

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