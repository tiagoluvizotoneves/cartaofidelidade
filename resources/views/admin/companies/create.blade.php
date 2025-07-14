<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Nova Empresa</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form method="POST" action="{{ route('admin.companies.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block">Nome</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block">Telefone</label>
                <input type="text" name="phone" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block">Documento (CNPJ/CPF)</label>
                <input type="text" name="document" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" class="form-checkbox" checked>
                    <span class="ml-2">Empresa ativa</span>
                </label>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Salvar Empresa
            </button>
        </form>
    </div>
</x-app-layout>
