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
*   Não é necessário ter PHP ou Composer instalados localmente no host (tudo roda via script `mini`/`dk`).

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
    *Edite o arquivo `.env` para suas credenciais.*

3.  **Iniciar Aplicação (via Docker):**
    ```bash
    # Usando o profile 'dev' para subir tudo
    docker compose --profile dev up -d --build
    ```

4.  **Instalar Dependências:**
    ```bash
    # O script dk wrapper facilita o uso do container
    ./dk composer install
    ```

5.  **Acessar:**
    Abra o navegador em `http://localhost:8080`.

## 🚀 CLI (Artisan-style)

O framework possui uma ferramenta de linha de comando poderosa.

*   **No Host (Mac/Linux)**: Use `./dk <comando>`
*   **No Container**: Use `php mini <comando>`

### Comandos Úteis
```bash
./dk list                   # Lista todos os comandos
./dk make:controller User   # Cria UsersController
./dk make:model Product     # Cria ProductModel
./dk make:migration CreateUsers # Cria migration do Phinx
./dk clear:cache            # Limpa cache do Blade
```

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

### Create a Controller
Create a file in `app/controllers/` following the pattern `NameController.php`:

```php
<?php
class ProductsController extends Controller {
    
    // Route: /products or /products/index
    public function index() {
        $products = (new ProductModel())->read();
        $this->view('products.index', ['products' => $products]);
    }

    // Route: /products/create
    public function create() {
        $this->view('products.create');
    }
}
```

### Create a View
Create a file in `app/views/` with `.blade.php` extension.
Example `app/views/products/index.blade.php`:

```html
@extends('layout')

@section('title', 'Product List')

@section('content')
    <h1>My Products</h1>
    @foreach($products as $product)
        <p>{{ $product['name'] }}</p>
    @endforeach
@endsection
```

### Use Database (Model)
Your models extend the base `Model` class, which already has **Medoo** configured.

```php
class ProductModel extends Model {
    public $table = "products";
}

// In Controller:
$model = new ProductModel();
$all = $model->read(); // SELECT * FROM products
$one = $model->read(1);   // SELECT * FROM products WHERE id = 1
$model->insert(['name' => 'New Item']);
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
