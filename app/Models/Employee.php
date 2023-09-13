<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'dept'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}