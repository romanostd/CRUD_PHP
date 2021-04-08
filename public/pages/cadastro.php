<?php require_once("../../conexao/conexao.php"); ?>
    
    <?php

    // insercao no banco
    if(isset($_POST["endereco"])) {
        $nome           = utf8_decode($_POST["nomecompleto"]);
        $endereco       = utf8_decode($_POST["endereco"]);
        $cidade         = utf8_decode($_POST["cidade"]);
        $complemento    = utf8_decode($_POST["complemento"]);
        $numero         = $_POST["numero"];
        $estado         = $_POST["estados"];
        $telefone       = $_POST["telefone"];
        $cep            = $_POST["cep"];
        $ddd            = $_POST["ddd"];
        $email          = $_POST["email"];
        $usuario        = $_POST["usuario"];
        $senha          = $_POST["senha"];
        
        // Insercao no banco
        $inserir    = "INSERT INTO clientes ";
        $inserir    .= "(nomecompleto,endereco,cidade,complemento,numero,estadoID,cep,telefone,ddd,email,usuario,senha) ";
        $inserir    .= "VALUES ";
        $inserir    .= "('$nome','$endereco','$cidade', '$numero', '$complemento', $estado, '$cep', '$telefone', '$ddd', '$email', '$usuario', '$senha')";
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir) {
            die("Erro no banco");
        }  
    }

        // selecao de estados
        $select = "SELECT estadoID, nome ";
        $select .= "FROM estados ";
        $lista_estados = mysqli_query($conecta, $select);
        if(!$lista_estados) {
            die("Erro no banco");
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
        <header>
            <nav class="navbar navbar-dark bg-dark-pink border-bottom border-secondary">
                <a class="navbar-brand" href="listagem.php">
                    <img src="../_assets/logo.png" width="300" height="100" alt="30">
                </a>
            </nav>
        <main>  
            <div class="container w-75 mt-5 border">
                <h3 class="text-center">Cadastre-se</h3>
                <form action="cadastro.php" method="post">
                    <!-- campo de nome e endereço -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nomecompleto" placeholder="Nome Completo">
                            </div>
                        </div>   
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="endereco" placeholder="Endereço">                     
                            </div>
                        </div>
                    </div>
                    <!-- campo de complemento , nuemro ,cidade e estado -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="complemento" placeholder="Complemento">                     
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <input type="number" class="form-control" name="numero" placeholder="Numero">                     
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="cidade" placeholder="Cidade">                     
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group form-select-lg">
                                <select name="estados" class="form-select w-100 form-select-lg" aria-label="Default select example">
                                <?php
                                    while($linha = mysqli_fetch_assoc($lista_estados)) {
                                ?>
                                    <option value="<?php echo $linha["estadoID"];  ?>">
                                        <?php echo utf8_encode($linha["nome"]);  ?>
                                    </option>
                                    <?php
                                }   
                                ?> 
                                </select>                     
                            </div>
                        </div>
                    </div>
                    <!-- campo de cep ,ddd, tel, email -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <input type="number" class="form-control" name="cep" placeholder="cep">                     
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <input type="number" class="form-control" name="ddd" placeholder="DDD">                     
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <input type="tel" class="form-control" name="telefone" placeholder="Telefone">                     
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email">                     
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="usuario" placeholder="Nome de usuario">                     
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <input type="password" class="form-control" name="senha" placeholder="Senha">                     
                            </div>
                        </div>
                    </div>  
                    <div class="row mt-3 mb-5">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <button type="submit" value="inserir" class="btn bg-pink text-light btn-block">Cadastrar</button>
                        </div>
                    </div>              
                </form>
            </div>          
        </main>
        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>