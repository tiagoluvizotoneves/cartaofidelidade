<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Recompensas</h2>
    </x-slot>

    <div class="py-4 px-6">
        <a href="{{ route('admin.rewards.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Nova Recompensa</a>

        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Usuário</th>
                    <th class="px-4 py-2">Cartão</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Resgatado em</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rewards as $reward)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $reward->user->name }}</td>
                        <td class="px-4 py-2">{{ $reward->card->title }}</td>
                        <td class="px-4 py-2">{{ $reward->status }}</td>
                        <td class="px-4 py-2">{{ $reward->redeemed_at?->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.rewards.edit', $reward) }}" class="text-blue-600">Editar</a>
                            <form action="{{ route('admin.rewards.destroy', $reward) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Confirma?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
