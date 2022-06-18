<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'postcode', 'city', 'state', 'country', 'postcode', 'phone', 'email'];

    public function customer_fields()
    {
        return $this->hasMany(CustomerField::class);
    }
}
