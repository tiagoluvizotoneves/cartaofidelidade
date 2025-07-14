<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Novo Carimbo</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form method="POST" action="{{ route('admin.stamps.store') }}">
            @csrf

            <div class="mb-4">
                <label>Usuário</label>
                <select name="user_id" class="w-full border rounded p-2" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Cartão</label>
                <select name="card_id" class="w-full border rounded p-2" required>
                    @foreach($cards as $card)
                        <option value="{{ $card->id }}">{{ $card->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Data do carimbo</label>
                <input type="datetime-local" name="stamped_at" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label><input type="checkbox" name="used" value="1"> Já foi usado?</label>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Salvar</button>
        </form>
    </div>
</x-app-layout>
