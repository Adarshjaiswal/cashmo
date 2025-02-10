<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileRecharge extends Model
{
    use HasFactory;
    protected $table = 'mobile_recharge';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trans_id', 'ref_id', 'provider', 'customer_info', 'amount','type','response','status','user_id'
    ];
}
