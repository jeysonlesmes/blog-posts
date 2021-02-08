<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('posts.index.title') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route("posts.store") }}">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="min-h-screen bg-gray-100 py-6 flex flex-col sm:py-12">
                    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                        <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                            <div class="max-w-md mx-auto">
                                <div class="flex items-center space-x-5">
                                    <div class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">i</div>
                                    <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                                        <h2 class="leading-relaxed">{{ __("posts.create.title") }}</h2>
                                        <p class="text-sm text-gray-500 font-normal leading-relaxed">{{ __("posts.create.subtitle") }}</p>
                                    </div>
                                </div>
                                <div class="divide-y divide-gray-200">
                                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                        <div class="flex flex-col">
                                            <label class="leading-loose">{{ __("posts.create.fields.title.label") }}</label>
                                            <input type="text" name="title" autocomplete="off" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="{{ __("posts.create.fields.title.placeholder") }}" value="{{ old('title') }}">
                                            @if($errors->has("title"))<p class="text-red-400 text-xs italic">{{ $errors->first("title") }}</p>@endif
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="leading-loose">{{ __("posts.create.fields.description.label") }}</label>
                                            <textarea name="description" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="{{ __("posts.create.fields.description.placeholder") }}">{{ old('description') }}</textarea>
                                            @if($errors->has("description"))<p class="text-red-400 text-xs italic">{{ $errors->first("description") }}</p>@endif
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <div class="flex flex-col">
                                                <label class="leading-loose">{{ __("posts.create.fields.publicationDate.label") }}</label>
                                                <div class="relative focus-within:text-gray-600 text-gray-400">
                                                    <input type="datetime-local" name="publication_date" class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="{{ __("posts.create.fields.publicationDate.placeholder") }}" value="{{ old('publication_date') }}">
                                                    <div class="absolute left-3 top-2">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                    @if($errors->has("publication_date"))<p class="text-red-400 text-xs italic">{{ $errors->first("publication_date") }}</p>@endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-4 flex items-center space-x-4">
                                        <a href="{{ route('posts.index') }}" class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            {{ __("posts.create.cancel") }}
                                        </a>
                                        <button class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">{{ __("posts.create.save") }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
