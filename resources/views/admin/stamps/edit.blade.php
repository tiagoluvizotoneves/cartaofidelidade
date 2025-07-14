<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Editar Carimbo</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form method="POST" action="{{ route('admin.stamps.update', $stamp) }}">
            @csrf @method('PUT')

            <div class="mb-4">
                <label>Usuário</label>
                <select name="user_id" class="w-full border rounded p-2" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @selected($user->id == $stamp->user_id)>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Cartão</label>
                <select name="card_id" class="w-full border rounded p-2" required>
                    @foreach($cards as $card)
                        <option value="{{ $card->id }}" @selected($card->id == $stamp->card_id)>
                            {{ $card->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Data do carimbo</label>
                <input type="datetime-local" name="stamped_at"
                    value="{{ $stamp->stamped_at ? \Carbon\Carbon::parse($stamp->stamped_at)->format('Y-m-d\TH:i') : '' }}"
                    class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label><input type="checkbox" name="used" value="1" @checked($stamp->used)> Já foi usado?</label>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Atualizar</button>
        </form>
    </div>
</x-app-layout>
