<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['full_name', 'email', 'phone', 'address', 'about', 'photo', 'template'];

    public function educations()  { return $this->hasMany(Education::class); }
    public function skills()      { return $this->hasMany(Skill::class); }
    public function projects()    { return $this->hasMany(Project::class); }
    public function experiences() { return $this->hasMany(Experience::class); }
    public function links()       { return $this->hasMany(Link::class); }
}