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


<style>
    .ownpaginator {
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        box-shadow: 0px 0px 1px #888;
        margin-bottom: 10px;
        margin-top: -4px;
    }
    .btn-circle {
        width: 36px;
        height: 36px;
        padding: 9px 0px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 18px;
        margin-left: 10px;
    }
    .btn-circle:hover{
        opacity: 1;
        text-decoration: none;
    }
    .btn-circle.active{
        color: #fff;
        background-image: linear-gradient(to right, #74D4D8 , #55B3E0);
    }
    .dot-pagination{
        padding-top: 8px;
        margin-left: 10px;
    }
</style>
