<?php
session_start();
require_once "funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>

        <meta charset="UTF-8">
        <title>Tela de Entrada</title>

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Another Icon Font-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--Link with configs-->
        <link rel="stylesheet" type="text/css" href="configs.css">

        <script>                        
            function mostrar() {
                var senha = document.getElementById("senha");
                if (senha.type === "password") {
                    senha.type = "text";
                } else {
                    senha.type = "password";
                }
            }
        </script>

    </head>

    <body>
        
        <nav>
            <div class="nav-wrapper teal lighten-1">
                <a href="#" class="brand-logo center teal lighten-1"><i class="fa fa-address-card" style="margin-right:0px; margin-top:10px;"></i></a>
            </div>
        </nav>

        <main class="container">

        <br>
        <br>

        <h4 class="center-align">RESOLUÇÃO DA PPI - BIOGRAFIAS DE PERSONALIDADES HISTÓRICAS</h4>
        <br>
        
        <form action="00_login.php" method="POST" class="col s12 l5 card-panel">

        
        <h4 class="center-align">LOGIN</h4>

        <br>
                <?php if(isset($_SESSION['mensagem'])){ echo "<div class='red-text center-align bold big'>".exibeMensagens()."</div>"; }?><br>

                <div class="row">
                <div class="col s12 teal-text big">Email:</div> 
                <div class="input-field col s12">
                    <input id="email" name="email" type="email" class="validate" required>
                </div>

                <br><br><br><br><br><br><br>

                <div class="col s6 teal-text big">Senha:</div>
                <div class="col s6 right-align"><button onclick="mostrar()" class="btn-b" form=""><i class="material-icons">remove_red_eye</i></button></div> 
                <div class="input-field col s12 left-align">
                    <input id="senha" name="senha" type="password" class="validate" required>
                </div>
                
                <div class="center">

                <br><br><br><br><br><br><br>

                    <button type="submit" class="waves-effect waves-light btn btn_a">Entrar<i class="material-icons right">send</i></button> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a href="00__form_cadastro_usuario.php" class="waves-effect waves-light btn btn_a center">Criar Conta<i class="material-icons right">person_add</i></a>
            <br>
            <br>
               
                </div>
            </form>


        </main>
        <br>
        <br>
        
        <?php require_once ".rodape.php"; ?>
        
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>

    </body>

</html>