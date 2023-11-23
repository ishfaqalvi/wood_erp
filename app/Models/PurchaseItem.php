<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PurchaseItem
 *
 * @property $id
 * @property $name
 * @property $length
 * @property $width
 * @property $height
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PurchaseItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, Userstamps;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','length','width','thikness'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stock()
    {
        return $this->hasOne('App\Models\PurchaseStock', 'id', 'purchase_item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany('App\Models\PurchaseDetail', 'purchase_item_id', 'id');
    }
}