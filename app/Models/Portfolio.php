<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'full_name', 'title', 'email', 'phone', 'address',
        'website', 'about', 'photo', 'template',
    ];

    public function user()        { return $this->belongsTo(User::class); }
    public function educations()  { return $this->hasMany(Education::class); }
    public function skills()      { return $this->hasMany(Skill::class); }
    public function projects()    { return $this->hasMany(Project::class); }
    public function experiences() { return $this->hasMany(Experience::class); }
    public function links()       { return $this->hasMany(Link::class); }
}