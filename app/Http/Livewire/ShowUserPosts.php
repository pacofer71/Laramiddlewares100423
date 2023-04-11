<?php

namespace App\Http\Livewire;

use App\Models\{Post, Category};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowUserPosts extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $buscar="";
    public string $campo="id", $orden="desc";
    public Post $post;
    public bool $openEditar=false;

    protected $listeners=[
        'refrescar'=>'render',
        'borrar'=>'borrar'
    ];

    protected function rules(){
        return [
            'post.titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo,'.$this->post->id],
            'post.contenido'=>['required', 'string', 'min:5'],
            'post.category_id'=>['required', 'exists:categories,id']
        ];
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function render()
    {
        $posts=Post::where('user_id', auth()->user()->id)
        ->where(function($q){
            $q->where('titulo', 'like', '%'.trim($this->buscar).'%')
            ->orWhere('contenido', 'like', '%'.trim($this->buscar).'%');
        })
        ->orderBy($this->campo, $this->orden)
        ->paginate(5);

        $categorias=Category::select("id", "nombre")->orderBy('nombre')->get();

        return view('dashboard', compact('posts', 'categorias'));
        
    }

    public function ordenar(string $campo): void{
        $this->orden=($this->orden=="asc") ? "desc" : "asc";
        $this->campo=$campo;
    }

    public function permisoBorrar(Post $post){
        $this->authorize('delete', $post);
        $this->emit('mensajeBorrar', $post);
    }

    public function borrar(Post $post){
        $post->delete();
        $this->emit('postMensaje', "El Post ha sido Borrado");
    }

    public function editar(Post $post){
        $this->authorize('update', $post);
        $this->post=$post;
        $this->openEditar=true;
    }
    public function update(){
        $this->validate();
        $this->post->update([
            'titulo'=>$this->post->titulo,
            'contenido'=>$this->post->contenido,
            'category_id'=>$this->post->category_id,
        ]);
        $this->reset(['openEditar']);
        $this->post=new Post;
        $this->emit('postMensaje', 'El post se editó con éxito');
    }

    public function cancelar(){
        $this->reset(['openEditar']);
    }
}
