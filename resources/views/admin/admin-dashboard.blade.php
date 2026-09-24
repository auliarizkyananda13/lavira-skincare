<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl" style="color: #2f5cb8;">
            {{ __('Admin Dashboard') }}
        </h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border" style="border-color: #dbeafe;">
                <div class="p-6 text-gray-900" style="border-top: 4px solid #3b6fd6;">
                    {{ __("Halo MIN, selamat datang!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>