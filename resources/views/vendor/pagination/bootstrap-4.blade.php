@if ($paginator->hasPages())
    <nav style="display: inline-block;">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="pagination-link px-4 py-2 fw-bold mx-3 fs-5" aria-hidden="true"><i class="fa-solid fa-chevron-left"></i></span>
                </li>
            @else
                <li class="">
                    <a class="pagination-link px-4 py-2 fw-bold mx-3 fs-5" href="{{ $paginator->appends(request()->query())->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa-solid fa-chevron-left"></i></a>
                </li>
            @endif

            @php( $limitedWidth = 4 )

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item" aria-disabled="true">
                        <span class="pagination-link px-4 py-2 fw-bold mx-3 fs-5">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item" aria-current="page">
                                <span class="pagination-link px-4 py-2 fw-bold mx-3 fs-5 active">{{ $page }}</span>
                            </li>
                        @elseif($page < $paginator->currentPage() + $limitedWidth)
                            <li class="pagination-item">
                                <a class="pagination-link px-4 py-2 fw-bold mx-3 fs-5" href="{{ $paginator->appends(request()->query())->url($page) }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a class="pagination-link px-4 py-2 fw-bold mx-3 fs-5" href="{{ $paginator->appends(request()->query())->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="fa-solid fa-chevron-right"></i></a>
                </li>
            @else
                <li class="pagination-item" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="pagination-link px-4 py-2 fw-bold mx-3 fs-5" aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif

