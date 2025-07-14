<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Carimbos</h2>
    </x-slot>

    <div class="py-4 px-6">
        <a href="{{ route('admin.stamps.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Novo Carimbo</a>

        <table class="w-full mt-4 table-auto border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-2 py-1">Usuário</th>
                    <th class="px-2 py-1">Cartão</th>
                    <th class="px-2 py-1">Carimbado em</th>
                    <th class="px-2 py-1">Usado?</th>
                    <th class="px-2 py-1">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stamps as $stamp)
                    <tr class="border-t">
                        <td class="px-2 py-1">{{ $stamp->user->name }}</td>
                        <td class="px-2 py-1">{{ $stamp->card->title }}</td>
                        <td class="px-2 py-1">{{ $stamp->stamped_at }}</td>
                        <td class="px-2 py-1">{{ $stamp->used ? 'Sim' : 'Não' }}</td>
                        <td class="px-2 py-1">
                            <a href="{{ route('admin.stamps.edit', $stamp) }}" class="text-blue-600">Editar</a>
                            <form action="{{ route('admin.stamps.destroy', $stamp) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Remover?')" class="text-red-600 ml-2">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $stamps->links() }}</div>
    </div>
</x-app-layout>
