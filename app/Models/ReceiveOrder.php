<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StockTransactions;

/**
 * Class ReceiveOrder
 *
 * @property $id
 * @property $warehouse_id
 * @property $worker_id
 * @property $order_number
 * @property $date
 * @property $status
 * @property $created_by
 * @property $updated_by
 * @property $deleted_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property ReceiveOrderItem[] $receiveOrderItems
 * @property Warehouse $warehouse
 * @property Worker $worker
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ReceiveOrder extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps, StockTransactions;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['warehouse_id','worker_id','order_number','date','status'];

    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->order_number = 'ON-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    /**
     * Calculate the total amount of the order.
     *
     * @return float
    */
    public function calculateTotalAmount()
    {
        $total = 0;
        foreach($this->items as $item)
        {
            $total += $item->quantity*$item->rate;
        }
        return $total;
    }

    /**
     * Interact with the date.
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\ReceiveOrderItem', 'order_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function warehouse()
    {
        return $this->hasOne('App\Models\Warehouse', 'id', 'warehouse_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function worker()
    {
        return $this->hasOne('App\Models\Worker', 'id', 'worker_id');
    }
    
}