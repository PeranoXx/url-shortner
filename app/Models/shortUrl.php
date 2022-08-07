<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shortUrl extends Model
{
    use HasFactory;

    protected $table = 'short_urls';

    public function short_url_visits()
    {
        return $this->hasMany(shortUrlVistit::class, 'short_url_id','id');
    }
}
