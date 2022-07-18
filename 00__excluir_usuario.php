<?php
session_start();
require_once "conexao_bd.php";

$id_usuario= $_SESSION['id_usuario'];

$sql = "DELETE FROM usuarios WHERE id_usuario=$id_usuario";
$resultado = mysqli_query($conexao,$sql);

mysqli_close($conexao);

if($resultado){
    header("Location: 00___entrada.php");
}
session_destroy();
?>
</body>
</html>
