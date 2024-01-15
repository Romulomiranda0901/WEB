<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nombres',
        'activo',
        'eliminado','created_at'
    ];

}
