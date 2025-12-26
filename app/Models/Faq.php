<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    protected $table = 'faq';
    use HasFactory;

     protected $fillable = [
        'question',
        'answer',
    ];
}
