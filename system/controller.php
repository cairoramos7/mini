<?php

class Controller extends System{

    protected function view($nome, $vars = null){
        $views = VIEWS;
        $cache = __DIR__ . '/../storage/views/cache';

        // Garante que o diretório de cache existe
        if (!file_exists($cache)) {
            mkdir($cache, 0777, true);
        }

        $blade = new \Jenssegers\Blade\Blade($views, $cache);

        // Se houver variáveis, passa para a view
        $data = (is_array($vars) && count($vars) > 0) ? $vars : [];

        echo $blade->make($nome, $data)->render();
    }
}
