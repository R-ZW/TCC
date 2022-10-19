<?php

$sql = "SELECT * FROM usuarios WHERE id_usuario='" . $_SESSION['id_usuario']."'";
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado);

?>

        <form action="../../______usuarios/__U2_altera_usuario.php" method="post" enctype="multipart/form-data" id="edicao_usuario" onsubmit="return validarSenha();">

            <h4 class="center-align">Editar Conta</h4><br>

            Nome:<i class="material-icons right">person</i><input id="field" name="nome_usuario" type="text" value="<?php echo $linha['nome_usuario']; ?>" placeholder="insira seu nome" required><br>

            <br>
            <br>

            <h6>Imagem de Perfil:<i class="material-icons right">image</i></h6>

                <img src="<?=$endereco_imagem_usuario;?>" style="margin-left:38%; border-radius: 100%; width: 240px; height: 240px;">

                <br>

                <div class="file-field" style="margin-left:39%;">
                    <div class="waves-effect waves-light btn grey darken-4">
                        <span class="bold"><i class="material-icons left">upload</i> Selecionar Arquivo</span>
                        <input name="endereco_imagem_usuario" type="file" style="text-align:center !important;" accept="image/*" form="edicao_usuario" onchange="previewImagem()">
                    </div>
                </div>
            
            <br>
            <br>
            <br>
            <br>

            Senha Antiga:<i class="material-icons right">vpn_key</i>
            <input id="field" name="senha_antiga" type="password" placeholder="insira sua senha"><br>

            <br>

            Senha Nova:<i class="material-icons right">lock_outline</i>
            <input id="senha" name="senha" type="password" placeholder="caso deseje, insira uma nova senha"><br>

            <br>

            Confirmar Senha Nova:<i class="material-icons right">lock_open</i>
            <input id="confirmar_senha" name="confirmar_senha" type="password" onblur="validarSenha()" placeholder="confirme a nova senha"><br>

            <br>
            <br>

            <input type="hidden" name="endereco_imagem_usuario_pre_alteracao" value="<?php echo $linha['endereco_imagem_usuario'];?>">

            <div class="left">
                <a href="#excluir" class="modal-trigger waves-effect waves-light btn bold"
                style="background-color: #e53935 !important;">DELETAR CONTA<i class="material-icons right">delete</i>
                </a>
            </div>
            <div class="right">

                <a href="#!" class="modal-close waves-effect waves-light btn bold"
                style="background-color: #212121 !important;">Cancelar<i class="material-icons right">close</i>
                </a>

                <button type="submit" class="waves-effect waves-light btn bold"
                style="background-color: #212121 !important;">ENVIAR<i class="material-icons right">check</i>
                </button>

            </div>

            <br>
            <br>

        </form>

    </main>

</body>

</html>