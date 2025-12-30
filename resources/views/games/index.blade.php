<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar resultados de partidos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @foreach ($games as $game)
                <div class="bg-white p-6 shadow rounded mb-6">

                    <h3 class="text-lg font-bold mb-1">
                        {{ $game->homeTeam->name }}
                        <span class="text-gray-500">vs</span>
                        {{ $game->awayTeam->name }}
                    </h3>

                    <p class="text-sm text-gray-500 mb-4">
                        {{ \Carbon\Carbon::parse($game->game_date)->format('d/m/Y H:i') }}
                    </p>

                    <form method="POST" action="{{ url('/games/' . $game->id . '/result') }}">
                        @csrf

                        <div class="flex items-center gap-4">

                            <div>
                                <label class="block text-sm text-gray-600">Local</label>
                                <input type="number"
                                       name="home_score"
                                       value="{{ $game->home_score }}"
                                       class="border rounded p-2 w-20">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-600">Visitante</label>
                                <input type="number"
                                       name="away_score"
                                       value="{{ $game->away_score }}"
                                       class="border rounded p-2 w-20">
                            </div>

                            <div class="mt-5">
                                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Guardar resultado
                                </button>
                            </div>

                        </div>

                        @if ($game->status === 'finished')
                            <p class="text-green-700 text-sm mt-3">
                                Partido finalizado — puntos ya calculados
                            </p>
                        @endif

                    </form>

                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>