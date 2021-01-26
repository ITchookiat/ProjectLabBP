<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyMechanic extends Model
{
    //body_mechanics
    protected $table = 'body_mechanics';
    protected $primaryKey = 'BPMec_id';
    protected $fillable = ['BPCus_id','BPMec_FixbodyRespon','BPMec_PaintRespon','BPMec_PolishRespon','BPMec_FixbodyDate','BPMec_PaintDate','BPMec_PolishDate',
                          'BPMec_Note','BPMec_UserUpdate'];

    public function BPbodypaint()
    {
        return $this->belongsTo(BodyPaint::class,'BPCus_id');
    }
}
