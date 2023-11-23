<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BankingTransactions;

/**
 * Class PurchasePayment
 *
 * @property $id
 * @property $vendor_id
 * @property $date
 * @property $amount
 * @property $created_at
 * @property $updated_at
 *
 * @property Vendor $vendor
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PurchasePayment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, Userstamps, BankingTransactions;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['vendor_id','date','amount','status'];

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
    public function vendor()
    {
        return $this->hasOne('App\Models\Vendor', 'id', 'vendor_id');
    } 
}