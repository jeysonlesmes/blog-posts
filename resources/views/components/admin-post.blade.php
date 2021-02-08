<div class="bg-white w-full flex items-center p-2 rounded-xl shadow border my-2">
    <div class="flex items-center space-x-4">
        <img src="{{ auth()->user()->image }}" alt="My profile" class="w-16 h-16 rounded-full" style="min-width: 4rem;">
    </div>
    <div class="flex-grow p-3">
        <div class="font-semibold text-gray-700">
            {{ $post->title }}
        </div>
        <div class="text-sm text-gray-500">
            {{ $post->description }}
        </div>
        <div class="text-sm text-gray-300">
            {{ $post->publicated_at }}
        </div>
    </div>
</div>