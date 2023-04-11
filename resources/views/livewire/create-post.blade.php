<div>
    <button wire:click="$set('openCrear', true)"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i
            class="fas fa-add mr-2"></i>Nuevo</button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Crea tu Post
        </x-slot>
        <x-slot name="content">
            @wire('defer')
                <x-form-input name="titulo" label="Título del Post" placeholder="Título..." />
                <x-form-textarea name="contenido" placeholder="Contenido..." label="Contenido del Post" class="my-2" />
                <x-form-select name="category_id" label="Categoría del Post" >
                <option>____ SELECCIONA UNA CATEGORÍA</option>
                @foreach($categorias as $item)
                <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
                </x-form-select>
            @endwire
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="guardar"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2"><i
                        class="fas fa-save mr-2"></i>GUARDAR</button>

                <button wire:click="$set('openCrear', 0)"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><i
                        class="fas fa-xmark mr-2"></i>CANCELAR</button>

            </div>
        </x-slot>
    </x-dialog-modal>
</div>
