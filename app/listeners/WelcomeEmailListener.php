<?php

class WelcomeEmailListener {

    public function handle($data) {
        $email = $data['email'];
        $name = $data['name'];

        // Simulação de envio de email
        // Mail::send($email, "Bem-vindo, $name!");
        
        // Log para ver funcionando
        $logger = new \Monolog\Logger('mail');
        $logger->pushHandler(new \Monolog\Handler\StreamHandler('storage/app.log'));
        $logger->info("Email de boas-vindas enviado para: $email");
    }
}
