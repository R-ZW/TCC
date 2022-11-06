<?php
session_start();
require_once "../_______necessarios/.funcoes.php";
include "../_______necessarios/.conexao_bd.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Criação de Conta</title>

    <!--Definindo icone da página-->
    <link rel="icon" href="../_.imgs_default/logo_nebula.png">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Another Icon Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs próprio-->
    <link rel="stylesheet" type="text/css" href="../index/.assets/css_entrada.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../_.materialize/css/materialize.min.css"  media="screen,projection"/>

</head>

<body>

    <div id="wapper">
        <div class="auth-background" style="<?php $i = mysqli_real_escape_string($conexao,$_GET['i']); echo "background: url(../_.imgs_default/nebulosas/$i.png);"?>"></div>
        <div class="panel-auth" style="padding-top: 40px">

            <h2 style="text-align:center; margin-top: 0">Nebula</h2>

            <h5 style="text-align:center; margin-top: 0">Criar Conta</h5>

            <br>

            <?php if (isset($_SESSION['mensagem'])) {
                echo "<div class='red-text'>" . exibeMensagens() . "</div>";
            } ?>

            <form action="____C2_cadastro_usuario.php" method="POST" enctype="multipart/form-data" id="cadastro_usuario" onsubmit="return validarSenha();">

                <h6><i class="material-icons right">person</i>Nome:</h6>
                <input id="field" name="nome_usuario" type="text" class="validate" placeholder="insira seu nome" required>

                <h6><i class="material-icons right">image</i>Imagem de Perfil (1x1):</h6>

                <center><img src="../_.imgs_default/sem_imagem_usuario.png" style="border-radius: 100%; width: 100px; height: 100px;"></center>

                <script src="https://ajax.googleapis.com/ajax/libs/3.3.1/jquery.min.js"></script>
                
                <br>

                <div class="file-field" style="margin-left:23%;">
                    <div class="waves-effect waves-light btn btn_b center-align">
                        <i class="material-icons left">upload</i> 
                        Selecionar Arquivo <input name="endereco_imagem_usuario" type="file" accept="image/*" class="waves-effect waves-light btn center-align" form="cadastro_usuario" onchange="previewImagem()">
                    </div>
                </div>

                <script>
                    function previewImagem(){
                        let imagem = document.querySelector('input[name=endereco_imagem_usuario]').files[0];
                        let preview = document.querySelector('img');

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
                </script>

                <h6><i class="material-icons right">email</i>Email:</h6>
                <input id="field" name="email" type="email" class="validate" placeholder="insira seu email" required>

                <h6><i class="material-icons right">lock_outline</i>Senha:</h6>
                <div class="input-field col s6">
                    <div class="text-align: -webkit-center"><i class="material-icons postfix right-align" style="font-size:1.3rem; margin-top:6px;" onclick="mostrar()">remove_red_eye</i></div>
                    <input id="senha" name="senha" type="password" class="field" placeholder="defina uma senha" required>
                </div>

                <h6><i class="material-icons right">lock_open</i>Confirmar Senha:</h6>
                <div class="input-field col s6">
                    <div class="text-align: -webkit-center"><i class="material-icons postfix right-align" style="font-size:1.3rem; margin-top:6px;" onclick="mostrar_confirmacao()">remove_red_eye</i></div>
                    <input id="confirmar_senha" name="confirmar_senha" type="password" placeholder="confirme sua senha" class="field" onblur="validarSenha()" required>
                </div>
                <br>

                <button type="submit" class="waves-effect waves-light btn btn_a center-align">Confirmar <i class="material-icons right">check</i></button>
                
                <br>
                
                <a href="../index/entrada.php" class="waves-effect waves-light btn btn_a center-align">Cancelar <i class="material-icons right">close</i></a>
                
            </form>

        </div>

        <div class="content">
            <article class="message">
                <p>NEBULA</p>
                <h4>Desenvolva e compartilhe conhecimento</h4>
            </article>
        </div>
    </div>

    </main>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>
    <script type="text/javascript">
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
    </script>
    <script>
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