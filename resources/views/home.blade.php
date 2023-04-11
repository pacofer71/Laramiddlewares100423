<x-app-layout>
    <x-propios.uno>
        <x-propios.tabla1>
            <table class="min-w-full text-sm font-light">
                <thead
                    class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                    <tr>
                        <th scope="col" class=" px-6 py-4">Autor</th>
                        <th scope="col" class=" px-6 py-4">Titulo</th>
                        <th scope="col" class=" px-6 py-4">Categoria</th>
                        <th scope="col" class=" px-6 py-4">Contenido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $item)
                    <tr @class([
                        "border-b dark:border-neutral-500",
                        "bg-red-800 text-white"=>$item->user->is_admin
                        ])>
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$item->user->email}}</td>
                        <td class="whitespace-nowrap  px-6 py-4">{{$item->titulo}}</td>
                        <td class="whitespace-nowrap  px-6 py-4">{{$item->category->nombre}}</td>
                        <td class="px-6 py-4">{{$item->contenido}}</td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </x-propios.tabla1>
        <div class="mt-2">
            {{$posts->links()}}
        </div>
    </x-propios.uno>
</x-app-layout>
