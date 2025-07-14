@csrf

<div class="mb-4">
    <label class="block">Usuário</label>
    <select name="user_id" class="w-full border rounded p-2" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}" @selected(old('user_id', $meta->user_id ?? '') == $user->id)>{{ $user->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label class="block">Plano</label>
    <input type="text" name="plan" class="w-full border rounded p-2" value="{{ old('plan', $meta->plan ?? '') }}" required>
</div>

<div class="mb-4">
    <label class="block">Está ativo?</label>
    <select name="is_active" class="w-full border rounded p-2">
        <option value="1" @selected(old('is_active', $meta->is_active ?? true) == 1)>Sim</option>
        <option value="0" @selected(old('is_active', $meta->is_active ?? true) == 0)>Não</option>
    </select>
</div>

<div class="mb-4">
    <label class="block">Data de Assinatura</label>
    <input type="datetime-local" name="subscribed_at" class="w-full border rounded p-2"
           value="{{ old('subscribed_at', optional($meta->subscribed_at)->format('Y-m-d\TH:i')) }}">
</div>

<div class="mb-4">
    <label class="block">Expira em</label>
    <input type="datetime-local" name="expires_at" class="w-full border rounded p-2"
           value="{{ old('expires_at', optional($meta->expires_at)->format('Y-m-d\TH:i')) }}">
</div>

<button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Salvar</button>
