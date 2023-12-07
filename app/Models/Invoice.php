<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StockTransactions;

/**
 * Class Invoice
 *
 * @property $id
 * @property $customer_id
 * @property $invoice_number
 * @property $invoice_date
 * @property $status
 * @property $created_by
 * @property $updated_by
 * @property $deleted_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Customer $customer
 * @property InvoiceItem[] $invoiceItems
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Invoice extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps, StockTransactions;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'warehouse_id',
        'customer_id',
        'invoice_number',
        'type',
        'invoice_date',
        'bilti_number',
        'goods_name',
        'concession',
        'status'
    ];
 
    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->invoice_number = 'IN-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    /**
     * Calculate the total amount of the bill.
     *
     * @return float
    */
    public function calculateTotalAmount()
    {
        $total = 0;
        $items = $this->type == 'Fancy' ? $this->saleItems : $this->purchaseItems;
        foreach($items as $item)
        {
            $total += $item->quantity*$item->rate;
        }
        return $total - $this->concession;
    }

    /**
     * Interact with the date.
     */
    public function setInvoiceDateAttribute($value)
    {
        $this->attributes['invoice_date'] = strtotime($value);
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
    public function warehouse()
    {
        return $this->hasOne('App\Models\Warehouse', 'id', 'warehouse_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleItems()
    {
        return $this->hasMany('App\Models\InvoiceSaleItem', 'invoice_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseItems()
    {
        return $this->hasMany('App\Models\InvoicePurchaseItem', 'invoice_id', 'id');
    }
}