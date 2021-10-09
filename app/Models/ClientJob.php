<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["tracking_number", "client_id", "driver_id", "goods_description", "pickup", "destination", "firebase_uid"];

    public function driver(){
        return $this->hasOne(Driver::class, "driver_id");
    }

    public function client(){
        return $this->belongsTo(Client::class, "client_id");
    }
}
