<div class="py-12">        
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-2">
        @if($message = Session::get('success'))
        <div class="bg-green-200 px-6 py-4 my-4 rounded-md text-lg flex items-center">
            <svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path>
            </svg>
            <span class="text-green-800">{{ $message }}</span>
        </div>
        @endif
        
        <div class="flow-root mb-4">
            @auth
            <a href="{{ route('posts.create') }}" class="inline-flex items-center h-10 px-5 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                <span>{{ __('posts.index.buttonAdd') }}</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </a>
            @endif

            <div class="relative inline-flex float-right">
                <select id="sort" class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                    <option value="" disabled>Sort by</option>
                    <option value="newest" @if($sortBy == "desc") selected @endif>Newest</option>
                    <option value="oldest" @if($sortBy == "asc") selected @endif>Oldest</option>
                </select>
            </div>
        </div>

        <div class="overflow-hidden sm:rounded-lg">
            <div class="mx-auto">
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                        @include("components.$postView", ["post" => $post])
                    @endforeach

                    {{ $posts->links() }}
                @else
                    <p>{{ __('posts.index.empty') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $("select#sort").change(function () {
        const value = $(this).val()
        
        if (value != "") {
            let page = {{ $posts->currentPage() }};
            let params = page > 1 ? `?page=${page}` : ''

            if (value == "oldest") {
                params = (params == '' ? '?' : `${params}&`) + `sort=${value}`
            }

            window.location.href = `{{ route(\Request::route()->getName()) }}${params}`
        }
    })
</script>