@if ($paginator->hasPages())
<nav aria-label="Page navigation">
    <div class="pagination-wrapper">
        <ul class="custom-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <span>
                        <i class="fas fa-chevron-left me-1"></i> Prev
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                        <i class="fas fa-chevron-left me-1"></i> Prev
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
                $start = max($current - 2, 1);
                $end = min($current + 2, $last);
                
                // Adjust for beginning
                if($start > 1) {
                    $start = max($current - 1, 1);
                    $end = min($current + 1, $last);
                }
                
                // Adjust for end
                if($end < $last) {
                    $start = max($current - 1, 1);
                    $end = min($current + 1, $last);
                }
            @endphp

            {{-- First Page --}}
            @if ($start > 1)
                <li>
                    <a href="{{ $paginator->url(1) }}">1</a>
                </li>
                @if ($start > 2)
                    <li class="disabled"><span>...</span></li>
                @endif
            @endif

            {{-- Middle Pages --}}
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <li class="active" aria-current="page">
                        <span>{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->url($page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endfor

            {{-- Last Page --}}
            @if ($end < $last)
                @if ($end < $last - 1)
                    <li class="disabled"><span>...</span></li>
                @endif
                <li>
                    <a href="{{ $paginator->url($last) }}">{{ $last }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                        Next <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <span>
                        Next <i class="fas fa-chevron-right ms-1"></i>
                    </span>
                </li>
            @endif
        </ul>
    </div>
</nav>
@endif