<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyMechanic extends Model
{
    //body_mechanics
    protected $table = 'body_mechanics';
    protected $primaryKey = 'BPMec_id';
    protected $fillable = ['BPCus_id','BPMec_Status','BPMec_KnockRespon','BPMec_RemoveRespon','BPMec_PrepareRespon','BPMec_PaintRespon','BPMec_AssembleRespon','BPMec_PolishRespon','BPMec_WashRespon','BPMec_DeliverRespon',
                          'BPMec_KnockDate','BPMec_RemoveDate','BPMec_PrepareDate','BPMec_PaintDate','BPMec_AssembleDate','BPMec_PolishDate','BPMec_WashDate','BPMec_DeliverDate','BPMec_Note','BPMec_UserUpdate'];

    public function BPbodypaint()
    {
        return $this->belongsTo(BodyPaint::class,'BPCus_id');
    }
}
