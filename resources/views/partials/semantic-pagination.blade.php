@if ($paginator->hasPages())
    <div class="ui buttons">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="ui button disabled"><span>上一页</span></button>
        @else
            <button class="ui button"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">上一页</a></button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <button class="ui button disabled"><span>{{ $element }}</span></button>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="ui button active"><span>{{ $page }}</span></button>
                    @else
                        <button class="ui button"><a href="{{ $url }}">{{ $page }}</a></button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button class="ui button"><a href="{{ $paginator->nextPageUrl() }}" rel="next">下一页</a></button>
        @else
            <button class="ui button disabled"><span>下一页</span></button>
        @endif
    </div>
@endif
