<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Editar Empresa</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form method="POST" action="{{ route('admin.companies.update', $company) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Nome</label>
                <input type="text" name="name" value="{{ old('name', $company->name) }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block">Email</label>
                <input type="email" name="email" value="{{ old('email', $company->email) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block">Telefone</label>
                <input type="text" name="phone" value="{{ old('phone', $company->phone) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block">Documento</label>
                <input type="text" name="document" value="{{ old('document', $company->document) }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" {{ $company->is_active ? 'checked' : '' }}>
                    <span class="ml-2">Empresa ativa</span>
                </label>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Atualizar</button>
        </form>
    </div>
</x-app-layout>
