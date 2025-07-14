<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Nova Recompensa</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form action="{{ route('admin.rewards.store') }}" method="POST">
            @include('admin.rewards.form', ['reward' => new \App\Models\Reward()])
        </form>
    </div>
</x-app-layout>
