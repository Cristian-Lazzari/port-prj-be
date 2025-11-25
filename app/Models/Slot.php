<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'type',
        'loa',
        'draft',
        'beam',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
