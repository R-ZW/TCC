<?php
session_start();
require_once "../../_______necessarios/.conexao_bd.php";
require_once "../../_______necessarios/.funcoes.php";

if (!isset($_SESSION['id_usuario'])) {
$_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
header("Location: ../entrada.php");
}
echo exibeMensagens();

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
    <title>Tela de Curso</title>
    
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

        <a href='../consumidor/CONS____home_consumidor.php' class='white-text' style='margin-left: 25px;'>
            <div class='btn-floating btn-small waves-effect waves-light deep-purple'>
                <i class='material-icons' style='line-height:33px; margin-right: 1px;'>sync</i>
            </div>
        </a>

        <a href="PROD____home_produtor.php" class="breadcrumb">HOME PRODUTOR</a>
        <a href="#!" class="breadcrumb">CURSO</a>

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

            $id_curso= $_GET['id_curso'];

            //----------------------        
            //obtenção dos dados do curso-
            $sql = "SELECT * FROM cursos WHERE id_curso=$id_curso";
            $resultado = mysqli_query($conexao,$sql); 

            while($linha = mysqli_fetch_assoc($resultado))
            {

                $nome_curso= $linha['nome_curso'];
                $descricao_curso = $linha['descricao_curso'];
                $endereco_imagem_curso = $linha['endereco_imagem_curso'];
                $endereco_certificado_curso = $linha['endereco_certificado_curso'];
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
                    <div id='editar_curso' class='modal'>
                        <div class='modal-content'>

                            <form action='../../_____cursos/__U2_altera_curso.php' method='post' id='editar_curso' enctype='multipart/form-data'>

                                <h4 class='center-align'>Editar Curso</h4><br>

                                <h6 class='bold'>Nome do curso:<i class='material-icons right'>border_color</i></h6>
                                <input id='field' type='text' name='nome_curso' placeholder='insira o nome do curso' value='$nome_curso' required>

                                <br>
                                <br>

                                <h6 class='bold'>Descrição do curso:<i class='material-icons right'>subject</i></h6>
                                <div class='input-field col s12'>
                                <textarea id='field' type='text' name='descricao_curso' placeholder='insira a descrição do curso' class='materialize-textarea' form='editar_curso' style='text-align:justify'required>$descricao_curso</textarea>
                                </div>

                                <h6 class='bold'>Imagem do curso (16x9):<i class='material-icons right'>image</i></h6>
                
                                <div class='file-field'>
                                    <div class='waves-effect waves-light btn grey darken-4' style='margin-left:39%;'>
                                        <span class='bold'><i class='material-icons left'>upload</i> Selecionar Arquivo</span>
                                        <input id='endereco_imagem_curso_edicao' name='endereco_imagem_curso' type='file' accept='image/*' form='editar_curso' onchange='previewImagemEditar()'>
                                    </div>
                                </div>

                                <br>
                                <br>
                                <br>
                                <h6 class='bold center-align' style='font-style:italic;'>preview:</h6>
                                <div class='card-panel hoverable'>
                                    <div class='row'>
                                        <div class='col s5'>
                                        
                                            <br>
                                            <img id='imagem_curso_edicao' src='$endereco_imagem_curso' width='300em' height='169em'>
                                    
                                        </div>
                                    
                                        <div class='col s7'>

                                            <h5 class='bold center-align'>[*nome do curso*]</h5>
                                            <br>
                                            <h6 style='text-align:justify; font-size:1.3em;'>[*descrição do curso*].</h6>

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
                
                
                    <div class='row'>
                        <div class='col s12'>
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
                            <div class='card-action center'>
                                <a href='#editar_curso' class='modal-trigger' style='color:#212121; vertical-align: text-bottom;'><i class='material-icons' style='font-size:2.5em !important;'>edit</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <a href='#excluir_curso' class='modal-trigger' style='color:#212121; vertical-align: text-bottom;'><i class='material-icons' style='font-size:2.5em !important;'>delete</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";

                    if($visibilidade_curso == "visível"){

                        echo "  <a href='../../_____cursos/inversao_situacao_visibilidade_curso.php?id_curso=$id_curso' style='color:#212121; vertical-align: super; font-size:2.5em;'><i class='fa fa-eye'></i></a>";
        
                    } else {
        
                        echo "  <a href='../../_____cursos/inversao_situacao_visibilidade_curso.php?id_curso=$id_curso' style='color:#212121; vertical-align: super;'><i class='fa fa-eye-slash fa-2x'></i></a>";
                        
                    }

                echo"       </div>
                        </div>
                    </div>";

                if(!isset($id_alternativa_valida) and $endereco_certificado_curso=="sem-certificado"){

                    echo "ESTE CURSO NÃO POSSUI CERTIFICADO, E SE POSSUI-SE NÃO ESTARIA VÁLIDO PARA DOWNLOAD";

                } elseif(!isset($id_alternativa_valida) and $endereco_certificado_curso!="sem-certificado"){

                    echo "ESTE CURSO POSSUI CERTIFICADO, PORÉM NÃO ESTÁ VÁLIDO PARA DOWNLOAD";

                } elseif(isset($id_alternativa_valida) and $endereco_certificado_curso=="sem-certificado"){

                    echo "ESTE CURSO NÃO POSSUI CERTIFICADO, PORÉM, CASO POSSUI-SE ESTARIA VÁLIDO PARA DOWNLOAD";

                } elseif(isset($id_alternativa_valida) and $endereco_certificado_curso!="sem-certificado"){

                    echo "<a href='$endereco_certificado_curso' download class='white-text'><div class='waves-effect waves-light btn bold'>BAIXAR CERTIFICADO<i class='material-icons right'>download</i></div></a></h5><br>";

                }

                
                echo "<br><br>";
            
                if(isset($id_modulo) or isset($linha_1)){

                    for($i=0 ; $i<count($id_modulo) ; $i++){

                        echo "<br>
                        <div class='card-panel'>
                            <div class='row'>
                                <h4 class='bold center-align'>" . $nome_modulo[$i] . " 
                                <a href='../../____modulos/__U1_form_altera_modulo.php?id_modulo=".$id_modulo[$i]."' class='link-curso'> <i class='material-icons small'>edit</i></a>
                                <a href='../../____modulos/_D1_excluir_modulo.php?id_modulo=".$id_modulo[$i]."' class='link-curso'><i class='material-icons small'>delete</i></a> ";

                                if($visibilidade_modulo[$i] == "visível"){

                                    echo "<a href='../../____modulos/inversao_situacao_visibilidade_modulo.php?id_curso=$id_curso&id_modulo=".$id_modulo[$i]."' class='link-curso'><i class='fa fa-eye'></i></a>";
                    
                                } else {
                    
                                    echo "<a href='../../____modulos/inversao_situacao_visibilidade_modulo.php?id_curso=$id_curso&id_modulo=".$id_modulo[$i]."' class='link-curso'><i class='fa fa-eye-slash'></i></a>";
                                    
                                }

    echo"                            
                                </h4><br><br>
                                    <div class='col s4 m4 l4 flow-text'>
                                    
                                        <img src=" . $endereco_imagem_modulo[$i] ." class='img-curso'>
                                
                                    </div>
                                
                                    <div class='center-align'>
                                        <h5 class='descricao-modulo'>" . $descricao_modulo[$i] . "<br><br>
                                    </div>
                            </div>";
                        
                        if(isset($id_aula[$i])){

                            for($j=0 ; $j<count($id_aula[$i]) ; $j++){

                                echo "<big>- <a href='PROD__tela_aula_produtor.php?id_aula=".$id_aula[$i][$j]."'>".$nome_aula[$i][$j]."</a> </big> 
                                <a href='../../___aulas/__U1_form_altera_aula.php?id_aula=".$id_aula[$i][$j]."&i=0'class='link-curso'><i class='material-icons'>edit</i></a>
                                <a href='../../___aulas/_D1_excluir_aula.php?id_aula=".$id_aula[$i][$j]."'class='link-curso'><i class='material-icons'>delete</i></a> ";

                                if($visibilidade_aula[$i][$j] == "visível"){

                                    echo "<a href='../../___aulas/inversao_situacao_visibilidade_aula.php?id_curso=$id_curso&id_aula=".$id_aula[$i][$j]."&i=0' class='link-curso'><i class='fa fa-eye fa-2x'></i></a><br>";
                    
                                } else {
                    
                                    echo "<a href='../../___aulas/inversao_situacao_visibilidade_aula.php?id_curso=$id_curso&id_aula=".$id_aula[$i][$j]."&i=0' class='link-curso'><i class='fa fa-eye-slash fa-2x'></i></a><br>";
                                    
                                }

                            }

                        } else {

                                echo "<big>Não existem aulas cadastradas neste módulo.</big><br>";

                        }

                        echo "<br><a href='../../___aulas/____C1_form_insere_aula.php?id_modulo=" . $id_modulo[$i] . "'class='white-text'><div class='waves-effect waves-light btn bold'>ADICIONAR AULA<i class='material-icons left'>add</i></div></a><br><br>";
                        echo "</div><br>";
                        
                    } 

                } else {

                    echo "<h5>Não existem módulos cadastrados neste curso.</h5><br><br>";

                }


        ?>

    <center><a href='../../____modulos/____C1_form_insere_modulo.php?id_curso=<?php echo $id_curso;?>'class='white-text'><div class='waves-effect waves-light btn bold'>ADICIONAR MÓDULO<i class='material-icons left'>add</i></div></a></center><br>

    <br> 
    <br>

    <div class="card-panel">
    <center><h4 class="bold">USUÁRIOS ASSOCIADOS AO CURSO</h4></center><br><br>

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
    
        if(isset($email_consumidor)){

            for($h=0 ; $h<count($email_consumidor) ; $h++){

                $d[$h]= date('d/m/Y',strtotime($data_relacao[$h]));

                echo "<big>- ".$email_consumidor[$h] . " desde " . $d[$h] . " </big>";
                echo "<a href='../../______relacao_usuario_curso/__U1_form_altera_associacao_usuario.php?email=".$email_consumidor[$h]."&id_curso=$id_curso'class='link-curso'><i class='material-icons'>edit</i></a>
                      <a href='../../______relacao_usuario_curso/_D1_excluir_associacao_usuario.php?email=".$email_consumidor[$h]."&id_curso=$id_curso'class='link-curso'><i class='material-icons'>delete</i></a><br>";

            }

        } else {

            echo "Não existem usuários associados a este curso<br><br>";

        }

    ?>
    <br>

    <a href="../../______relacao_usuario_curso/____C1_form_insere_associacao_usuario.php?id_curso=<?php echo $id_curso;?>"class='white-text'><div class='waves-effect waves-light btn bold'>ASSOCIAR USUÁRIO<i class='material-icons left'>add</i></div></a>

    <br>
    <br>
    </div>

    <br>
    <br>

    <center><a href='PROD____home_produtor.php'class='white-text'><div class='waves-effect waves-light btn bold'>Voltar<i class='material-icons left'>keyboard_backspace</i></div></a></center><br><br> 

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $('.sidenav').sidenav({
            edge: 'right'
        });
        });
    </script>
    <script>
        $(document).ready(function(){
        $('.modal').modal();
        });
    </script>
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
        function previewImagem(){
            let imagem = document.querySelector('input[id=endereco_imagem_curso_cadastro]').files[0];
            let preview = document.querySelector('#imagem_curso_cadastro');

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