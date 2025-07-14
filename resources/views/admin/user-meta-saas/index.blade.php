<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Planos dos Usuários</h2>
    </x-slot>

    <div class="py-4 px-6">
        <a href="{{ route('admin.user-meta-saas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Novo Plano</a>

        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Usuário</th>
                    <th class="px-4 py-2">Plano</th>
                    <th class="px-4 py-2">Ativo?</th>
                    <th class="px-4 py-2">Assinou em</th>
                    <th class="px-4 py-2">Expira em</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($metas as $meta)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $meta->user->name }}</td>
                        <td class="px-4 py-2">{{ $meta->plan }}</td>
                        <td class="px-4 py-2">{{ $meta->is_active ? 'Sim' : 'Não' }}</td>
                        <td class="px-4 py-2">{{ $meta->subscribed_at?->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ $meta->expires_at?->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.user-meta-saas.edit', $meta) }}" class="text-blue-600">Editar</a>
                            <form action="{{ route('admin.user-meta-saas.destroy', $meta) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Confirma?')">
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
