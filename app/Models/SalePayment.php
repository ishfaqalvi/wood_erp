<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BankingTransactions;

/**
 * Class SalePayment
 *
 * @property $id
 * @property $customer_id
 * @property $date
 * @property $amount
 * @property $created_at
 * @property $updated_at
 *
 * @property Customer $customer
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SalePayment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, Userstamps, BankingTransactions;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'type',
        'bank_id',
        'account_id',
        'slip_number',
        'check_number',
        'attachment',
        'remarks',
        'date',
        'amount',
        'status'
    ];

    /**
     * The set attributes.
     *
     * @var array
     */
    public function setAttachmentAttribute($image)
    {
        if ($image) {
            $name = $image->getClientOriginalName();
            $image->move('images/payments/sale', $name);
            $this->attributes['attachment'] = 'images/payments/sale/'.$name;
        } else {
            unset($this->attributes['attachment']);
        }
    }

    /**
     * The get attributes.
     *
     * @var array
     */
    public function getAttachmentAttribute($image)
    {
        if ($image) { return asset($image); }
    }

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
    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bank()
    {
        return $this->hasOne('App\Models\Bank', 'id', 'bank_id');
    } 

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne('App\Models\Account', 'id', 'account_id');
    } 
}