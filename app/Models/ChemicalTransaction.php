<?php

namespace App\Models;

use App\Models\User;
use App\Models\People;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChemicalTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'person_id',
        'user_id',
        'chemical_id',
        'delivery_note_no',
        'internal_delivery_no',
        'no_of_packs',
        'receipt_no',
        'destination',
        'type',
        'date',
        'reverses',
        'is_reversed',
        'reversal_reason',
        'reversed_by',
    ];

    // Define relationships if necessary
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function person()
    {
        return $this->belongsTo(People::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chemical()
    {
        return $this->belongsTo(Chemical::class);
    }
}
