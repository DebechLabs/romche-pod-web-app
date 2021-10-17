<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["client_name", "short_name", "address", "kra_pin", "contact_person", "logo"];
    protected $appends = ["client_logo"];

    public function getClientLogoAttribute(){
        $logo = $this->logo;
        if ($logo === null || $logo === "null"){
            return "images/default.png";
        }elseif (filter_var($logo, FILTER_VALIDATE_URL)){
            return $logo;
        }else{
            return "/storage/{$logo}";
        }
    }
}
