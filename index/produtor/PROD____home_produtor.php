<?php
session_start();

require_once "../../_______necessarios/.funcoes.php";

echo exibeMensagens();
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
    <link rel="stylesheet" type="text/css" href="../../_.materialize/css/configs.css">

</head>

<body class="container">

    <h2 class="center-align bold">Home Produtor</h2>	

    <?php 

        include_once "../../_______necessarios/.conexao_bd.php";

        $email= $_SESSION['email'];
        
        echo "<br><center><a href='../consumidor/CONS____home_consumidor.php' class='white-text'><div class='waves-effect waves-light btn bold'>PERMUTAR CONTA <i class='material-icons right'>sync</i></div></a></center><br><br>";

        //obtenção dos cursos associados a um usuário
        $sql = "SELECT id_curso FROM relacao_usuario_curso WHERE email='$email' AND tipo_relacao='produtor'";
        $resultado = mysqli_query($conexao,$sql);

        while($linha = mysqli_fetch_assoc($resultado))
        {
            $id_curso[]= $linha['id_curso'];
        }
        //fim da obtenção dos cursos associados a um usuário 

        if(isset($id_curso)){
            //obtenção dos dados dos cursos
            $b=0;
            while($b<count($id_curso)){

                $sqlb[$b]= "SELECT * FROM cursos WHERE id_curso=".$id_curso[$b];
                $resultadob[$b] = mysqli_query($conexao,$sqlb[$b]); 

                while($linhab[$b] = mysqli_fetch_assoc($resultadob[$b]))
                {
                    $nome_curso[$b]= $linhab[$b]['nome_curso'];
	                $descricao_curso[$b]= $linhab[$b]['descricao_curso'];
	                $endereco_imagem_curso[$b]= $linhab[$b]['endereco_imagem_curso'];
                    $visibilidade_curso[$b]= $linhab[$b]['visibilidade_curso'];

                }
                
                if(strlen($descricao_curso[$b])>=950){

                    $str = $descricao_curso[$b];

                    $p1 = substr("$str", 0, 950);
                    $p2 = "$p1"."...";

                    $descricao_curso[$b]= $p2;

                }

                $b++;

            }
            //fim da obtenção dos dados dos cursos


            for($i=0 ; $i<count($id_curso) ; $i++){

                echo "

                    <a href='PROD___tela_curso_produtor.php?id_curso=" . $id_curso[$i] . "' class='link-curso'>
                     
                        <div class='card-panel hoverable'>

                            <div class='row'>

                                <div class='col s4 m4 l4 flow-text'>
                                
                                    <img src=" . $endereco_imagem_curso[$i] ." class='img-curso'>
                            
                                </div>
                            
                                <div class='center-align'>

                                    <h4 class='bold'>" . $nome_curso[$i] . "</h4>
                                    <h6 class='descricao-curso'>" . $descricao_curso[$i] . "<br><br>

                                </div> 

                            </div>
                            <div class='center-align'>

                                <a href='../../_____cursos/__U1_form_altera_curso.php?id_curso=" . $id_curso[$i] . "&i=0' class='edita-exclui'><i class='material-icons small'>edit</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <a href='../../_____cursos/_D1_excluir_curso.php?id_curso=" . $id_curso[$i] . "' class='edita-exclui'><i class='material-icons small'>delete</i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                            
                                if($visibilidade_curso[$i] == "visível"){

                                    echo "<a href='../../_____cursos/inversao_situacao_visibilidade_curso.php?id_curso=".$id_curso[$i]."&i=0' class='edita-exclui'><i class='fa fa-eye fa-2x'></i></a>";
                    
                                } else {
                    
                                    echo "<a href='../../_____cursos/inversao_situacao_visibilidade_curso.php?id_curso=".$id_curso[$i]."&i=0' class='edita-exclui'><i class='fa fa-eye-slash fa-2x'></i></a>";
                                    
                                }
echo"    
                            </div>
                            
                        </div>
                    
                    </a>
                    <br>
                        
                ";

            }

        } else {

            echo "<br><h4>Não existem cursos associados à esta conta.</h4>";

        }

        $sql_1 = "SELECT * FROM usuarios WHERE id_usuario='".$_SESSION['id_usuario']."'";
        $resultado_1 = mysqli_query($conexao, $sql_1);

        $linha_1 = mysqli_fetch_assoc($resultado_1);

        $nome_usuario = $linha_1['nome_usuario'];
        $endereco_imagem_usuario = $linha_1['endereco_imagem_usuario'];

        echo "<br>
        
              <img src='$endereco_imagem_usuario' width='5%'> 
              
              $nome_usuario

              <a href='../../______usuarios/logout.php'>logout</a>
              
              <a href='../../______usuarios/__U1_form_altera_usuario.php'>editar</a>
              
              <a href='../../______usuarios/_D1_excluir_usuario.php'>excluir</a>";

    ?>

    <br>

    <div class='center-align'><a href='../../_____cursos/____C1_form_insere_curso.php?email=<?php echo $email;?>' class='btn-floating btn-large waves-effect waves-light'><i class='material-icons'>add</i></a></div>

    <br> 

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>

</body>

</html>