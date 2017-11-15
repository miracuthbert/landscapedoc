@component('admin.services.partials._base_service', compact('service'))

    @slot('category')

        <div class="item-col item-col-category no-overflow">
            <div class="item-heading">Category</div>
            <div class="no-overflow">
                <a href="{{ route('admin.services.index', ['category' => $service->category]) }}">{{ $service->category->name }}</a>
            </div>
        </div>

    @endslot

@endcomponent