<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
        'legal_counsel',
        'case_detail',
        'profile_image',
        'date_profiled'
    ];

    /**
     * {@inheritdoc}
     */
    protected $dates = ['date_profiled','date_of_birth'];

}
