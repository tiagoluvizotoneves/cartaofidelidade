@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Cartão</h1>

    <form action="{{ route('admin.cards.update', $card) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Empresa</label>
            <select name="company_id" class="w-full border-gray-300 rounded">
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ $company->id == $card->company_id ? 'selected' : '' }}>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Título</label>
            <input type="text" name="title" class="w-full border-gray-300 rounded" value="{{ $card->title }}" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Descrição</label>
            <textarea name="description" rows="3" class="w-full border-gray-300 rounded">{{ $card->description }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">Total de Selos</label>
            <input type="number" name="total_stamps" class="w-full border-gray-300 rounded" value="{{ $card->total_stamps }}" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Recompensa</label>
            <input type="text" name="reward_description" class="w-full border-gray-300 rounded" value="{{ $card->reward_description }}" required>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" {{ $card->is_active ? 'checked' : '' }}>
            <label>Ativo</label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Atualizar</button>
    </form>
</div>
@endsection
