<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'description', 'logo', 'favicon', 'email', 'phone', 'address', 'facebook', 'twitter', 'instagram', 'youtube', 'tiktok', 'created_at', 'updated_at'];
    protected $table = 'settings';

}
