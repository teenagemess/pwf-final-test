<!-- resources/views/Home.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-52">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3">
                @foreach ($todos as $todo)
                    <div class="overflow-hidden transition-transform duration-300 transform bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg hover:scale-105">
                        <a href="{{ route('todo.show', $todo) }}" class="block">
                            @if ($todo->image_path)
                                <img src="{{ $todo->getImage() }}" alt="{{ $todo->title }}" class="w-full h-32 rounded">
                            @endif
                            <div class="p-2 text-gray-900 dark:text-gray-100">
                                <h3 class="mb-2 text-base font-semibold">{{ $todo->title }}</h3>
                                <div class="text-white">
                                    <p class="dark:text-white">
                                        {!! $todo->description !!}
                                    </p>
                                </div>

                                @if ($todo->category)
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Category: {{ $todo->category->title }}</p>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
