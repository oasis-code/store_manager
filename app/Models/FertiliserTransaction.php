<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FertiliserTransaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'vehicle_id',
        'person_id',
        'user_id',
        'name',
        'receipt_number',
        'destination',
        'number_of_packs',
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
}
