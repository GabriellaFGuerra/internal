<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'blueprint',
        'blueprint_path',
        'project_id'
    ];

    protected $dates = ['deleted_at'];

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }
}
