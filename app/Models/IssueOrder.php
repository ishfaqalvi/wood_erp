<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StockTransactions;

/**
 * Class IssueOrder
 *
 * @property $id
 * @property $shop_id
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
 * @property IssueOrderItem[] $issueOrderItems
 * @property Shop $shop
 * @property Worker $worker
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class IssueOrder extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps, StockTransactions;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['shop_id','worker_id','order_number','date','status'];

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
        return $this->hasMany('App\Models\IssueOrderItem', 'order_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shop()
    {
        return $this->hasOne('App\Models\Shop', 'id', 'shop_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function worker()
    {
        return $this->hasOne('App\Models\Worker', 'id', 'worker_id');
    }
}