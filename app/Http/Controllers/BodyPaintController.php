<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use File;

use App\StockBPCus;
use App\StockBPCar;
// use App\BodyPaint;
use App\BodyCall;
use App\BodyPart;
use App\BodyImage;


class BodyPaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $newfdate = '';
        $newtdate = '';
        if ($request->has('Fromdate')) {
            $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
            $newtdate = $request->get('Todate');
        }

        $data = DB::table('stock_BP_cuses')
            ->join('stock_BP_cars','stock_BP_cuses.BPCus_id','=','stock_BP_cars.BPCus_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('stock_BP_cuses.BPCus_dateKeyin',[$newfdate,$newtdate]);
              })
            ->get();
        $type = $request->type;

        return view('bodyPaint.view', compact('type', 'data','newfdate','newtdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $Cus_id = $request->id;
        $type = $request->type;
        $tab = $request->tab;
        $data = DB::table('stock_BP_cuses')
            ->join('stock_BP_cars','stock_BP_cuses.BPCus_id','=','stock_BP_cars.BPCus_id')
            ->where('stock_BP_cuses.BPCus_id',$Cus_id)
            ->first();
        // dd($Cus_id,$type);
        return view('bodyPaint.option',compact('Cus_id','type','data','tab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('Storetype') == 1){ //เพิ่มรายการลูกค้ามาใหม่
            if($request->get('BPclaimcompany') != null){
                $Setclaimcompany = $request->get('BPclaimcompany');
            }
            if($request->get('BPclaimcompany1') != null){
                $Setclaimcompany = $request->get('BPclaimcompany1');
            }
            $BPCus = new StockBPCus([
                'BPCus_name' => $request->get('BPCusname'),
                'BPCus_phone' => $request->get('BPCusphone'),
                'BPCus_claimLevel' => $request->get('BPclaimlevel'),
                'BPCus_claimType' => $request->get('BPclaimtype'),
                'BPCus_claimCompany' => $request->get('BPclaimcompany'),
                'BPCus_claimCompanyother' => $request->get('BPclaimcompanyother'),
                'BPCus_note' => $request->get('BPnote'),
                'BPCus_dateKeyin' => date('Y-m-d'),
                'BPCus_userKeyin' => $request->get('BPuser'),
                'BPCus_status' => 'มาเคลมใหม่', // สถานะ
            ]);
            $BPCus->save();

            $BPCar = new StockBPCar([
                'BPCus_id' => $BPCus->BPCus_id,
                'BPCar_regisCar' => $request->get('BPCusregiscar'),
            ]);
            $BPCar->save();
        }
        elseif($request->get('Storetype') == 2){ //เพิ่มรายการโทรแจ้ง
            $BPcalldb = new BodyCall([
                'BPCus_id' => $request->get('BPCus_id'),
                'BPCall_date' => $request->get('BPcalldate'),
                'BPCall_result' => $request->get('BPcallresult'),
                'BPCall_note' => $request->get('BPcallnote'),
                'BPCall_type' => $request->get('BPcalltype'),
                'BPCall_usercall' => $request->get('BPcalluser'),
            ]);
            $BPcalldb->save();
        }
        elseif($request->get('Storetype') == 3){ //เพิ่มรายการอะไหล่
            $BPpartdb = new BodyPart([
                'BPCus_id' => $request->get('BPCus_id'),
                'BPPart_date' => $request->get('BPpartdate'),
                'BPPart_assessment' => $request->get('BPpartassessment'),
                'BPPart_quantity' => $request->get('BPpartquantity'),
                'BPPart_assessmentclaim' => $request->get('BPpartassessmentclaim'),
                'BPPart_datecome' => $request->get('BPpartdatecome'),
                'BPPart_assessmentcome' => $request->get('BPpartassessmentcome'),
                'BPPart_company' => $request->get('BPpartcompany'),
                'BPPart_note' => $request->get('BPpartnote'),
                'BPPart_status' => $request->get('BPpartstatus'),
                'BPPart_user' => $request->get('BPpartuser'),
            ]);
            $BPpartdb->save();
        }
        elseif($request->get('Storetype') == 4){ //เพิ่มรูปภาพ
            // $user = StockBPCar::find($request->BPCus_id);
            //     $user->BPCar_regisCar = $request->get('BPcusCarbrand');
            //     $user->BPCar_carModel = $request->get('BPcusCarmodel');
            //     $user->BPCar_regisCar = $request->get('BPcusCarregis');
            //     $user->BPCar_carYear = $request->get('BPcusCaryear');
            // $user->update();

            $image_new_name = "";
            // รูปประกอบ
            if ($request->hasFile('file_image')) {
                $image_array = $request->file('file_image');
                $Brandcar = $request->get('BPCuscarbrand');
                $Regiscar = $request->get('BPCusregiscar');
                $array_len = count($image_array);

                for ($i=0; $i < $array_len; $i++) {
                $image_size = $image_array[$i]->getClientSize();
                $image_lastname = $image_array[$i]->getClientOriginalExtension();
                $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

                // $destination_path = public_path().'/BP-image/'.$Brandcar.'/'.$Regiscar;
                $destination_path = storage_path('app/public/BP-images/').$Brandcar.'/'.$Regiscar;
                Storage::makeDirectory($destination_path, 0777, true, true);
                
                $image_array[$i]->move($destination_path,$image_new_name);

                $Uploaddb = new BodyImage([
                    'BPCus_id' => $request->BPCus_id,
                    'BPImage_filename' => $image_new_name,
                    'BPImage_filesize' => $image_size,
                    'BPImage_type' => 1,
                    'BPImage_userUpload' => $request->get('BPuser'),
                ]);
                $Uploaddb ->save();
                }
            }
        }
        $type = $request->get('Storetype');
        // return redirect()->Route('Analysis',$type)->with('success','บันทึกข้อมูลเรียบร้อย');
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->type == 1){
            $data = DB::table('stock_BP_cuses')
            ->join('stock_BP_cars','stock_BP_cuses.BPCus_id','=','stock_BP_cars.BPCus_id')
            ->where('stock_BP_cuses.BPCus_id',$id)
            ->first();

            $dataCallClaim = DB::table('body_calls') //งานโทรอนุมัติประกัน
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',1)
            ->get();

            $dataCallClaim2 = DB::table('body_calls') //งานโทรอะไหล่ครบ
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',2)
            ->get();

            $dataCallClaim3 = DB::table('body_calls') //งานโทรซ่อมตัวถัง
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',3)
            ->get();

            $dataCallClaim4 = DB::table('body_calls') //งานโทรพ่นสี
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',4)
            ->get();

            $dataCallClaim5 = DB::table('body_calls') //งานโทรขัดสี ก่อนส่งมอบ
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',5)
            ->get();

            $dataPart = DB::table('body_parts')
            ->where('body_parts.BPCus_id',$id)
            ->get();

            $dataImage = DB::table('body_images')
            ->where('body_images.BPCus_id',$id)
            ->get();

            $type = 8;
            return view('bodyPaint.option',
                compact('data','dataCallClaim','dataCallClaim2','dataCallClaim3','dataCallClaim4','dataCallClaim5',
                'dataPart','dataImage','type'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->type == 1){ //แก้ไขรายการโดยรวม
            $data = DB::table('stock_BP_cuses')
            ->join('stock_BP_cars','stock_BP_cuses.BPCus_id','=','stock_BP_cars.BPCus_id')
            ->where('stock_BP_cuses.BPCus_id',$id)
            ->first();

            $dataCallClaim = DB::table('body_calls') //งานโทรอนุมัติประกัน
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',1)
            ->get();
            $countDataCallClaim = count($dataCallClaim);

            $dataCallClaim2 = DB::table('body_calls') //งานโทรอะไหล่ครบ
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',2)
            ->get();
            $countDataCallClaim2 = count($dataCallClaim2);

            $dataCallClaim3 = DB::table('body_calls') //งานโทรซ่อมตัวถัง
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',3)
            ->get();
            $countDataCallClaim3 = count($dataCallClaim3);

            $dataCallClaim4 = DB::table('body_calls') //งานโทรพ่นสี
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',4)
            ->get();
            $countDataCallClaim4 = count($dataCallClaim4);

            $dataCallClaim5 = DB::table('body_calls') //งานโทรขัดสี ก่อนส่งมอบ
            ->where('body_calls.BPCus_id',$id)
            ->where('body_calls.BPCall_type',5)
            ->get();
            $countDataCallClaim5 = count($dataCallClaim5);

            $dataPart = DB::table('body_parts')
            ->where('body_parts.BPCus_id',$id)
            ->get();
                 $countdataPart = count($dataPart);

            $dataImage = DB::table('body_images')
            ->where('body_images.BPCus_id',$id)
            ->get();

            $tab = $request->tab;
            return view('bodyPaint.edit',
                compact('data','dataCallClaim','dataCallClaim2','dataCallClaim3','dataCallClaim4','dataCallClaim5',
                'countDataCallClaim','countDataCallClaim2','countDataCallClaim3','countDataCallClaim4','countDataCallClaim5',
                'dataPart','countdataPart','dataImage','tab'));

        }
        elseif($request->type == 2){ //แก้ไขรายการอะไหล่
            $datapart = DB::table('body_parts')
            ->where('body_parts.BPPart_id',$id)
            ->first();
            $type = 6;
            return view('bodyPaint.option',compact('datapart','type'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->Updatetype == 1){ //อัพเดทรายการลูกค้า
            $user = StockBPCus::find($id);
                $user->BPCus_name = $request->get('BPCusname');
                $user->BPCus_phone = $request->get('BPCusphone');
                $user->BPCus_claimLevel = $request->get('BPclaimlevel');
                $user->BPCus_claimType = $request->get('BPclaimtype');
                $user->BPCus_claimCompany = $request->get('BPclaimcompany');
                $user->BPCus_claimCompanyother = $request->get('BPclaimcompanyother');
                $user->BPCus_claimNumber = $request->get('BPCusclaimNo');
                $user->BPCus_note = $request->get('BPnote');
                $user->BPCus_userUpdated = $request->get('UserUpdate');
                $user->BPCus_dateUpdated = date('H:i:s');
                $user->BPCus_status = $request->get('BPstatus');
                if($request->get('BPstatus') == 'มาเคลมใหม่'){
                    $dateChanged = date('Y-m-d');
                }elseif($request->get('BPstatus') == 'ประกันอนุมัติ'){
                    $dateChanged = date('Y-m-d');
                }elseif($request->get('BPstatus') == 'อะไหล่ครบ'){
                    $dateChanged = date('Y-m-d');
                }elseif($request->get('BPstatus') == 'ซ่อมตัวถัง/พื้น'){
                    $dateChanged = date('Y-m-d');
                }elseif($request->get('BPstatus') == 'พ่นสี'){
                    $dateChanged = date('Y-m-d');
                }elseif($request->get('BPstatus') == 'ขัดสี QC ก่อนส่งมอบ'){
                    $dateChanged = date('Y-m-d');
                }else{
                    $dateChanged = '';
                }
                $user->BPCus_changeStatus = $dateChanged;
            $user->update();

            $dateExpected = null;
            if($request->get('carRepair') != null){
                if($request->get('BPclaimlevel') == 'เบา'){             //3-5วัน
                  $dateExpected = date('Y-m-d',strtotime('+5 days'));
                }elseif($request->get('BPclaimlevel') == 'กลาง'){        //7-14วัน
                  $dateExpected = date('Y-m-d',strtotime('+14 days'));
                }elseif($request->get('BPclaimlevel') == 'หนัก'){      //1-3เดือน
                  $dateExpected = date('Y-m-d',strtotime('+90 days'));
                }
            }

            $StockBPCar = StockBPCar::where('BPCus_id',$id)->first();
                $StockBPCar->BPCar_regisCar = $request->get('BPCusregiscar');
                $StockBPCar->BPCar_carBrand = $request->get('BPCuscarbrand');
                $StockBPCar->BPCar_carModel = $request->get('BPCuscarmodel');
                $StockBPCar->BPCar_carRepair = $request->get('carRepair');
                $StockBPCar->BPCar_carFinished = $dateExpected;
                $StockBPCar->BPCar_carDelivered = $request->get('carDeliver');
            $StockBPCar->update();
        }
        elseif($request->Updatetype == 2){ //อัพเดทรายการอะไหล่
            $BPpartdb = BodyPart::find($id);
                $BPpartdb->BPPart_date = $request->get('BPpartdate');
                $BPpartdb->BPPart_assessment = $request->get('BPpartassessment');
                $BPpartdb->BPPart_quantity = $request->get('BPpartquantity');
                $BPpartdb->BPPart_assessmentclaim = $request->get('BPpartassessmentclaim');
                $BPpartdb->BPPart_datecome = $request->get('BPpartdatecome');
                $BPpartdb->BPPart_assessmentcome = $request->get('BPpartassessmentcome');
                $BPpartdb->BPPart_company = $request->get('BPpartcompany');
                $BPpartdb->BPPart_note = $request->get('BPpartnote');
                $BPpartdb->BPPart_status = $request->get('BPpartstatus');
                $BPpartdb->BPPart_user = $request->get('BPpartuser');
            $BPpartdb->update();
        }
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if($request->deltype == 1){ //ลบรายการทั้งหมด
            $item1 = StockBPCus::find($id);
            $item2 = BodyCall::where('BPCus_id',$id);
            $item3 = BodyPart::where('BPCus_id',$id);
            $item4 = StockBPCar::where('BPCus_id',$id);
            // $item5 = BodyImage::where('BPCus_id',$id);
            
            $item1->Delete();
            $item2->Delete();
            $item3->Delete();
            $item4->Delete();
            // $item5->Delete();
        }
        elseif($request->deltype == 2){ //ลบรายการโทร ประกันอนุมัติ
            $item1 = BodyCall::where('BPCall_id',$id)->where('BPCall_type',$request->calltype);
            $item1->Delete();
        }
        elseif($request->deltype == 3){ //ลบรายการอะไหล่
            $item1 = BodyPart::find($id);
            $item1->Delete();
        }
        elseif($request->deltype == 4){ //ลบรูปภาพ
            $item1 = BodyImage::find($id);
            $itemPath = storage_path('app/public/BP-images/').$request->Imagepath;
            File::delete($itemPath);
            $item1->Delete();
        }

        // return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
        $tab = $request->tab;
        return redirect()->back()->with(['tab' => $tab,'success' => 'ลบข้อมูลเรียบร้อย']);
    }
}
