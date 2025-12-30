<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tabla de posiciones
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded p-6">

                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-center">Posición</th>
                            <th class="px-4 py-2 text-center">Usuario</th>
                            <th class="px-4 py-2 text-center">Puntos</th>
                            <th class="px-4 py-2 text-center">Predicciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 text-center">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $user->total_points }}</td>
                                <td class="px-4 py-2 text-center">{{ $user->predictions->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>