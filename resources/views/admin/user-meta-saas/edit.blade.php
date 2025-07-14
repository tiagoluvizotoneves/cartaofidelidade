<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Editar Plano</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form method="POST" action="{{ route('admin.user-meta-saas.update', ['userMetaSaas' => $userMetaSaas->id]) }}">
            @csrf
            @method('PUT')
            @include('admin.user-meta-saas.form', ['meta' => $userMetaSaas])
        </form>
    </div>
</x-app-layout>
