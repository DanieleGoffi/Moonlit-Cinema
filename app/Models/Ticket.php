<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';

    public function user()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function screening()
    {
        return $this->belongsTo(Screening::class);
    }

    public function seat(){
        return $this->belongsTo(Seat::class);
    } 
}
