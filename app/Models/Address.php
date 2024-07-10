<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $primaryKey = 'address_id';

    protected $fillable = [
        'user_id',
        'address_type_id',
        'address',
        'ward',
        'district',
        'province',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function addressType()
    {
        return $this->belongsTo(AddressType::class, 'address_type_id', 'address_type_id');
    }
}
