<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Todo Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col items-center justify-center p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-lg">
                        <div class="container content-center w-16 h-6 p-0 mb-2 text-center bg-current rounded">
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $todo->category->title }}</p>
                        </div>
                        <h1 class="text-xl font-semibold">{{ $todo->title }}</h1>
                        @if ($todo->image_path)
                            <img src="{{ $todo->getImage() }}" alt="{{ $todo->title }}" class="my-4 rounded" style="max-width: 500px;">
                        @endif
                        <div class="text-white">
                            <p class="dark:text-white">
                                {!! $todo->description !!}
                            </p>
                        </div>
                        <div class="flex mt-6 space-x-3">
                            <a href="{{ route('todo.edit', $todo) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                            <button type="button" class="text-red-600 dark:text-red-400 hover:underline" onclick="confirmDelete()">Delete</button>
                            <form id="delete-form" action="{{ route('todo.destroy', $todo) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        })
    }
</script>
