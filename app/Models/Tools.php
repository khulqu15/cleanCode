<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tools extends Model
{
    use HasFactory;
    public $table = 'tools';
    protected $fillable = ['name', 'location', 'status', 'info'];
}
