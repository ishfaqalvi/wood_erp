<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class InvoiceSaleItem
 *
 * @property $id
 * @property $invoice_id
 * @property $sale_item_id
 * @property $quantity
 * @property $rate
 * @property $created_at
 * @property $updated_at
 *
 * @property Invoice $invoice
 * @property SaleItem $saleItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InvoiceSaleItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id','sale_item_id','bundle_quantity','quantity','rate'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice()
    {
        return $this->hasOne('App\Models\Invoice', 'id', 'invoice_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function saleItem()
    {
        return $this->hasOne('App\Models\SaleItem', 'id', 'sale_item_id');
    }
}