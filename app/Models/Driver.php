<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["last_name", "other_names", "date_of_birth", "kra_pin", "license_no"];
    protected $appends = ["driver_name"];

    public function getDriverNameAttribute(){
        return strtoupper($this->last_name) . " " . ucwords(strtolower($this->other_names));
    }
}
