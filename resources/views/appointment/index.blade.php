<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment') }}
        </h2>
    </x-slot>

    <x-section-content>
        <div class="flex justify-between items-center mb-4">
            <div>
                <Link modal href="{{ route('dashboard.appointment.create') }}" class="bg-black text-white px-4 py-2 rounded-md">Create New</Link>
            </div>
            <!-- Add a search bar or any other filters if needed -->
        </div>

        <div class="overflow-x-auto">
            <x-splade-table :for="$appointment">
{{--                <x-splade-cell images as="$appointment">--}}
{{--                    <img src="{{ asset('storage/' . $appointment->images) }}" alt="" class="w-20 h-auto">--}}
{{--                </x-splade-cell>--}}
                <x-splade-cell action as="$appointment">
                    <div class="flex items-center">
                        <Link modal href="{{ route('dashboard.appointment.edit', ['appointment' => $appointment->id]) }}" class="bg-black text-white px-4 py-2 rounded-md mr-2">Edit</Link>
                        <Link href="{{ route('dashboard.appointment.delete',['appointment'=>$appointment->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">Delete</Link>
                        <Link href="{{ route('dashboard.appointment.duplicate',['appointment'=>$appointment->id]) }}" class="bg-blue-600 text-white p-2 rounded-md ml-2">Duplicate</Link>


                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </x-section-content>
</x-dashboard-layout>
