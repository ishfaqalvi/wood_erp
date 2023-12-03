@canany(['receiveOrders-view', 'receiveOrders-edit', 'receiveOrders-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @can('receiveOrders-view')
                <a href="{{ route('receive-orders.show',$receiveOrder->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('دکھائیں۔') }}
                </a>
            @endcan
            @if($receiveOrder->status !='Posted')
                @can('receiveOrders-edit')
                    <a href="{{ route('receive-orders.edit',$receiveOrder->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('ترمیم') }}
                    </a>
                @endcan
                @can('receiveOrders-post')
                    @if(count($receiveOrder->items)>0)
                    <form method="POST" action="{{ route('receive-orders.post', $receiveOrder->id) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <button type="submit" class="dropdown-item sa-post">
                            <i class="ph-fast-forward-circle me-2"></i>{{ __('پوسٹ') }}
                        </button>
                    </form>
                    @endif
                @endcan
            @endif
            @can('receiveOrders-delete')
                <form action="{{ route('receive-orders.destroy',$receiveOrder->id) }}" method="POST">
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