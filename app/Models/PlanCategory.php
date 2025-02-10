<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCategory extends Model
{
    use HasFactory;
    protected $table = 'plan_category';
    protected $fillable = [
        'operator_id', 'category','status'
    ];
}
