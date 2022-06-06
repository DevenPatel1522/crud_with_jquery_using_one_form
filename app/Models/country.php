<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;

    protected $table = "country";

    protected $fillable = [
        'sortname',
        'country_name'
    ];

    public function posts()
    {
        return $this->hasOneThrough(
            city::class ,
            state::class ,
            'country_id',
            'state_id',
            'id',
            'id',

        );
    }
}
