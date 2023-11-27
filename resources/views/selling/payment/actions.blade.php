@canany(['salePayments-view', 'salePayments-edit', 'salePayments-approval', 'salePayments-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @can('salePayments-view')
                <a href="{{ route('sale-payments.show',$salePayment->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('دکھائیں۔') }}
                </a>
            @endcan
            @if($salePayment->status =='Pending')
                @can('salePayments-edit')
                    <a href="{{ route('sale-payments.edit',$salePayment->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('ترمیم') }}
                    </a>
                @endcan
                @can('salePayments-approval')
                    <form method="POST" action="{{ route('sale-payments.approve', $salePayment->id) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <button type="submit" class="dropdown-item sa-approve">
                            <i class="ph-check-square me-2"></i>{{ __('منظور کرو') }}
                        </button>
                    </form>
                @endcan
            @endif
            @can('salePayments-delete')
                <form action="{{ route('sale-payments.destroy',$salePayment->id) }}" method="POST">
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