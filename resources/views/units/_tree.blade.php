@foreach ($nodes as $node)
    @php $hasChildren = $node->children->isNotEmpty(); @endphp

    @if ($hasChildren)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed py-2" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#unit-{{ $node->id }}">
                    {{ $node->name }}
                </button>
            </h2>
            <div id="unit-{{ $node->id }}" class="accordion-collapse collapse">
                <div class="accordion-body py-2 ps-4">
                    <div class="accordion accordion-flush">
                        @include('units._tree', ['nodes' => $node->children])
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="accordion-item">
            <div class="px-3 py-2">{{ $node->name }}</div>
        </div>
    @endif
@endforeach
