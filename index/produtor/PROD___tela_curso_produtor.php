<?php
session_start();
require_once "../../_______necessarios/.conexao_bd.php";
require_once "../../_______necessarios/.funcoes.php";

if (!isset($_SESSION['id_usuario'])) {
$_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
header("Location: ../entrada.php");
}

$email_produtor= $_SESSION['email'];

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
    <title>(P) CURSO</title>
    
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
        
            <p>O certificado é dedicado aos consumidores que concluíram o curso,
            contendo o <span class="bold">nome do consumidor</span>, o
            <span class="bold">nome do curso</span> e a <span class="bold">carga horária</span> do mesmo.
            Para que o certificado fique disponível para os consumidores, além de ter sido adicionado, é necessário que
            o curso possua forma de avaliação válida, sendo isso, no caso, questionário(s) válido(s).</p>

            <br style="font-size:0.3em;">

            <p>Caso o curso possua questionários válidos, ao lado do botão de cadastro/edição de 
            certificado será mostrado o ícone: <i class="material-icons deep-purple-text" style="vertical-align: middle;">check_circle</i></p>

            <p>Caso o curso não possua, será mostrado: <i class="material-icons deep-purple-text" style="vertical-align: middle;">cancel</i></p>

            <br style="font-size:0.5em;">

            Sendo possível criar um certificado mesmo sem questionários válidos, mas que não será 
            disponibilizado aos consumidores. Por fim, um questionário só é considerado válido quando há pelo menos 
            uma questão válida, ou seja, uma questão que possua pelo menos uma resposta correta.

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

        <a href="PROD____home_produtor.php" class="breadcrumb bold" style='margin-left:30px;'>HOME PRODUTOR</a>
        <a href="#!" class="breadcrumb bold">CURSO</a>

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

            $id_curso= mysqli_real_escape_string($conexao,$_GET['id_curso']);

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
                $visibilidade_curso = $linha['visibilidade_curso'];

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
                $visibilidade_modulo[] = $linha_1['visibilidade_modulo'];

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
                        $visibilidade_aula[$i][]= $linhai[$i]['visibilidade_aula'];

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

                echo "
                    <script>
                        function previewImagemModulo(){
                            let imagem = document.querySelector('input[id=endereco_imagem_modulo_cadastro]').files[0];
                            let preview = document.querySelector('#imagem_modulo');
                
                            let reader = new FileReader();
                
                            reader.onloadend = function(){
                
                                preview.src=reader.result;
                
                            }
                
                            if(imagem){
                
                                reader.readAsDataURL(imagem);
                
                            } else {
                
                                preview.src=".'""'.";
                
                            }
                        }
                    </script>

                    <div id='criar_modulo' class='modal'>
                        <div class='modal-content'>

                        <form action='../../____modulos/____C2_insere_modulo.php' method='post' id='criar_modulo' enctype='multipart/form-data'>

                            <h4 class='center-align'>Criar Módulo</h4><br>
                    
                            <h6 class='bold'>Nome do módulo:<i class='material-icons right'>border_color</i></h6>
                            <input id='field' type='text' name='nome_modulo' placeholder='insira o nome do módulo' required>
                    
                            <br>
                            <br>
                    
                            <h6 class='bold'>Descrição do módulo:<i class='material-icons right'>subject</i></h6>
                            <div class='input-field col s12'>
                            <textarea id='field' type='text' name='descricao_modulo' placeholder='insira a descrição do módulo' class='materialize-textarea' style='text-align:justify' required></textarea>
                            </div>
                    
                            <h6 class='bold'>Imagem do módulo (16x9):<i class='material-icons right'>image</i></h6>
                    
                            <div class='file-field'>
                                <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                    <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                    <input id='endereco_imagem_modulo_cadastro' name='endereco_imagem_modulo' type='file' style='text-align: -webkit-center;' accept='image/*' onchange='previewImagemModulo()'>
                                </div>
                            </div>
                    
                            <br>
                            <br>
                            <br>
                            <h6 class='bold center-align' style='font-style:italic;'>preview:</h6>
                            <div class='collapsible-header'>
                                <div class='col s3' style='margin-left:0px;'>
                                    <img id='imagem_modulo' src='../../_.imgs_default/sem_imagem.png' width='230em' height='129.4em' style='border-radius:4%;'>
                                </div>
                    
                                <div class='col s1 valign-wrapper left' style='margin-left:0px;'>
                                    <i class='material-icons' style='vertical-align: middle; font-size:2.33em !important;'>arrow_drop_down</i>
                                </div>
                    
                                <div class='col s7 valign-wrapper' style='margin-left:0px; padding-left:0px;'>
                                    <span style='font-size:1.85em; font-weight:400;'>[*nome do módulo*]</span>
                                </div>
                            </div>
                    
                            <br>
                    
                            <h6 class='bold'>Visibilidade do módulo: <i class='material-icons right'>remove_red_eye</i></h6><br>
                    
                            <div class='switch'>
                                
                                <label>
                    
                                <h6 class='bold'>Não visível
                    
                                <input type='checkbox' id='visibilidade_modulo' name='visibilidade_modulo' value='1' checked>
                    
                                <span class='lever'></span>
                    
                                Visível</h6>
                    
                                </label>
                                
                            </div>
                    
                            <input type='hidden' name='id_curso' value='$id_curso''>
                    
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

                    <div id='cadastro_certificado' class='modal'>

                        <div class='modal-content'>

                            <h4 class='center-align'>Cadastrar Certificado</h4><br>

                            <form action='../../_____cursos/certificados_curso/_C2_U2_insere_altera_certificado.php?id_curso=$id_curso&i=0' method='post'>

                                <h6 class='bold'>Carga horária (em horas):<i class='material-icons right'>access_time</i></h6>
                                <input id='field' type='number' name='carga_horaria' placeholder='insira a carga horária do curso' required>

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
                    <div id='edicao_certificado' class='modal'>
                        <div class='modal-content'>

                            <h4 class='center-align'>Editar Certificado</h4><br>

                            <form action='../../_____cursos/certificados_curso/_C2_U2_insere_altera_certificado.php?id_curso=$id_curso&i=1' method='post'>

                                <h6 class='bold'>Carga horária (em horas):<i class='material-icons right'>access_time</i></h6>
                                <input id='field' type='number' name='carga_horaria' placeholder='insira a carga horária do curso' value='$certificado_curso' required>

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

                    <div id='excluir_certificado' class='modal'>
                        <div class='modal-content'>
                    
                        <h5 class='center-align'>Deseja realmente remover o certificado do curso?</h5>
                        <br><br><br>
            
                        <div class='center-align'>
            
                            <a href='../../_____cursos/certificados_curso/_D1_excluir_certificado.php?id_curso=$id_curso' class='modal-trigger waves-effect waves-light btn bold'
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

                    <div id='excluir_curso' class='modal'>
                        <div class='modal-content'>
                    
                        <h5 class='center-align'>Deseja realmente excluir o curso <span class='bold'>$nome_curso</span>?</h5>
                        <br><br><br>
            
                        <div class='center-align'>
            
                            <a href='../../_____cursos/_D1_excluir_curso.php?id_curso=$id_curso' class='modal-trigger waves-effect waves-light btn bold'
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
                
                    <div id='editar_curso' class='modal'>
                        <div class='modal-content'>

                            <form action='../../_____cursos/__U2_altera_curso.php' method='post' id='editar_curso' enctype='multipart/form-data'>

                                <h4 class='center-align'>Editar Curso</h4><br>

                                <h6 class='bold'>Nome do curso:<i class='material-icons right'>border_color</i></h6>
                                <input id='field' type='text' name='nome_curso' placeholder='insira o nome do curso' value='$nome_curso' required>

                                <br>
                                <br>

                                <h6 class='bold'>Descrição do curso:<i class='material-icons right'>subject</i></h6>
                                <div class='input-field'>
                                <textarea id='field' type='text' name='descricao_curso' placeholder='insira a descrição do curso' class='materialize-textarea' style='text-align:justify'required>$descricao_curso</textarea>
                                </div>

                                <h6 class='bold'>Imagem do curso (16x9):<i class='material-icons right'>image</i></h6>
                
                                <div class='file-field'>
                                    <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                        <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                        <input id='endereco_imagem_curso_edicao' name='endereco_imagem_curso' type='file' accept='image/*' onchange='previewImagemEditar()'>
                                    </div>
                                </div>

                                <br>
                                <br>
                                <br>
                                <h6 class='bold center-align' style='font-style:italic;'>preview da home:</h6>
                                <div class='card-panel hoverable'>
                                    <div class='row'>
                                        <div class='col s5'>
                                        
                                            <br>
                                            <img id='imagem_curso_edicao' src='$endereco_imagem_curso' width='300em' height='169em' style='border-radius:4%;'>
                                    
                                        </div>
                                    
                                        <div class='col s7'>

                                            <h5 class='bold center-align'>[*nome do curso*]</h5>
                                            <br>
                                            <h6 style='text-align:justify; font-size:1.3em;'>[*descrição do curso*].</h6>

                                        </div> 
                                    </div>
                                </div>
                                <br>
                                <h6 class='bold center-align' style='font-style:italic;'>preview da tela de curso:</h6>
                                <div class='col s12' style='padding:0px;'>
                                    <div class='card meddium'>

                                        <div class='card-image'>
                                            <img id='imagem_curso_edicao_1' src='$endereco_imagem_curso' style='filter: brightness(80%);' width='900em' height='506.25em'>
                                            <div class='card-title' style='width:100%; font-weight:400; font-size:2em; text-align: -webkit-center; backdrop-filter: brightness(70%)'>
                                                [*nome do curso*]
                                            </div>
                                        </div>

                                        <div class='card-content'>
                                            <h6 style='text-align: justify; font-size:1.5em;'>[*descrição do curso*]</h6>
                                        </div>

                                    </div>
                                </div>
                                <br>

                                <h6 class='bold'>Visibilidade do curso: <i class='material-icons right'>remove_red_eye</i></h6><br>
                                
                                <div class='switch'>
                                    
                                    <label>

                                    <h6 class='bold'>Não visível";
                                    
                                        if($visibilidade_curso == "não-visível"){

                                            echo "<input type='checkbox' id='visibilidade_curso' name='visibilidade_curso' value='1'>";

                                        } else {

                                            echo "<input type='checkbox' id='visibilidade_curso' name='visibilidade_curso' value='1' checked>";

                                        }
                                    
                                echo "

                                    <span class='lever'></span>

                                    Visível</h6>

                                    </label>
                                    
                                </div>

                                <br>
                                <br>

                                <input type='hidden' name='endereco_imagem_curso_pre_alteracao' value='$endereco_imagem_curso'>
                                <input type='hidden' name='id_curso' value='$id_curso'>

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
                                <img src='$endereco_imagem_curso' style='filter: brightness(80%);' width='1200em' height='675em'>
                                <div class='card-title' style='width:100%; font-weight:400; font-size:3em; text-align: -webkit-center; backdrop-filter: brightness(70%)'>
                                $nome_curso
                                </div>
                            </div>
                            <div class='card-content'>
                                <h6 style='text-align: justify; font-size:1.5em;'>$descricao_curso</h6>
                            </div>

                            <div class='card-action'>
                                <br>
                                <span>";
                        
                                    if(!isset($id_alternativa_valida) and $certificado_curso=="sem-certificado"){

                                        echo "<a href='#cadastro_certificado' class='modal-trigger waves-effect waves-light bold btn' style='background-color:#212121; font-size:1.1em; vertical-align: middle; text-align:center;'>
                                            ADICIONAR CERTIFICADO<i class='material-icons left'>chrome_reader_mode</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle;'>cancel</i>";

                                    } elseif(!isset($id_alternativa_valida) and $certificado_curso!="sem-certificado"){

                                        echo "<a href='#excluir_certificado' class='modal-trigger' style='color:#212121; vertical-align: middle; margin-right:12px;'><i class='material-icons' style='font-size:2em; vertical-align: middle;'>delete</i></a>
                                            <a href='../../_____cursos/certificados_curso/gerar_certificado.php?id_curso=$id_curso' style='color:#212121; vertical-align: middle; margin-right:12px;'><i class='material-icons' style='font-size:2em; vertical-align: middle;'>download</i></a>
                                            <a href='#edicao_certificado' class='modal-trigger waves-effect waves-light bold btn' style='background-color:#212121; font-size:1.1em;vertical-align: middle; text-align:center;'>
                                            EDITAR CERTIFICADO<i class='material-icons left'>edit</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle;'>cancel</i>";

                                    } elseif(isset($id_alternativa_valida) and $certificado_curso=="sem-certificado"){

                                        echo "<a href='#cadastro_certificado' class='modal-trigger waves-effect waves-light bold btn' style='background-color:#212121; font-size:1.1em;vertical-align: middle; text-align:center;'>
                                            ADICIONAR CERTIFICADO<i class='material-icons left'>chrome_reader_mode</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle;'>check_circle</i>";

                                    } elseif(isset($id_alternativa_valida) and $certificado_curso!="sem-certificado"){

                                        echo "<a href='#excluir_certificado' class='modal-trigger' style='color:#212121; vertical-align: middle; margin-right:12px;'><i class='material-icons' style='font-size:2em; vertical-align: middle;'>delete</i></a>
                                            <a href='../../_____cursos/certificados_curso/gerar_certificado.php?id_curso=$id_curso' style='color:#212121; vertical-align: middle; margin-right:12px;'><i class='material-icons' style='font-size:2em; vertical-align: middle;'>download</i></a>
                                            <a href='#edicao_certificado' class='modal-trigger waves-effect waves-light bold btn' style='background-color:#212121; font-size:1.1em;vertical-align: middle; text-align:center;'>
                                            EDITAR CERTIFICADO<i class='material-icons left'>edit</i>
                                            </a>";
                                        echo "<i class='material-icons deep-purple-text' style='font-size:2.5em; vertical-align: middle;'>check_circle</i>";

                                    }

                                    echo "<a href='#info' class='modal-trigger' style='color:#212121; vertical-align: middle;'><i class='material-icons' style='font-size:2.5em; vertical-align: middle;'>info</i></a>
                                </span>

                                <span class='right'>
                                    <a href='#editar_curso' class='modal-trigger' style='color:#212121; vertical-align: top;'>
                                        <i class='material-icons' style='font-size:2.5em !important; vertical-align: middle;'>edit</i>
                                    </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                                    <a href='#excluir_curso' class='modal-trigger' style='color:#212121; vertical-align: top;'>
                                        <i class='material-icons' style='font-size:2.5em !important; vertical-align: middle;'>delete</i>
                                    </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";

                                    if($visibilidade_curso == "visível"){

                                        echo "<a href='../../_____cursos/inversao_situacao_visibilidade_curso.php?id_curso=$id_curso' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                                <i class='fa fa-eye' style='padding-bottom:15px;'></i>
                                                </a>";
                        
                                    } else {
                        
                                        echo "<a href='../../_____cursos/inversao_situacao_visibilidade_curso.php?id_curso=$id_curso' style='color:#212121; font-size:2.5em; line-height:0; vertical-align: text-bottom;'>
                                                <i class='fa fa-eye-slash style='vertical-align: text-bottom;'></i>
                                                </a>";
                                        
                                    }

        echo "                  </span>
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

                                    <div class='col s9 valign-wrapper'>
                                        <i class='material-icons left' style='font-size:2.5em;'>arrow_drop_down</i>    
                                        <div style='font-size:2.5em; font-weight:500;'>Módulos</div> 
                                    </div>

                                    <div class='col s3 center'>
                                        <a href='#criar_modulo' class='modal-trigger'>
                                            <div class='waves-effect waves-light btn deep-purple bold' style='font-size:1.1em;'>
                                                ADICIONAR MÓDULO<i class='material-icons left' style='margin-right:8px;'>add</i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class='collapsible-body' style='border:0px; border-radius:10px;'>";
                if(isset($id_modulo) or isset($linha_1)){

                                    for($i=0 ; $i<count($id_modulo) ; $i++){

                                        echo "
                                            <script>
                                                function previewImagemEditarModulo$i(){
                                                    let imagem = document.querySelector('input[id=endereco_imagem_modulo_edicao$i]').files[0];
                                                    let preview = document.querySelector('#imagem_modulo_edicao$i');
                                        
                                                    let reader = new FileReader();
                                        
                                                    reader.onloadend = function(){
                                        
                                                        preview.src=reader.result;
                                        
                                                    }
                                        
                                                    if(imagem){
                                        
                                                        reader.readAsDataURL(imagem);
                                        
                                                    } else {
                                        
                                                        preview.src=".'""'.";
                                        
                                                    }
                                                }

                                                function previewImagemAula$i(){
                                                    let imagem = document.querySelector('input[id=endereco_imagem_aula_cadastro_$i]').files[0];
                                                    let preview = document.querySelector('#imagem_aula_criacao_$i');
                                                    let preview1 = document.querySelector('#imagem_aula_criacao_1_$i');
                                        
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

                                            <div id='excluir_modulo_$i' class='modal'>
                                                <div class='modal-content'>
                                            
                                                    <h5 class='center-align'>Deseja realmente excluir o módulo <span class='bold'>".$nome_modulo[$i]."</span>?</h5>
                                                    <br><br><br>
                                        
                                                    <div class='center-align'>
                                        
                                                        <a href='../../____modulos/_D1_excluir_modulo.php?id_modulo=".$id_modulo[$i]."' class='modal-trigger waves-effect waves-light btn bold'
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

                                            <div id='editar_modulo_$i' class='modal'>
                                                <div class='modal-content'>

                                                    <form action='../../____modulos/__U2_altera_modulo.php' method='post' id='editar_modulo$i' enctype='multipart/form-data'>

                                                        <h4 class='center-align'>Editar Modulo</h4><br>

                                                        <h6 class='bold'>Nome do módulo:<i class='material-icons right'>border_color</i></h6>
                                                        <input id='field' type='text' name='nome_modulo' placeholder='insira o nome do módulo' value='".$nome_modulo[$i]."' required>

                                                        <br>
                                                        <br>

                                                        <h6 class='bold'>Descrição do módulo:<i class='material-icons right'>subject</i></h6>
                                                        <div class='input-field'>
                                                            <textarea id='field' type='text' name='descricao_modulo' placeholder='insira a descrição do módulo' class='materialize-textarea' form='editar_modulo$i' style='text-align:justify'required>".$descricao_modulo[$i]."</textarea>
                                                        </div>

                                                        <h6 class='bold'>Imagem do módulo (16x9):<i class='material-icons right'>image</i></h6>
                                        
                                                        <div class='file-field'>
                                                            <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                                                <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                                                <input id='endereco_imagem_modulo_edicao$i' name='endereco_imagem_modulo' type='file' accept='image/*' onchange='previewImagemEditarModulo$i()'>
                                                            </div>
                                                        </div>

                                                        <br>
                                                        <br>
                                                        <br>

                                                        <h6 class='bold center-align' style='font-style:italic;'>preview:</h6>
                                                        <div class='collapsible-header'>
                                                            <div class='col s3' style='margin-left:0px;'>
                                                                <img id='imagem_modulo_edicao$i' src='" . $endereco_imagem_modulo[$i] ."' width='230em' height='129.4em' style='border-radius:4%;'>
                                                            </div>

                                                            <div class='col s1 valign-wrapper left' style='margin-left:0px;'>
                                                                <i class='material-icons' style='vertical-align: middle; font-size:2.33em !important;'>arrow_drop_down</i>
                                                            </div>

                                                            <div class='col s7 valign-wrapper' style='margin-left:0px; padding-left:0px;'>
                                                                <span style='font-size:1.85em; font-weight:400;'>[*nome do módulo*]</span>
                                                            </div>
                                                        </div>

                                                        <br>

                                                        <h6 class='bold'>Visibilidade do módulo: <i class='material-icons right'>remove_red_eye</i></h6><br>
                                                        
                                                        <div class='switch'>
                                                            
                                                            <label>

                                                                <h6 class='bold'>Não visível";
                                                                
                                                                    if($visibilidade_modulo[$i] == "não-visível"){

                                                                        echo "<input type='checkbox' id='visibilidade_modulo' name='visibilidade_modulo' value='1'>";

                                                                    } else {

                                                                        echo "<input type='checkbox' id='visibilidade_modulo' name='visibilidade_modulo' value='1' checked>";

                                                                    }
                                                                
                        echo "

                                                                <span class='lever'></span>

                                                                Visível</h6>

                                                            </label>
                                                            
                                                        </div>

                                                        <br>
                                                        <br>

                                                        <input type='hidden' name='endereco_imagem_modulo_pre_alteracao' value='".$endereco_imagem_modulo[$i]."'>
                                                        <input type='hidden' name='id_modulo' value='".$id_modulo[$i]."'>

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

                                            <div id='criar_aula_$i' class='modal'>
                                                <div class='modal-content'>

                                                <form action='../../___aulas/____C2_insere_aula.php' method='post' id='criar_aula' enctype='multipart/form-data'>

                                                    <h4 class='center-align'>Criar Aula</h4><br>
                                            
                                                    <h6 class='bold'>Nome da aula:<i class='material-icons right'>border_color</i></h6>
                                                    <input id='field' type='text' name='nome_aula' placeholder='insira o nome do aula' required>
                                            
                                                    <br>
                                                    <br>
                                            
                                                    <h6 class='bold'>Descrição da aula:<i class='material-icons right'>subject</i></h6>
                                                    <div class='input-field col s12'>
                                                    <textarea id='field' type='text' name='descricao_aula' placeholder='insira a descrição do aula' class='materialize-textarea' style='text-align:justify' required></textarea>
                                                    </div>
                                            
                                                    <h6 class='bold'>Imagem da aula (16x9):<i class='material-icons right'>image</i></h6>
                                            
                                                    <div class='file-field'>
                                                        <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                                            <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                                            <input id='endereco_imagem_aula_cadastro_$i' name='endereco_imagem_aula' type='file' style='text-align: -webkit-center;' accept='image/*' onchange='previewImagemAula$i()'>
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
                                                                <img id='imagem_aula_criacao_$i' src='../../_.imgs_default/sem_imagem.png' width='190em' height='112.5em' style='border-radius:4%;'>
                                                                <i class='material-icons right valign-wrapper' style='height:112.5px;'>play_circle_filled</i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <h6 class='bold center-align' style='font-style:italic;'>preview da tela de aula:</h6>
                                                    <div class='col s12' style='padding:0px;'>
                                                        <div class='card meddium'>

                                                            <div class='card-image'>
                                                                <img id='imagem_aula_criacao_1_$i' src='../../_.imgs_default/sem_imagem.png' style='filter: brightness(80%);' width='900em' height='506.25em'>
                                                                <div class='card-title' style='width:100%; font-weight:400; font-size:2em; text-align: -webkit-center; backdrop-filter: brightness(70%)'>
                                                                    [*nome da aula*]
                                                                </div>
                                                            </div>

                                                            <div class='card-content'>
                                                                <h6 style='text-align: justify; font-size:1.5em;'>[*descrição da aula*]</h6>
                                                            </div>

                                                        </div>
                                                    </div>
                                            
                                                    <br>
                                            
                                                    <h6 class='bold'>Visibilidade da aula: <i class='material-icons right'>remove_red_eye</i></h6><br>
                                            
                                                    <div class='switch'>
                                                        
                                                        <label>
                                            
                                                        <h6 class='bold'>Não visível
                                            
                                                        <input type='checkbox' id='visibilidade_aula' name='visibilidade_aula' value='1' checked>
                                            
                                                        <span class='lever'></span>
                                            
                                                        Visível</h6>
                                            
                                                        </label>
                                                        
                                                    </div>
                                            
                                                    <input type='hidden' name='id_modulo' value='".$id_modulo[$i]."'>
                                            
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

                                                            <div class='col s7 valign-wrapper' style='margin-left:0px; padding-left:0px;'>
                                                                <span style='font-size:2em; font-weight:400;'>" . $nome_modulo[$i] . "
                                                                </span>
                                                            </div>
                                                            
                                                            <div class='col s2 valign-wrapper' style='margin-left:0px;'>

                                                                <a href='#editar_modulo_$i' class='modal-trigger' style='vertical-align: middle; color:#212121;'> 
                                                                    <i class='material-icons' style='vertical-align: middle; font-size:2.3em !important;'>edit</i>
                                                                </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                                                                <a href='#excluir_modulo_$i' class='modal-trigger' style='vertical-align: middle; color:#212121;'>
                                                                    <i class='material-icons' style='vertical-align: middle; font-size:2.3em !important;'>delete</i>
                                                                </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";

                                                                if($visibilidade_modulo[$i] == "visível"){

                                                                    echo "<a href='../../____modulos/inversao_situacao_visibilidade_modulo.php?id_curso=$id_curso&id_modulo=".$id_modulo[$i]."' style='vertical-align: middle; color:#212121;'>
                                                                            <i class='fa fa-eye' style='font-size:2.3em !important;'></i>
                                                                          </a>";
                                                    
                                                                } else {
                                                    
                                                                    echo "<a href='../../____modulos/inversao_situacao_visibilidade_modulo.php?id_curso=$id_curso&id_modulo=".$id_modulo[$i]."' style='vertical-align: middle; color:#212121;'>
                                                                            <i class='fa fa-eye-slash' style='font-size:2.3em !important;'></i>
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
                                                                
                                                                <div class='col s12 center-align' style='margin-bottom:18px;'>
                                                                    <a href='#criar_aula_$i' class='modal-trigger'>
                                                                        <div class='waves-effect waves-light btn bold deep-purple'>ADICIONAR AULA<i class='material-icons left'>add</i></div>
                                                                    </a>
                                                                </div>
                                                                <br><br><br>

                                                    ";
                                        
                                                    if(isset($id_aula[$i])){

                                                        for($j=0 ; $j<count($id_aula[$i]) ; $j++){

                                                            echo "
                                                                <script>
                                                                    function previewImagemAulaEdicao_$i".'_'."$j(){
                                                                        let imagem = document.querySelector('input[id=endereco_imagem_aula_edicao_$i".'_'."$j]').files[0];
                                                                        let preview = document.querySelector('#imagem_aula_edicao_$i".'_'."$j');
                                                                        let preview1 = document.querySelector('#imagem_aula_edicao_1_$i".'_'."$j');
                                                            
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
                                                                <div id='excluir_aula_[$i][$j]' class='modal'>
                                                                    <div class='modal-content'>
                                                                
                                                                        <h5 class='center-align'>Deseja realmente excluir a aula <span class='bold'>".$nome_aula[$i][$j]."</span>?</h5>
                                                                        <br><br><br>
                                                            
                                                                        <div class='center-align'>
                                                            
                                                                            <a href='../../___aulas/_D1_excluir_aula.php?id_aula=".$id_aula[$i][$j]."' class='modal-trigger waves-effect waves-light btn bold'
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
                                                                <div id='editar_aula_[$i][$j]' class='modal'>
                                                                    <div class='modal-content'>

                                                                    <form action='../../___aulas/__U2_altera_aula.php' method='post' id='editar_aula' enctype='multipart/form-data'>

                                                                        <h4 class='center-align'>Editar Aula</h4><br>
                                                                
                                                                        <h6 class='bold'>Nome da aula:<i class='material-icons right'>border_color</i></h6>
                                                                        <input id='field' type='text' name='nome_aula' value='".$nome_aula[$i][$j]."' placeholder='insira o nome do aula' required>
                                                                
                                                                        <br>
                                                                        <br>
                                                                
                                                                        <h6 class='bold'>Descrição da aula:<i class='material-icons right'>subject</i></h6>
                                                                        <div class='input-field'>
                                                                        <textarea id='field' type='text' name='descricao_aula' placeholder='insira a descrição do aula' class='materialize-textarea' style='text-align:justify' required>".$descricao_aula[$i][$j]."</textarea>
                                                                        </div>
                                                                
                                                                        <h6 class='bold'>Imagem da aula (16x9):<i class='material-icons right'>image</i></h6>
                                                                
                                                                        <div class='file-field'>
                                                                            <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                                                                <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                                                                <input id='endereco_imagem_aula_edicao_$i".'_'."$j' name='endereco_imagem_aula' type='file' style='text-align: -webkit-center;' accept='image/*' onchange='previewImagemAulaEdicao_$i".'_'."$j()'>
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
                                                                                    <img id='imagem_aula_edicao_$i".'_'."$j' src='".$endereco_imagem_aula[$i][$j]."' width='190em' height='112.5em' style='border-radius:4%;'>
                                                                                    <i class='material-icons right valign-wrapper' style='height:112.5px;'>play_circle_filled</i>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <br>
                                                                        <h6 class='bold center-align' style='font-style:italic;'>preview da tela de aula:</h6>
                                                                        <div class='col s12' style='padding:0px;'>
                                                                            <div class='card meddium'>

                                                                                <div class='card-image'>
                                                                                    <img id='imagem_aula_edicao_1_$i".'_'."$j' src='".$endereco_imagem_aula[$i][$j]."' style='filter: brightness(80%);' width='900em' height='506.25em'>
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
                                                                                
                                                                                    if($visibilidade_aula[$i][$j] == "não-visível"){

                                                                                        echo "<input type='checkbox' id='visibilidade_aula' name='visibilidade_aula' value='1'>";

                                                                                    } else {

                                                                                        echo "<input type='checkbox' id='visibilidade_aula' name='visibilidade_aula' value='1' checked>";

                                                                                    }
                                                                                
                                        echo "

                                                                                <span class='lever'></span>

                                                                                Visível</h6>

                                                                            </label>
                                                                            
                                                                        </div>
                                                                
                                                                        <input type='hidden' name='id_aula' value='".$id_aula[$i][$j]."'>
                                                                        <input type='hidden' name='endereco_imagem_aula_pre_alteracao' value='".$endereco_imagem_aula[$i][$j]."'>
                                                                
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
                                                                    <div class='col s12 hoverable' style='padding-top:10px; padding-bottom:10px; padding-left:30px; border-radius:10px;'> 
                                                                        <div class='col s2 valign-wrapper' style='margin:0px; padding:0px; height:112.5px;'>

                                                                            <a class='modal-trigger' href='#editar_aula_[$i][$j]' style='color:#000;'><i class='material-icons' style='font-size:1.75em; vertical-align:bottom;'>edit</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp 
                                                                            <a class='modal-trigger' href='#excluir_aula_[$i][$j]' style='color:#000;'><i class='material-icons' style='font-size:1.75em; vertical-align:bottom;'>delete</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                                                            if($visibilidade_aula[$i][$j] == "visível"){

                                                                                echo "<a href='../../___aulas/inversao_situacao_visibilidade_aula.php?id_aula=".$id_aula[$i][$j]."' style='color:#000;'><i class='fa fa-eye' style='font-size:1.75em; vertical-align:bottom;'></i></a><br>";
                                                                
                                                                            } else {
                                                                
                                                                                echo "<a href='../../___aulas/inversao_situacao_visibilidade_aula.php?id_aula=".$id_aula[$i][$j]."' style='color:#000;'><i class='fa fa-eye-slash' style='font-size:1.75em; vertical-align:bottom;'></i></a><br>";
                                                                                
                                                                            }

                                                echo "
                                                                        </div>

                                                                        <a href='PROD__tela_aula_produtor.php?id_aula=".$id_aula[$i][$j]."' style='color:#000;'>
                                                                            <div class='col s7 center-align valign-wrapper' style='margin:0px; padding:0px; height:112.5px;'>
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

                                                            echo "<div style='font-size:1.4em; font-weight:500;'>Não existem aulas cadastradas neste módulo</div><br>";

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

                    echo "<div style='font-size:1.8em; font-weight:500;'>Não existem módulos cadastrados neste curso</div><br><br>";

                }
                echo "
                                    </div>
                                    </li>
                                </ul>";


        ?>
 
    <br>

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
    
        echo "

        <div id='cadastro_consumidor' class='modal'>
            <div class='modal-content'>
                <h4 class='center-align'>Associar consumidor ao curso</h4><br>

                <form action='../../______relacao_usuario_curso/____C2_insere_associacao_usuario.php?' method='post'>

                    <h6 class='bold'>Email do usuário:<i class='material-icons right'>email</i></h6>
                    <input id='field' type='email' name='email' placeholder='insira o email do usuário' required>
                    <input type='hidden' name='id_curso' value='$id_curso'>

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
                        <div style='font-size:2.5em; font-weight:500;'>Consumidores associados ao curso</div> 
                    </div>

                    <div class='col s3 center'>
                        <a href='#cadastro_consumidor' class='modal-trigger'>
                            <div class='waves-effect waves-light btn deep-purple bold' style='font-size:1.1em;'>
                            ASSOCIAR CONSUMIDOR<i class='material-icons left' style='margin-right:8px;'>person_add</i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class='collapsible-body' style='border:0px; border-radius:10px;'>";
        if(isset($email_consumidor)){

            for($h=0 ; $h<count($email_consumidor) ; $h++){

                $sqlh[$h] = "SELECT * FROM usuarios WHERE email='".$email_consumidor[$h]."'"; 
                $resultadoh[$h] = mysqli_query($conexao,$sqlh[$h]);
                $linhah[$h] = mysqli_fetch_assoc($resultadoh[$h]);

                $d[$h]= date('d/m/Y',strtotime($data_relacao[$h]));

                echo "
                <div id='editar_consumidor_$h' class='modal'>
                    <div class='modal-content'>
                        <h4 class='center-align'>Associar consumidor ao curso</h4><br>
        
                        <form action='../../______relacao_usuario_curso/__U2_altera_associacao_usuario.php?id_curso=$id_curso' method='post'>
        
                            <h6 class='bold'>Email do usuário:<i class='material-icons right'>email</i></h6>
                            <input id='field' type='email' name='email_novo' value='".$email_consumidor[$h]."' placeholder='insira o email do usuário' required>
                            <input type='hidden' name='email_antigo' value='".$email_consumidor[$h]."'>
                            <input type='hidden' name='id_curso' value='$id_curso'>
        
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
                
                <div id='excluir_consumidor_$h' class='modal'>
                    <div class='modal-content'>
                
                        <h5 class='center-align'>Deseja realmente desassociar o cosumidor <span class='bold'>".$linhah[$h]['nome_usuario']."</span>?</h5>
                        <br><br><br>
            
                        <div class='center-align'>
            
                            <a href='../../______relacao_usuario_curso/_D1_excluir_associacao_usuario.php?email=".$email_consumidor[$h]."&id_curso=$id_curso' class='modal-trigger waves-effect waves-light btn bold'
                            style='background-color: #e53935 !important;'>CONFIRMAR<i class='material-icons right'>delete_forever</i>
                            </a>
            
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            
                            <a href='#!' class='modal-close waves-effect waves-light btn bold'
                            style='background-color: #212121 !important;'>CANCELAR<i class='material-icons right'>close</i>
                            </a>
            
                        </div>

                        <br>
                        
                    </div>
                </div>";

                echo "
                    <div class='valign-wrapper' style='margin-bottom:10px;'>
                        <span class='valign-wrapper' style='font-size:1.3em;'>
                            <img src='".$linhah[$h]['endereco_imagem_usuario']."' height='40px' width='40px' style='border-radius:100%; margin-right:8px;'>
                            <span class='bold'>
                                ".$linhah[$h]['nome_usuario']."
                            </span> 
                            &nbsp- ".$email_consumidor[$h] . " - desde " . $d[$h] . " 
                        </span> &nbsp&nbsp&nbsp&nbsp
                        <a href='#editar_consumidor_$h' class='modal-trigger' style='color:#000; vertical-align:middle;'>
                            <i class='material-icons' style='vertical-align:middle;'>edit</i>
                        </a>&nbsp
                        <a href='#excluir_consumidor_$h' class='modal-trigger' style='color:#000; vertical-align:middle;'>
                            <i class='material-icons' style='vertical-align:middle;'>delete</i>
                        </a>
                        <br>
                    </div>";
            }

        } else {

            echo "<div style='font-size:1.8em; font-weight:500;'>Não existem usuários associados a este curso</div><br><br>";

        }
    echo"
            </div>
        </li>
        </ul>";


    ?>
    <br>
    <br>
    <div class='center-align'>
        <a href='PROD____home_produtor.php' class='waves-effect waves-light btn deep-purple bold' style='font-size:1.1em;'>
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