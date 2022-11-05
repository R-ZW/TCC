<?php
session_start();
require_once "../../_______necessarios/.conexao_bd.php";
require_once "../../_______necessarios/.funcoes.php";

if (!isset($_SESSION['id_usuario'])) {
$_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
header("Location: ../entrada.php");
}

$email= $_SESSION['email'];
$id_questionario= mysqli_real_escape_string($conexao,$_GET['id_questionario']);

$sql_1 = "SELECT * FROM usuarios WHERE id_usuario='".$_SESSION['id_usuario']."'";
$resultado_1 = mysqli_query($conexao, $sql_1);
$linha_1 = mysqli_fetch_assoc($resultado_1);
$nome_usuario = $linha_1['nome_usuario'];
$endereco_imagem_usuario = $linha_1['endereco_imagem_usuario'];


//obtenção do id_aula-
$s = "SELECT id_aula FROM questionarios WHERE id_questionario=$id_questionario";
$r = mysqli_query($conexao, $s);
$l = mysqli_fetch_assoc($r);
$id_aula = $l['id_aula'];
//-

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>(C) QUESTIONÁRIO</title>
    
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
        <a href="#!" class="breadcrumb bold" style='margin-left:30px;'>HOME CONSUMIDOR</a>
        <a href="#!" class="breadcrumb bold">CURSO</a>
        <a href="#!" class="breadcrumb bold">AULA</a>
        <a href="#!" class="breadcrumb bold">QUESTIONÁRIO</a>
        
        <a href="#!" class="brand-logo center"><img src='../../_.imgs_default/logo_n2.png' height="70px" style="margin-top:10px;"></a>

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
            <a href='#!' class="waves-effect">Permutar Conta
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

            date_default_timezone_set('America/Sao_Paulo');

            //----------------------
            //obtendo o questionario-
            $sq = "SELECT * FROM questionarios WHERE id_questionario=$id_questionario";
            $res = mysqli_query($conexao, $sq);

            $li = mysqli_fetch_assoc($res);

            $nome_questionario = $li['nome_questionario'];
            $distribuicao_questoes = $li['distribuicao_questoes'];
            //-


            //obtendo as questões-
            $sql = "SELECT * FROM questoes WHERE id_questionario=$id_questionario";
            $resultado = mysqli_query($conexao, $sql);

            while ($linha = mysqli_fetch_assoc($resultado)){

                $id_questao[] = $linha['id_questao']; 

            }
            //-


            //obtendo as alternativas válidas-
            for($a=0 ; $a<count($id_questao) ; $a++){

                $sqla[$a] = "SELECT id_alternativa FROM alternativas WHERE validade_alternativa='correta' AND id_questao=".$id_questao[$a];
                $resultadoa[$a] = mysqli_query($conexao, $sqla[$a]);

                while ($linhaa = mysqli_fetch_assoc($resultadoa[$a])){

                    $id_alternativa_valida0[] = $linhaa['id_alternativa'];

                }

            }
            //-


            //obtendo as questões válidas-
            for($b=0 ; $b<count($id_alternativa_valida0) ; $b++){

                $sqlb[$b] = "SELECT id_questao FROM alternativas WHERE id_alternativa=".$id_alternativa_valida0[$b];
                $resultadob[$b] = mysqli_query($conexao, $sqlb[$b]);

                while ($linhab = mysqli_fetch_assoc($resultadob[$b])){

                    $id_questao_valida[] = $linhab['id_questao'];

                }

            }
            //-


            for($d=0 ; $d<count($id_questao_valida) ; $d++){

                //obtendo as questões válidas-
                $sqld[$d] = "SELECT * FROM questoes WHERE id_questao=".$id_questao_valida[$d];
                $resultadod[$d] = mysqli_query($conexao, $sqld[$d]);

                $linhad = mysqli_fetch_assoc($resultadod[$d]);

                $questoes[$d]['id_questao'] = $linhad['id_questao'];
                $questoes[$d]['desenvolvimento_questao'] = $linhad['desenvolvimento_questao'];
                $questoes[$d]['distribuicao_alternativas'] = $linhad['distribuicao_alternativas'];
                //-

                //obtendo as alternativas das questões válidas-
                $sqle[$d] = "SELECT * FROM alternativas WHERE id_questao=".$id_questao_valida[$d];
                $resultadoe[$d] = mysqli_query($conexao, $sqle[$d]);

                $e=0;
                while ($linhae = mysqli_fetch_assoc($resultadoe[$d])){

                    $questoes[$d]['alternativas'][$e]['id_alternativa'] = $linhae['id_alternativa'];
                    $questoes[$d]['alternativas'][$e]['desenvolvimento_alternativa'] = $linhae['desenvolvimento_alternativa'];
                    $questoes[$d]['alternativas'][$e]['validade_alternativa'] = $linhae['validade_alternativa'];

                    $e++;

                }
                //-


                //obtendo as informações da relação do usuário com o questionário-
                $sql_1 = "SELECT * FROM relacao_usuario_questionario WHERE id_questionario=$id_questionario AND email='$email'";
                $resultado_1 = mysqli_query($conexao, $sql_1);

                $linha_1 = mysqli_fetch_assoc($resultado_1);
            }
            //----------------------


            $data_hoje= new DateTime();
            $data_proxima_realizacao = new DateTime($linha_1['data_proxima_realizacao']);

            $data_exibivel = $data_proxima_realizacao->format('d/m/Y');
            $tempo_exibivel = $data_proxima_realizacao->format('H:i:s');

            if($data_proxima_realizacao > $data_hoje){

                $_SESSION['mensagem'] = "Você só poderá realizar este questionário novamente na seguinte data/horário: <br><br> <span class='bold'>$data_exibivel as $tempo_exibivel</span>";
                echo "<script>window.history.go(-1);</script>";
                
                die;
            
            } else {

                echo "<div class='center' style='font-weight:500; font-size:3em; margin-bottom:10px;'>    
                        $nome_questionario
                      </div>      
                    
                    <form action='CONS_tela_questionario_consumidor_2.php' method='post'>";

                if($distribuicao_questoes == "aleatoria"){

                    shuffle($questoes);

                } 


                for($f=0 ; $f<count($questoes) ; $f++){

                    $n = $f+1;

                    echo "<br><br><div style='font-size:1.3em; margin-bottom:27px; line-height:1.3;' class='justify'>
                            <span style='font-weight:500;'>".
                                $n.
                           ") </span>".
                            $questoes[$f]['desenvolvimento_questao'].
                          "</div>";

                    if($questoes[$f]['distribuicao_alternativas'] == "aleatoria"){
                        shuffle($questoes[$f]['alternativas']);
                    }

                    for($g=0 ; $g<count($questoes[$f]['alternativas']) ; $g++){


                    echo "
                        <p style='margin-bottom:8px;'>
                            <label class='justify'>
                                <input type='radio' name='".$questoes[$f]['id_questao']."'
                                value='".$questoes[$f]['alternativas'][$g]['id_alternativa']."' required>
                                <span style='line-height:1.25; font-size:1.4em; color:#4c4c4c;'>". 
                                    $questoes[$f]['alternativas'][$g]['desenvolvimento_alternativa']."
                                </span>
                            </label>
                        </p>";

                    }

                }


                echo "<br><br>
                        <input type='hidden' name='id_questionario' value='$id_questionario'>
                        <input type='hidden' name='id_aula' value='$id_aula'>

                        <div class='center'>
                            <button type='submit' class='waves-effect waves-light btn deep-purple bold'>
                                ENVIAR <i class='material-icons right'>check</i>
                            </button>
                            <button type='reset' class='waves-effect waves-light btn deep-purple bold'>
                                REDEFINIR <i class='material-icons right'>sync</i>
                            </button>  
                        </div>
                    </form>";

                $_SESSION['questoes'] = $questoes;

            }

        ?>
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