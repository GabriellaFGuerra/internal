<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'item',
        'quantity',
        'withdrawn_datetime',
        'returned_datetime',
        'category_id'
    ];

    protected $dates = [
        'deleted_at',
        'withdrawn_datetime',
        'returned_datetime',
    ];

    public function categories() {
        return $this->belongsTo(Category::class);
    }
}
