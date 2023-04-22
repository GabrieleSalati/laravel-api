<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }

    protected $fillable = ['title', 'description', 'image', 'link'];
}
