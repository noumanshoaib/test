<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\product;
use App\User;
class order extends Model
{
    public function product()
    {
        return $this->belongsTo(product::class,'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getStatusAttribute($key)
    {
        return $key == 1? 'In Progress': ($key == 2? 'Shipped':($key == 3? 'completed':'cancelled'));
    }
}
