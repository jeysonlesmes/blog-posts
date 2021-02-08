<div class="bg-white border shadow-sm px-4 py-3 rounded-lg mb-4">
    <div class="flex items-center">
        <img class="h-12 w-12 rounded-full" src="{{ $post->user->image }}"/>
        <div class="ml-2">
            <div class="text-sm">
                <span class="font-semibold">{{ auth()->check() && $post->user_id == auth()->user()->id ? 'You' : $post->user->name }}</span>
            </div>
            <div class="text-gray-500 text-xs">
                {{ $post->publicated_at }}
            </div>
        </div>
    </div>
    <b class="flex mt-3">{{ $post->title }}</b>
    <p class="text-gray-800 text-sm mt-2 leading-normal md:leading-relaxed">{{ $post->description }}</p>
</div>