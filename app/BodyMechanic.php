<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyMechanic extends Model
{
    //body_mechanics
    protected $table = 'body_mechanics';
    protected $primaryKey = 'BPMec_id';
    protected $fillable = ['BPCus_id','BPMec_Status','BPMec_StartDate','BPMec_StopDate','BPMec_UserRespon','BPMec_Note','BPMec_UserUpdate','BPMec_DoneDate'];

    public function BPbodypaint()
    {
        return $this->belongsTo(BodyPaint::class,'BPCus_id');
    }
}
