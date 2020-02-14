@if ($paginator->hasPages())
    <nav>
        <div class="d-flex justify-content-between p-2 bg-white ownpaginator">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="btn ownbtn disabled" href="#">&lt Prev</a>
            @else
                <a class="btn ownbtn" href="{{ $paginator->previousPageUrl() }}">&lt Prev</a>
            @endif

            <div class="d-flex">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <div class="dot-pagination">•••</div>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a class="btn-circle active" href="{{ $url }}">{{ $page }}</a>
                            @else
                                <a class="btn-circle" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="btn ownbtn" href="{{ $paginator->nextPageUrl() }}">Next &gt</a>
            @else
                <a class="btn ownbtn disabled" href="#">Next &gt</a>
            @endif
        </div>
    </nav>
@endif


