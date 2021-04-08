<?php require_once("../../conexao/conexao.php"); ?>
<?php include_once("../_incluir/functions_include_page.php"); ?>

<?php
    // conferir se a navegacao veio pelo preenchimento do formulario
    if( isset($_POST['nomeproduto']) ) {
        $resultado1 = publicarImagem($_FILES['foto_grande']);
        $resultado2 = publicarImagem($_FILES['foto_pequena']);

        $mensagem1 = $resultado1[0]; 
        $mensagem2 = $resultado2[0];
        
        $nomeproduto    = utf8_decode($_POST['nomeproduto']);
        $descricao      = utf8_decode($_POST['descricao']);
        $tempoentrega   = $_POST['tempoentrega'];
        $precounitario  = $_POST['precounitario'];
        $estoque        = $_POST['estoque'];
        $imagem_grande  = $resultado1[1];
        
        // Insercao no banco
        $inserir = "INSERT INTO produtos ";
        $inserir .="(nomeproduto,descricao,tempoentrega,precounitario,estoque,imagemgrande) ";
        $inserir .="VALUES ";
        $inserir .="('$nomeproduto','$descricao',$tempoentrega,$precounitario,$estoque,'$imagem_grande')";
        $qInserir = mysqli_query($conecta,$inserir);
        if(!$qInserir) {
            die("Erro na insercao");   
        } else {
            $mensagem = "Inserção ocorreu com sucesso.";
        }
    }

    // Consulta a tabela de categorias
    $categorias = "SELECT categoriaID, nomecategoria ";
    $categorias .= "FROM categorias ";
    $qCategorias = mysqli_query($conecta, $categorias);
    if(!$qCategorias) {
        die("Falha na consulta ao banco");   
    }

    // Consulta a tabela de fornecedores
    $fornecedores = "SELECT fornecedorID, nomefornecedor ";
    $fornecedores .= "FROM fornecedores ";
    $qFornecedores = mysqli_query($conecta, $fornecedores);
    if(!$qFornecedores) {
        die("Falha na consulta ao banco");   
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
            <div class="container mt-5">
                <h3 class="text-center">Incluir Novo Produto</h3>
                <form action="incluir.php" method="post" enctype="multipart/form-data">
                    <!-- campo de nome do produto e codigo de barra -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nomeproduto" placeholder="Nome do Produto">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="descricao" placeholder="Descrição">                     
                            </div>
                        </div>
                    </div>
                    <!-- campo de tempo de entrega -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                                <label>Tempo de Entrega: </label>                          
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="tempoentrega" value="5">5 dias
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="tempoentrega" value="8">8 dias
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="tempoentrega" value="15">15 dias
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="tempoentrega" value="30">30 dias
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- campo de categorias 
                    <label>Selecione a categoria do produto</label>
                    <select name="categoriaID">
                        <?php
                            while($linha = mysqli_fetch_assoc($qCategorias)) {
                        ?>
                            <option value="<?php echo $linha["categoriaID"];  ?>">
                                <?php echo utf8_encode($linha["nomecategoria"]);  ?>
                            </option>
                        <?php
                            }
                        ?>                        
                    </select>
                    -->
                    <!-- campo de fornecedor 
                    <label>Selecione o fornecedor do produto</label>
                    <select name="fornecedorID">
                        <?php
                            while($linha = mysqli_fetch_assoc($qFornecedores)) {
                        ?>
                            <option value="<?php echo $linha["fornecedorID"];  ?>">
                                <?php echo utf8_encode($linha["nomefornecedor"]);  ?>
                            </option>
                        <?php
                            }
                        ?>                        
                    </select>                    
                    -->
                    <!-- campo de precos 
                    <input type="text" name="precorevenda" placeholder="Preço Revenda">-->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">R$</span>
                                    </div>
                                    <input type="text" class="form-control" name="precounitario" placeholder="Preço Unitário">                      
                                </div>
                            </div>
                        </div>
                    </div>    
                    <!-- campo de estoque -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="614400">
                    
                    <!-- campo de foto grande -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <div class="form-group ">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto_grande">
                                    <label class="custom-file-label" for="customFile">Foto grande</label>
                                    <span class="resposta">
                                        <?php
                                            if( isset($mensagem1) ) {
                                                echo $mensagem1;
                                            }    
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                   
                    <!-- campo escondido para iniciar estoque -->
                    <input type="hidden" name="estoque" value="0">
                    
                    <!-- botao submit -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <button type="submit" value="Inserir novo produto" class="btn bg-pink text-light btn-block">Enviar</button>
                            <?php
                                if( isset($mensagem) ) {
                                    echo "<p>" . $mensagem . "</p>";
                                }
                            ?>
                        </div>
                    </div>                                  
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
    // Fechar as queries
    mysqli_free_result($qCategorias);
    mysqli_free_result($qFornecedores);
?>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>