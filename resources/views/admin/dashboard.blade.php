<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Dashboard Administrativo</h2>
    </x-slot>

    <div class="py-6 px-4 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <div class="bg-white p-4 shadow rounded">Empresas: <strong>{{ $companiesCount }}</strong></div>
        <div class="bg-white p-4 shadow rounded">Cartões: <strong>{{ $cardsCount }}</strong></div>
        <div class="bg-white p-4 shadow rounded">Carimbos: <strong>{{ $stampsCount }}</strong></div>
        <div class="bg-white p-4 shadow rounded">Recompensas: <strong>{{ $rewardsCount }}</strong></div>
        <div class="bg-white p-4 shadow rounded">Usuários: <strong>{{ $usersCount }}</strong></div>
    </div>
</x-app-layout>
