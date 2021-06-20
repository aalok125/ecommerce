<?php

namespace Modules\MediaUpload\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Upload extends Model
{
    use HasFactory;

    protected $table = 'upload';

    protected $fillable = [
        'fileoriginalname','filename','file_size','user_id','extension','type'
    ];

    protected static function newFactory()
    {
        return \Modules\MediaUpload\Database\factories\UploadFactory::new();
    }
}
