<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyImage extends Model
{
    //body_images
    protected $table = 'body_images';
    protected $primaryKey = 'BPImage_id';
    protected $fillable = ['BPCus_id','BPImage_filename','BPImage_filesize','BPImage_type','BPImage_userUpload'];

    public function BPbodypaint()
    {
        return $this->belongsTo(BodyPaint::class,'BPCus_id');
    }
}
