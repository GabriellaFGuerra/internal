<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'image_name',
        'image_path',
        'entry_id'
    ];

    protected $dates = ['deleted_at'];

    public function diary()
    {
        return $this->belongsTo(Diary::class, 'entry_id');
    }
}
