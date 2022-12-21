<?php
session_start();
require_once "../../_______necessarios/.conexao_bd.php";
require_once "../../_______necessarios/.funcoes.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../entrada.php");
    die;
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
    <title>(P) AULA</title>

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

        <a href="PROD____home_produtor.php" class="breadcrumb bold" style='margin-left:30px;'>HOME PRODUTOR</a>
        <a href="PROD___tela_curso_produtor.php?id_curso=<?=$id_curso;?>" class="breadcrumb bold">CURSO</a>
        <a href="#!" class="breadcrumb bold">AULA</a>

        <a href="PROD____home_produtor.php" class="brand-logo center"><img src='../../_.imgs_default/logo_n2.png' height="70px" style="margin-top:10px;"></a>

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
            <a href='../consumidor/CONS____home_consumidor.php' class="waves-effect">Permutar Conta
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

            //obtenção dos dados da aula-
            $sql = "SELECT * FROM aulas WHERE id_aula=$id_aula";
            $resultado = mysqli_query($conexao,$sql); 

            while($linha = mysqli_fetch_assoc($resultado))
            {

                $nome_aula= $linha['nome_aula'];
                $descricao_aula = $linha['descricao_aula'];
                $endereco_imagem_aula = $linha['endereco_imagem_aula'];
                $visibilidade_aula = $linha['visibilidade_aula'];

            } 
            //-


            //obtenção dos materiais-
            $sql_1 = "SELECT * FROM materiais WHERE id_aula=$id_aula";
            $resultado_1 = mysqli_query($conexao,$sql_1); 

            while($linha_1 = mysqli_fetch_assoc($resultado_1))
            {

                $id_material[] = $linha_1['id_material'];
                $nome_material[] = $linha_1['nome_material'];
                $endereco_material[] = $linha_1['endereco_material'];
                $visibilidade_material[] = $linha_1['visibilidade_material'];

            }
            //-


            //obtenção dos questionários-
            $sql_2 = "SELECT * FROM questionarios WHERE id_aula=$id_aula";
            $resultado_2 = mysqli_query($conexao,$sql_2);

            $var=0;
            while($linha_2 = mysqli_fetch_assoc($resultado_2))
            {

                $id_questionario[] = $linha_2['id_questionario'];
                $nome_questionario[] = $linha_2['nome_questionario'];
                $distribuicao_questoes[] = $linha_2['distribuicao_questoes'];
                $visibilidade_questionario[] = $linha_2['visibilidade_questionario'];

                $tempo[$var]= explode("-",$linha_2['tempo_proxima_realizacao']);
                $tempo_numero[$var]= $tempo[$var][0];
                $tempo_unidade[$var]= $tempo[$var][1];

                $var++;

            }
            //-

            echo "
                <script>
                    function previewImagemAulaEdicao(){
                        let imagem = document.querySelector('input[id=endereco_imagem_aula_edicao]').files[0];
                        let preview = document.querySelector('#imagem_aula_edicao');
                        let preview1 = document.querySelector('#imagem_aula_edicao_1');
            
                        let reader = new FileReader();
            
                        reader.onloadend = function(){
            
                            preview.src=reader.result;
                            preview1.src=reader.result;
            
                        }
            
                        if(imagem){
            
                            reader.readAsDataURL(imagem);
            
                        } else {
            
                            preview.src=".'""'.";
                            preview1.src=".'""'.";
            
                        }
                    }
                </script>

                <div id='excluir_aula' class='modal'>
                    <div class='modal-content'>
                
                        <h5 class='center-align'>Deseja realmente excluir a aula <span class='bold'>$nome_aula</span>?</h5>
                        <br><br><br>
            
                        <div class='center-align'>
            
                            <a href='../../___aulas/_D1_excluir_aula.php?id_aula=$id_aula' class='modal-trigger waves-effect waves-light btn bold'
                            style='background-color: #e53935 !important;'>CONFIRMAR<i class='material-icons right'>delete_forever</i>
                            </a>
            
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            
                            <a href='#!' class='modal-close waves-effect waves-light btn bold'
                            style='background-color: #212121 !important;'>CANCELAR<i class='material-icons right'>close</i>
                            </a>
            
                        </div>

                        <br>
                        
                    </div>
                </div>
                <div id='editar_aula' class='modal'>
                    <div class='modal-content'>

                    <form action='../../___aulas/__U2_altera_aula.php' method='post' id='editar_aula' enctype='multipart/form-data'>

                        <h4 class='center-align'>Editar Aula</h4><br>
                
                        <h6 class='bold'>Nome da aula:<i class='material-icons right'>border_color</i></h6>
                        <input id='field' type='text' name='nome_aula' value='$nome_aula' placeholder='insira o nome do aula' required>
                
                        <br>
                        <br>
                
                        <h6 class='bold'>Descrição da aula:<i class='material-icons right'>subject</i></h6>
                        <div class='input-field'>
                        <textarea id='field' type='text' name='descricao_aula' placeholder='insira a descrição do aula' class='materialize-textarea' style='text-align:justify' required>$descricao_aula</textarea>
                        </div>
                
                        <h6 class='bold'>Imagem da aula (16x9):<i class='material-icons right'>image</i></h6>
                
                        <div class='file-field'>
                            <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                <input id='endereco_imagem_aula_edicao' name='endereco_imagem_aula' type='file' style='text-align: -webkit-center;' accept='image/*' onchange='previewImagemAulaEdicao()'>
                            </div>
                        </div>
                
                        <br>
                        <br>
                        <br>
                        <h6 class='bold center-align' style='font-style:italic;'>preview da tela de curso:</h6>
            
                        <div class='row' style='margin-bottom:20px; border: 1px solid #9575cd; border-radius:10px;'>
                            <div class='col s12 hoverable' style='padding-top:10px; padding-bottom:10px; border-radius:10px;'> 
                                <div class='col s9 center-align valign-wrapper' style='margin:0px; padding:0px; height:112.5px;'>
                                    <span style='font-size:1.5em;'>[*nome da aula*]</span>
                                </div>
                                <div class='col s3 right-align' style='margin:0px; padding:0px; height:112.5px;'>
                                    <img id='imagem_aula_edicao' src='$endereco_imagem_aula' width='190em' height='112.5em' style='border-radius:4%;'>
                                    <i class='material-icons right valign-wrapper' style='height:112.5px;'>play_circle_filled</i>
                                </div>
                            </div>
                        </div>

                        <br>
                        <h6 class='bold center-align' style='font-style:italic;'>preview da tela de aula:</h6>
                        <div class='col s12' style='padding:0px;'>
                            <div class='card meddium'>

                                <div class='card-image'>
                                    <img id='imagem_aula_edicao_1' src='$endereco_imagem_aula' style='filter: brightness(80%);' width='900em' height='506.25em'>
                                    <div class='card-title' style='width:100%; font-weight:400; font-size:2em; text-align: -webkit-center; backdrop-filter: brightness(70%)'>
                                        [*nome da aula*]
                                    </div>
                                </div>

                                <div class='card-content'>
                                    <h6 style='text-align: justify; font-size:1.5em;'>[*descrição da aula*]</h6>
                                </div>

                            </div>
                            <br>
                        </div>                                                                                                    
                
                        <h6 class='bold'>Visibilidade da aula: <i class='material-icons right'>remove_red_eye</i></h6><br>
                
                        <div class='switch'>
            
                            <label>

                                <h6 class='bold'>Não visível";
                                
                                    if($visibilidade_aula == "não-visível"){

                                        echo "<input type='checkbox' id='visibilidade_aula' name='visibilidade_aula' value='1'>";

                                    } else {

                                        echo "<input type='checkbox' id='visibilidade_aula' name='visibilidade_aula' value='1' checked>";

                                    }
                                
        echo "

                                <span class='lever'></span>

                                Visível</h6>

                            </label>
                            
                        </div>
                
                        <input type='hidden' name='id_aula' value='$id_aula'>
                        <input type='hidden' name='endereco_imagem_aula_pre_alteracao' value='$endereco_imagem_aula'>
                
                        <br>
                        <br>
                
                        <div class='right'>
                
                            <a href='#!' class='modal-close waves-effect waves-light btn bold'
                            style='background-color: #212121 !important;'>cancelar<i class='material-icons right'>close</i>
                            </a>
                
                            <button type='submit' class='waves-effect waves-light btn bold'
                            style='background-color: #212121 !important;'>ENVIAR<i class='material-icons right'>check</i>
                            </button>
                
                            <br>
                            <br>
                
                        </div> 
                    </form>
                    </div>
                </div>

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
                            <span class='right'>
                                <a href='#editar_aula' class='modal-trigger' style='color:#212121; vertical-align: top;'>
                                    <i class='material-icons' style='font-size:2.5em !important; vertical-align: middle;'>edit</i>
                                </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                                <a href='#excluir_aula' class='modal-trigger' style='color:#212121; vertical-align: top;'>
                                    <i class='material-icons' style='font-size:2.5em !important; vertical-align: middle;'>delete</i>
                                </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";

                                if($visibilidade_aula == "visível"){

                                    echo "<a href='../../___aulas/inversao_situacao_visibilidade_aula.php?id_aula=$id_aula' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                            <i class='fa fa-eye' style='padding-bottom:15px;'></i>
                                            </a>";
                    
                                } else {
                    
                                    echo "<a href='../../___aulas/inversao_situacao_visibilidade_aula.php?id_aula=$id_aula' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                            <i class='fa fa-eye-slash style='vertical-align: text-bottom;'></i>
                                            </a>";
                                    
                                }

        echo "              </span>
                            <br>
                        </div>
                        <br>
                    </div>
                </div>
                <br><br>
            ";

            echo "
                    <div id='criar_material' class='modal'>
                        <div class='modal-content'>

                        <form action='../../__materiais/____C2_insere_material.php' method='post' id='criar_material' enctype='multipart/form-data'>

                            <h4 class='center-align'>Criar Material</h4><br>
                    
                            <h6 class='bold'>Nome do material:<i class='material-icons right'>border_color</i></h6>
                            <input id='field' type='text' name='nome_material' placeholder='insira o nome do material' required>
                    
                            <br>
                            <br>
                    
                    
                            <h6 class='bold'>Material:<i class='material-icons right'>file</i></h6>
                    
                            <div class='file-field'>
                                <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                    <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                    <input id='endereco_material' name='endereco_material' type='file' style='text-align: -webkit-center;' required>
                                </div><br><br><br>
                                <div class='file-path-wrapper' style='width:100%';>
                                    <input class='file-path field' id='disabled' type='text'>
                                </div>
                            </div>
                    
                            <br>
                            <h6 class='bold'>Visibilidade do material:<i class='material-icons right'>remove_red_eye</i></h6>
                            <br>
                            
                            <div class='switch'>
                
                                <label>

                                    <h6 class='bold'>Não visível
                                    
                                    <input type='checkbox' id='visibilidade_material' name='visibilidade_material' value='1' checked>

                                    <span class='lever'></span>

                                    Visível</h6>

                                </label>
                                
                            </div>
                    
                            <input type='hidden' name='id_aula' value='$id_aula'>
                    
                            <br>
                            <br>
                    
                            <div class='right'>
                    
                                <a href='#!' class='modal-close waves-effect waves-light btn bold'
                                style='background-color: #212121 !important;'>cancelar<i class='material-icons right'>close</i>
                                </a>
                    
                                <button type='submit' class='waves-effect waves-light btn bold'
                                style='background-color: #212121 !important;'>ENVIAR<i class='material-icons right'>check</i>
                                </button>
                    
                                <br>
                                <br>
                    
                            </div> 
                        </form>
                        </div>
                    </div>
                    <ul class='collapsible' 
                    style='border:1px solid #DCDCDC; border-radius:10px; 
                    box-shadow: 0 0 0 0 rgb(0 0 0), 0 0 0 -0 rgb(0 0 0), 0 0 0 0 rgb(0 0 0);'>
                    <li>
                        <div class='collapsible-header valign-wrapper' style='border:0px; border-radius:10px; border-color:#DCDCDC;'>
                            <div class='row valign-wrapper' style='margin:0px; width:100%;'>

                                <div class='col s9 valign-wrapper'>
                                    <i class='material-icons left' style='font-size:2.5em;'>arrow_drop_down</i>    
                                    <div style='font-size:2.5em; font-weight:500;'>Materiais</div> 
                                </div>

                                <div class='col s3 center'>
                                    <a href='#criar_material' class='modal-trigger'>
                                        <div class='waves-effect waves-light btn deep-purple bold' style='font-size:1.1em;'>
                                            ADICIONAR MATERIAL<i class='material-icons left' style='margin-right:8px;'>add</i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class='collapsible-body' style='border:0px; border-radius:10px;'>";

            if(isset($id_material)){

                for($i=0 ; $i<count($id_material) ; $i++){

                    $arq= explode(".",$endereco_material[$i]);
                    $ext= $arq[count($arq)-1];

                    echo "
                        <div id='excluir_material_$i' class='modal'>
                            <div class='modal-content'>
                        
                                <h5 class='center-align'>Deseja realmente excluir o material <span class='bold'>".$nome_material[$i]."</span>?</h5>
                                <br><br><br>
                    
                                <div class='center-align'>
                    
                                    <a href='../../__materiais/_D1_excluir_material.php?id_material=".$id_material[$i]."' class='modal-trigger waves-effect waves-light btn bold'
                                    style='background-color: #e53935 !important;'>CONFIRMAR<i class='material-icons right'>delete_forever</i>
                                    </a>
                    
                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    
                                    <a href='#!' class='modal-close waves-effect waves-light btn bold'
                                    style='background-color: #212121 !important;'>CANCELAR<i class='material-icons right'>close</i>
                                    </a>
                    
                                </div>

                                <br>
                                
                            </div>
                        </div>
                        <div id='editar_material_$i' class='modal'>
                            <div class='modal-content'>

                            <form action='../../__materiais/__U2_altera_material.php' method='post' id='editar_material' enctype='multipart/form-data'>

                                <h4 class='center-align'>Editar Material</h4><br>
                        
                                <h6 class='bold'>Nome do material:<i class='material-icons right'>border_color</i></h6>
                                <input id='field' type='text' name='nome_material' value='".$nome_material[$i]."' placeholder='insira o nome do material'>
                        
                                <br>
                                <br>
                        
                        
                                <h6 class='bold'>Material:<i class='material-icons right'>file</i></h6>
                        
                                <div class='file-field'>
                                    <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                        <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                        <input id='endereco_material' name='endereco_material' type='file' style='text-align: -webkit-center;'>
                                    </div><br><br><br>
                                    <div class='file-path-wrapper' style='width:100%';>
                                        <input class='file-path field' id='disabled' type='text' value='".$endereco_material[$i]."'>
                                    </div>
                                </div>
                        
                                <br>
                                <h6 class='bold'>Visibilidade do material:<i class='material-icons right'>remove_red_eye</i></h6>
                                <br>
                                
                                <div class='switch'>
                    
                                    <label>

                                        <h6 class='bold'>Não visível";
                                        
                                            if($visibilidade_material[$i] == "não-visível"){

                                                echo "<input type='checkbox' id='visibilidade_material' name='visibilidade_material' value='1'>";

                                            } else {

                                                echo "<input type='checkbox' id='visibilidade_material' name='visibilidade_material' value='1' checked>";

                                            }
                                        
                echo "

                                        <span class='lever'></span>

                                        Visível</h6>

                                    </label>
                                    
                                </div>
                        
                                <input type='hidden' name='endereco_material_pre_alteracao' value='".$endereco_material[$i]."'>
                                <input type='hidden' name='id_material' value='".$id_material[$i]."'>
                                <input type='hidden' name='id_aula' value='$id_aula'>
                        
                                <br>
                                <br>
                        
                                <div class='right'>
                        
                                    <a href='#!' class='modal-close waves-effect waves-light btn bold'
                                    style='background-color: #212121 !important;'>cancelar<i class='material-icons right'>close</i>
                                    </a>
                        
                                    <button type='submit' class='waves-effect waves-light btn bold'
                                    style='background-color: #212121 !important;'>ENVIAR<i class='material-icons right'>check</i>
                                    </button>
                        
                                    <br>
                                    <br>
                        
                                </div> 
                            </form>
                            </div>
                        </div>
                        <div class='row' style='margin-bottom:20px; border: 1px solid #9575cd; border-radius:10px;'>
                            <div class='col s12 hoverable' style='padding-top:10px; padding-left:30px; padding-bottom:10px; border-radius:10px;'> 
                                <div class='col s2 valign-wrapper' style='margin:0px; padding:0px; height:42px; vertical-align:middle;'>

                                    <a class='modal-trigger' href='#editar_material_$i' style='color:#000;'><i class='material-icons' style='font-size:1.75em; vertical-align:bottom;'>edit</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <a class='modal-trigger' href='#excluir_material_$i' style='color:#000;'><i class='material-icons' style='font-size:1.75em; vertical-align:bottom;'>delete</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                    if($visibilidade_material[$i]== "visível"){

                                        echo "<a href='../../__materiais/inversao_situacao_visibilidade_material.php?id_material=".$id_material[$i]."' style='color:#000;'><i class='fa fa-eye' style='font-size:1.75em; vertical-align:bottom;'></i></a><br>";
                        
                                    } else {
                        
                                        echo "<a href='../../__materiais/inversao_situacao_visibilidade_material.php?id_material=".$id_material[$i]."' style='color:#000;'><i class='fa fa-eye-slash' style='font-size:1.75em; vertical-align:bottom;'></i></a><br>";
                                        
                                    }

        echo "
                                </div>
                                ";
            
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
                                    <div class='col s9 valign-wrapper' style='margin:0px; padding:0px; height:42px; color:#000;'>
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
                                    <div class='col s9 valign-wrapper' style='margin:0px; padding:0px; height:42px; color:#000;'>
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
                                    <div class='col s9 valign-wrapper' style='margin:0px; padding:0px; height:42px; color:#000;'>
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
            <div id='criar_questionario' class='modal'>
                <div class='modal-content'>

                <form action='../../__questionarios/____C2_insere_questionario.php' method='post' id='criar_questionario' enctype='multipart/form-data'>

                    <h4 class='center-align'>Criar Questionário</h4><br>
            
                    <h6 class='bold'>Nome do questionário:<i class='material-icons right'>border_color</i></h6>
                    <input id='field' type='text' name='nome_questionario' placeholder='insira o nome do questionário' required>

                    <br>
                    <br>

                    <h6 class='bold'>Tempo de espera para nova realização:<i class='material-icons right'>schedule</i></h6>
                    <div class='row'>
                        <div class='col s1' style='padding-left:0px; padding-right:5px;'>
                            <input id='field' type='number' name='tempo_numero' required>
                        </div>
                        <div class='col s2'>
                            <select name='tempo_unidade' style='border-color:#000;'>
                            <option value='M'>minutos</option>
                            <option value='H'>horas</option>
                            <option value='D'>dias</option>
                            </select>
                        </div>
                    </div>
            
                    <br>
            
                    <h6 class='bold'>Distribuição das questões: <span class='right'><i class='fa fa-random'></i></span></h6>
                    <br>

                    <div class='switch'>
        
                        <label>

                            <h6 class='bold'>Aleatória
                            
                            <input type='checkbox' id='distribuicao_questoes' name='distribuicao_questoes' value='1' checked>

                            <span class='lever'></span>

                            Padronizada</h6>

                        </label>
                        
                    </div>

                    <br>
                    <br>

                    <h6 class='bold'>Visibilidade do questionário:<i class='material-icons right'>remove_red_eye</i></h6>
                    <br>

                    <div class='switch'>
        
                        <label>

                            <h6 class='bold'>Não visível
                            
                            <input type='checkbox' id='visibilidade_questionario' name='visibilidade_questionario' value='1' checked>

                            <span class='lever'></span>

                            Visível</h6>

                        </label>
                        
                    </div>
                           
                    <br>
            
                    <input type='hidden' name='id_aula' value='$id_aula'>
            
                    <br>
                    <br>
            
                    <div class='right'>
            
                        <a href='#!' class='modal-close waves-effect waves-light btn bold'
                        style='background-color: #212121 !important;'>cancelar<i class='material-icons right'>close</i>
                        </a>
            
                        <button type='submit' class='waves-effect waves-light btn bold'
                        style='background-color: #212121 !important;'>ENVIAR<i class='material-icons right'>check</i>
                        </button>
            
                        <br>
                        <br>
            
                    </div> 
                </form>
                </div>
            </div>
            <ul class='collapsible' 
            style='border:1px solid #DCDCDC; border-radius:10px; 
            box-shadow: 0 0 0 0 rgb(0 0 0), 0 0 0 -0 rgb(0 0 0), 0 0 0 0 rgb(0 0 0);'>
            <li>
                <div class='collapsible-header valign-wrapper' style='border:0px; border-radius:10px; border-color:#DCDCDC;'>
                    <div class='row valign-wrapper' style='margin:0px; width:100%;'>

                        <div class='col s9 valign-wrapper'>
                            <i class='material-icons left' style='font-size:2.5em;'>arrow_drop_down</i>    
                            <div style='font-size:2.5em; font-weight:500;'>Questionários</div> 
                        </div>

                        <div class='col s4 right-align'>
                            <a href='#criar_questionario' class='modal-trigger'>
                                <div class='waves-effect waves-light btn deep-purple bold' style='font-size:1.1em;'>
                                    ADICIONAR QUESTIONÁRIO<i class='material-icons left' style='margin-right:8px;'>add</i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class='collapsible-body' style='border:0px; border-radius:10px;'>";
            if(isset($id_questionario)){

                for($i=0 ; $i<count($id_questionario) ; $i++){
                    
                    echo "
                        <div id='excluir_questionario_$i' class='modal'>
                            <div class='modal-content'>
                        
                                <h5 class='center-align'>Deseja realmente excluir o questionário <span class='bold'>".$nome_questionario[$i]."</span>?</h5>
                                <br><br><br>
                    
                                <div class='center-align'>
                    
                                    <a href='../../__questionarios/_D1_excluir_questionario.php?id_questionario=".$id_questionario[$i]."' class='modal-trigger waves-effect waves-light btn bold'
                                    style='background-color: #e53935 !important;'>CONFIRMAR<i class='material-icons right'>delete_forever</i>
                                    </a>
                    
                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    
                                    <a href='#!' class='modal-close waves-effect waves-light btn bold'
                                    style='background-color: #212121 !important;'>CANCELAR<i class='material-icons right'>close</i>
                                    </a>
                    
                                </div>

                                <br>
                                
                            </div>
                        </div>
                        <div id='editar_questionario_$i' class='modal'>
                            <div class='modal-content'>

                            <form action='../../__questionarios/__U2_altera_questionario.php' method='post' id='criar_material' enctype='multipart/form-data'>

                                <h4 class='center-align'>Editar Questionário</h4><br>
                        
                                <h6 class='bold'>Nome do questionário:<i class='material-icons right'>border_color</i></h6>
                                <input id='field' type='text' name='nome_questionario' value='".$nome_questionario[$i]."' placeholder='insira o nome do questionário' required>

                                <br>
                                <br>

                                <h6 class='bold'>Tempo de espera para nova realização:<i class='material-icons right'>schedule</i></h6>
                                <div class='row'>
                                    <div class='col s1' style='padding-left:0px; padding-right:5px;'>
                                        <input id='field' type='number' value='".$tempo_numero[$i]."' name='tempo_numero' required>
                                    </div>
                                    <div class='col s2'>
                                        <select name='tempo_unidade' style='border-color:#000;'>";

                                        if($tempo_unidade[$i] == "M"){

                                            echo "<option value='M' selected>minutos</option>
                                                  <option value='H'>horas</option>
                                                  <option value='D'>dias</option>";
                    
                                        }
                    
                                        if($tempo_unidade[$i] == "H"){
                    
                                            echo "<option value='M'>minutos</option>
                                                  <option value='H' selected>horas</option>
                                                  <option value='D'>dias</option>";
                    
                                        }
                    
                                        if($tempo_unidade[$i] == "D"){
                    
                                            echo "<option value='M'>minutos</option>
                                                  <option value='H'>horas</option>
                                                  <option value='D' selected>dias</option>";
                    
                                        }

echo"                                   </select>
                                    </div>
                                </div>
                        
                                <br>
                        
                                <h6 class='bold'>Distribuição das questões: <span class='right'><i class='fa fa-random'></i></span></h6>
                                <br>

                                <div class='switch'>
            
                                    <label>

                                        <h6 class='bold'>Aleatória";
                                        
                                            if($distribuicao_questoes[$i] == "aleatoria"){

                                                echo "<input type='checkbox' id='distribuicao_questoes' name='distribuicao_questoes' value='1'>";

                                            } else {

                                                echo "<input type='checkbox' id='distribuicao_questoes' name='distribuicao_questoes' value='1' checked>";

                                            }
                                        
                echo "

                                        <span class='lever'></span>

                                        Padronizada</h6>

                                    </label>
                                    
                                </div>
                                        
                                <br>
                                <br>

                                <h6 class='bold'>Visibilidade do questionário:<i class='material-icons right'>remove_red_eye</i></h6>
                                <br>

                                <div class='switch'>
            
                                    <label>

                                        <h6 class='bold'>Não visível";
                                        
                                            if($visibilidade_questionario[$i] == "não-visível"){

                                                echo "<input type='checkbox' id='visibilidade_questionario' name='visibilidade_questionario' value='1'>";

                                            } else {

                                                echo "<input type='checkbox' id='visibilidade_questionario' name='visibilidade_questionario' value='1' checked>";

                                            }
                                        
                echo "

                                        <span class='lever'></span>

                                        Visível</h6>

                                    </label>
                                    
                                </div>
                                    
                                <br>
                        
                                <input type='hidden' name='id_questionario' value='".$id_questionario[$i]."'>
                        
                                <br>
                                <br>
                        
                                <div class='right'>
                        
                                    <a href='#!' class='modal-close waves-effect waves-light btn bold'
                                    style='background-color: #212121 !important;'>cancelar<i class='material-icons right'>close</i>
                                    </a>
                        
                                    <button type='submit' class='waves-effect waves-light btn bold'
                                    style='background-color: #212121 !important;'>ENVIAR<i class='material-icons right'>check</i>
                                    </button>
                        
                                    <br>
                                    <br>
                        
                                </div> 
                            </form>
                            </div>
                        </div>
                        <div class='row' style='margin-bottom:20px; border: 1px solid #9575cd; border-radius:10px;'>
                            <div class='col s12 hoverable' style='padding-top:10px; padding-left:30px; padding-bottom:10px; border-radius:10px;'> 
                                <div class='col s2 valign-wrapper' style='margin:0px; padding:0px; height:42px; vertical-align:middle;'>

                                    <a class='modal-trigger' href='#editar_questionario_$i' style='color:#000;'><i class='material-icons' style='font-size:1.75em; vertical-align:bottom;'>edit</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <a class='modal-trigger' href='#excluir_questionario_$i' style='color:#000;'><i class='material-icons' style='font-size:1.75em; vertical-align:bottom;'>delete</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                    if($visibilidade_questionario[$i]== "visível"){

                                        echo "<a href='../../__questionarios/inversao_situacao_visibilidade_questionario.php?id_questionario=".$id_questionario[$i]."' style='color:#000;'><i class='fa fa-eye' style='font-size:1.75em; vertical-align:bottom;'></i></a><br>";
                        
                                    } else {
                        
                                        echo "<a href='../../__questionarios/inversao_situacao_visibilidade_questionario.php?id_questionario=".$id_questionario[$i]."' style='color:#000;'><i class='fa fa-eye-slash' style='font-size:1.75em; vertical-align:bottom;'></i></a><br>";
                                        
                                    }

        echo "
                                </div>

                                <a href='PROD_tela_questionario_produtor.php?id_questionario=".$id_questionario[$i]."'>
                                    <div class='col s9 valign-wrapper' style='margin:0px; padding:0px; height:42px; color:#000;'>
                                        <span style='font-size:1.5em;'>".$nome_questionario[$i]."</span>
                                    </div>
                                    <div class='col s1 center valign-wrapper btn btn-floating deep-purple' style='margin:0px; padding:0px; width:3em; height:3em;'>
                                        <i class='material-icons'>chevron_right</i>
                                    </div>
                                </a>
                            </div>
                        </div>
                                ";

                }

            } else {

                echo "<div style='font-size:1.8em; font-weight:500;'>Não existem questionários associados a esta aula</div><br><br>";

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
            <a href='PROD___tela_curso_produtor.php?id_curso=<?=$id_curso;?>' class='waves-effect waves-light btn deep-purple bold' style='font-size:1.1em;'>
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

        $('select').formSelect();

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