<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensagem = trim($_POST["mensagem"]);

    // Verifica se os dados são válidos
    if (empty($nome) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($mensagem)) {
        http_response_code(400);
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Configurações do Email
    $recipient = "seuemail@dominio.com";
    $subject = "Nova mensagem de $nome";
    $email_content = "Nome: $nome\n";
    $email_content = "Email: $email\n\n";
    $email_content = "Mensagem:\n$mensagem\n";

    // Cabeçalhos do Email
    $email_headers = "From: $nome <$email>";

    // Envia o Email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Obrigado! Sua mensagem foi enviada com sucesso.";
    } else {
        http_response_code(500);
        echo "Oops! Algo deu errado, não conseguimos enviar sua mensagem.";
    }
} else {
    http_response_code(403);
    echo "Método de requisição não permitido.";
}
?>1
