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
$id_questionario= mysqli_real_escape_string($conexao,$_POST['id_questionario']);
$id_aula = mysqli_real_escape_string($conexao,$_POST['id_aula']);
$questoes = $_SESSION['questoes'];

$sql_1 = "SELECT * FROM usuarios WHERE id_usuario='".$_SESSION['id_usuario']."'";
$resultado_1 = mysqli_query($conexao, $sql_1);
$linha_1 = mysqli_fetch_assoc($resultado_1);
$nome_usuario = $linha_1['nome_usuario'];
$endereco_imagem_usuario = $linha_1['endereco_imagem_usuario'];

//obtenção do id_modulo-
$s1 = "SELECT id_modulo FROM aulas WHERE id_aula=$id_aula";
$r1 = mysqli_query($conexao, $s1);
$l1 = mysqli_fetch_assoc($r1);
$id_modulo = $l1['id_modulo'];
//-

//obtenção do id_curso
$s2 =  "SELECT id_curso FROM modulos WHERE id_modulo=$id_modulo";
$r2 = mysqli_query($conexao, $s2);
$l2 = mysqli_fetch_assoc($r2);
$id_curso = $l2['id_curso'];
//-
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>(C) QUESTIONÁRIO</title>

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
        <a href="CONS____home_consumidor.php" class="breadcrumb bold" style='margin-left:30px;'>HOME CONSUMIDOR</a>
        <a href="CONS___tela_curso_consumidor.php?id_curso=<?=$id_curso;?>" class="breadcrumb bold">CURSO</a>
        <a href="CONS__tela_aula_consumidor.php?id_aula=<?=$id_aula;?>" class="breadcrumb bold">AULA</a>
        <a href="#!" class="breadcrumb bold">QUESTIONÁRIO</a>

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

            $acertos=0;
            
            //obtendo as informações do questionário-
            $sql = "SELECT * FROM questionarios WHERE id_questionario=$id_questionario";
            $resultado = mysqli_query($conexao, $sql);

            $linha = mysqli_fetch_assoc($resultado);

            $tempo = explode("-",$linha['tempo_proxima_realizacao']);
            
            $tempo_numero = $tempo[0];
            $tempo_unidade = $tempo[1];

            $nome_questionario = $linha['nome_questionario'];
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

            echo "<div class='center' style='font-weight:500; font-size:3em; margin-bottom:10px;'>    
                    $nome_questionario
                    </div>";

            for($b=0 ; $b<count($questoes) ; $b++){

                $n = $b+1;

                echo "<br><br><div style='font-size:1.3em; margin-bottom:27px; line-height:1.3;' class='justify'>
                        <span style='font-weight:500;'>".
                            $n.
                        ") </span>".
                        $questoes[$b]['desenvolvimento_questao'].
                        "</div>";
    
                for($c=0 ; $c<count($questoes[$b]['alternativas']) ; $c++){       
    
                    if($_POST[$questoes[$b]['id_questao']] == $questoes[$b]['alternativas'][$c]['id_alternativa']){

                        $id_alt[$b][$c]= $questoes[$b]['alternativas'][$c]['id_alternativa'];
                        $s[$b][$c]= "SELECT * FROM alternativas WHERE id_alternativa=".$id_alt[$b][$c];
                        $r[$b][$c]= mysqli_query($conexao, $s[$b][$c]);
                        $l[$b][$c]= mysqli_fetch_assoc($r[$b][$c]);

                        $val_alt[$b][$c] = $l[$b][$c]['validade_alternativa'];

                        if($val_alt[$b][$c] == "correta"){

                            echo "
                            <p style='margin-bottom:8px;'>
                                <label class='justify'>
                                    <input type='radio' id='".$questoes[$b]['alternativas'][$c]['id_alternativa']."' name='".$questoes[$b]['id_questao']."'
                                    value='".$questoes[$b]['alternativas'][$c]['validade_alternativa']."' disabled='disabled' checked>
                                    <span class='bold' style='line-height:1.25; font-size:1.4em; color:#4caf50 !important;'>". 
                                        $questoes[$b]['alternativas'][$c]['desenvolvimento_alternativa']."
                                    </span>
                                </label>
                            </p>";

                            $acertos++;

                        } elseif($val_alt[$b][$c] == "incorreta"){
    
                            echo"
                            <p style='margin-bottom:8px;'>
                                <label class='justify'>
                                    <input type='radio' id='".$questoes[$b]['alternativas'][$c]['id_alternativa']."' name='".$questoes[$b]['id_questao']."'
                                    value='".$questoes[$b]['alternativas'][$c]['validade_alternativa']."' disabled='disabled' checked>
                                    <span class='bold' style='line-height:1.25; font-size:1.4em; color:#f44336 !important;'>". 
                                        $questoes[$b]['alternativas'][$c]['desenvolvimento_alternativa']."
                                    </span>
                                </label>
                            </p>";
                        
                        }
    
                    } else {

                        echo "
                        <p style='margin-bottom:8px;'>
                            <label class='justify'>
                                <input type='radio' id='".$questoes[$b]['alternativas'][$c]['id_alternativa']."' name='".$questoes[$b]['id_questao']."'
                                value='".$questoes[$b]['alternativas'][$c]['validade_alternativa']."' disabled='disabled'>
                                <span style='line-height:1.25; font-size:1.4em; color:#4c4c4c;'>". 
                                    $questoes[$b]['alternativas'][$c]['desenvolvimento_alternativa']."
                                </span>
                            </label>
                        </p>";

                    }

                }

            }
            
            $nota_usuario = ($acertos/count($questoes))*100;

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

            echo "<br><br>
                  <div style='font-size:1.4em; font-weight:500;'>$acertos/".count($questoes)." = $nota_usuario% → ";

            if($nota_usuario >= 70){

                echo "<span style='color:#388e3c;'>Parabéns! Você atingiu a nota requerida!</span>";

            } else {

                echo "<span style='color:#d32f2f;'>Infelizmente você não conseguiu atingir a nota requerida (70%).</span>
                O questionário estará diponível novamente em $tempo_numero $nome_unidade.";

            }

            echo "</div>";

        ?>

        <br><br>
        <div class='center-align'>
            <a href='CONS__tela_aula_consumidor.php?id_aula=<?=$id_aula;?>' class='waves-effect waves-light btn deep-purple bold' style='font-size:1.1em;'>
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
    </body>
</html>