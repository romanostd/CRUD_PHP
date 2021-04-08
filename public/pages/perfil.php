<?php require_once("../../conexao/conexao.php"); ?>

<?php 

    // teste de segurança
    session_start();

    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');


    if ( isset($_GET["conta"]) ) {
        $cliente_id = $_GET["conta"];
    } else {
        Header("Location: inicial.php");
    }

    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM clientes ";
    $consulta .= "WHERE clienteID = {$cliente_id} ";
    $perfil    = mysqli_query($conecta,$consulta);

    // Testar erro
    if ( !$perfil ) {
        die("Falha no Banco de dados");
    } 
        else {
        $dados_perfil = mysqli_fetch_assoc($perfil);
        $clienteID      = $dados_perfil["clienteID"];
        $nome           = $dados_perfil["nomecompleto"];
        $endereco       = $dados_perfil["endereco"];
        $complemento    = $dados_perfil["complemento"];
        $numero         = $dados_perfil["numero"];
        $cidade         = $dados_perfil["cidade"];
        $estadoID       = $dados_perfil["estadoID"];
        $cep            = $dados_perfil["cep"];
        $ddd            = $dados_perfil["ddd"];
        $telefone       = $dados_perfil["telefone"];
        $email          = $dados_perfil["email"];
        $usuario        = $dados_perfil["usuario"];
        $senha          = $dados_perfil["senha"];
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
            <div class="row">
                <div class="col">Nome: <?php echo utf8_encode($nome) ?></div>
            </div>
            <div class="row">
                <div class="col">Endereço: 
                <?php echo utf8_encode($endereco)  ?> 
                <?php echo utf8_encode($complemento) ?>
                <?php echo utf8_encode($numero) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">Cidade: <?php echo utf8_encode($cidade) ?></div>
            </div>
            <div class="row">
                <div class="col">Estado: <?php echo utf8_encode($estadoID) ?></div>
            </div>
            <div class="row">
                <div class="col">cep: <?php echo utf8_encode($cep) ?></div>
            </div>
            <div class="row">
                <div class="col">Tell: <?php echo utf8_encode($ddd) ?> <?php echo utf8_encode($telefone) ?></div>
            </div>
            <div class="row">
                <div class="col">Email: <?php echo utf8_encode($email) ?></div>
            </div>
            <div class="row">
                <div class="col">Endereço: <?php echo utf8_encode($endereco) ?></div>
            </div>
            <div class="row">
                <div class="col">Usuario: <?php echo utf8_encode($usuario) ?></div>
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