<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payment';

    // // public function billings(){
    // //     return $this->hasMany(Billing::class);
    // // }

    // public function billing(){
    //     return $this->belongsTo(Billing::class);
    // }
}
