@canany(['invoices-view', 'invoices-edit', 'invoices-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @can('invoices-view')
                <a href="{{ route('invoices.show',$invoice->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('دکھائیں۔') }}
                </a>
            @endcan
            @can('invoices-edit')
                <a href="{{ route('invoices.edit',$invoice->id) }}" class="dropdown-item">
                    <i class="ph-note-pencil me-2"></i>{{ __('ترمیم') }}
                </a>
            @endcan
            @if($invoice->status !='Posted')
                @can('invoices-publish')
                    @if(count($invoice->purchaseItems)>0 || count($invoice->saleItems)>0)
                    <form method="POST" action="{{ route('invoices.publish', $invoice->id) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <button type="submit" class="dropdown-item sa-post">
                            <i class="ph-fast-forward-circle me-2"></i>{{ __('پوسٹ') }}
                        </button>
                    </form>
                    @endif
                @endcan
            @endif
            @can('invoices-delete')
                <form action="{{ route('invoices.destroy',$invoice->id) }}" method="POST">
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