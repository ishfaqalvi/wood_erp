@canany(['purchasePayments-view', 'purchasePayments-edit', 'purchasePayments-approval', 'purchasePayments-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @can('purchasePayments-view')
                <a href="{{ route('purchase-payments.show',$purchasePayment->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('دکھائیں۔') }}
                </a>
            @endcan
            @if($purchasePayment->status =='Pending')
                @can('purchasePayments-edit')
                    <a href="{{ route('purchase-payments.edit',$purchasePayment->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('ترمیم') }}
                    </a>
                @endcan
                @can('purchasePayments-approval')
                    <form method="POST" action="{{ route('purchase-payments.approve', $purchasePayment->id) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <button type="submit" class="dropdown-item sa-approve">
                            <i class="ph-check-square me-2"></i>{{ __('منظور کرو') }}
                        </button>
                    </form>
                @endcan
            @endif
            @can('purchasePayments-delete')
                <form action="{{ route('purchase-payments.destroy',$purchasePayment->id) }}" method="POST">
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