<?php require_once("../../conexao/conexao.php"); ?>

<?php
    // teste de segurança
    session_start();

    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');

    // Consulta ao banco de dados
    $produtos = "SELECT produtoID, nomeproduto, tempoentrega, precounitario, imagemgrande ";
    $produtos .= "FROM produtos ";
    if (isset($_GET["produto"])) {
        $nome_produto   = urlencode($_GET["produto"]);
        $produtos       .= "WHERE nomeproduto LIKE '%{$nome_produto}%' "; 
    }
    $resultado = mysqli_query($conecta, $produtos);
    if(!$resultado) {
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
        <?php include_once("../_incluir/funcoes.php"); ?>  
        <?php include_once("../_incluir/functions_main_page.php"); ?> 
        
        <main>
            
            <!-- Carrossel-->
            
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="../_assets/Wallpaper1.jpg" height="400" alt="First slide">
                    </div>
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="../_assets/Wallpaper2.jpg" height="400" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../_assets/Wallpaper3.jpg" height="400" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            </div>
            
            <!-- Produtos em destaque-->
            
            <div class="container mt-5">
                <h3 class="mb-5">DESTAQUES</h3>
                <div class="row">
                <?php
                    while($linha = mysqli_fetch_assoc($resultado)) {
                ?>
                
                    <div class="col-sm-3 mb-4">
                        <div class="card" style="width: 15rem;">
                            <a href="detalhe.php?codigo=<?php echo $linha['produtoID'] ?>">
                                <img class="card-img-top" src="<?php echo $linha["imagemgrande"] ?>" width="150" height="200" alt="Card image cap">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo utf8_encode ($linha["nomeproduto"]) ?></h5>
                                <p class="card-text">Preço unitário : <?php echo real_format($linha["precounitario"]) ?></p>
                            </div>
                        </div>
                    </div>
                <?php    
                }
                ?>  
           

            </div> 
        </main>
        <?php include_once("../_incluir/rodape.php"); ?>
        
        <!-- Scripts-->
        
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>