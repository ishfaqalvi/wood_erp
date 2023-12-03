<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class IssueOrderItem
 *
 * @property $id
 * @property $order_id
 * @property $purchase_stock_id
 * @property $quantity
 * @property $created_at
 * @property $updated_at
 *
 * @property IssueOrder $issueOrder
 * @property PurchaseStock $purchaseStock
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class IssueOrderItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','purchase_stock_id','quantity'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function issueOrder()
    {
        return $this->hasOne('App\Models\IssueOrder', 'id', 'order_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchaseStock()
    {
        return $this->hasOne('App\Models\PurchaseStock', 'id', 'purchase_stock_id');
    }
    
}