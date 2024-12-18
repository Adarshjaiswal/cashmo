<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletDeposite extends Model
{
    use HasFactory;
    protected $table = 'wallet_deposits';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'reforutr', 'status','recharge_id','type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
