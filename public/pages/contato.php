<?php require_once("../../conexao/conexao.php"); ?>
<?php require_once("../_incluir/functions_contact.php"); ?>


<?php

    // teste de segurança
    session_start();

    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');

    if ( isset($_POST['enviar']) ) {
        if ( enviarMensagem($_POST) ) {
            $mensagem = "Mensagem enviada com sucesso.";
        } else {
            $mensagem = "Erro no envio.";
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../style/css_main_page.css" rel="stylesheet">

    </head>


    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        
        <main>
            <div class="container  mt-5">
                <h3 class="mb-4 text-center">Contato</h2>
                <form action="contato.php" method="post">
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <div class="form-group">
                                <input type="text" name="nome" class="form-control"  aria-describedby="emailHelp" placeholder="Digite seu nome">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Digite seu email">
                            </div>
                        </div>    
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <label>Mensagem</label>
                            <div class="form-group">
                                <textarea class="form-control" name="mensagem" rows="5" value="Enviar Mensagem"></textarea>
                            </div>
                        </div>    
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">    
                            <button type="submit" name="enviar" value="Enviar Mensagem" class=" text-center btn bg-pink text-light btn-block">Enviar</button>
                        </div>    
                    </div>
                    <?php
                        if( isset($mensagem) ) {
                            echo "<p>" . $mensagem . "</p>";
                        }
                    ?>  
                </form>
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>
        
        <!-- Scripts -->
        
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>