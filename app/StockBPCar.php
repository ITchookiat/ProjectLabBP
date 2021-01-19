<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockBPCar extends Model
{
    //body_parts
    protected $table = 'stock_BP_cars';
    protected $primaryKey = 'BPCar_id';
    protected $fillable = ['BPCus_id','BPCar_regisCar','BPCar_carBrand','BPCar_carModel','BPCar_carYear',
                            'BPCar_carRepair','BPCar_carFinished','BPCar_carDelivered'];

    public function BPbodypaint()
    {
        return $this->belongsTo(StockBPCus::class,'BPCus_id');
    }
}
