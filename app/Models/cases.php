<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class cases extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'case_id',
    'customer_name',
    'passport_no',
    'country',
    'application_type',
    'tittle',
    'message',
    'status',
];

}
