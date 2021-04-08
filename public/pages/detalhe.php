<?php require_once("../../conexao/conexao.php"); ?>
<?php

    // teste de segurança
    session_start();

    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');


    if ( isset($_GET["codigo"]) ) {
        $produto_id = $_GET["codigo"];
    } else {
        Header("Location: inicial.php");
    }

    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM produtos ";
    $consulta .= "WHERE produtoID = {$produto_id} ";
    $detalhe    = mysqli_query($conecta,$consulta);

    // Testar erro
    if ( !$detalhe ) {
        die("Falha no Banco de dados");
    } else {
        $dados_detalhe = mysqli_fetch_assoc($detalhe);
        $produtoID      = $dados_detalhe["produtoID"];
        $nomeproduto    = $dados_detalhe["nomeproduto"];
        $descricao      = $dados_detalhe["descricao"];
        $codigobarra    = $dados_detalhe["codigobarra"];
        $tempoentrega   = $dados_detalhe["tempoentrega"];
        $precorevenda   = $dados_detalhe["precorevenda"];
        $precounitario  = $dados_detalhe["precounitario"];
        $estoque        = $dados_detalhe["estoque"];
        $imagemgrande   = $dados_detalhe["imagemgrande"];
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
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-8 ">
                        <div class="card pr-5 pl-5">
                            <img class="card-img-top pr-5 pl-5" src="<?php echo $imagemgrande ?>"height="350" alt="Imagem de capa do card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo utf8_encode($nomeproduto) ?></h5>
                                <p class="card-text text-justify text-secondary">Descrição: <?php echo utf8_encode($descricao)?></p>
                                <p class="card-text text-secondary">Estoque: <?php echo $estoque ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 ">
                        <div class="card text-center h-50">
                            <div class="card-body">
                                <h5 class="card-title mt-4">Preçoo Unitario: <?php echo "R$ " . number_format($precounitario,2,",",".") ?></h5>
                                <p class="card-text text-secondary">Tempo de Entrega: <?php echo $tempoentrega ?> dias</p>
                                <a href="#" class="btn bg-pink text-light">COMPRAR</a>
                            </div>
                        </div>             
                    </div>
                </div>
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>