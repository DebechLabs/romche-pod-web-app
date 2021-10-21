<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["tracking_number", "client_id", "driver_id", "goods_description", "pickup", "destination", "firebase_uid"];

    protected $appends = ["date_created"];

    public function driver(){
        return $this->hasOne(Driver::class, "id", "driver_id");
    }

    public function client(){
        return $this->belongsTo(Client::class, "client_id");
    }

    public function vehicle(){
        return $this->hasOne(Fleet::class, "id", "fleet_id");
    }

    public function getDateCreatedAttribute(){
        return Carbon::parse($this->created_at)->format("d-M-Y H:i:a");
    }
}
