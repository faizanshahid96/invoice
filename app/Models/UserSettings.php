<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserSettings extends Model
{
    protected $table = 'user_settings';
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'company_name',
        'company_address',
        'city_zip_code',
        'country',
        'image'
        // Add other fillable attributes
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}
