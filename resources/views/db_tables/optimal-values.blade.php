<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Optimal Values</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">ID Category</th>
                    <th class="py-3 px-4 border-b">ID Measured Unit</th>
                    <th class="py-3 px-4 border-b">Optimal Range</th>
                </tr>
            </thead>
            <tbody>
                @foreach($optimalValues as $value)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ trim($value->id_category) }}</td>
                        <td class="py-3 px-4 border-b">{{ $value->id_measured_unit }}</td>
                        <td class="py-3 px-4 border-b">{{ $value->optimal_range }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
