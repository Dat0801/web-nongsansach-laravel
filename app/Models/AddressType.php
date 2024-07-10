<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{
    use HasFactory;
    protected $table = 'address_types';
    protected $primaryKey = 'address_type_id';

    protected $fillable = [
        'address_type_name',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'address_type_id', 'address_type_id');
    }

    
}
