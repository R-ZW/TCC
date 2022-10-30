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
    <title>Home Consumidor</title>

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

        <a href="#!" class="breadcrumb" style='margin-left:30px;'>HOME CONSUMIDOR</a>

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

            //obtenção dos cursos associados ao usuário como consumidor-
            $sql = "SELECT id_curso FROM relacao_usuario_curso WHERE email='$email' AND tipo_relacao='consumidor'";
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

            if(isset($_GET['fav'])){
                $fav = $_GET['fav'];
            } else {
                $fav = 0;
            }

            $offset = $limite * ($p - 1);

            echo "
                <div class='row'>
                    <form action='' method='GET' class='col s12' style='padding:0px;'>
                    <div class='input-field col s10'>";
                    if($pesquisa != ""){

                        echo "<a href='CONS____home_consumidor.php?limite=$limite&fav=$fav' style='color:#212121;'><i class='material-icons postfix'>clear</i></a>";
            
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
                            <li class='active deep-purple lighten-2'><a href='CONS____home_consumidor.php?limite=5&p=1&pesquisa=$pesquisa&fav=$fav'>5</a></li>
                            <li class='waves-effect'><a href='CONS____home_consumidor.php?limite=10&pesquisa=$pesquisa&fav=$fav'>10</a></li>
                            <li class='waves-effect'><a href='CONS____home_consumidor.php?limite=15&pesquisa=$pesquisa&fav=$fav'>15</a></li>
                            ";
                        }
                        if($limite == 10){
                            echo "
                            <li class='waves-effect'><a href='CONS____home_consumidor.php?limite=5&pesquisa=$pesquisa&fav=$fav'>5</a></li>
                            <li class='active deep-purple'><a href='CONS____home_consumidor.php?limite=10&pesquisa=$pesquisa&fav=$fav'>10</a></li>
                            <li class='waves-effect'><a href='CONS____home_consumidor.php?limite=15&pesquisa=$pesquisa&fav=$fav'>15</a></li>
                            ";
                        }
                        if($limite == 15){
                            echo "
                            <li class='waves-effect'><a href='CONS____home_consumidor.php?limite=5&pesquisa=$pesquisa&fav=$fav'>5</a></li>
                            <li class='waves-effect'><a href='CONS____home_consumidor.php?limite=10&pesquisa=$pesquisa&fav=$fav'>10</a></li>
                            <li class='active deep-purple darken-4'><a href='CONS____home_consumidor.php?limite=15&pesquisa=$pesquisa&fav=$fav'>15</a></li>
                            ";
                        }
            echo "
                        </ul>
                </div>
                </form>
                </div>
                <div class='center-align'>";
            
            if($fav==0){

                echo "<a href='CONS____home_consumidor.php?limite=5&pesquisa=$pesquisa&fav=1' class='btn waves-effect waves-light white'>
                        <div style='color: #673ab7;' class='bold valign-wrapper'>MOSTRAR APENAS FAVORITOS &nbsp<i class='fa fa-star-o'></i></div>
                      </a>";

            } else {

                echo "<a href='CONS____home_consumidor.php?limite=5&pesquisa=$pesquisa&fav=0' class='btn waves-effect waves-light deep-purple'>
                        <div style='color: #FFFFFF;' class='bold valign-wrapper'>MOSTRAR APENAS FAVORITOS &nbsp<i class='fa fa-star'></i></div>
                      </a>";

            }

            echo "</div><br>";

            if(isset($id_curso1)){
                //obtenção dos dados dos cursos
                $b=0;
                if($fav==0){

                    while($b<count($id_curso1)){

                        $sqlb[$b]= "SELECT * 
                                    FROM cursos 
                                    WHERE visibilidade_curso='visível'
                                    AND id_curso=".$id_curso1[$b]."
                                    AND nome_curso LIKE '%$pesquisa%'";
                        $resultadob[$b] = mysqli_query($conexao,$sqlb[$b]); 

                        if($resultadob[$b]){
                            
                            while($linhab[$b] = mysqli_fetch_assoc($resultadob[$b]))
                            {
                                
                                $id_curso[] = $linhab[$b]['id_curso'];
                                $nome_curso[]= $linhab[$b]['nome_curso'];
                                $descricao_curso[]= substr($linhab[$b]['descricao_curso'], 0, 320) . "...";
                                $endereco_imagem_curso[]= $linhab[$b]['endereco_imagem_curso'];

                            } 
                            
                            if(isset($descricao_curso[$b])){

                                if(strlen($descricao_curso[$b])>=350){

                                    $str = $descricao_curso[$b];
                
                                    $p1 = substr("$str", 0, 350);
                                    $p2 = "$p1"."...";
                
                                    $descricao_curso[$b]= $p2;
                
                                }

                            }
                            
                        }

                        $b++;

                    }
                
                } elseif($fav==1){

                    for($var=0; $var<count($id_curso1); $var++){

                        $sql_[$var]= "SELECT id_curso FROM favoritos_curso WHERE email='$email' AND id_curso=".$id_curso1[$var]." AND situacao_favorito_curso='favorito'";

                        $resultado_[$var] = mysqli_query($conexao, $sql_[$var]);  

                        if($resultado_[$var]){
                            while($linha_[$var] = mysqli_fetch_assoc($resultado_[$var]))
                            {
                                
                                $id_curso_favorito[] = $linha_[$var]['id_curso'];

                            }
                        }
                    }

                    if(isset($id_curso_favorito)){
                        
                        while($b<count($id_curso_favorito)){

                            $sqlb[$b]= "SELECT * 
                                        FROM cursos 
                                        WHERE visibilidade_curso='visível'
                                        AND id_curso=".$id_curso_favorito[$b]."
                                        AND nome_curso LIKE '%$pesquisa%'";
                            $resultadob[$b] = mysqli_query($conexao,$sqlb[$b]); 

                            if($resultadob[$b]){
                                
                                while($linhab[$b] = mysqli_fetch_assoc($resultadob[$b]))
                                {
                                    
                                    $id_curso[] = $linhab[$b]['id_curso'];
                                    $nome_curso[]= $linhab[$b]['nome_curso'];
                                    $descricao_curso[]= substr($linhab[$b]['descricao_curso'], 0, 320) . "...";
                                    $endereco_imagem_curso[]= $linhab[$b]['endereco_imagem_curso'];

                                } 
                                
                            }
 
                            $b++;
                                
                        }

                    }

                }

            }
            //-

            if(isset($id_curso)){

                $ultima_pagina = ceil(count($id_curso) / $limite);
                $limitep = $limite * $p;

                if($p*$limite > count($id_curso)+($limite-1)){

                    echo "Número de página inválido!";

                } else {
                
                    for($i=$offset; $i<count($id_curso) and $i<$limitep; $i++){

                        echo "
                        
                            <a href='CONS___tela_curso_consumidor.php?id_curso=" . $id_curso[$i] . "' style='color:black;'>

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

                                    </div>";

                                    $sqli[$i] = "SELECT * FROM favoritos_curso WHERE email='$email' AND id_curso=".$id_curso[$i];
                                    $resultadoi[$i] = mysqli_query($conexao, $sqli[$i]);

                                    if($resultadoi[$i] == true){

                                        if($linhai[$i] = mysqli_fetch_assoc($resultadoi[$i])){

                                            $situacao_favorito_curso[$i] = $linhai[$i]['situacao_favorito_curso'];

                                        }

                                    }

                                    if(isset($situacao_favorito_curso[$i])){

                                        if($situacao_favorito_curso[$i] == "favorito"){

                                            echo "<div style='text-align: -webkit-center'><a href='../../_____cursos/favorito_curso.php?id_curso=".$id_curso[$i]."' style='color:#673ab7;'><i class='fa fa-star fa-2x'></i></a></div>";

                                        } else {

                                            echo "<div style='text-align: -webkit-center'><a href='../../_____cursos/favorito_curso.php?id_curso=".$id_curso[$i]."' style='color:#673ab7;'><i class='fa fa-star-o fa-2x'></i></a></div>";

                                        }

                                    } else {

                                        echo "<div style='text-align: -webkit-center'><a href='../../_____cursos/favorito_curso.php?id_curso=".$id_curso[$i]."' style='color:#673ab7;'><i class='fa fa-star-o fa-2x'></i></a></div>";

                                    }

        echo "

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
                            <a href='CONS____home_consumidor.php?limite=$limite&p=$pAntecessora&pesquisa=$pesquisa&fav=$fav'>
                                <i class='material-icons'>chevron_left</i>
                            </a>
                          </li>";

                }

                    if($ultima_pagina > 1){

                        for($i=1; $i<=$ultima_pagina; $i++){

                            if($i==$p){

                              echo "<li class='active deep-purple'><a href='#!'>$i</a></li>";  

                            } else {

                                echo "<li class='waves-effect'><a href='CONS____home_consumidor.php?limite=$limite&p=$i&pesquisa=$pesquisa&fav=$fav'>$i</a></li>";

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
                            <a href='CONS____home_consumidor.php?limite=$limite&p=$pSucessora&pesquisa=$pesquisa&fav=$fav'>
                                <i class='material-icons'>chevron_right</i>
                            </a>
                            </li>";

                }

                echo "</ul>";

            } else {

                echo "<br><h4>Não foram encontrados cursos!</h4>";

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