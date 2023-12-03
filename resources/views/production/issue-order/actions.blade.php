@canany(['issueOrders-view', 'issueOrders-edit', 'issueOrders-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @can('issueOrders-view')
                <a href="{{ route('issue-orders.show',$issueOrder->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('دکھائیں۔') }}
                </a>
            @endcan
            @if($issueOrder->status !='Posted')
                @can('issueOrders-edit')
                    <a href="{{ route('issue-orders.edit',$issueOrder->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('ترمیم') }}
                    </a>
                @endcan
                @can('issueOrders-post')
                    @if(count($issueOrder->items)>0)
                    <form method="POST" action="{{ route('issue-orders.post', $issueOrder->id) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <button type="submit" class="dropdown-item sa-post">
                            <i class="ph-fast-forward-circle me-2"></i>{{ __('پوسٹ') }}
                        </button>
                    </form>
                    @endif
                @endcan
            @endif
            @can('issueOrders-delete')
                <form action="{{ route('issue-orders.destroy',$issueOrder->id) }}" method="POST">
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