<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ShopDetail
 *
 * @property $id
 * @property $purchase_stock_id
 * @property $quantity
 * @property $created_at
 * @property $updated_at
 *
 * @property PurchaseStock $purchaseStock
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ShopDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['shop_id','purchase_stock_id','date','quantity'];

    /**
     * Interact with the date.
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchaseStock()
    {
        return $this->hasOne('App\Models\PurchaseStock', 'id', 'purchase_stock_id');
    }
}