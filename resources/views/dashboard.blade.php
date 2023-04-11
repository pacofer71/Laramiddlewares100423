<x-propios.uno>
    <x-propios.tabla1>
        <div class="flex mb-2">
            <div class="flex-1">
                <x-input class="w-full" type='search' placeholder="Buscar..." wire:model="buscar" />
            </div>
            <div class="ml-2">
                @livewire('create-post')
            </div>
        </div>
        <table class="min-w-full text-sm font-light">
            <thead class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                <tr>
                    <th scope="col" wire:click="ordenar('id')" class="whitespace-nowrap cursor-pointer px-6 py-4">ID<i
                            class="ml-2 fas fa-sort"></i></th>
                    <th scope="col" wire:click="ordenar('titulo')" class="whitespace-nowrap cursor-pointer px-6 py-4">Titulo<i
                            class="ml-2 fas fa-sort"></i></th>
                    <th scope="col" wire:click="ordenar('category_id')" class="whitespace-nowrap cursor-pointer px-6 py-4">Categoria<i
                            class="ml-2 fas fa-sort"></i></th>
                    <th scope="col" wire:click="ordenar('contenido')" class="whitespace-nowrap cursor-pointer px-6 py-4">Contenido<i
                            class="ml-2 fas fa-sort"></i></th>
                    <th scope="col" class="whitespace-nowrap px-6 py-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    <tr @class([
                        'border-b dark:border-neutral-500 hover:bg-gray-200',
                        'bg-gray-100 text-gray-600' => $item->user->is_admin,
                    ])>
                        <td class="whitespace-nowrap  px-6 py-4 font-bold">{{ $item->id }}</td>
                        <td class="whitespace-nowrap  px-6 py-4">{{ $item->titulo }}</td>
                        <td class="whitespace-nowrap  px-6 py-4">{{ $item->category->nombre }}</td>
                        <td class="px-6 py-4">{{ $item->contenido }}</td>
                        <td class="whitespace-nowrap  px-6 py-4">
                            <button  wire:click="permisoBorrar({{$item->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button  wire:click="editar({{$item->id}})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-propios.tabla1>
    <div class="mt-2">
        {{ $posts->links() }}
    </div>
    <!-- MODAL PARA  EDITAR ------------------------------------------------------------------------------------------------------>
    @isset($post->id)
    <x-dialog-modal wire:model="openEditar">
        <x-slot name="title">
            Editar Post
        </x-slot>
        <x-slot name="content">
            @wire($post, 'defer')
                <x-form-input name="post.titulo" label="Título del Post" placeholder="Título..." />
                <x-form-textarea name="post.contenido" placeholder="Contenido..." label="Contenido del Post" class="my-2" />
                <x-form-select name="post.category_id" label="Categoría del Post" >
                <option>____ SELECCIONA UNA CATEGORÍA</option>
                @foreach($categorias as $item)
                <option value="{{$item->id}}" @selected($post->category_id==$item->id)>{{$item->nombre}}</option>
                @endforeach
                </x-form-select>
            @endwire
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="update"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2"><i
                        class="fas fa-edit mr-2"></i>EDITAR</button>

                <button wire:click="cancelar"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><i
                        class="fas fa-xmark mr-2"></i>CANCELAR</button>

            </div>
        </x-slot>
    </x-dialog-modal>
    @endisset
</x-propios.uno>

