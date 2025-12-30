<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Estás registrado!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="text-center py-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
            Quiniela del Mundial 2026
        </h1>
        <p class="mt-2 text-gray-600 dark:text-gray-300">
            ¡Haz tus predicciones, compite con amigos y sigue el torneo partido a partido!
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 max-w-4xl mx-auto mt-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Reglas de la Quiniela</h2>
            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-2">
                <li>🎯 Atinar al marcador exacto: <strong>3 puntos</strong></li>
                <li>✅ Atinar al equipo ganador: <strong>1 punto</strong></li>
                <li>🤝 Atinar al empate (sin marcador exacto): <strong>1 punto</strong></li>
                <li>❌ No atinar a nada: <strong>0 puntos</strong></li>
            </ul>
    </div>


</x-app-layout>
