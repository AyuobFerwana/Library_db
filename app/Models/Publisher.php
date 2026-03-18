<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Publisher extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\PublisherFactory> */
    use HasFactory;

    public function getFullNameAttribute()
    {
        return $this->name;
    }
}
