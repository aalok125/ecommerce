<?php

namespace Modules\SiteSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;

class Sitesetting extends Model
{
    use HasFactory;

    protected $table = 'sitesettings';
    protected $fillable = [
        'key','value'
    ];

    protected static function newFactory()
    {
        return \Modules\SiteSetting\Database\factories\SitesettingFactory::new();
    }


    public function hasImage($val){
        if(isset($val)){
            if(file_exists(public_path($val)))
                return true;
            return false;
        }
        return false;
    }
}
