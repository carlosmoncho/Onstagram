@extends('layouts.app')

@section("titulo")
    Página Pricipal
@endsection

@section("contenido")
    <x-listar-post :posts="$posts">
        <p class="text-center">No sigues aun a nadie</p>
    </x-listar-post>
@endsection