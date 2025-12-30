<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Mis Predicciones') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">

                <h3 class="text-lg font-bold mb-4">Partidos disponibles</h3>

                @foreach ($games as $game)

                    @php
                        // Obtener la predicción del usuario para este partido
                        $prediction = $game->predictions
                            ->where('user_id', auth()->id())
                            ->first();

                        // Determinar si el partido ya inició
                        $hasStarted = now()->greaterThanOrEqualTo($game->game_date);
                    @endphp

                    <div class="mb-6 border-b border-gray-700 pb-4">

                        <p class="font-semibold">
                            {{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}
                        </p>

                        <p class="text-sm text-gray-400">
                            {{ \Carbon\Carbon::parse($game->game_date)->format('d/m/Y H:i') }}
                        </p>

                        {{-- Si el partido NO ha iniciado y NO está finalizado --}}
                        @if (!$hasStarted && $game->status === 'pending')

                            <form method="POST" action="{{ route('predictions.store', $game->id) }}">
                                @csrf

                                <div class="flex items-center gap-4 mt-3">

                                    <input type="number"
                                           name="predicted_home_score"
                                           value="{{ $prediction->predicted_home_score ?? '' }}"
                                           class="border p-2 w-20"
                                           style="color: black !important; background-color: white !important;"
                                           placeholder="Local">

                                    <span>-</span>

                                    <input type="number"
                                           name="predicted_away_score"
                                           value="{{ $prediction->predicted_away_score ?? '' }}"
                                           class="border p-2 w-20"
                                           style="color: black !important; background-color: white !important;"
                                           placeholder="Visitante">
                                </div>

                                <button class="mt-3 bg-blue-600 px-4 py-2 rounded text-white">
                                    Guardar
                                </button>
                            </form>

                        {{-- Si el partido YA inició o YA terminó --}}
                        @else

                            <div class="flex items-center gap-4 mt-3">

                                <input type="number"
                                       value="{{ $prediction->predicted_home_score ?? '' }}"
                                       class="border p-2 w-20"
                                       style="color: black !important; background-color: #e5e7eb !important;"
                                       disabled>

                                <span>-</span>

                                <input type="number"
                                       value="{{ $prediction->predicted_away_score ?? '' }}"
                                       class="border p-2 w-20"
                                       style="color: black !important; background-color: #e5e7eb !important;"
                                       disabled>
                            </div>

                            <p class="text-yellow-400 text-sm mt-2">
                                Este partido ya inició o está finalizado. No puedes modificar tu predicción.
                            </p>

                        @endif

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>