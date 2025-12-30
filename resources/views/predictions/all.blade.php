<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Todos los Pronósticos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @forelse ($games as $game)
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">

                    <h3 class="text-lg font-bold mb-2">
                        {{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}
                    </h3>

                    <p class="text-sm text-gray-600 mb-4">
                        Resultado final:
                        <strong>{{ $game->home_score }} - {{ $game->away_score }}</strong>
                    </p>

                    @php
                        $gamePredictions = $predictions[$game->id] ?? collect();
                    @endphp

                    @if ($gamePredictions->isEmpty())
                        <p class="text-gray-500 italic">Nadie hizo pronóstico para este partido.</p>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b">
                                    <th class="px-4 py-2 text-center">Usuario</th>
                                    <th class="px-4 py-2 text-center">Predicción</th>
                                    <th class="px-4 py-2 text-center">Puntos</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($users as $user)
                                        @php
                                            // Buscar si este usuario hizo predicción para este partido
                                            $prediction = $gamePredictions->firstWhere('user_id', $user->id);
                                        @endphp

                                        <tr class="border-b">
                                            <td class="px-4 py-2 text-center">{{ $user->name }}</td>

                                            <td class="px-4 py-2 text-center">
                                                @if ($prediction)
                                                    {{ $prediction->predicted_home_score }} - {{ $prediction->predicted_away_score }}
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="px-4 py-2 text-center">
                                                {{ $prediction->points ?? 0 }}
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>

                        </table>
                    @endif

                </div>
            @empty
                <p class="text-gray-500 italic">No hay partidos finalizados aún.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>