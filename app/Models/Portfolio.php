<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
        'address',
        'photo_url',
        'about_me',
        'education',
        'skills',
        'projects',
        'work_experience',
        'social_links',
        'template',
    ];
}
