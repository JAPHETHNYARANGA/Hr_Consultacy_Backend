<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listings extends Model
{
    use HasFactory;

    protected $table ="listing";
    protected $fillable =[
        'position','requirements','tasks','benefits','name','logo','salary'
    ];
}