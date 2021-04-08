<?php
    function enviarMensagem($dados) {
        // Dados do formulario
        $nome_usuario       = $dados['nome'];
        $email_usuario      = $dados['email'];
        $mensagem_usuario   = $dados['mensagem'];
        
        // Criar variaveis de envio
        $destino            = "suporte@imediabrasil.com.br";
        $remetente          = "imediabrasil@imediabrasil.com.br";
        $assunto            = "Mensagem do site";
        
        // Montar o corpo da mensagem
        $mensagem           = "O usuario " . $nome_usuario . " enviou uma mensagem." . "</BR>";
        $mensagem           .= "email do usuario: " . $email_usuario . "</BR>";
        $mensagem           .= "mensagem:" . "</BR>";
        $mensagem           .= $mensagem_usuario;
        
        return mail($destino, $assunto, $mensagem, $remetente);
    }

?>