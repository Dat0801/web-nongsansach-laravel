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

    public function products()
    {
        return $this->hasMany(Product::class, 'weight_id', 'weight_id');
    }

}
