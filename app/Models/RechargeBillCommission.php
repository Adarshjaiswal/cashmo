<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechargeBillCommission extends Model
{
    use HasFactory;
    protected $table = 'recharge_bills_commission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'package_id', 'provider_id', 'commission_type', 'commission_rate'
    ];

    public function provider()
{
    return $this->belongsTo(Provider::class, 'provider_id');
}
}
