@if ($paginator->hasPages())
    <div class="shop__last__option">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="shop__pagination">
                    {{-- Previous Page Link --}}
                    @if (!$paginator->onFirstPage())
                        <a href="{{ $paginator->previousPageUrl() }}"><span class="arrow_carrot-left"></span></a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- Array of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <a class="active" href="{{ $url }}">{{ $page }}</a>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"><span class="arrow_carrot-right"></span></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="shop__last__text">
                    <p>Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }} results</p>
                </div>
            </div>
        </div>
    </div>
@endif