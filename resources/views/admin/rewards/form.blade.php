@csrf

<div class="mb-4">
    <label class="block">Cartão</label>
    <select name="card_id" class="w-full border rounded p-2" required>
        @foreach($cards as $card)
            <option value="{{ $card->id }}" @selected(old('card_id', $reward->card_id ?? '') == $card->id)>{{ $card->title }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label class="block">Usuário</label>
    <select name="user_id" class="w-full border rounded p-2" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}" @selected(old('user_id', $reward->user_id ?? '') == $user->id)>{{ $user->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label class="block">Status</label>
    <select name="status" class="w-full border rounded p-2">
        <option value="pending" @selected(old('status', $reward->status ?? '') == 'pending')>Pendente</option>
        <option value="redeemed" @selected(old('status', $reward->status ?? '') == 'redeemed')>Resgatado</option>
        <option value="expired" @selected(old('status', $reward->status ?? '') == 'expired')>Expirado</option>
    </select>
</div>

<div class="mb-4">
    <label class="block">Data de Resgate</label>
    <input type="datetime-local" name="redeemed_at" class="w-full border rounded p-2" value="{{ old('redeemed_at', optional($reward->redeemed_at)->format('Y-m-d\TH:i')) }}">
</div>

<button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Salvar</button>
