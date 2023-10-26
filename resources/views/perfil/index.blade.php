@extends('layouts.app')

@section('titulo')
    Editar Perfil:  {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{route('perfil.store')}}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input
                    id="username"
                    name="username" 
                    type="text"
                    placeholder="Tu Nombre de Usuario" 
                    class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                    value="{{auth()->user()->username}}">
                    @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input
                    id="imagen"
                    name="imagen" 
                    type="file"
                    class="border p-3 w-full rounded-lg "
                    value=""
                    accept=".jpg, .jpeg, .png">
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                    id="email" 
                    name="email" 
                    type="text" 
                    placeholder="Tu Email de registro" 
                    class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                    value="{{auth()->user()->email}}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Cambiar Password
                    </label>
                    <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    placeholder="Password actual" 
                    class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @if (session('passwordMensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{session('passwordMensaje')}}
                        </p>
                    @endif
                </div>
                <div class="mb-5">
                    <label for="newpassword" class="mb-2 block uppercase text-gray-500 font-bold">
                    </label>
                    <input 
                    id="newpassword" 
                    name="newpassword" 
                    type="password" 
                    placeholder="Password nueva" 
                    class="border p-3 w-full rounded-lg">
                    @if(session('newpasswordMensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{session('newpasswordMensaje')}}
                        </p>
                    @endif
                </div>
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
    </div>
@endsection