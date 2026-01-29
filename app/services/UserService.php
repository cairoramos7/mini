<?php

class UserService {
    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register(array $data) {
        // 1. Regra de Negócio: Validar dados
        if (empty($data['email']) || empty($data['password'])) {
            throw new Exception("Dados inválidos.");
        }

        // 2. Regra de Negócio: Hash da senha (se não usar o Auth lib)
        // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // 3. Persistência
        $userId = $this->userModel->insert($data);

        // 4. Evento: Disparar evento de boas-vindas
        if ($userId) {
            EventManager::dispatch('user.created', [
                'id' => $userId,
                'email' => $data['email'],
                'name' => $data['name']
            ]);
        }

        return $userId;
    }
}
