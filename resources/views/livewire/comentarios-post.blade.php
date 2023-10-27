<div>
    <form wire:submit="save">
        @csrf
        <div class="mb-5">
            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                comentario
            </label>
            <textarea
            wire:model="comentario"
            id="comentario" 
            name="comentario" 
            type="text" 
            placeholder="Agrega un comentario" 
            class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror">{{$comentario}}</textarea>
            <div>
                @error('comentario') <span class="error">{{ $message }}</span> @enderror 
            </div>
        </div>
        <input 
            type="submit" 
            value="Comentar" 
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
    </form>
    <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
        @if ($coments->count())
            @foreach ($coments as $comentario)
                <div class="p-5 border-gray-300 border-b">
                    <a href="{{route('posts.index',$comentario->user)}}" class="font-bold">{{$comentario->user->username}}</a>
                    <p>{{$comentario->comentario}}</p>
                    <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                </div>
            @endforeach
        @else
            <p class="p-10 text-center">No hay comentarios</p>
        @endif
    </div>
</div>
