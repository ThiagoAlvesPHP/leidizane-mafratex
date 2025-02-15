<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Op extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'number_op',
        'date_op',
        'preiod_start_init',
        'period_start_end',
        'period_stop_init',
        'period_stop_end',
        'quantity',
        'quantity_primary',
        'quantity_secondy',
        'quantity_third',
        'quantity_longitudinal',
        'quantity_transversal',
        'quantity_court',
        'observations',
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
