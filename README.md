# Mini Framework PHP

Um framework PHP puramente didático. O objetivo deste projeto é servir de base para estudos sobre como estruturas MVC funcionam "por baixo do capô", integrando componentes comuns do ecossistema PHP.

## 🚀 Principais Features

*   **Arquitetura MVC**: Separação entre Models, Views e Controllers.
*   **Docker Ready**: Ambiente de desenvolvimento com Nginx, PHP 8.2-FPM e MySQL 8.0 via Docker Compose.
*   **Gestão de Dependências**: Uso do [Composer](https://getcomposer.org/).
*   **Template Engine**: Integração com o [Laravel Blade](https://github.com/jenssegers/blade) para as views.
*   **Banco de Dados**: Uso do [Medoo](https://medoo.in/) para facilitar consultas SQL.
*   **Rotas Simples**: Sistema de rotas baseado em convenção (Controller/Action).
*   **Segurança Básica**:
    *   Uso de variáveis de ambiente (`.env`).
    *   Exemplo de autenticação com `System\Auth`.
*   **Debug**: Tratamento de erros com [Whoops](https://filp.github.io/whoops/).

## 🛠 Pré-requisitos

*   [Docker](https://www.docker.com/) e Docker Compose instalados.
*   Não é necessário ter PHP ou Composer instalados localmente na máquina host.

## 📦 Como Instalar

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/cairoramos7/mini.git
    cd mini
    ```

2.  **Configurar Variáveis de Ambiente:**
    ```bash
    cp .env.example .env
    ```
    *Edite o arquivo `.env` se precisar alterar credenciais do banco.*

3.  **Subir o Ambiente Docker:**
    ```bash
    docker-compose up -d --build
    ```

4.  **Instalar Dependências (via Container):**
    ```bash
    docker-compose run --rm app composer install
    ```

5.  **Acessar:**
    Abra o navegador em `http://localhost:8080`.

## 📂 Estrutura de Pastas

```
mini/
├── app/
│   ├── controllers/    # Controladores (Logica da aplicação)
│   ├── models/         # Modelos (Acesso a dados / Regras de negócio)
│   ├── views/          # Templates (Blade)
│   ├── services/       # Serviços (Regras de negócio complexas)
│   ├── observers/      # Observadores de Modelos
│   └── listeners/      # Ouvintes de Eventos
├── public_html/        # Document Root (Entry point)
├── system/             # Core do Framework (Router, Controller base, etc)
├── storage/            # Cache de views e arquivos gerados
├── docker/             # Configurações do ambiente (Nginx, etc)
└── ...
```

## 💻 Como Usar

### Criar um Controller
Crie um arquivo em `app/controllers/` seguindo o padrão `NomeController.php`:

```php
<?php
class ProdutosController extends Controller {
    
    // Rota: /produtos ou /produtos/index
    public function index() {
        $produtos = (new ProdutosModel())->read();
        $this->view('produtos.index', ['produtos' => $produtos]);
    }

    // Rota: /produtos/create
    public function create() {
        $this->view('produtos.create');
    }
}
```

### Criar uma View
Crie um arquivo em `app/views/` com a extensão `.blade.php`.
Exemplo `app/views/produtos/index.blade.php`:

```html
@extends('layout')

@section('title', 'Lista de Produtos')

@section('content')
    <h1>Meus Produtos</h1>
    @foreach($produtos as $produto)
        <p>{{ $produto['nome'] }}</p>
    @endforeach
@endsection
```

### Usar o Banco de Dados (Model)
Seus models estendem a classe base `Model`, que já possui o **Medoo** configurado.

```php
class ProdutosModel extends Model {
    public $_tabela = "produtos";
}

// No Controller:
$model = new ProdutosModel();
$todos = $model->read(); // SELECT * FROM produtos
$um = $model->read(1);   // SELECT * FROM produtos WHERE id = 1
$model->insert(['nome' => 'Novo Item']);
```

### Autenticação
Use o helper `Auth` em qualquer lugar:

```php
if (Auth::check()) {
    $userId = Auth::id();
} else {
    // Redirecionar para login
}
```

## 📝 Licença

Este projeto é open-source e está licenciado sob a [MIT license](LICENSE).
