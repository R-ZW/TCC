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
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!--Link with configs-->
    <link rel="stylesheet" type="text/css" href="materialize/css/configs.css">
    
</head>

<body class="container">

    <?php 

        include_once ".conexao_bd.php";

        $id_curso= $_GET['id_curso'];
        $email = $_GET['email'];


        //obtenção dos dados do curso
        $sql = "SELECT nome_curso, descricao_curso, endereco_imagem_curso FROM cursos WHERE id_curso=$id_curso";
        $resultado = mysqli_query($conexao,$sql); 
        //obtidos os dados do curso

        while($linha = mysqli_fetch_assoc($resultado))
        {

            $nome_curso= $linha['nome_curso'];
	        $descricao_curso = $linha['descricao_curso'];
	        $endereco_imagem_curso = $linha['endereco_imagem_curso'];

        } 
        //fim da obtenção dos dados do curso

        echo "<h2 class='center-align bold'>$nome_curso</h2><br>";
        echo "<center><img src=$endereco_imagem_curso class='materialboxed' width=50%></center><br><br>";
        echo "<h5 class='justify'>$descricao_curso</h4><br>";


        //obtenção dos dados dos módulos
        $sql_1 = "SELECT id_modulo, nome_modulo, descricao_modulo, endereco_imagem_modulo FROM modulos WHERE id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao,$sql_1); 

        while($linha_1 = mysqli_fetch_assoc($resultado_1))
        {

            $id_modulo[]= $linha_1['id_modulo'];
            $nome_modulo[]= $linha_1['nome_modulo'];
            $descricao_modulo[]= $linha_1['descricao_modulo'];
            $endereco_imagem_modulo[]= $linha_1['endereco_imagem_modulo'];

        }
        //fim da obtenção dos dados dos módulos


        if(isset($id_modulo)){

            //obtenção dos dados das aulas
            $i=0;
            while($i<count($id_modulo)){

                $sqli[$i] = "SELECT id_aula, nome_aula, descricao_aula, endereco_imagem_aula FROM aulas WHERE id_modulo=$id_modulo[$i]";
                $resultadoi[$i] = mysqli_query($conexao,$sqli[$i]);
    
                while($linhai[$i] = mysqli_fetch_assoc($resultadoi[$i])){

                    $id_aula[$i][]= $linhai[$i]['id_aula'];
                    $nome_aula[$i][]= $linhai[$i]['nome_aula'];
                    $descricao_aula[$i][]= $linhai[$i]['descricao_aula'];
                    $endereco_imagem_aula[$i][]= $linhai[$i]['endereco_imagem_aula'];

                }
            $i++;
            }
            //fim da obtenção dos dados das aulas
        
            for($i=0 ; $i<count($id_modulo) ; $i++){

                echo "<br>
                <div class='card-panel'>
                    <div class='row'>
                    <h4 class='bold center-align'>" . $nome_modulo[$i] . "</h4><br><br>
                        <div class='col s4 m4 l4 flow-text'>
                        
                            <img src=" . $endereco_imagem_modulo[$i] ." class='img-curso'>
                    
                        </div>
                    
                        <div class='center-align'>
                            <h5 class='descricao-modulo'>" . $descricao_modulo[$i] . "<br><br>
                        </div>
                    </div>";

                    if(isset($id_aula[$i])){

                        for($j=0 ; $j<count($id_aula[$i]) ; $j++){

                            echo "<big>- <a href='0_tela_aula.php?id_aula=".$id_aula[$i][$j]."&email=$email'>".$nome_aula[$i][$j]."</a> </big><br>";

                        }

                    } else {

                            echo "<big>Não existem aulas cadastradas neste módulo.</big><br><br>";

                    }

                echo "</div>";
                

            }
        } else {

            echo "<br><h5>- Não existem módulos cadastrados neste curso.</h5><br><br>";

        }

        echo "<br><br><center><a href='0___home_consumidor.php?email=$email' class='white-text'><div class='waves-effect waves-light btn bold'>Voltar<i class='material-icons left'>keyboard_backspace</i></div></a></center><br><br>";

    ?>

    <br> 

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    
</body>

</html>