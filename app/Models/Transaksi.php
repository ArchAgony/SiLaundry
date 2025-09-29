<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaksi extends Model
{
    //
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    public function layanan(){
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
}
