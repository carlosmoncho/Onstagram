<?php

namespace App\Livewire;
 
use Livewire\Component;
use App\Models\Comentario;
use Livewire\Attributes\Rule;

class ComentariosPost extends Component
{
    public $post;
    public $coments = [];

    #[Rule('required')] 
    public $comentario;

    public function mount($post){
        $this->coments = $post->comentarios;
    }

    public function save(){
        $this->validate(); 
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comentario' => $this->comentario
        ]);
        $this->comentario = '';
        $this->coments = $this->post->comentarios;
    }

    public function render()
    {
        return view('livewire.comentarios-post');
    }
}
