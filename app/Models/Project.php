<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project',
        'address',
        'zipcode',
        'district',
        'stage',
        'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function blueprints()
    {
        return $this->hasMany(Blueprint::class);
    }

    public function diaries()
    {
        return $this->hasMany(Diary::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
