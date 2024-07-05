<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;
    protected $table = 'weights';
    protected $primaryKey = 'weight_id';

    protected $fillable = [
        'weight_name',
    ];
}
