<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Connectdb2;
use App\DataIBM;
use DB;

use App\StockBPCus;
use App\StockBPCar;
use App\BodyCall;
use App\BodyPart;
use App\BodyImage;
use App\BodyMechanic;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($name)
    {
        $newfdate = '';
        $newtdate = '';
        $data = DB::table('stock_BP_cuses')
            ->leftjoin('stock_BP_cars','stock_BP_cuses.BPCus_id','=','stock_BP_cars.BPCus_id')
            ->leftjoin('body_mechanics','stock_BP_cuses.BPCus_id','=','body_mechanics.BPMec_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('stock_BP_cuses.BPCus_dateKeyin',[$newfdate,$newtdate]);
              })
            ->where('stock_BP_cars.BPCar_carDelivered','=', null)
            ->get();
        $countData = count($data);
        $dataDone = DB::table('stock_BP_cuses')
            ->leftjoin('stock_BP_cars','stock_BP_cuses.BPCus_id','=','stock_BP_cars.BPCus_id')
            ->leftjoin('body_mechanics','stock_BP_cuses.BPCus_id','=','body_mechanics.BPMec_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('stock_BP_cuses.BPCus_dateKeyin',[$newfdate,$newtdate]);
              })
            ->where('stock_BP_cars.BPCar_carDelivered','!=', null)
            ->get();
        $countDataDone = count($dataDone);

        $Anumat[] = '';
        $Alai[] = '';
        $Tank[] = '';
        $Paint[] = '';
        $polishQC[] = '';
            for ($i=0; $i < $countData; $i++) { 
                if($data[$i]->BPCus_status == 'ประกันอนุมัติ'){
                    $Anumat[] = $data[$i];
                }
                elseif($data[$i]->BPCus_status == 'อะไหล่ครบ'){
                    $Alai[] = $data[$i];
                }
                elseif($data[$i]->BPCus_status == 'ซ่อมตัวถัง/พื้น'){
                    $Tank[] = $data[$i];
                }
                elseif($data[$i]->BPCus_status == 'พ่นสี'){
                    $Paint[] = $data[$i];
                }
                elseif($data[$i]->BPCus_status == 'ขัดสี QC ก่อนส่งมอบ'){
                    $polishQC[] = $data[$i];
                }
            }
        $countAnumat = count($Anumat) - 1;
        $countAlai = count($Alai) - 1;
        $countTank = count($Tank) - 1;
        $countPaint = count($Paint) - 1;
        $countpolishQC = count($polishQC) - 1;
        // dd($countData,$countDataDone,$countAnumat,$countAlai,$countTank,$countPaint,$countpolishQC);

        $dataMechanic = DB::table('stock_BP_cuses')
            ->leftjoin('stock_BP_cars','stock_BP_cuses.BPCus_id','=','stock_BP_cars.BPCus_id')
            ->leftjoin('body_mechanics','stock_BP_cuses.BPCus_id','=','body_mechanics.BPCus_id')
            ->select('stock_BP_cuses.BPCus_id as Cus_id','stock_BP_cuses.*','stock_BP_cars.*','body_mechanics.*')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('stock_BP_cuses.BPCus_dateKeyin',[$newfdate,$newtdate]);
              })
            ->where('stock_BP_cars.BPCar_carRepair','!=', null)
            ->where('stock_BP_cars.BPCar_carDelivered','=', null)
            ->where('body_mechanics.BPMec_StopDate','=', null)
            ->get();
        $countdataMechanic = count($dataMechanic);

        $RemoveParts[] = '';
        $RepairTank[] = '';
        $PrepareBG[] = '';
        $PaintColor[] = '';
        $AssembleParts[] = '';
        $PolishColor[] = '';
        $Wash[] = '';
        $QCbeforeSend[] = '';
        $RepairDone[] = '';
            for ($j=0; $j < $countdataMechanic; $j++) { 
                if($dataMechanic[$j]->BPMec_Status == 'ถอดชิ้นส่วนงาน'){
                    $RemoveParts[] = $dataMechanic[$j];
                }
                elseif($dataMechanic[$j]->BPMec_Status == 'ซ่อมตัวถัง'){
                    $RepairTank[] = $dataMechanic[$j];
                }
                elseif($dataMechanic[$j]->BPMec_Status == 'เตรียมพื้น'){
                    $PrepareBG[] = $dataMechanic[$j];
                }
                elseif($dataMechanic[$j]->BPMec_Status == 'พ่นสี'){
                    $PaintColor[] = $dataMechanic[$j];
                }
                elseif($dataMechanic[$j]->BPMec_Status == 'ประกอบชิ้นส่วน'){
                    $AssembleParts[] = $dataMechanic[$j];
                }
                elseif($dataMechanic[$j]->BPMec_Status == 'ขัดสี/QC'){
                    $PolishColor[] = $dataMechanic[$j];
                }
                elseif($dataMechanic[$j]->BPMec_Status == 'ส่งล้าง'){
                    $Wash[] = $dataMechanic[$j];
                }
                elseif($dataMechanic[$j]->BPMec_Status == 'QC ก่อนส่งมอบ'){
                    $QCbeforeSend[] = $dataMechanic[$j];
                }
                elseif($dataMechanic[$j]->BPMec_Status == 'ปิดงานซ่อม'){
                    $RepairDone[] = $dataMechanic[$j];
                }
        }
        $countRemoveParts = count($RemoveParts) - 1;
        $countRepairTank = count($RepairTank) - 1;
        $countPrepareBG = count($PrepareBG) - 1;
        $countPaintColor = count($PaintColor) - 1;
        $countAssembleParts = count($AssembleParts) - 1;
        $countPolishColor = count($PolishColor) - 1;
        $countWash = count($Wash) - 1;
        $countQCbeforeSend = count($QCbeforeSend) - 1;
        $countRepairDone = count($RepairDone) - 1;

        // dump($countRemoveParts,$countRepairTank,$countPrepareBG,$countPaintColor,$countAssembleParts,$countPolishColor,$countWash,$countQCbeforeSend,$countRepairDone);

        $type = '';
        
        return view($name, compact('countData','countDataDone','countAnumat','countAlai','countTank','countPaint','countpolishQC',
                                   'countdataMechanic','countRemoveParts','countRepairTank','countPrepareBG','countPaintColor','countAssembleParts','countPolishColor','countWash','countQCbeforeSend','countRepairDone','type'));
    }

}
