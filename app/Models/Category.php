<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
