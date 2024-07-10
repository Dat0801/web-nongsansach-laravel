<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'employee_id',
        'create_at',
        'ship_date',
        'order_total',
        'payment_method',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
}
