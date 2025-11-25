<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'boat_id',
        'slot_id',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    // Prenotazione appartiene a un cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Prenotazione appartiene a una barca
    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    // Prenotazione appartiene a uno slot
    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}
