<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ReceiveOrderItem
 *
 * @property $id
 * @property $order_id
 * @property $sale_item_id
 * @property $quantity
 * @property $rate
 * @property $created_at
 * @property $updated_at
 *
 * @property ReceiveOrder $receiveOrder
 * @property SaleItem $saleItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ReceiveOrderItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','sale_item_id','quantity','rate'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function receiveOrder()
    {
        return $this->hasOne('App\Models\ReceiveOrder', 'id', 'order_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function saleItem()
    {
        return $this->hasOne('App\Models\SaleItem', 'id', 'sale_item_id');
    }
    
}