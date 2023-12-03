@canany(['warehouses-view', 'warehouses-edit', 'warehouses-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('warehouses.destroy',$warehouse->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('warehouses-view')
                    <a href="{{ route('warehouses.show',$warehouse->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('دکھائیں۔') }}
                    </a>
                @endcan
                @can('warehouses-edit')
                    <a href="{{ route('warehouses.edit',$warehouse->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('ترمیم') }}
                    </a>
                @endcan
                @can('warehouses-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('حذف کریں') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany