<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Empresas</h2>
    </x-slot>

    <div class="py-4 px-6">
        <a href="{{ route('admin.companies.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
            + Nova Empresa
        </a>

        <table class="w-full text-left border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Nome</th>
                    <th class="p-2">Slug</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Ativa</th>
                    <th class="p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($companies as $company)
                    <tr class="border-t">
                        <td class="p-2">{{ $company->name }}</td>
                        <td class="p-2">{{ $company->slug }}</td>
                        <td class="p-2">{{ $company->email }}</td>
                        <td class="p-2">
                            @if ($company->is_active)
                                <span class="text-green-600 font-bold">Sim</span>
                            @else
                                <span class="text-red-600 font-bold">Não</span>
                            @endif
                        </td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('admin.companies.edit', $company) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta empresa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Remover</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="p-2" colspan="5">Nenhuma empresa cadastrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
