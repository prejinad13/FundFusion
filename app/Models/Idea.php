<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function investee()
    {
        return $this->belongsTo(User::class,'investee_id');
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }

    public function investors()
    {
        return $this->belongsTo(User::class,'investee_id');
    }
}
