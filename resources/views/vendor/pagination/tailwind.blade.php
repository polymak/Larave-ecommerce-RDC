<div class="flex justify-between mt-4">
    @if ($paginator->onFirstPage())
        <span class="text-gray-500">Previous</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="text-blue-500 hover:underline">Previous</a>
    @endif

    <span class="text-sm text-gray-700">
        Page {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}
    </span>

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="text-blue-500 hover:underline">Next</a>
    @else
        <span class="text-gray-500">Next</span>
    @endif
</div>
