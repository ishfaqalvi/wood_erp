@canany(['transactions-view', 'transactions-edit', 'transactions-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('transactions.destroy',$row->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('transactions-view')
                    <a href="{{ route('transactions.show',$row->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('دکھائیں۔') }}
                    </a>
                @endcan
                @can('transactions-edit')
                    <a href="{{ route('transactions.edit',$row->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('ترمیم') }}
                    </a>
                @endcan
                @can('transactions-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('حذف کریں') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany