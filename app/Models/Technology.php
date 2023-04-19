<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'color'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function getBadgeHTML()
    {
        return '<span class="badge" style="background-color:' . $this->color . '">' . $this->title . '</span>';
    }
}
