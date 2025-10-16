<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'billing';

    // public function payment(){
    //     return $this->belongsTo(Payment::class);
    // }

    // public function Payment(){
    //     return $this->hasMany(Billing::class);
    // }
}
