<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LubsTransactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'person_id',
        'user_id',
        'type',
        'quantity',
        'date',
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
