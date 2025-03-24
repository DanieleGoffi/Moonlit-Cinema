<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $table = 'seats';
    protected $fillable = ['row', 'number', 'wheelchair_reserved', 'screen_id'];

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

}
