<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'entry_datetime',
        'entry_text',
        'project_id'
    ];

    protected $dates = ['deleted_at', 'entry_datetime'];

    public function projects() {
        return $this->belongsTo(Project::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
