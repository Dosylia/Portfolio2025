<?php
    if (isset($_POST["submit"])) {
        $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = nl2br(htmlspecialchars(strip_tags(trim($_POST["message"]))));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Adresse email invalide.";
            exit;
        }

        if (!empty($_POST['website'])) {
            exit("Spam detected.");
        }

        $to = "emma.montbarbon@outlook.fr";
        $subject = "💌 Nouveau message de votre portfolio";

        // HTML body
        $body = "
            <html>
            <head>
            <style>
                body { font-family: Arial, sans-serif; color: #333; }
                .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; background: #fafafa; }
                h2 { color: #5C6BC0; }
                p { line-height: 1.6; }
                .label { font-weight: bold; }
            </style>
            </head>
            <body>
            <div class='container'>
                <h2>📨 Nouveau message reçu</h2>
                <p><span class='label'>👤 Nom:</span> $name</p>
                <p><span class='label'>📧 Email:</span> $email</p>
                <p><span class='label'>💬 Message:</span><br>$message</p>
            </div>
            </body>
            </html>
        ";

        // Headers
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";

        if (mail($to, $subject, $body, $headers)) {
            header("location: /?success=Votre message a été envoyé avec succès !");
            exit();
        } else {
            header("location: /?error=Une erreur s'est produite lors de l'envoi de votre message.");
            exit();
        }
    }
?>
