<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: 00___entrada.php");
}

require_once "funcoes.php";
require_once "conexao_bd.php";

$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);

$sql = "SELECT nome_usuario, email FROM usuarios WHERE id_usuario=".$_SESSION['id_usuario'];
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>

        <meta charset="UTF-8">
        <title>Alteração de Usuário</title>

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
            function confirmacao1(){
                var resposta = confirm ("Deseja realmente excluir sua conta do sistema?");
                if (resposta == true){
                    window.location.href = "00__excluir_usuario.php"
                }
            }
                     
            function mostrar_senha_antiga() {
                var senha = document.getElementById("senha_antiga");
                if (senha.type === "password") {
                    senha.type = "text";
                } else {
                    senha.type = "password";
                }
            }

            function mostrar_senha_nova() {
                var senha = document.getElementById("senha_nova");
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

            function validarSenha() {
                senha = document.getElementById("senha_nova").value;
                rs = document.getElementById("confirmar_senha");
                repetirSenha = document.getElementById("confirmar_senha").value;
                if (senha == repetirSenha) {
                    rs.setCustomValidity('');
                    rs.checkValidity();
                    return true;
                } else {
                    rs.setCustomValidity('As senhas não conferem!');
                    rs.checkValidity();
                    rs.reportValidity();
                    return false;
                }
            }
        </script>

    </head>

    <link rel="stylesheet" type="text/css" href="configs.css">

    <!-- Dropdown Structure -->
    <ul id="dropdown2" class="dropdown-content">
        <li><a class="teal-text white center-align bold" href="00__form_altera_usuario.php">EDITAR</a></li>
        <li><a class="teal-text white center-align bold" href='#' onclick='confirmacao1()'>EXCLUIR</a></li>
    </ul>

    <nav class="teal lighten-1">
        <div class="nav-wrapper fixed container">
        

        <ul class="left hide-on-med-and-down">

            <li <?php if($paginaCorrente == "01_capa.php"){echo 'class = "teal darken-2"';}?>><a href="01_capa.php"><i class="material-icons">home</i></a></li>
            <li <?php if($paginaCorrente == "02_index.php"){echo 'class = "teal darken-2"';}?>><div class="bold"><a href="02_index.php">LISTAR BIOGRAFIAS</a></div></li>      
        
        </ul>

        <a href="#" class="brand-logo center teal lighten-1"><i class="fa fa-address-card" style="margin-right:0px; margin-top:10px;"></i></a>

        <ul class="right hide-on-med-and-down">
            
            <li <?php if($paginaCorrente == "00__form_altera_usuario.php"){echo 'class = "teal darken-2"';}?>><a class="dropdown-button bold" data-activates="dropdown2" data-beloworigin="true"><?php echo $linha['nome_usuario'];?><i class="material-icons right">arrow_drop_down</i></a></li>
            <li><div class="bold"><a href="00_logout.php"><i class="material-icons right">logout</i></a></div></li>

        </ul>
        </div>
    </nav>
    
    <body>

        <main class="container">

        <br>
        <br>

            <form action="00__altera_usuario.php" method="POST" class="col s12 l5 card-panel">

            <h4 class="center-align">ALTERAÇÃO DE CONTA</h4>

            <br>

                <?php if(isset($_SESSION['mensagem'])){ echo "<div class='red-text center-align bold big'>".exibeMensagens()."</div><br>"; }?><br>

                <div class="row">
                <div class="col s12 teal-text big">Nome de Usuário</div> 
                <div class="input-field col s12">
                    <input id="nome_conhecido" name="nome_usuario" type="text" class="validate" value="<?php echo $linha['nome_usuario'];?>" required>
                </div>

                <br><br><br><br><br><br>

                <div class="col s12 teal-text big">Email</div> 
                <div class="input-field col s12">
                    <input id="nome_conhecido" name="email" type="email" class="validate" value="<?php echo $linha['email'];?>" required>
                </div>

                <br><br><br><br><br><br>


                <div class="col s6 teal-text big">Senha Antiga</div>
                <div class="col s6 right-align"><button onclick="mostrar_senha_antiga()" class="btn-b" form=""><i class="material-icons">remove_red_eye</i></button></div> 
                <div class="input-field col s12">  
                <input id="senha_antiga" name="senha_antiga" type="password" class="validate">
                </div>
                
                <br><br><br><br><br><br>


                <div class="col s6 teal-text big">Senha Nova</div>
                <div class="col s6 right-align"><button onclick="mostrar_senha_nova()" class="btn-b" form=""><i class="material-icons">remove_red_eye</i></button></div>
                <div class="input-field col s12">  
                <input id="senha_nova" name="senha_nova" type="password" class="validate">
                </div>

                <br><br><br><br><br><br>


                <div class="col s6 teal-text big">Confirmar Senha Nova</div>
                <div class="col s6 right-align"><button onclick="mostrar_confirmacao()" class="btn-b" form=""><i class="material-icons">remove_red_eye</i></button></div> 
                <div class="input-field col s12">
                    <input id="confirmar_senha" name="confirmar_senha" type="password" onblur="validarSenha()" class="validate">
                </div>

                
                <h6 class="center-align grey-text col s12">é necessário que ambas senhas sejam submetidas para haver mudança</h6>

                <br><br><br><br><br><br><br><br>
                
                <div class="center">
                    
                    <button type="submit" class="waves-effect waves-light btn btn_a">ENVIAR<i class="material-icons right">check</i></button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a href="javascript:window.history.go(-1)" class="waves-effect waves-light btn btn_a center">CANCELAR<i class="material-icons right">close</i></a>
               
                </div>

            </form>
            
        </main>
        <br><br>
        <?php require_once ".rodape.php"; ?>
      
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>

</html>