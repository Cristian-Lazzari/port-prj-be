<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boat extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'loa',
        'draft',
        'beam',
        'type',
        'serial_code',
    ];

    // Una barca appartiene a un cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Una barca può avere più prenotazioni
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
