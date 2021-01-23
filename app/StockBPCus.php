<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockBPCus extends Model
{
    //body_paints
    protected $table = 'stock_BP_cuses';
    protected $primaryKey = 'BPCus_id';
    protected $fillable = ['BPCus_name','BPCus_phone','BPCus_address','BPCus_claimLevel','BPCus_claimType',
                            'BPCus_claimCompany','BPCus_claimCompanyother','BPCus_claimNumber','BPCus_note','BPCus_dateKeyin',
                            'BPCus_userKeyin','BPCus_status','BPCus_changeStatus','BPCus_userUpdated','BPCus_dateUpdated',];

    public function BPcall()
    {
        return $this->hasMany(BodyCall::class);
    }
    public function BPpart()
    {
        return $this->hasMany(BodyPart::class);
    }
    public function BPimage()
    {
        return $this->hasMany(BodyImage::class);
    }
    public function BPCar()
    {
        return $this->hasMany(StockBPCar::class);
    }
}
