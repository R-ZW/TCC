<?php
session_start();
require_once "../../_______necessarios/.conexao_bd.php";
require_once "../../_______necessarios/.funcoes.php";

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../entrada.php");
}

$email= $_SESSION['email'];

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
    <title>Home Produtor</title>

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

    <div id="criar_curso" class="modal">
        <div class="modal-content">
        
            <?php include "../../_____cursos/____C1_form_insere_curso.php";?>

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

        <a href="#!" class="breadcrumb" style='margin-left:30px;'>HOME PRODUTOR</a>

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

            //obtenção dos cursos associados ao usuário como produtor-
            $sql = "SELECT id_curso FROM relacao_usuario_curso WHERE email='$email' AND tipo_relacao='produtor'";
            $resultado = mysqli_query($conexao,$sql);

            while($linha = mysqli_fetch_assoc($resultado))
            {
                $id_curso1[]= $linha['id_curso'];
            }
            //-

            if(isset($_GET['pesquisa'])){
                $pesquisa = $_GET['pesquisa'];
            } else {
                $pesquisa = "";
            }

            if(isset($_GET['p'])){
                $p = $_GET['p'];
            } else {
                $p = 1;
            }

            if(isset($_GET['limite'])){
                $limite = $_GET['limite'];
            } else {
                $limite = 5;
            }

            $offset = $limite * ($p - 1);
            
            echo "
                <div class='row'>
                    <form action='' method='GET' class='col s12' style='padding:0px;'>
                    <div class='input-field col s10'>";
                    if($pesquisa != ""){

                        echo "<a href='PROD____home_produtor.php?limite=$limite' style='color:#212121;'><i class='material-icons postfix'>clear</i></a>";
            
                    }
            echo "  <i class='material-icons prefix' type='submit'>search</i></button>
                    <input type='text' id='field' name='pesquisa' value='$pesquisa' placeholder='Buscar'> ";
                
            echo "
                    </div>
                    <div class='col s2 center-align'>
                        Cursos por página:
                        <ul class='pagination'>";
                        if($limite == 5){
                            echo "
                            <li class='active deep-purple lighten-2'><a href='PROD____home_produtor.php?limite=5&p=1&pesquisa=$pesquisa'>5</a></li>
                            <li class='waves-effect'><a href='PROD____home_produtor.php?limite=10&pesquisa=$pesquisa'>10</a></li>
                            <li class='waves-effect'><a href='PROD____home_produtor.php?limite=15&pesquisa=$pesquisa'>15</a></li>
                            ";
                        }
                        if($limite == 10){
                            echo "
                            <li class='waves-effect'><a href='PROD____home_produtor.php?limite=5&pesquisa=$pesquisa'>5</a></li>
                            <li class='active deep-purple'><a href='PROD____home_produtor.php?limite=10&pesquisa=$pesquisa'>10</a></li>
                            <li class='waves-effect'><a href='PROD____home_produtor.php?limite=15&pesquisa=$pesquisa'>15</a></li>
                            ";
                        }
                        if($limite == 15){
                            echo "
                            <li class='waves-effect'><a href='PROD____home_produtor.php?limite=5&pesquisa=$pesquisa'>5</a></li>
                            <li class='waves-effect'><a href='PROD____home_produtor.php?limite=10&pesquisa=$pesquisa'>10</a></li>
                            <li class='active deep-purple darken-4'><a href='PROD____home_produtor.php?limite=15&pesquisa=$pesquisa'>15</a></li>
                            ";
                        }
            echo "
                        </ul>
                </div>
                </form>
                </div>
                <div class='center-align'>
                <a href='#criar_curso' class='modal-trigger btn waves-effect waves-light deep-purple'>
                    <div style='color: #FFFFFF;' class='bold valign-wrapper'>ADICIONAR CURSO &nbsp<i class='material-icons'>add</i></div>
                </a>
                </div>
                <br>";

            if(isset($id_curso1)){
                //obtenção dos dados dos cursos
                $b=0;
                while($b<count($id_curso1)){

                    $sqlb[$b]= "SELECT * 
                                FROM cursos 
                                WHERE id_curso=".$id_curso1[$b]." 
                                AND nome_curso LIKE '%$pesquisa%'";
                    $resultadob[$b] = mysqli_query($conexao,$sqlb[$b]); 
        
                    if($resultadob[$b]){

                        while($linhab[$b] = mysqli_fetch_assoc($resultadob[$b]))
                        {

                            $id_curso[] = $linhab[$b]['id_curso'];
                            $nome_curso[]= $linhab[$b]['nome_curso'];
                            $descricao_curso[]= substr($linhab[$b]['descricao_curso'], 0, 320) . "...";
                            $descricao_curso1[]= $linhab[$b]['descricao_curso'];
                            $endereco_imagem_curso[]= $linhab[$b]['endereco_imagem_curso'];
                            $visibilidade_curso[]= $linhab[$b]['visibilidade_curso'];

                        }

                    }
                    
                    $b++;

                }

            }
            //-

            if(isset($id_curso)){

                $ultima_pagina = ceil(count($id_curso) / $limite);
                $limitep = $limite * $p;

                if($p*$limite > count($id_curso)+($limite-1)){

                    echo "<div style='font-size:2.5em; font-weight:500;'>Número de página inválido!</div>";

                } else {

                    for($i=$offset; $i<count($id_curso) and $i<$limitep; $i++){

                        echo "
                            <script>
                            function previewImagemEditar$i(){
                                let imagem = document.querySelector('input[id=endereco_imagem_curso_edicao$i]').files[0];
                                let preview = document.querySelector('#imagem_curso_edicao$i');
                                let preview1 = document.querySelector('#imagem_curso_edicao_1_$i');
                    
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

                            <div id='excluir_curso_$i' class='modal'>
                                <div class='modal-content'>
                                
                                    <h5 class='center-align'>Deseja realmente excluir o curso <span class='bold'>".$nome_curso[$i]."</span>?</h5>
                                    <br><br><br>

                                    <div class='center-align'>

                                        <a href='../../_____cursos/_D1_excluir_curso.php?id_curso=" . $id_curso[$i] . "' class='modal-trigger waves-effect waves-light btn bold'
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

                            <div id='editar_curso_$i' class='modal'>
                                <div class='modal-content'>

                                    <form action='../../_____cursos/__U2_altera_curso.php' method='post' id='editar_curso$i' enctype='multipart/form-data'>

                                        <h4 class='center-align'>Editar Curso</h4><br>

                                        <h6 class='bold'>Nome do curso:<i class='material-icons right'>border_color</i></h6>
                                        <input id='field' type='text' name='nome_curso' placeholder='insira o nome do curso' value='".$nome_curso[$i]."' required>

                                        <br>
                                        <br>

                                        <h6 class='bold'>Descrição do curso:<i class='material-icons right'>subject</i></h6>
                                        <div class='input-field'>
                                        <textarea id='field' type='text' name='descricao_curso' placeholder='insira a descrição do curso' class='materialize-textarea' form='editar_curso$i' style='text-align:justify'required>".$descricao_curso1[$i]."</textarea>
                                        </div>

                                        <h6 class='bold'>Imagem do curso (16x9):<i class='material-icons right'>image</i></h6>
                        
                                        <div class='file-field'>
                                            <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                                <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                                <input id='endereco_imagem_curso_edicao$i' name='endereco_imagem_curso' type='file' accept='image/*' onchange='previewImagemEditar$i()'>
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
                                                    <img id='imagem_curso_edicao$i' src='" . $endereco_imagem_curso[$i] ."' width='300em' height='169em' style='border-radius:4%;'>
                                            
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
                                                    <img id='imagem_curso_edicao_1_$i' src='" . $endereco_imagem_curso[$i] ."' style='filter: brightness(80%);' width='900em' height='506.25em'>
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
                                            
                                                if($visibilidade_curso[$i] == "não-visível"){

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

                                        <input type='hidden' name='endereco_imagem_curso_pre_alteracao' value='".$endereco_imagem_curso[$i]."'>
                                        <input type='hidden' name='id_curso' value='".$id_curso[$i]."'>

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

                            <a href='PROD___tela_curso_produtor.php?id_curso=" . $id_curso[$i] . "' style='color:black;'>
                            
                                <div class='card-panel hoverable'>
                                    <div class='row'>
                                        <div class='col s5'>
                                        
                                            <br>
                                            <img src=" . $endereco_imagem_curso[$i] ." width='400em' height='225em' style='border-radius:4%;'>
                                    
                                        </div>
                                    
                                        <div class='col s7'>

                                            <h4 class='bold center-align'>" . $nome_curso[$i] . "</h4>
                                            <br>
                                            <h6 style='text-align:justify; font-size:1.3em;'>" . $descricao_curso[$i] . "</h6>

                                        </div> 
                                    </div>
                                    <div class='center-align' style='height:31.5px'>

                                        <a href='#editar_curso_$i' class='modal-trigger' style='color:#673ab7; vertical-align: text-bottom;'><i class='material-icons small'>edit</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        <a href='#excluir_curso_$i' class='modal-trigger' style='color:#673ab7; vertical-align: text-bottom;'><i class='material-icons small'>delete</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                    
                                        if($visibilidade_curso[$i] == "visível"){

                                            echo "<a href='../../_____cursos/inversao_situacao_visibilidade_curso.php?id_curso=".$id_curso[$i]."' style='color:#673ab7; vertical-align: super;'><i class='fa fa-eye fa-2x'></i></a>";
                            
                                        } else {
                            
                                            echo "<a href='../../_____cursos/inversao_situacao_visibilidade_curso.php?id_curso=".$id_curso[$i]."' style='color:#673ab7; vertical-align: super;'><i class='fa fa-eye-slash fa-2x'></i></a>";
                                            
                                        }
                        echo"    
                                    </div>
                                    
                                </div>
                            
                            </a>
                            <br>
                                
                        ";

                    }

                }
                
                echo "<ul class='pagination center-align'>";

                if($p==1){

                    echo "<li class='disabled'><a href='#!'><i class='material-icons'>chevron_left</i></a></li>";
                
                } else {

                    $pAntecessora = $p-1;

                    echo "<li class='waves-effect'>
                            <a href='PROD____home_produtor.php?limite=$limite&p=$pAntecessora&pesquisa=$pesquisa'>
                                <i class='material-icons'>chevron_left</i>
                            </a>
                          </li>";

                }

                    if($ultima_pagina > 1){

                        for($i=1; $i<=$ultima_pagina; $i++){

                            if($i==$p){

                              echo "<li class='active deep-purple'><a href='#!'>$i</a></li>";  

                            } else {

                                echo "<li class='waves-effect'><a href='PROD____home_produtor.php?limite=$limite&p=$i&pesquisa=$pesquisa'>$i</a></li>";

                            }
                             
                        }

                    } else {

                        echo "<li class='active deep-purple'><a href='#!'>1</a></li>";
                        
                    }

                if($p==$ultima_pagina){

                    echo "<li class='disabled'><a href='#!'><i class='material-icons'>chevron_right</i></a></li>";
                
                } else {

                    $pSucessora = $p+1;
                    
                    echo "<li class='waves-effect'>
                            <a href='PROD____home_produtor.php?limite=$limite&p=$pSucessora&pesquisa=$pesquisa'>
                                <i class='material-icons'>chevron_right</i>
                            </a>
                            </li>";

                }

                echo "</ul>";

            } else {

                echo "<div style='font-size:2.5em; font-weight:500;'>Não foram encontrados cursos!</div>";

            }

        ?>
    </main>
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

        function previewImagemCurso(){
            let imagem = document.querySelector('input[id=endereco_imagem_curso_cadastro]').files[0];
            let preview = document.querySelector('#imagem_curso_cadastro');
            let preview1 = document.querySelector('#imagem_curso_cadastro_1');

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