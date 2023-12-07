<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class InvoicePurchaseItem
 *
 * @property $id
 * @property $invoice_id
 * @property $purchase_item_id
 * @property $description
 * @property $quantity
 * @property $rate
 * @property $created_at
 * @property $updated_at
 *
 * @property Invoice $invoice
 * @property PurchaseItem $purchaseItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InvoicePurchaseItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id','purchase_stock_id','description','bundle_quantity','quantity','rate'];


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
    public function purchaseStock()
    {
        return $this->hasOne('App\Models\PurchaseStock', 'id', 'purchase_stock_id');
    }  
}