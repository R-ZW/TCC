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
$id_questionario= mysqli_real_escape_string($conexao,$_GET['id_questionario']);

$sql_1 = "SELECT * FROM usuarios WHERE id_usuario='".$_SESSION['id_usuario']."'";
$resultado_1 = mysqli_query($conexao, $sql_1);
$linha_1 = mysqli_fetch_assoc($resultado_1);
$nome_usuario = $linha_1['nome_usuario'];
$endereco_imagem_usuario = $linha_1['endereco_imagem_usuario'];

//obtenção do questionario-
$sql = "SELECT * FROM questionarios WHERE id_questionario=$id_questionario";
$resultado = mysqli_query($conexao,$sql);

$linha = mysqli_fetch_assoc($resultado);

$id_aula = $linha['id_aula'];
$nome_questionario = $linha['nome_questionario'];
$distribuicao_questoes = $linha['distribuicao_questoes'];
$visibilidade_questionario = $linha['visibilidade_questionario'];

$tempo = explode("-",$linha['tempo_proxima_realizacao']);
$tempo_numero= $tempo[0];
$tempo_unidade= $tempo[1];

//-

//obtenção do id_modulo-
$s = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
$r = mysqli_query($conexao, $s);
$l = mysqli_fetch_assoc($r);
$id_modulo = $l['id_modulo'];
//-

