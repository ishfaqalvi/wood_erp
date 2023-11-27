@canany(['productionPayments-view', 'productionPayments-edit', 'productionPayments-approval', 'productionPayments-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @can('productionPayments-view')
                <a href="{{ route('production-payments.show',$productionPayment->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('دکھائیں۔') }}
                </a>
            @endcan
            @if($productionPayment->status =='Pending')
                @can('productionPayments-edit')
                    <a href="{{ route('production-payments.edit',$productionPayment->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('ترمیم') }}
                    </a>
                @endcan
                @can('productionPayments-approval')
                    <form method="POST" action="{{ route('production-payments.approve', $productionPayment->id) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <button type="submit" class="dropdown-item sa-approve">
                            <i class="ph-check-square me-2"></i>{{ __('منظور کرو') }}
                        </button>
                    </form>
                @endcan
            @endif
            @can('productionPayments-delete')
                <form action="{{ route('production-payments.destroy',$productionPayment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('حذف کریں') }}
                    </button>
                </form>
            @endcan
        </div>
    </div>
</div>
@endcanany