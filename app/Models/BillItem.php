<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class BillItem
 *
 * @property $id
 * @property $bill_id
 * @property $purchase_item_id
 * @property $quantity
 * @property $rate
 * @property $created_at
 * @property $updated_at
 *
 * @property Bill $bill
 * @property PurchaseItem $purchaseItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BillItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['bill_id','name','length','width','thikness','quantity','rate','amount'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            $result = ($item->length /1000) * ($item->width/1000) * ($item->thikness/1000);
            $item->amount = $result * 35.3147 * $item->quantity * $item->rate;
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bill()
    {
        return $this->hasOne('App\Models\Bill', 'id', 'bill_id');
    }
}
