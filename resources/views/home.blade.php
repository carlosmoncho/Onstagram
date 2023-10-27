@extends('layouts.app')

@section("titulo")
    Página Pricipal
@endsection

@section("contenido")
    <x-listar-post :posts="$posts"/>
@endsection