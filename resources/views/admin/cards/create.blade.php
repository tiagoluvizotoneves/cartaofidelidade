@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Novo Cartão</h1>

    <form action="{{ route('admin.cards.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Empresa</label>
            <select name="company_id" class="w-full border-gray-300 rounded">
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Título</label>
            <input type="text" name="title" class="w-full border-gray-300 rounded" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Descrição</label>
            <textarea name="description" rows="3" class="w-full border-gray-300 rounded"></textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">Total de Selos</label>
            <input type="number" name="total_stamps" class="w-full border-gray-300 rounded" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Recompensa</label>
            <input type="text" name="reward_description" class="w-full border-gray-300 rounded" required>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" checked>
            <label>Ativo</label>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Salvar</button>
    </form>
</div>
@endsection
