@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="starter-template">
        <h1>Isto é uma view - Index</h1>
        <p class="lead">Exemplo de integração do Blade.</p>
        <hr>
        <div class="text-left">
            <p><strong>Nome:</strong> {{ $nome ?? '' }}</p>
            <p><strong>Sobrenome:</strong> {{ $sobrenome ?? '' }}</p>
            <p><strong>Idade:</strong> {{ $idade ?? '' }}</p>
            <p><strong>Tamanho:</strong> {{ $tamanho ?? '' }}</p>
        </div>
    </div>
@endsection
