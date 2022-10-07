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
    <link type="text/css" rel="stylesheet" href="../../_.materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="../../_.materialize/css/configs.css">

</head>

<body class="container">
    
    <h2 class="center-align bold">Home Consumidor</h2>	

    <?php 

        include_once "../../_______necessarios/.conexao_bd.php";

        $email= $_SESSION['email'];
        
        echo "<br><center><a href='../produtor/PROD____home_produtor.php' class='white-text'><div class='waves-effect waves-light btn bold'>PERMUTAR CONTA <i class='material-icons right'>sync</i></div></a></center><br><br>";

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

        $offset = $limite * ($p - 1);

        echo "
            <form action='' method='GET'>
            <input type='text' name='pesquisa' size='75'><input type='submit' value='pesquisar'> ";

            if($pesquisa != ""){

                echo "<a href='CONS____home_consumidor.php?limite=$limite'>cancelar</a>";
    
            }
            
        echo "
            </form>
            <br>
            Cursos por página:
                <a href='CONS____home_consumidor.php?limite=5&p=1&pesquisa=$pesquisa'>5</a>
                <a href='CONS____home_consumidor.php?limite=10&p=1&pesquisa=$pesquisa'>10</a>
                <a href='CONS____home_consumidor.php?limite=15&p=1&pesquisa=$pesquisa'>15</a>
            <br><br>
        ";

        if(isset($id_curso1)){
            //obtenção dos dados dos cursos
            $b=0;
            while($b<count($id_curso1)){

                $sqlb[$b]= "SELECT * 
                            FROM cursos 
                            WHERE visibilidade_curso='vísivel'
                            AND id_curso=".$id_curso1[$b]."
                            AND nome_curso LIKE '%$pesquisa%'";
                $resultadob[$b] = mysqli_query($conexao,$sqlb[$b]); 

                if($resultadob[$b]){
                    
                    while($linhab[$b] = mysqli_fetch_assoc($resultadob[$b]))
                    {
                        
                        $id_curso[] = $linhab[$b]['id_curso'];
                        $nome_curso[]= $linhab[$b]['nome_curso'];
                        $descricao_curso[]= $linhab[$b]['descricao_curso'];
                        $endereco_imagem_curso[]= $linhab[$b]['endereco_imagem_curso'];

                    } 
                    
                    if(isset($descricao_curso[$b])){

                        if(strlen($descricao_curso[$b])>=950){

                            $str = $descricao_curso[$b];
        
                            $p1 = substr("$str", 0, 950);
                            $p2 = "$p1"."...";
        
                            $descricao_curso[$b]= $p2;
        
                        }

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

                echo "Número de página inválido!";

            } else {
            
                for($i=$offset; $i<count($id_curso) and $i<$limitep; $i++){

                    echo "
                    
                        <a href='CONS___tela_curso_consumidor.php?id_curso=" . $id_curso[$i] . "' class='link-curso'>

                            <div class='card-panel hoverable'>

                                <div class='row'>

                                    <div class='col s4 m4 l4 flow-text'>
                                    
                                        <img src=" . $endereco_imagem_curso[$i] ." class='img-curso'>
                                
                                    </div>
                                
                                    <div class='center-align'>

                                        <h4 class='bold'>" . $nome_curso[$i] . "</h4>

                                        <h6 class='descricao-curso'>" . $descricao_curso[$i] . "<br><br>

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

                                        echo "<center><a href='../../_____cursos/favorito_curso.php?id_curso=".$id_curso[$i]."&i=0' class='edita-exclui'><i class='fa fa-star fa-2x'></i></a></center>";

                                    } else {

                                        echo "<center><a href='../../_____cursos/favorito_curso.php?id_curso=".$id_curso[$i]."&i=0' class='edita-exclui'><i class='fa fa-star-o fa-2x'></i></a></center>";

                                    }

                                } else {

                                    echo "<center><a href='../../_____cursos/favorito_curso.php?id_curso=".$id_curso[$i]."&i=0' class='edita-exclui'><i class='fa fa-star-o fa-2x'></i></a></center>";

                                }

    echo "

                            </div>
                        </a>
                        <br>
                    ";

                } 

            }

            if($ultima_pagina > 1){

                echo "<center>";

                for($i=1; $i<=$ultima_pagina; $i++){

                    echo "<a href='CONS____home_consumidor.php?limite=$limite&p=$i&pesquisa=$pesquisa'>$i</a> ";

                }

                echo "</center>";

            } else {

                echo "<center>1</center>";
                
            }

        } else {

            echo "<br><h4>Não foram encontrados cursos!</h4>";

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

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../_.materialize/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../_.materialize/js/materialize.min.js"></script>
    
</body>

</html>