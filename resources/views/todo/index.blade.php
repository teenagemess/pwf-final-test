<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('todo.create') }}" />
                        </div>
                        <div>
                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                                </p>
                            @endif
                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Description</th>
                                <th scope="col" class="px-6 py-3">Image</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $todo)
                                <tr class="bg-white dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <a href="{{ route('todo.edit', $todo) }}" class="hover:underline">{{ $todo->title }}</a>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        @if ($todo->category_id)
                                            {{ $todo->category->title }}
                                        @endif
                                    </td>
                                    <td class="py-4 text-gray-900 px-9 dark:text-white ">
                                        <div class="max-w-xs overflow-hidden">
                                            <div class="text-white">
                                                <p class="dark:text-white">
                                                    {!! $todo->description !!}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($todo->image_path)
                                            <img src="{{ $todo->getImage() }}" alt="{{ $todo->title }}" class="w-16 h-16 rounded">
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="space-x-3">
                                            @if (!$todo->is_complete)
                                                <form action="{{ route('todo.complete', $todo) }}" method="Post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-600 dark:text-green-400">Complete</button>
                                                </form>
                                            @else
                                                <form action="{{ route('todo.uncomplete', $todo) }}" method="Post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-blue-600 dark:text-blue-400">Uncomplete</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('todo.destroy', $todo) }}" method="Post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400">Delete</button>
                                            </form>
                                            </form>
                                            <form action="{{ route('todo.show', $todo) }}" method="Get">
                                                @csrf
                                                <button type="submit" class="text-blue-600 dark:text-blue-400">Show</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td colspan="5" class="px-6 py-4 font-medium text-gray-900 dark:text-white">Empty</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($todosCompleted > 1)
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('todo.deleteallcompleted') }}" method="Post">
                            @csrf
                            @method('delete')
                            <x-primary-button>Delete All Completed Tasks</x-primary-button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
