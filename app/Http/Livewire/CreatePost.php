<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public bool $openCrear=false;
    public string $titulo="", $contenido="", $category_id="";

    
    
    protected function rules(){
        return [
            'titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo'],
            'contenido'=>['required', 'string', 'min:5'],
            'category_id'=>['required', 'exists:categories,id']
        ];
    }
    
    public function render()
    {
        $categorias=Category::select("id", "nombre")->orderBy('nombre')->get();
        return view('livewire.create-post', compact('categorias'));
    }

    public function guardar(){
        $this->validate();
        Post::create([
            'titulo'=>$this->titulo,
            'contenido'=>$this->contenido,
            'category_id'=>$this->category_id,
            'user_id'=>auth()->user()->id
        ]);
        $this->emitTo('show-user-posts', 'refrescar');
        $this->reset(['openCrear', 'titulo', 'contenido', 'category_id']);
    }

}
