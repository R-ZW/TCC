<?php
session_start();

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
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="materialize/css/configs.css">

</head>

<body class="container">
    
    <h2 class="center-align bold">Home Consumidor</h2>	

    <?php 

        include_once ".conexao_bd.php";

        $email= $_SESSION['email'];
        
        echo "<br><center><a href='1_____home_produtor.php' class='white-text'><div class='waves-effect waves-light btn bold'>PERMUTAR CONTA <i class='material-icons right'>sync</i></div></a></center><br><br>";

        //obtenção dos cursos associados a um usuário
        $sql = "SELECT id_curso FROM relacao_usuario_curso WHERE email='$email' AND tipo_relacao='consumidor'";
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

                $sqlb[$b]= "SELECT nome_curso, descricao_curso, endereco_imagem_curso FROM cursos WHERE id_curso=".$id_curso[$b];
                $resultadob[$b] = mysqli_query($conexao,$sqlb[$b]); 

                while($linhab[$b] = mysqli_fetch_assoc($resultadob[$b]))
                {
                    $nome_curso[$b]= $linhab[$b]['nome_curso'];
	                $descricao_curso[$b]= $linhab[$b]['descricao_curso'];
	                $endereco_imagem_curso[$b]= $linhab[$b]['endereco_imagem_curso'];

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
                    <a href='0__tela_curso.php?id_curso=" . $id_curso[$i] . "&email=$email' class='link-curso'>
                        <div class='card-panel hoverable'>
                            <div class='row '>
                                <div class='col s4 m4 l4 flow-text'>
                                
                                    <img src=" . $endereco_imagem_curso[$i] ." class='img-curso'>
                            
                                </div>
                            
                                <div class='center-align'>
                                    <h4 class='bold'>" . $nome_curso[$i] . "</h4>
                                    <h6 class='descricao-curso'>" . $descricao_curso[$i] . "<br><br>
                                </div>
                            </div>
                        </div>
                    </a>
                    <br>
                ";

            }

        } else {

            echo "<br><h4>Não existem cursos associados a esta conta.</h4>";

        }

        $sql_1 = "SELECT * FROM usuarios WHERE id_usuario='".$_SESSION['id_usuario']."'";
        $resultado_1 = mysqli_query($conexao, $sql_1);

        $linha_1 = mysqli_fetch_assoc($resultado_1);

        $nome_usuario = $linha_1['nome_usuario'];
        $endereco_imagem_usuario = $linha_1['endereco_imagem_usuario'];

        echo "<br>
        
              <img src='$endereco_imagem_usuario' width='5%'> 
              
              $nome_usuario

              <a href='00_logout.php'>logout</a>
              
              <a href='00__form_altera_usuario.php'>editar</a>
              
              <a href='00__excluir_usuario.php'>excluir</a>";
    ?>

    

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    
</body>

</html>