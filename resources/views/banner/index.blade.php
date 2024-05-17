{{--<x-dashboard-layout>--}}
{{--    <x-section-content>--}}
{{--        <Link modal href="{{route('dashboard.banner.create')}}" class="bg-black text-white p-1 rounded-md">Create New</Link>--}}

{{--        <div class="flex ">--}}
{{--            <x-splade-table :for="$banner">--}}
{{--                <x-splade-cell image as="$images">--}}
{{--                    <img src="{{asset('storage/'.$images->image)}}" alt="" style="width: 100px;">--}}
{{--                </x-splade-cell>--}}
{{--                <x-splade-cell action as="$banner">--}}
{{--                    <Link modal href="{{ route('dashboard.banner.edit',['banner'=>$banner->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>--}}
{{--                    <Link href="{{ route('dashboard.banner.delete',['banner'=>$banner->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">Delete</Link>--}}
{{--                    <Link href="{{ route('dashboard.banner.duplicate',['banner'=>$banner->id]) }}" class="bg-blue-600 text-white p-2 rounded-md ml-2">Duplicate</Link>--}}
{{--                </x-splade-cell>--}}


{{--            </x-splade-table>--}}

{{--        </div>--}}
{{--    </x-section-content>--}}

{{--</x-dashboard-layout>--}}

<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Banners') }}
        </h2>
    </x-slot>

    <x-section-content>
        <div class="flex justify-between items-center mb-4">
            <div>
                <Link modal href="{{ route('dashboard.banner.create') }}" class="bg-black text-white px-4 py-2 rounded-md">Create New</Link>
            </div>
            <!-- Add a search bar or any other filters if needed -->
        </div>

        <div class="overflow-x-auto">
            <x-splade-table :for="$banner">
                <x-splade-cell image as="$banner">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="" class="w-20 h-auto">
                </x-splade-cell>
                <x-splade-cell action as="$banner">
                    <div class="flex items-center">
                        <Link modal href="{{ route('dashboard.banner.edit', ['banner' => $banner->id]) }}" class="bg-black text-white px-4 py-2 rounded-md mr-2">Edit</Link>
                        <Link href="{{ route('dashboard.banner.delete',['banner'=>$banner->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">Delete</Link>
                        <Link href="{{ route('dashboard.banner.duplicate',['banner'=>$banner->id]) }}" class="bg-blue-600 text-white p-2 rounded-md ml-2">Duplicate</Link>


                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </x-section-content>
</x-dashboard-layout>
