<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyPart extends Model
{
    //body_parts
    protected $table = 'body_parts';
    protected $primaryKey = 'BPPart_id';
    protected $fillable = ['BPCus_id','BPPart_date','BPPart_assessment','BPPart_quantity','BPPart_assessmentclaim','BPPart_datecome','BPPart_assessmentcome',
                          'BPPart_company','BPPart_note','BPPart_user','BPPart_status'];

    public function BPbodypaint()
    {
        return $this->belongsTo(BodyPaint::class,'BPCus_id');
    }
}
