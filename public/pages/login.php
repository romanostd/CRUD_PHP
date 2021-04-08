<?php require_once("../../conexao/conexao.php"); ?>
<?php
    // adicionar variaveis de sessao
    session_start();

    if ( isset( $_POST["usuario"] )  ) {
        $usuario    = $_POST["usuario"];
        $senha      = $_POST["senha"];    
        
        $login = "SELECT * ";
        $login .= "FROM clientes ";
        $login .= "WHERE usuario = '{$usuario}' and senha = '{$senha}' ";
    
        $acesso = mysqli_query($conecta, $login);
        if ( !$acesso ) {
            die("Falha na consulta ao banco");
        }
        
        $informacao = mysqli_fetch_assoc($acesso);
        
        if ( empty($informacao) ) {
            $mensagem = "Login sem sucesso.";
        } else {
            $_SESSION["user_portal"] = $informacao["clienteID"];
            header("location:listagem.php");
        }
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Terminator Suplementos</title>
        <link rel="shortcut icon" href="../_assets/icon.png" />
        
        <!-- estilo -->
        <link href="../style/css_main_page.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
    </head>

    <body>
        <header>
            <nav class="navbar navbar-dark bg-dark-pink border-bottom border-secondary">
                <a class="navbar-brand" href="listagem.php">
                    <img src="../_assets/logo.png" width="300" height="100" alt="30">
                </a>
            </nav>
        </header>
        
        <main>
       
        <div class="container text-center mt-3">
            <h2>Login do usuario</h2>
            <form action="login.php" method="post">
            <div class="row mt-3">
                <div class="col-sm-12 col-md-4 offset-sm-4">
                    <input type="text" name="usuario" class="form-control"  aria-describedby="emailHelp" placeholder="Seu email">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12 col-md-4 offset-sm-4">
                    <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12 col-md-4 offset-sm-4">
                <button type="submit" value="Login" class="btn bg-pink text-light btn-block">Enviar</button>
                </div>
            </div>
            </form>
                <?php
                    if ( isset($mensagem)) { 
                ?>
                    <p><?php echo $mensagem ?></p>
                    
                <?php
                    }
                ?>                        
            </form>
            <div class="mt-3"><p>Não tem cadastro? <a class="text-dark" href="cadastro.php">Cadastre-se</a></div>
        </div>
        </main>
        
        <!--          
        <footer>
            <div id="footer_central">
                <p>ANDES &eacute; uma empresa fict&iacute;cia, usada para o curso PHP Integra&ccedil;&atilde;o com MySQL.</p>
            </div>
        </footer>
        -->

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>