//obtenção do id_curso-
$sq = "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
$res = mysqli_query($conexao, $sq);
$li = mysqli_fetch_assoc($res);
$id_curso = $li['id_curso'];
//-
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>(P) QUESTIONÁRIO</title>

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
        <a href="PROD__tela_aula_produtor.php?id_aula=<?=$id_aula;?>" class="breadcrumb bold">AULA</a>
        <a href="#!" class="breadcrumb bold">QUESTIONÁRIO</a>

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
            
            //obtenção das questões-
            $sql_1 = "SELECT * FROM questoes WHERE id_questionario=$id_questionario";
            $resultado_1 = mysqli_query($conexao, $sql_1);

            while($linha_1 = mysqli_fetch_assoc($resultado_1))
            {

                $id_questao[] = $linha_1['id_questao'];
                $desenvolvimento_questao[] = $linha_1['desenvolvimento_questao'];
                $distribuicao_alternativas[] = $linha_1['distribuicao_alternativas'];

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
            <div id='criar_questao' class='modal'>
                <div class='modal-content'>

                <form action='../../_questoes/____C2_insere_questao.php' method='post' id='criar_questao' enctype='multipart/form-data'>

                    <h4 class='center-align'>Criar Questão</h4><br>
            
                    <h6 class='bold'>Desenvolvimento da questão:<i class='material-icons right'>format_align_justify</i></h6>
                    <div class='input-field'>
                        <textarea id='field' type='text' name='desenvolvimento_questao' placeholder='insira o desenvolvimento da questão' class='materialize-textarea' style='text-align:justify'required></textarea>
                    </div>
                    
                    <br>
            
                    <h6 class='bold'>Distribuição das alternativas: <span class='right'><i class='fa fa-random'></i></span></h6>
                    <br>

                    <div class='switch'>
        
                        <label>

                            <h6 class='bold'>Aleatória
                            
                            <input type='checkbox' id='distribuicao_alternativas' name='distribuicao_alternativas' value='1' checked>

                            <span class='lever'></span>

                            Padronizada</h6>

                        </label>
                        
                    </div>
                           
                    <br>
            
                    <input type='hidden' name='id_questionario' value='$id_questionario'>
            
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
            <div id='excluir_questionario' class='modal'>
                <div class='modal-content'>
            
                    <h5 class='center-align'>Deseja realmente excluir o questionário <span class='bold'>$nome_questionario</span>?</h5>
                    <br><br><br>
        
                    <div class='center-align'>
        
                        <a href='../../__questionarios/_D1_excluir_questionario.php?id_questionario=$id_questionario' class='modal-trigger waves-effect waves-light btn bold'
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
            <div id='editar_questionario' class='modal'>
                <div class='modal-content'>

                <form action='../../__questionarios/__U2_altera_questionario.php' method='post' id='criar_material' enctype='multipart/form-data'>

                    <h4 class='center-align'>Editar Questionário</h4><br>
            
                    <h6 class='bold'>Nome do questionário:<i class='material-icons right'>border_color</i></h6>
                    <input id='field' type='text' name='nome_questionario' value='$nome_questionario' placeholder='insira o nome do questionário' required>

                    <br>
                    <br>

                    <h6 class='bold'>Tempo de espera para nova realização:<i class='material-icons right'>schedule</i></h6>
                    <div class='row'>
                        <div class='col s1' style='padding-left:0px; padding-right:5px;'>
                            <input id='field' type='number' value='$tempo_numero' name='tempo_numero' required>
                        </div>
                        <div class='col s2'>
                            <select name='tempo_unidade' style='border-color:#000;'>";

                            if($tempo_unidade == "M"){

                                echo "<option value='M' selected>minutos</option>
                                      <option value='H'>horas</option>
                                      <option value='D'>dias</option>";
        
                            }
        
                            if($tempo_unidade == "H"){
        
                                echo "<option value='M'>minutos</option>
                                        <option value='H' selected>horas</option>
                                        <option value='D'>dias</option>";
        
                            }
        
                            if($tempo_unidade == "D"){
        
                                echo "<option value='M'>minutos</option>
                                        <option value='H'>horas</option>
                                        <option value='D' selected>dias</option>";
        
                            }

echo"                       </select>
                        </div>
                    </div>
            
                    <br>
            
                    <h6 class='bold'>Distribuição das questões: <span class='right'><i class='fa fa-random'></i></span></h6>
                    <br>

                    <div class='switch'>

                        <label>

                            <h6 class='bold'>Aleatória";
                            
                                if($distribuicao_questoes == "aleatoria"){

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
                            
                                if($visibilidade_questionario == "não-visível"){

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
            
                    <input type='hidden' name='id_questionario' value='$id_questionario'>
            
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
            <div id='info' class='modal'>
                <div class='modal-content justify' style='font-size:1.25em'>
                    <h4 class='center'>Validade de Questionário</h4><br>
                    <p style='margin-bottom:40px;'>O questionário só é considerado válido quando há pelo menos uma questão válida, ou seja, uma questão que possua pelo menos uma resposta correta.</p>

                    <p><i class='material-icons left deep-purple-text'>check_circle</i> Questionário válido</p>
                    <p style='margin-bottom:30px;'><i class='material-icons left deep-purple-text'>cancel</i> Questionário inválido</p>
                    <p><i class='material-icons left'>check_circle</i> Questão válida</p>
                    <p><i class='material-icons left'>cancel</i> Questão inválida</p>
                </div>
                <div class='modal-footer'>
                    <a href='#!' class='modal-close waves-effect waves-purple btn-flat'>Ok</a>
                </div>
            </div>

            <div class='center-align'>

                <div style='height:35px;'>";

                        if(isset($id_alternativa_valida)){

                            echo "<i class='material-icons deep-purple-text' style='font-size:2.8em;'>check_circle</i> ";

                        } else {

                            echo "<i class='material-icons deep-purple-text' style='font-size:2.8em;'>cancel</i> ";

                        }

        echo "  
                    <a href='#info' class='modal-trigger' style='color:#212121;'><i class='material-icons' style='font-size:1.7em; vertical-align:super;'>info</i></a>
                </div> 
                <div style='font-weight:500; font-size:3em;'>    
                    $nome_questionario  
                </div>
                <a class='modal-trigger' href='#editar_questionario' style='color:#212121;'><i class='material-icons small'>edit</i></a>&nbsp&nbsp&nbsp
                <a class='modal-trigger' href='#excluir_questionario' style='color:#212121;'><i class='material-icons small'>delete</i></a>&nbsp&nbsp&nbsp";
                   
            if($visibilidade_questionario == "visível"){

                echo "<a href='../../__questionarios/inversao_situacao_visibilidade_questionario.php?id_questionario=$id_questionario&i=1' style='vertical-align:super; color:#212121;'>
                        <i class='fa fa-eye' style='font-size:2rem; vertical-align:middle; vertical-align:sub;'></i>
                      </a>";

            } else {

                echo "<a href='../../__questionarios/inversao_situacao_visibilidade_questionario.php?id_questionario=$id_questionario&i=1' style='vertical-align:super; color:#212121;'>
                        <i class='fa fa-eye-slash' style='font-size:2rem; vertical-align:sub;'></i>
                      </a>";
                
            } 
                   
echo "
            </div><br><br>";
            
        
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

                    $k=$i+1;

                    echo "
                    <div id='excluir_questao_$i' class='modal'>
                        <div class='modal-content'>
                    
                            <h5 class='center-align'>Deseja realmente excluir esta questão?</h5>
                            <br><br><br>
                
                            <div class='center-align'>
                
                                <a href='../../_questoes/_D1_excluir_questao.php?id_questao=".$id_questao[$i]."&id_questionario=$id_questionario' class='modal-trigger waves-effect waves-light btn bold'
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
                    <div id='editar_questao_$i' class='modal'>
                    <div class='modal-content'>

                    <form action='../../_questoes/__U2_altera_questao.php' method='post' id='editar_questao' enctype='multipart/form-data'>

                        <h4 class='center-align'>Edtiar Questão</h4><br>
                
                        <h6 class='bold'>Desenvolvimento da questão:<i class='material-icons right'>format_align_justify</i></h6>
                        <div class='input-field'>
                            <textarea id='field' type='text' name='desenvolvimento_questao' placeholder='insira o desenvolvimento da questão' class='materialize-textarea' style='text-align:justify'required>".$desenvolvimento_questao[$i]."</textarea>
                        </div>
                        
                        <br>
                
                        <h6 class='bold'>Distribuição das alternativas: <span class='right'><i class='fa fa-random'></i></span></h6>
                        <br>

                        <div class='switch'>
            
                            <label>

                                <h6 class='bold'>Aleatória";
                                
                                    if($distribuicao_alternativas[$i] == "aleatoria"){

                                        echo "<input type='checkbox' id='distribuicao_alternativas' name='distribuicao_alternativas' value='1'>";

                                    } else {

                                        echo "<input type='checkbox' id='distribuicao_alternativas' name='distribuicao_alternativas' value='1' checked>";

                                    }
                                
        echo "
                                <span class='lever'></span>

                                Padronizada</h6>

                            </label>
                            
                        </div>
                            
                        <br>
                
                        <input type='hidden' name='id_questao' value='".$id_questao[$i]."'>
                        <input type='hidden' name='id_questionario' value='$id_questionario'>
                
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
                <div id='criar_alternativa_$i' class='modal'>
                <div class='modal-content'>

                <form action='../../alternativas/____C2_insere_alternativa.php' method='post' id='criar_alternativa' enctype='multipart/form-data'>

                    <h4 class='center-align'>Criar Alternativa</h4><br>
            
                    <h6 class='bold'>Desenvolvimento da alternativa:<i class='material-icons right'>format_align_justify</i></h6>
                    <div class='input-field'>
                        <textarea id='field' type='text' name='desenvolvimento_alternativa' placeholder='insira o desenvolvimento da alternativa' class='materialize-textarea' style='text-align:justify'required></textarea>
                    </div>
                    
                    <br>
            
                    <h6 class='bold'>Validade da alternativa:<i class='material-icons right'>done</i></h6>
                    <br>

                    <div class='switch'>
        
                        <label>

                            <h6 class='bold'>Incorreta
                            
                            <input type='checkbox' id='validade_alternativa' name='validade_alternativa' value='1'>

                            <span class='lever'></span>

                            Correta</h6>

                        </label>
                        
                    </div>
                           
                    <br>
            
                    <input type='hidden' name='id_questao' value='".$id_questao[$i]."'>
                    <input type='hidden' name='id_questionario' value='$id_questionario'>
            
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
                    <ul class='collapsible hoverable' 
                    style='border:1px solid #DCDCDC; border-radius:10px; margin-bottom:25px;'>
                    <li>
                        <div class='collapsible-header valign-wrapper' style='border:0px; border-radius:10px; border-color:#DCDCDC;'>
                            <div class='row valign-wrapper' style='margin:0px; width:100%;'>

                                <div class='col s11 valign-wrapper'>
                                    <i class='material-icons left' style='font-size:2.5em; margin-right:15px;'>arrow_drop_down</i>";
                                    if(isset($validade_questao[$i])){
    
                                        echo "<i class='material-icons' style='margin-right:30px; vertical-align:sub;'>check_circle</i> ";
                        
                                    } else {
                        
                                        echo "<i class='material-icons' style='margin-right:30px; vertical-align:sub;'>cancel</i> ";
                        
                                    }
                                    echo"    
                                    <span style='font-size:1.35em; line-height: 1.3; font-weight:400' class='justify'>".$desenvolvimento_questao[$i]."</span> 
                                ";

                    echo " 
                            </div>
                            <div class='col s1 valign-wrapper'>
                                <a class='modal-trigger' href='#editar_questao_$i' style='color:#212121; vertical-align:middle;'>
                                    <i class='material-icons' style='margin:0px; vertical-align:middle;'>edit</i>
                                </a>
                                <a class='modal-trigger' href='#excluir_questao_$i' style='margin-left:15px; color:#212121; vertical-align:middle;'>
                                    <i class='material-icons' style='margin:0px; vertical-align:middle;'>delete</i>
                                </a>
                                <br><br>
                            </div>
                            ";

                    echo "
                        </div>
                    </div>
                    <div class='collapsible-body' style='border:0px; border-radius:10px;'>";

                    if(isset($id_alternativa[$i])){

                        for($l=0 ; $l<count($id_alternativa[$i]) ; $l++){
                            
                            echo "
                            <div id='excluir_alternativa_$i".'_'."$l' class='modal'>
                                <div class='modal-content'>
                            
                                    <h5 class='center-align'>Deseja realmente excluir esta alternativa?</h5>
                                    <br><br><br>
                        
                                    <div class='center-align'>
                        
                                        <a href='../../alternativas/_D1_excluir_alternativa.php?id_alternativa=".$id_alternativa[$i][$l]."&id_questionario=$id_questionario' class='modal-trigger waves-effect waves-light btn bold'
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
                            <div id='editar_alternativa_$i".'_'."$l' class='modal'>
                                <div class='modal-content'>

                                <form action='../../alternativas/__U2_altera_alternativa.php' method='post' id='editar_alternativa' enctype='multipart/form-data'>

                                    <h4 class='center-align'>Editar Alternativa</h4><br>
                            
                                    <h6 class='bold'>Desenvolvimento da alternativa:<i class='material-icons right'>format_align_justify</i></h6>
                                    <div class='input-field'>
                                        <textarea id='field' type='text' name='desenvolvimento_alternativa' placeholder='insira o desenvolvimento da alternativa' class='materialize-textarea' style='text-align:justify'required>".$desenvolvimento_alternativa[$i][$l]."</textarea>
                                    </div>
                                    
                                    <br>
                            
                                    <h6 class='bold'>Validade da alternativa:<i class='material-icons right'>done</i></h6>
                                    <br>

                                    <div class='switch'>
                        
                                        <label>

                                            <h6 class='bold'>Incorreta";
                                            
                                            if($validade_alternativa[$i][$l] == "correta"){

                                                echo "<input type='checkbox' id='validade_alternativa' name='validade_alternativa' value='1' checked>";
                                            
                                            } else {

                                                echo "<input type='checkbox' id='validade_alternativa' name='validade_alternativa' value='1'>";

                                            }

    echo"                                   <span class='lever'></span>

                                            Correta</h6>

                                        </label>
                                        
                                    </div>
                                        
                                    <br>
                            
                                    <input type='hidden' name='id_alternativa' value='".$id_alternativa[$i][$l]."'>
                                    <input type='hidden' name='id_questao' value='".$id_questao[$i]."'>
                                    <input type='hidden' name='id_questionario' value='$id_questionario'>
                            
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

                            <div class='row' style='margin-bottom:15px; border: 1px solid #9575cd; border-radius:10px;'>
                                <div class='col s12 valign-wrapper' style='padding-top:10px; padding-left:30px; padding-right:0px;; padding-bottom:10px; border-radius:10px;'>
                                    <div class='col s11 valign-wrapper' style='margin:0px; padding:0px; height:auto; min-height:42px; vertical-align:middle;'>
                                        <a class='modal-trigger' href='#editar_alternativa_$i".'_'."$l' style='color:#000;'><i class='material-icons' style='font-size:1.3em; vertical-align:bottom;'>edit</i></a>&nbsp&nbsp&nbsp
                                        <a class='modal-trigger' href='#excluir_alternativa_$i".'_'."$l' style='color:#000;'><i class='material-icons' style='font-size:1.3em; vertical-align:bottom; margin-right:30px;'>delete</i></a>
                                        <span style='font-size:1.2em; line-height:1.2;' class='justify'>".$desenvolvimento_alternativa[$i][$l]."</span>
                                    </div>
                                    <div class='col s1 center' style='margin:0px; padding:0px; height:100%; min-height:42px; vertical-align:middle;'>";
                                    
                                        if($validade_alternativa[$i][$l] == "correta"){

                                            echo "
                                            <div class='btn btn-floating green darken-2' style='margin:0px; padding:0px; width:3em; height:3em;'>
                                                <i class='material-icons' style='height:auto;'>check</i>
                                            </div>";
    
                                        } else {
    
                                            echo "
                                            <div class='btn btn-floating red darken-2' style='margin:0px; padding:0px; width:3em; height:3em;'>
                                                <i class='material-icons' style='height:auto;'>close</i>
                                            </div>";
    
                                        }
                                    
                                    
    echo"                           </div>
                                </div>
                            </div>";

                        }

                    } else {

                        echo "<div style='font-size:1.4em; font-weight:500;'>Não existem alternativas cadastradas nesta questão</div><br>";

                    }

                    echo "<br>
                        <a href='#criar_alternativa_$i' class='modal-trigger white-text'>
                            <div class='waves-effect waves-light btn bold deep-purple'>
                                <i class='material-icons left'>add</i>ADICIONAR ALTERNATIVA
                            </div>
                        </a>
                    </div>
                    </li>
                    </ul>";
                
                }

            } else {

                echo "<br><div style='font-size:1.6em; font-weight:500;'>Não existem questões cadastradas neste questionário</div><br><br><br>";

            }

            echo "<br><div class='center'>
                        <a href='#criar_questao' class='modal-trigger white-text'>
                            <div class='waves-effect waves-light btn bold deep-purple' style='font-size:1.2em;'>
                                <i class='material-icons left' style='font-size:1.5em;'>add</i>ADICIONAR QUESTÃO
                            </div>
                        </a>
                  </div><br><br><br>";
        
        ?>

        <div class="center">
            <a href='PROD__tela_aula_produtor.php?id_aula=<?= $id_aula; ?>' class="white-text">
                <div class='waves-effect waves-light btn bold deep-purple' style='font-size:1.1em;'>
                    <i class='material-icons left'>keyboard_backspace</i>Voltar
                </div>
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