<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'document',
        'document_path',
        'project_id'
    ];

    protected $dates = ['deleted_at'];

    public function projects() {
        return $this->belongsTo(Project::class);
    }
}
