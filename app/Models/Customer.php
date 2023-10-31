<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'customers';

    // Define fillable fields
    protected $fillable = ['name', 'company_name', 'company_address','company_zipcode','company_country','company_city'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
