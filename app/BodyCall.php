<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyCall extends Model
{
    //body_calls
    protected $table = 'body_calls';
    protected $primaryKey = 'BPCall_id';
    protected $fillable = ['BPCus_id','BPCall_date','BPCall_result','BPCall_note','BPCall_type','BPCall_usercall'];

    public function BPbodypaint()
    {
      return $this->belongsTo(BodyPaint::class,'BPCus_id');
    }
}
