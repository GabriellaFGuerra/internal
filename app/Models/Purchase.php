<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'item',
        'category_id',
        'project_id',
        'unit_value',
        'quantity',
        'provider',
        'invoice_key',
        'invoice_path',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function projects() {
        return $this->belongsTo(Project::class);
    }
}
