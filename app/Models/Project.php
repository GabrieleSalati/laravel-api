<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function technology()
    {
        return $this->belongsTo(technology::class, 'technology_id');
    }

    protected $fillable = ['title', 'description', 'image', 'link', 'technology_id'];
}
