<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Measured Units</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 border-b">Title</th>
                    <th class="py-3 px-4 border-b">Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($measuredUnits as $unit)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4 border-b">{{ $unit->title }}</td>
                        <td class="py-3 px-4 border-b">{{ $unit->unit }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

