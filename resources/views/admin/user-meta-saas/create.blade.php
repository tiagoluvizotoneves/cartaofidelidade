<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Novo Plano</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form action="{{ route('admin.user-meta-saas.store') }}" method="POST">
            @include('admin.user-meta-saas.form', ['meta' => new \App\Models\UserMetaSaas()])
        </form>
    </div>
</x-app-layout>
