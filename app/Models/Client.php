<?php

namespace App\Models;

use App\Models\Boat;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'surname',
        'mail',
        'phone',
    ];

    // Un cliente può avere più barche
    public function boats()
    {
        return $this->hasMany(Boat::class);
    }

    // Un cliente può avere più prenotazioni
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
