<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Editar Recompensa</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form action="{{ route('admin.rewards.update', $reward) }}" method="POST">
            @method('PUT')
            @include('admin.rewards.form')
        </form>
    </div>
</x-app-layout>
