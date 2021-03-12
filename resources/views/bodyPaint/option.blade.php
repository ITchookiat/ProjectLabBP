@php
    function DateThai($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
        //$strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");
        //$strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
        //return "$strDay-$strMonthThai-$strYear";
    }
    //dd($type);
    date_default_timezone_set('Asia/Bangkok');
    $ifdate = date('Y-m-d');
@endphp
  <section class="content">
    @if($type == 1 or $type == 2 or $type == 3 or $type == 4 or $type == 5) {{-- ฟอร์มเพิ่มงานโทรแจ้ง --}}
        <form name="form2" action="{{ route('MasterBP.store') }}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="modal-header bg-info">
            <div class="col text-center">
                <h5 class="modal-title">
                    <i class="fas fa-phone-square-alt"></i> 
                    @if($type == 1)
                      โทรแจ้งประกันอนุมัติ
                    @elseif($type == 2)
                      โทรแจ้งอะไหล่ครบ
                    @elseif($type == 3)
                      โทรแจ้งซ่อมตัวถัง/พื้น
                    @elseif($type == 4)
                      โทรแจ้งพ่นสี
                    @elseif($type == 5)
                      โทรแจ้งขัดสี QC ก่อนส่งมอบ
                    @endif
                </h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-12">
                    <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">วันที่โทร : </label>
                    <div class="col-sm-8">
                        <input type="date" name="BPcalldate" class="form-control" required/>
                    </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">ผลการโทร : </label>
                    <div class="col-sm-8">
                        <select id="BPcallresult" name="BPcallresult" class="form-control" required>
                        <option value="" selected>--- เลือกผลการโทร ---</option>
                        <option value="ติดต่อได้">ติดต่อได้</option>
                        <option value="ติดต่อไม่ได้">ติดต่อไม่ได้</option>
                        <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                    </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">หมายเหตุ : </label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="BPcallnote" rows="3" placeholder="ป้อนหมายเหตุ..."></textarea>
                    </div>
                    </div>
                </div>
                </div>

                <input type="hidden" name="Storetype" value="2"/>
                <input type="hidden" name="BPCus_id" value="{{ $Cus_id }}"/>
                <input type="hidden" name="BPcalltype" value="{{$type}}"/> 
                <input type="hidden" name="tab" value="{{$tab}}"/> 
                <input type="hidden" name="BPcalluser" value="{{ auth::user()->name }}"/>
                <hr>
            </div>

            <div style="text-align: center;">
                <button type="submit" class="btn btn-success text-center">บันทึก</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
            <br>
        </form>
    @elseif($type == 6) {{-- ฟอร์มแก้ไขอะไหล่ --}}
        <form name="form2" action="{{ route('MasterBP.update',[$datapart->BPPart_id]) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <input type="hidden" name="_method" value="PATCH"/>

            <div class="modal-header bg-info">
                <div class="col text-center">
                <h5 class="modal-title"><i class="fas fa-wrench"></i> แก้ไขรายการอะไหล่</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">วันที่สั่ง : </label>
                        <div class="col-sm-7">
                        <input type="date" name="BPpartdate" class="form-control" value="{{$datapart->BPPart_date}}" required/>
                        </div>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">เลขที่ใบประเมิณ : </label>
                        <div class="col-sm-7">
                        <input type="text" name="BPpartassessment" class="form-control" value="{{$datapart->BPPart_assessment}}"/>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">จำนวน : </label>
                        <div class="col-sm-7">
                        <input type="number" name="BPpartquantity" class="form-control" value="{{$datapart->BPPart_quantity}}"/>
                        </div>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">ใบอนุมัติประกัน : </label>
                        <div class="col-sm-7">
                          <input type="text" name="BPpartassessmentclaim" class="form-control" value="{{$datapart->BPPart_assessmentclaim}}"/>
                        </div>
                    </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">วันที่อะไหล่เข้า : </label>
                        <div class="col-sm-7">
                        <input type="date" name="BPpartdatecome" class="form-control" value="{{$datapart->BPPart_datecome}}"/>
                        </div>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">เลขรับโอนอะไหล่ : </label>
                        <div class="col-sm-7">
                          <input type="text" name="BPpartassessmentcome" class="form-control" value="{{$datapart->BPPart_assessmentcome}}"/>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">อะไหล่บริษัท : </label>
                        <div class="col-sm-7">
                          <select id="BPpartcompany" name="BPpartcompany" class="form-control mb-1">
                            <option value="" selected>--- เลือกอะไหล่บริษัท ---</option>
                            <option value="อะไหล่มาสด้า" {{ ($datapart->BPPart_company === 'อะไหล่มาสด้า') ? 'selected' : '' }}>อะไหล่มาสด้า</option>
                            <option value="อะไหล่ฟอร์ด" {{ ($datapart->BPPart_company === 'อะไหล่ฟอร์ด') ? 'selected' : '' }}>อะไหล่ฟอร์ด</option>
                          </select>
                        </div>
                        <label class="col-sm-4 col-form-label text-right text-sm">สถานะไหล่ : </label>
                        <div class="col-sm-7">
                        <input type="text" name="BPpartstatus" class="form-control" value="{{$datapart->BPPart_status}}"/>
                        </div>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">หมายเหตุ : </label>
                        <div class="col-sm-7">
                          <textarea class="form-control" name="BPpartnote" rows="3" placeholder="ป้อนหมายเหตุ...">{{$datapart->BPPart_note}}</textarea>
                        </div>
                    </div>
                    </div>
                </div>

                <input type="hidden" name="Updatetype" value="2"/>
                <input type="hidden" name="BPpartuser" value="{{ auth::user()->name }}"/>
                <hr>
            </div>

            <div style="text-align: center;">
                <button type="submit" class="btn btn-success text-center">บันทึก</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
            <br>
        </form>
    @elseif($type == 7) {{-- ฟอร์มเพิ่มรูปภาพ --}}
        <form name="form2" action="{{ route('MasterBP.store') }}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="modal-header bg-info">
            <div class="col text-center">
                <h5 class="modal-title">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fas fa-image"></i> 
                    เพิ่มรูปรถยนต์
                </h5>
            </div>
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-save"></i> บันทึก
            </button>
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                <i class="far fa-window-close"></i> ยกเลิก
            </button>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="file-loading">
                            <input required id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="Storetype" value="4"/>
                <input type="hidden" name="BPCus_id" value="{{ $Cus_id }}"/>
                <input type="hidden" name="BPCuscarbrand" value="{{ $data->BPCar_carBrand }}"/>
                <input type="hidden" name="BPCusregiscar" value="{{ $data->BPCar_regisCar }}"/>
                <input type="hidden" name="BPuser" value="{{ auth::user()->name }}"/>
            </div>
        </form>
    @elseif($type == 8) {{-- หน้าดูรายละเอียด --}}
            <div class="modal-header bg-info">
                <div class="col text-center">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle"></i> 
                        ข้อมูลรายละเอียด
                    </h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-sm">
                    <div class="col-6">
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label text-right"> ชื่อ-สกุล :</label>
                            <div class="col-sm-6 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนชื่อสกุล" value="{{$data->BPCus_name}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-form-label text-right"> เบอร์ติดต่อ :</label>
                            <div class="col-sm-6 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนเบอร์ติดต่อ" value="{{$data->BPCus_phone}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-form-label text-right">ชนิดงาน : </label>
                            <div class="col-sm-6 mb-1">
                                <input type="text" class="form-control" placeholder="ชนิดงาน" value="{{$data->BPCus_claimLevel}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-form-label text-right">ประเภทประกัน :</label>
                            <div class="col-sm-6 mb-1">
                                <input type="text" class="form-control" placeholder="ประเภทประกัน" value="{{$data->BPCus_claimType}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-form-label text-right">บริษัทประกัน :</label>
                            <div class="col-sm-6 mb-1">
                                <input type="text" class="form-control" placeholder="บริษัทประกัน" value="{{$data->BPCus_claimCompany}}" readonly/>
                                @if($data->BPCus_claimCompany === 'อื่นๆ')
                                    <input type="text" class="form-control" placeholder="ป้อนบริษัทประกัน" value="{{$data->BPCus_claimCompanyother}}" readonly/>
                                @else
                                    <input type="text" class="form-control" placeholder="ป้อนบริษัทประกัน" value="{{$data->BPCus_claimCompanyother}}" style="display:none" readonly/>
                                @endif
                            </div>
                            <label class="col-sm-4 col-form-label text-right"> เลขเคลมประกัน :</label>
                            <div class="col-sm-6 mb-1">
                            <input type="text" class="form-control" placeholder="ป้อนเลขเคลมประกัน" value="{{$data->BPCus_claimNumber}}" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ป้ายทะเบียน : </label>
                            <div class="col-sm-7 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนป้ายทะเบียน" value="{{$data->BPCar_regisCar}}" readonly/>
                            </div>
                            <label class="col-sm-3 col-form-label text-right"> ยี่ห้อรถ :</label>
                            <div class="col-sm-7 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนยี่ห้อรถ" value="{{$data->BPCar_carBrand}}" readonly/>
                            </div>
                            <label class="col-sm-3 col-form-label text-right"> รุ่นรถ :</label>
                            <div class="col-sm-7 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนรุ่นรถ" value="{{$data->BPCar_carModel}}" readonly/>
                            </div>
                            <label class="col-sm-3 col-form-label text-right"> สีรถ :</label>
                            <div class="col-sm-7 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนสีรถ" value="{{$data->BPCar_carColor}}" readonly/>
                            </div>
                            <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                            <div class="col-sm-7 mb-1">
                                <textarea class="form-control" rows="3" placeholder="ป้อนหมายเหตุ..." readonly>{{$data->BPCus_note}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                @if($viewType == 1)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- <div class="card-header bg-info">
                                    <h5 class="text-center"><i class="fas fa-phone-square-alt"></i> รายการโทรแจ้ง
                                    </h5>
                                </div> -->
                                <div class="card-body">
                                    <div class="form-inline">
                                        <table class="table table-bordered table-hover" id="table">
                                            <thead class="bg-gray-light" >
                                                <tr>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> ประกันอนุมัติ</th>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> อะไหล่ครบ</th>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> ซ่อมตัวถัง/พื้น</th>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> พ่นสี</th>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> ขัดสี QC ก่อนส่งมอบ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center text-xs">
                                                        @foreach($dataCallClaim as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-primary">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">
                                                        @foreach($dataCallClaim2 as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-secondary">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">
                                                        @foreach($dataCallClaim3 as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-success">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">
                                                        @foreach($dataCallClaim4 as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-waring">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-left">
                                                        @foreach($dataCallClaim5 as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-danger">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($viewType == 2)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-inline">
                                        <table class="table table-bordered table-hover" id="table">
                                            <thead class="bg-gray-light" >
                                                <tr>
                                                    <th class="text-center">ลำดับ</th>
                                                    <th class="text-center">สถานะซ่อม</th>
                                                    <th class="text-center">วันที่เริ่มซ่อม</th>
                                                    <th class="text-center">วันที่สิ้นสุดซ่อม</th>
                                                    <th class="text-center">ระยะเวลา</th>
                                                    <th class="text-center" style="width:250px">หมายเหตุ</th>
                                                    <th class="text-center">ผู้รับผิดชอบงาน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dataMechanic as $key => $row)
                                                    <tr>
                                                        <td class="text-center">{{$key+1}}</td>
                                                        <td class="text-center">{{$row->BPMec_Status}}</td>
                                                        <td class="text-center">{{DateThai($row->BPMec_StartDate)}}</td>
                                                        <td class="text-center">
                                                        @if($row->BPMec_StopDate != null)
                                                            {{DateThai($row->BPMec_StopDate)}}
                                                        @else
                                                            -
                                                        @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if($row->BPMec_Status == 'ปิดงานซ่อม')
                                                                @php
                                                                    $Cldate = date_create($row->BPMec_StartDate);
                                                                    $nowCldate = date_create($row->BPMec_DoneDate);
                                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                                @endphp
                                                                <font color="green">{{$ClDateDiff->format('%a วัน')}}</font>
                                                            @else
                                                                @if($row->BPMec_StartDate != null and $row->BPMec_StopDate == null)
                                                                    @php
                                                                        $Cldate = date_create($row->BPMec_StartDate);
                                                                        $nowCldate = date_create($ifdate);
                                                                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                                    @endphp
                                                                    <font color="red">{{$ClDateDiff->format('%a วัน')}}</font>
                                                                @elseif($row->BPMec_StartDate != null and $row->BPMec_StopDate != null)
                                                                    @php
                                                                        $Cldate = date_create($row->BPMec_StartDate);
                                                                        $nowCldate = date_create($row->BPMec_StopDate);
                                                                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                                    @endphp
                                                                    <font color="blue">{{$ClDateDiff->format('%a วัน')}}</font>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td class="text-left">{{($row->BPMec_Note != null)?$row->BPMec_Note:'-'}}</td>
                                                        <td class="text-left"> {{$row->BPMec_UserRespon}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($viewType == 3)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h5 class="text-center"><i class="fas fa-phone-square-alt"></i> รายการโทร
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-inline">
                                        <table class="table table-bordered table-hover" id="table">
                                            <thead class="bg-gray-light" >
                                                <tr>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> ประกันอนุมัติ</th>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> อะไหล่ครบ</th>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> ซ่อมตัวถัง/พื้น</th>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> พ่นสี</th>
                                                    <th class="text-center"><i class="fas fa-phone-square-alt"></i> ขัดสี QC ก่อนส่งมอบ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center text-xs">
                                                        @foreach($dataCallClaim as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-primary">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">
                                                        @foreach($dataCallClaim2 as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-secondary">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">
                                                        @foreach($dataCallClaim3 as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-success">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">
                                                        @foreach($dataCallClaim4 as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-waring">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-left">
                                                        @foreach($dataCallClaim5 as $key => $row)
                                                            <div class="mb-3 btn btn-xs btn-block btn-outline-danger">
                                                                <span>ครั้งที่ {{$key+1}}</span><br>
                                                                <span>{{DateThai($row->BPCall_date)}}</span><br>
                                                                <span>{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h5 class="text-center"><i class="fas fa-wrench"></i> รายการซ่อม
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-inline">
                                        <table class="table table-bordered table-hover" id="table">
                                            <thead class="bg-gray-light" >
                                                <tr>
                                                    <th class="text-center">ลำดับ</th>
                                                    <th class="text-center">สถานะซ่อม</th>
                                                    <th class="text-center">วันที่เริ่มซ่อม</th>
                                                    <th class="text-center">วันที่สิ้นสุดซ่อม</th>
                                                    <th class="text-center">ระยะเวลา</th>
                                                    <th class="text-center" style="width:250px">หมายเหตุ</th>
                                                    <th class="text-center">ผู้รับผิดชอบงาน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dataMechanic as $key => $row)
                                                    <tr>
                                                        <td class="text-center">{{$key+1}}</td>
                                                        <td class="text-center">{{$row->BPMec_Status}}</td>
                                                        <td class="text-center">{{DateThai($row->BPMec_StartDate)}}</td>
                                                        <td class="text-center">
                                                        @if($row->BPMec_StopDate != null)
                                                            {{DateThai($row->BPMec_StopDate)}}
                                                        @else
                                                            -
                                                        @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if($row->BPMec_Status == 'ปิดงานซ่อม')
                                                                @php
                                                                    $Cldate = date_create($row->BPMec_StartDate);
                                                                    $nowCldate = date_create($row->BPMec_DoneDate);
                                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                                @endphp
                                                                <font color="green">{{$ClDateDiff->format('%a วัน')}}</font>
                                                            @else
                                                                @if($row->BPMec_StartDate != null and $row->BPMec_StopDate == null)
                                                                    @php
                                                                        $Cldate = date_create($row->BPMec_StartDate);
                                                                        $nowCldate = date_create($ifdate);
                                                                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                                    @endphp
                                                                    <font color="red">{{$ClDateDiff->format('%a วัน')}}</font>
                                                                @elseif($row->BPMec_StartDate != null and $row->BPMec_StopDate != null)
                                                                    @php
                                                                        $Cldate = date_create($row->BPMec_StartDate);
                                                                        $nowCldate = date_create($row->BPMec_StopDate);
                                                                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                                    @endphp
                                                                    <font color="blue">{{$ClDateDiff->format('%a วัน')}}</font>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td class="text-left">{{($row->BPMec_Note != null)?$row->BPMec_Note:'-'}}</td>
                                                        <td class="text-left"> {{$row->BPMec_UserRespon}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h5 class="text-center"><i class="fas fa-gears"></i> รายการอะไหล่
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-inline">
                                        <table class="table table-bordered table-hover" id="table">
                                            <thead class="bg-gray-light" >
                                                <tr>
                                                    <th class="text-center">ลำดับ</th>
                                                    <th class="text-center">วันที่</th>
                                                    <th class="text-center">เลขที่ใบประเมิณ</th>
                                                    <th class="text-center">จำนวน</th>
                                                    <th class="text-center">สถานะ</th>
                                                    <th class="text-center">หมายเหตุ</th>
                                                    <th class="text-center">ผู้เพิ่มอะไหล่</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dataPart as $key => $row)
                                                <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{DateThai($row->BPPart_date)}}</td>
                                                    <td class="text-center">{{$row->BPPart_assessment}}</td>
                                                    <td class="text-center">{{$row->BPPart_quantity}}</td>
                                                    <td class="text-center">{{($row->BPPart_status != null)?$row->BPPart_status:'-'}}</td>
                                                    <td class="text-left">{{($row->BPPart_note != null)?$row->BPPart_note:'-'}}</td>
                                                    <td class="text-left">{{$row->BPPart_user}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($viewType == 4)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-inline">
                                        <table class="table table-bordered table-hover" id="table">
                                            <thead class="bg-gray-light" >
                                                <tr>
                                                    <th class="text-center">ลำดับ</th>
                                                    <th class="text-center">วันที่</th>
                                                    <th class="text-center">เลขที่ใบประเมิณ</th>
                                                    <th class="text-center">จำนวน</th>
                                                    <th class="text-center">สถานะ</th>
                                                    <th class="text-center">หมายเหตุ</th>
                                                    <th class="text-center">ผู้เพิ่มอะไหล่</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dataPart as $key => $row)
                                                <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{DateThai($row->BPPart_date)}}</td>
                                                    <td class="text-center">{{$row->BPPart_assessment}}</td>
                                                    <td class="text-center">{{$row->BPPart_quantity}}</td>
                                                    <td class="text-center">{{($row->BPPart_status != null)?$row->BPPart_status:'-'}}</td>
                                                    <td class="text-left">{{($row->BPPart_note != null)?$row->BPPart_note:'-'}}</td>
                                                    <td class="text-left">{{$row->BPPart_user}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
    @elseif($type == 9) {{-- หน้าแก้ไขรายรายการส่วนช่าง (เก็บไว้ยังไม่ใช้) --}}
        <form name="form2" action="{{ route('MasterBP.update',[$data->Cus_id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="_method" value="PATCH"/>
            <div class="modal-header bg-warning">
                <div class="col-4">
                    <div class="form-inline">
                        <h5 class="modal-title"><i class="fas fa-edit"></i> แก้ไขรายการ</h5>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-tools d-inline float-right">
                        {{--<small class="badge badge-warning">
                            <select name="BPstatus" class="form-control text-sm">
                            <option value="" selected>--- เลือกสถานะ ---</option>
                            <option value="มาเคลมใหม่" {{ ($data->BPCus_status === 'มาเคลมใหม่') ? 'selected' : '' }}>มาเคลมใหม่</option>
                            <option value="ประกันอนุมัติ" {{ ($data->BPCus_status === 'ประกันอนุมัติ') ? 'selected' : '' }}>ประกันอนุมัติ</option>
                            <option value="อะไหล่ครบ" {{ ($data->BPCus_status === 'อะไหล่ครบ') ? 'selected' : '' }}>อะไหล่ครบ</option>
                            <option value="ซ่อมตัวถัง/พื้น" {{ ($data->BPCus_status === 'ซ่อมตัวถัง/พื้น') ? 'selected' : '' }}>ซ่อมตัวถัง/พื้น</option>
                            <option value="พ่นสี" {{ ($data->BPCus_status === 'พ่นสี') ? 'selected' : '' }}>พ่นสี</option>
                            <option value="ขัดสี QC ก่อนส่งมอบ" {{ ($data->BPCus_status === 'ขัดสี QC ก่อนส่งมอบ') ? 'selected' : '' }}>ขัดสี QC ก่อนส่งมอบ</option>
                            </select>
                        </small>--}}
                        <button type="submit" class="delete-modal btn btn-success btn-sm">
                            <i class="fas fa-save"></i> อัพเดท
                        </button>
                        <a class="delete-modal btn btn-danger btn-sm" href="{{ route('MasterBP.index') }}?type={{2}}">
                            <i class="far fa-window-close text-white"> ยกเลิก</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row text-sm">
                    <div class="col-4">
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label text-right"> ชื่อ-สกุล :</label>
                            <div class="col-sm-8 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนชื่อสกุล" value="{{$data->BPCus_name}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-form-label text-right"> เบอร์ติดต่อ :</label>
                            <div class="col-sm-8 mb-1">
                              <input type="text" class="form-control" placeholder="ป้อนเบอร์ติดต่อ" value="{{$data->BPCus_phone}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-for-label text-right">ชนิดงาน : </label>
                            <div class="col-sm-8 mb-1">
                                <select id="BPclaimlevel" class="form-control" readonly>
                                    <option value="" selected>--- เลือกชนิดงาน ---</option>
                                    <option value="เบา" {{ ($data->BPCus_claimLevel === 'เบา') ? 'selected' : '' }}>เบา</option>
                                    <option value="กลาง" {{ ($data->BPCus_claimLevel === 'กลาง') ? 'selected' : '' }}>กลาง</option>
                                    <option value="หนัก" {{ ($data->BPCus_claimLevel === 'หนัก') ? 'selected' : '' }}>หนัก</option>
                                </select>
                            </div>
                            <label class="col-sm-4 col-form-label text-right"> เลขที่เคลม :</label>
                            <div class="col-sm-8 mb-1">
                              <input type="text" class="form-control" placeholder="ป้อนเลขเคลมประกัน" value="{{$data->BPCus_claimNumber}}" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group row mb-1">
                            <label class="col-sm-4 col-form-label text-right">ป้ายทะเบียน : </label>
                            <div class="col-sm-8 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนป้ายทะเบียน" value="{{$data->BPCar_regisCar}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-form-label text-right"> ยี่ห้อรถ :</label>
                            <div class="col-sm-8 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนยี่ห้อรถ" value="{{$data->BPCar_carBrand}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-form-label text-right"> รุ่นรถ :</label>
                            <div class="col-sm-8 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนรุ่นรถ" value="{{$data->BPCar_carModel}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-form-label text-right"> สีรถ :</label>
                            <div class="col-sm-8 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนรุ่นรถ" value="{{$data->BPCar_carColor}}" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                       <div class="form-group row mb-1">
                            <label class="col-sm-4 col-form-label text-right text-red">สถานะซ่อม : </label>
                            <div class="col-sm-8 mb-1">
                                <select name="BPMecstatus" class="form-control">
                                    <option value="" selected>--- เลือกสถานะซ่อม ---</option>
                                    <option value="ถอดชิ้นส่วนงาน" {{ ($data->BPMec_Status === 'ถอดชิ้นส่วนงาน') ? 'selected' : '' }}>ถอดชิ้นส่วนงาน</option>
                                    <option value="ซ่อมตัวถัง" {{ ($data->BPMec_Status === 'ซ่อมตัวถัง') ? 'selected' : '' }}>ซ่อมตัวถัง</option>
                                    <option value="เตรียมพื้น" {{ ($data->BPMec_Status === 'เตรียมพื้น') ? 'selected' : '' }}>เตรียมพื้น</option>
                                    <option value="พ่นสี" {{ ($data->BPMec_Status === 'พ่นสี') ? 'selected' : '' }}>พ่นสี</option>
                                    <option value="ประกอบชิ้นส่วน" {{ ($data->BPMec_Status === 'ประกอบชิ้นส่วน') ? 'selected' : '' }}>ประกอบชิ้นส่วน</option>
                                    <option value="ขัดสี/QC" {{ ($data->BPMec_Status === 'ขัดสี/QC') ? 'selected' : '' }}>ขัดสี/QC</option>
                                    <option value="ส่งล้าง" {{ ($data->BPMec_Status === 'ส่งล้าง') ? 'selected' : '' }}>ส่งล้าง</option>
                                    <option value="QC ก่อนส่งมอบ" {{ ($data->BPMec_Status === 'QC ก่อนส่งมอบ') ? 'selected' : '' }}>QC ก่อนส่งมอบ</option>
                                    <option value="ปิดงานซ่อม" {{ ($data->BPMec_Status === 'ปิดงานซ่อม') ? 'selected' : '' }}>ปิดงานซ่อม</option>
                                </select>
                            </div>
                            @if($data->BPCar_carFinished != null)
                                @if($ifdate < $data->BPCar_carFinished)
                                @php
                                    $Cldate = date_create($data->BPCar_carFinished);
                                    $nowCldate = date_create($ifdate);
                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                @endphp
                                @endif
                            @endif
                            <label class="col-sm-4 col-form-label text-right text-red">เหลือเวลา :</label>
                            <div class="col-sm-8 mb-1">
                                <input type="text" class="form-control" placeholder="ป้อนรุ่นรถ" value="{{$ClDateDiff->format('%a วัน')}}" readonly/>
                            </div>
                            <label class="col-sm-4 col-form-label text-right">หมายเหตุ :</label>
                            <div class="col-sm-8 mb-1">
                                <textarea class="form-control" rows="3" readonly>{{$data->BPCus_note}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 form-inline text-sm">
                        <table class="table table-bordered" id="table">
                            <thead class="bg-red" >
                                <tr>
                                    <th class="text-center">สถานะซ่อม</th>
                                    <th class="text-center">วันเริ่มดำเนินการ</th>
                                    <th class="text-center">ระยะเวลา</th>
                                    <th class="text-center" style="width:250px">ผู้รับผิดชอบงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->BPMec_RemoveDate != null) {{-- ถอดชิ้นส่วนงาน --}}
                                    <tr>
                                        <td class="text-center">
                                        ถอดชิ้นส่วนงาน
                                        </td>
                                        <td class="text-center">
                                            {{DateThai($data->BPMec_RemoveDate)}}
                                        </td>
                                        <td class="text-center">
                                            @if($data->BPMec_RemoveDate != null)
                                                @php
                                                    $Cldate = date_create($data->BPMec_RemoveDate);
                                                    $nowCldate = date_create($ifdate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                @endphp
                                                {{$ClDateDiff->format('%a วัน')}}
                                            @else 

                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <select name="BPMecuserremove" class="form-control text-sm" {{ ($data->BPMec_Status !== 'ถอดชิ้นส่วนงาน') ? 'disabled' : '' }}>
                                            <option value="" selected>--- เลือกผู้รับผิดชอบงาน ---</option>
                                                <option value="นายเดวิด  แสงศรี" {{ ($data->BPMec_RemoveRespon === 'นายเดวิด  แสงศรี') ? 'selected' : '' }}>นายเดวิด  แสงศรี</option>
                                                <option value="นายวริศ  นิแม" {{ ($data->BPMec_RemoveRespon === 'นายวริศ  นิแม') ? 'selected' : '' }}>นายวริศ  นิแม</option>
                                                <option value="นายบาหารี  นิเลาะ" {{ ($data->BPMec_RemoveRespon === 'นายบาหารี  นิเลาะ') ? 'selected' : '' }}>นายบาหารี  นิเลาะ</option>
                                                <option value="นายรอมลี  อาแวปาโอะ" {{ ($data->BPMec_RemoveRespon === 'นายรอมลี  อาแวปาโอะ') ? 'selected' : '' }}>นายรอมลี  อาแวปาโอะ</option>
                                                <option value="นายประเสริฐ อาแวปาโอะ" {{ ($data->BPMec_RemoveRespon === 'นายประเสริฐ อาแวปาโอะ') ? 'selected' : '' }}>นายประเสริฐ อาแวปาโอะ</option>
                                                <option value="นายซัมซัม  วานิ" {{ ($data->BPMec_RemoveRespon === 'นายซัมซัม  วานิ') ? 'selected' : '' }}>นายซัมซัม  วานิ</option>
                                                <!-- <option value="นายมะดารี  สาเยาะ" {{ ($data->BPMec_RemoveRespon === 'นายมะดารี  สาเยาะ') ? 'selected' : '' }}>นายมะดารี  สาเยาะ</option> -->
                                                <option value="นายหัสดิน  เจ๊ะโก๊ะ" {{ ($data->BPMec_RemoveRespon === 'นายหัสดิน  เจ๊ะโก๊ะ') ? 'selected' : '' }}>นายหัสดิน  เจ๊ะโก๊ะ</option>
                                                <option value="นายซาเฟียน  มะแซ" {{ ($data->BPMec_RemoveRespon === 'นายซาเฟียน  มะแซ') ? 'selected' : '' }}>นายซาเฟียน  มะแซ</option>
                                                <option value="นายพิทยา  เลี้ยงพันธุ์สกุล" {{ ($data->BPMec_RemoveRespon === 'นายพิทยา  เลี้ยงพันธุ์สกุล') ? 'selected' : '' }}>นายพิทยา  เลี้ยงพันธุ์สกุล</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                                @if($data->BPMec_KnockDate != null)  {{--  ซ่อมตัวถัง --}}
                                    <tr>
                                        <td class="text-center">
                                            ซ่อมตัวถัง
                                        </td>
                                        <td class="text-center">
                                            {{DateThai($data->BPMec_KnockDate)}}
                                        </td>
                                        <td class="text-center">
                                            @if($data->BPMec_KnockDate != null)
                                                @php
                                                    $Cldate = date_create($data->BPMec_KnockDate);
                                                    $nowCldate = date_create($ifdate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                @endphp
                                                {{$ClDateDiff->format('%a วัน')}}
                                            @elseif($data->BPMec_RemoveDate != null)
                                                @php
                                                    $Cldate = date_create($data->BPMec_KnockDate);
                                                    $nowCldate = date_create($data->BPMec_RemoveDate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                @endphp
                                                {{$ClDateDiff->format('%a วัน')}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <select name="BPMecuserknock" class="form-control text-sm" {{ ($data->BPMec_Status !== 'ซ่อมตัวถัง') ? 'disabled' : '' }}>
                                                <option value="" selected>--- เลือกผู้รับผิดชอบงาน ---</option>
                                                <option value="นายเดวิด  แสงศรี" {{ ($data->BPMec_KnockRespon === 'นายเดวิด  แสงศรี') ? 'selected' : '' }}>นายเดวิด  แสงศรี</option>
                                                <option value="นายวริศ  นิแม" {{ ($data->BPMec_KnockRespon === 'นายวริศ  นิแม') ? 'selected' : '' }}>นายวริศ  นิแม</option>
                                                <option value="นายบาหารี  นิเลาะ" {{ ($data->BPMec_KnockRespon === 'นายบาหารี  นิเลาะ') ? 'selected' : '' }}>นายบาหารี  นิเลาะ</option>
                                                <option value="นายรอมลี  อาแวปาโอะ" {{ ($data->BPMec_KnockRespon === 'นายรอมลี  อาแวปาโอะ') ? 'selected' : '' }}>นายรอมลี  อาแวปาโอะ</option>
                                                <!-- <option value="นายประเสริฐ อาแวปาโอะ" {{ ($data->BPMec_KnockRespon === 'นายประเสริฐ อาแวปาโอะ') ? 'selected' : '' }}>นายประเสริฐ อาแวปาโอะ</option> -->
                                                <option value="นายซัมซัม  วานิ" {{ ($data->BPMec_KnockRespon === 'นายซัมซัม  วานิ') ? 'selected' : '' }}>นายซัมซัม  วานิ</option>
                                                <!-- <option value="นายมะดารี  สาเยาะ" {{ ($data->BPMec_KnockRespon === 'นายมะดารี  สาเยาะ') ? 'selected' : '' }}>นายมะดารี  สาเยาะ</option> -->
                                                <option value="นายหัสดิน  เจ๊ะโก๊ะ" {{ ($data->BPMec_KnockRespon === 'นายหัสดิน  เจ๊ะโก๊ะ') ? 'selected' : '' }}>นายหัสดิน  เจ๊ะโก๊ะ</option>
                                                <option value="นายซาเฟียน  มะแซ" {{ ($data->BPMec_KnockRespon === 'นายซาเฟียน  มะแซ') ? 'selected' : '' }}>นายซาเฟียน  มะแซ</option>
                                                <option value="นายพิทยา  เลี้ยงพันธุ์สกุล" {{ ($data->BPMec_KnockRespon === 'นายพิทยา  เลี้ยงพันธุ์สกุล') ? 'selected' : '' }}>นายพิทยา  เลี้ยงพันธุ์สกุล</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                                @if($data->BPMec_PrepareDate != null) {{--  เตรียมพื้น --}}
                                    <tr>
                                        <td class="text-center">
                                            เตรียมพื้น
                                        </td>
                                        <td class="text-center">
                                            {{DateThai($data->BPMec_PrepareDate)}}
                                        </td>
                                        <td class="text-center">
                                            @if($data->BPMec_PrepareDate != null)
                                                @php
                                                    $Cldate = date_create($data->BPMec_PrepareDate);
                                                    $nowCldate = date_create($ifdate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                @endphp
                                                {{$ClDateDiff->format('%a วัน')}}
                                            @else 

                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <select name="BPMecuserprepare" class="form-control text-sm" {{ ($data->BPMec_Status !== 'เตรียมพื้น') ? 'disabled' : '' }}>
                                            <option value="" selected>--- เลือกผู้รับผิดชอบงาน ---</option>
                                                <option value="นายเดวิด  แสงศรี" {{ ($data->BPMec_PrepareRespon === 'นายเดวิด  แสงศรี') ? 'selected' : '' }}>นายเดวิด  แสงศรี</option>
                                                <option value="นายวริศ  นิแม" {{ ($data->BPMec_PrepareRespon === 'นายวริศ  นิแม') ? 'selected' : '' }}>นายวริศ  นิแม</option>
                                                <option value="นายบาหารี  นิเลาะ" {{ ($data->BPMec_PrepareRespon === 'นายบาหารี  นิเลาะ') ? 'selected' : '' }}>นายบาหารี  นิเลาะ</option>
                                                <option value="นายรอมลี  อาแวปาโอะ" {{ ($data->BPMec_PrepareRespon === 'นายรอมลี  อาแวปาโอะ') ? 'selected' : '' }}>นายรอมลี  อาแวปาโอะ</option>
                                                <!-- <option value="นายประเสริฐ อาแวปาโอะ" {{ ($data->BPMec_PrepareRespon === 'นายประเสริฐ อาแวปาโอะ') ? 'selected' : '' }}>นายประเสริฐ อาแวปาโอะ</option> -->
                                                <option value="นายซัมซัม  วานิ" {{ ($data->BPMec_PrepareRespon === 'นายซัมซัม  วานิ') ? 'selected' : '' }}>นายซัมซัม  วานิ</option>
                                                <!-- <option value="นายมะดารี  สาเยาะ" {{ ($data->BPMec_PrepareRespon === 'นายมะดารี  สาเยาะ') ? 'selected' : '' }}>นายมะดารี  สาเยาะ</option> -->
                                                <option value="นายหัสดิน  เจ๊ะโก๊ะ" {{ ($data->BPMec_PrepareRespon === 'นายหัสดิน  เจ๊ะโก๊ะ') ? 'selected' : '' }}>นายหัสดิน  เจ๊ะโก๊ะ</option>
                                                <option value="นายซาเฟียน  มะแซ" {{ ($data->BPMec_PrepareRespon === 'นายซาเฟียน  มะแซ') ? 'selected' : '' }}>นายซาเฟียน  มะแซ</option>
                                                <option value="นายพิทยา  เลี้ยงพันธุ์สกุล" {{ ($data->BPMec_PrepareRespon === 'นายพิทยา  เลี้ยงพันธุ์สกุล') ? 'selected' : '' }}>นายพิทยา  เลี้ยงพันธุ์สกุล</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                                @if($data->BPMec_PaintDate != null)   {{--  พ่นสี --}}
                                    <tr>
                                        <td class="text-center">
                                            พ่นสี
                                        </td>
                                        <td class="text-center">
                                            {{DateThai($data->BPMec_PaintDate)}}
                                        </td>
                                        <td class="text-center">
                                            @if($data->BPMec_PaintDate != null)
                                                @php
                                                    $Cldate = date_create($data->BPMec_PaintDate);
                                                    $nowCldate = date_create($ifdate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                @endphp
                                                {{$ClDateDiff->format('%a วัน')}}
                                            @else 

                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <select name="BPMecuserpaint" class="form-control text-sm" {{ ($data->BPMec_Status !== 'พ่นสี') ? 'disabled' : '' }}>
                                            <option value="" selected>--- เลือกผู้รับผิดชอบงาน ---</option>
                                                <option value="นายเดวิด  แสงศรี" {{ ($data->BPMec_PaintRespon === 'นายเดวิด  แสงศรี') ? 'selected' : '' }}>นายเดวิด  แสงศรี</option>
                                                <option value="นายวริศ  นิแม" {{ ($data->BPMec_PaintRespon === 'นายวริศ  นิแม') ? 'selected' : '' }}>นายวริศ  นิแม</option>
                                                <option value="นายบาหารี  นิเลาะ" {{ ($data->BPMec_PaintRespon === 'นายบาหารี  นิเลาะ') ? 'selected' : '' }}>นายบาหารี  นิเลาะ</option>
                                                <option value="นายรอมลี  อาแวปาโอะ" {{ ($data->BPMec_PaintRespon === 'นายรอมลี  อาแวปาโอะ') ? 'selected' : '' }}>นายรอมลี  อาแวปาโอะ</option>
                                                <!-- <option value="นายประเสริฐ อาแวปาโอะ" {{ ($data->BPMec_PaintRespon === 'นายประเสริฐ อาแวปาโอะ') ? 'selected' : '' }}>นายประเสริฐ อาแวปาโอะ</option> -->
                                                <option value="นายซัมซัม  วานิ" {{ ($data->BPMec_PaintRespon === 'นายซัมซัม  วานิ') ? 'selected' : '' }}>นายซัมซัม  วานิ</option>
                                                <!-- <option value="นายมะดารี  สาเยาะ" {{ ($data->BPMec_PaintRespon === 'นายมะดารี  สาเยาะ') ? 'selected' : '' }}>นายมะดารี  สาเยาะ</option> -->
                                                <option value="นายหัสดิน  เจ๊ะโก๊ะ" {{ ($data->BPMec_PaintRespon === 'นายหัสดิน  เจ๊ะโก๊ะ') ? 'selected' : '' }}>นายหัสดิน  เจ๊ะโก๊ะ</option>
                                                <option value="นายซาเฟียน  มะแซ" {{ ($data->BPMec_PaintRespon === 'นายซาเฟียน  มะแซ') ? 'selected' : '' }}>นายซาเฟียน  มะแซ</option>
                                                <option value="นายพิทยา  เลี้ยงพันธุ์สกุล" {{ ($data->BPMec_PaintRespon === 'นายพิทยา  เลี้ยงพันธุ์สกุล') ? 'selected' : '' }}>นายพิทยา  เลี้ยงพันธุ์สกุล</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                                @if($data->BPMec_AssembleDate != null)  {{--  ประกอบชิ้นส่วน --}}
                                    <tr>
                                        <td class="text-center">
                                            ประกอบชิ้นส่วน
                                        </td>
                                        <td class="text-center">
                                            {{DateThai($data->BPMec_AssembleDate)}}
                                        </td>
                                        <td class="text-center">
                                            @if($data->BPMec_AssembleDate != null)
                                                @php
                                                    $Cldate = date_create($data->BPMec_AssembleDate);
                                                    $nowCldate = date_create($ifdate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                @endphp
                                                {{$ClDateDiff->format('%a วัน')}}
                                            @else 

                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <select name="BPMecuserassemble" class="form-control text-sm" {{ ($data->BPMec_Status !== 'ประกอบชิ้นส่วน') ? 'disabled' : '' }}>
                                            <option value="" selected>--- เลือกผู้รับผิดชอบงาน ---</option>
                                                <option value="นายเดวิด  แสงศรี" {{ ($data->BPMec_AssembleRespon === 'นายเดวิด  แสงศรี') ? 'selected' : '' }}>นายเดวิด  แสงศรี</option>
                                                <option value="นายวริศ  นิแม" {{ ($data->BPMec_AssembleRespon === 'นายวริศ  นิแม') ? 'selected' : '' }}>นายวริศ  นิแม</option>
                                                <option value="นายบาหารี  นิเลาะ" {{ ($data->BPMec_AssembleRespon === 'นายบาหารี  นิเลาะ') ? 'selected' : '' }}>นายบาหารี  นิเลาะ</option>
                                                <option value="นายรอมลี  อาแวปาโอะ" {{ ($data->BPMec_AssembleRespon === 'นายรอมลี  อาแวปาโอะ') ? 'selected' : '' }}>นายรอมลี  อาแวปาโอะ</option>
                                                <!-- <option value="นายประเสริฐ อาแวปาโอะ" {{ ($data->BPMec_AssembleRespon === 'นายประเสริฐ อาแวปาโอะ') ? 'selected' : '' }}>นายประเสริฐ อาแวปาโอะ</option> -->
                                                <option value="นายซัมซัม  วานิ" {{ ($data->BPMec_AssembleRespon === 'นายซัมซัม  วานิ') ? 'selected' : '' }}>นายซัมซัม  วานิ</option>
                                                <!-- <option value="นายมะดารี  สาเยาะ" {{ ($data->BPMec_AssembleRespon === 'นายมะดารี  สาเยาะ') ? 'selected' : '' }}>นายมะดารี  สาเยาะ</option> -->
                                                <option value="นายหัสดิน  เจ๊ะโก๊ะ" {{ ($data->BPMec_AssembleRespon === 'นายหัสดิน  เจ๊ะโก๊ะ') ? 'selected' : '' }}>นายหัสดิน  เจ๊ะโก๊ะ</option>
                                                <option value="นายซาเฟียน  มะแซ" {{ ($data->BPMec_AssembleRespon === 'นายซาเฟียน  มะแซ') ? 'selected' : '' }}>นายซาเฟียน  มะแซ</option>
                                                <option value="นายพิทยา  เลี้ยงพันธุ์สกุล" {{ ($data->BPMec_AssembleRespon === 'นายพิทยา  เลี้ยงพันธุ์สกุล') ? 'selected' : '' }}>นายพิทยา  เลี้ยงพันธุ์สกุล</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                                @if($data->BPMec_PolishDate != null)   {{-- ขัดสี/QC --}}
                                    <tr>
                                        <td class="text-center">
                                        ขัดสี/QC
                                        </td>
                                        <td class="text-center">
                                            {{DateThai($data->BPMec_PolishDate)}}
                                        </td>
                                        <td class="text-center">
                                            @if($data->BPMec_PolishDate != null)
                                                @php
                                                    $Cldate = date_create($data->BPMec_PolishDate);
                                                    $nowCldate = date_create($ifdate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                @endphp
                                                {{$ClDateDiff->format('%a วัน')}}
                                            @else 

                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <select name="BPMecuserpolish" class="form-control text-sm" {{ ($data->BPMec_Status !== 'ขัดสี') ? 'disabled' : '' }}>
                                            <option value="" selected>--- เลือกผู้รับผิดชอบงาน ---</option>
                                                <option value="นายเดวิด  แสงศรี" {{ ($data->BPMec_PolishRespon === 'นายเดวิด  แสงศรี') ? 'selected' : '' }}>นายเดวิด  แสงศรี</option>
                                                <option value="นายวริศ  นิแม" {{ ($data->BPMec_PolishRespon === 'นายวริศ  นิแม') ? 'selected' : '' }}>นายวริศ  นิแม</option>
                                                <option value="นายบาหารี  นิเลาะ" {{ ($data->BPMec_PolishRespon === 'นายบาหารี  นิเลาะ') ? 'selected' : '' }}>นายบาหารี  นิเลาะ</option>
                                                <option value="นายรอมลี  อาแวปาโอะ" {{ ($data->BPMec_PolishRespon === 'นายรอมลี  อาแวปาโอะ') ? 'selected' : '' }}>นายรอมลี  อาแวปาโอะ</option>
                                                <option value="นายประเสริฐ อาแวปาโอะ" {{ ($data->BPMec_PolishRespon === 'นายประเสริฐ อาแวปาโอะ') ? 'selected' : '' }}>นายประเสริฐ อาแวปาโอะ</option>
                                                <option value="นายซัมซัม  วานิ" {{ ($data->BPMec_PolishRespon === 'นายซัมซัม  วานิ') ? 'selected' : '' }}>นายซัมซัม  วานิ</option>
                                                <option value="นายมะดารี  สาเยาะ" {{ ($data->BPMec_PolishRespon === 'นายมะดารี  สาเยาะ') ? 'selected' : '' }}>นายมะดารี  สาเยาะ</option>
                                                <option value="นายหัสดิน  เจ๊ะโก๊ะ" {{ ($data->BPMec_PolishRespon === 'นายหัสดิน  เจ๊ะโก๊ะ') ? 'selected' : '' }}>นายหัสดิน  เจ๊ะโก๊ะ</option>
                                                <option value="นายซาเฟียน  มะแซ" {{ ($data->BPMec_PolishRespon === 'นายซาเฟียน  มะแซ') ? 'selected' : '' }}>นายซาเฟียน  มะแซ</option>
                                                <option value="นายพิทยา  เลี้ยงพันธุ์สกุล" {{ ($data->BPMec_PolishRespon === 'นายพิทยา  เลี้ยงพันธุ์สกุล') ? 'selected' : '' }}>นายพิทยา  เลี้ยงพันธุ์สกุล</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                                @if($data->BPMec_WashDate != null)
                                    <tr>
                                        <td class="text-center">
                                            ส่งล้าง
                                        </td>
                                        <td class="text-center">
                                            {{DateThai($data->BPMec_WashDate)}}
                                        </td>
                                        <td class="text-center">
                                            @if($data->BPMec_WashDate != null)
                                                @php
                                                    $Cldate = date_create($data->BPMec_WashDate);
                                                    $nowCldate = date_create($ifdate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                @endphp
                                                {{$ClDateDiff->format('%a วัน')}}
                                            @else 

                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <select name="BPMecuserwash" class="form-control text-sm" {{ ($data->BPMec_Status !== 'ส่งล้าง') ? 'disabled' : '' }}>
                                            <option value="" selected>--- เลือกผู้รับผิดชอบงาน ---</option>
                                                <option value="นายเดวิด  แสงศรี" {{ ($data->BPMec_WashRespon === 'นายเดวิด  แสงศรี') ? 'selected' : '' }}>นายเดวิด  แสงศรี</option>
                                                <option value="นายวริศ  นิแม" {{ ($data->BPMec_WashRespon === 'นายวริศ  นิแม') ? 'selected' : '' }}>นายวริศ  นิแม</option>
                                                <option value="นายบาหารี  นิเลาะ" {{ ($data->BPMec_WashRespon === 'นายบาหารี  นิเลาะ') ? 'selected' : '' }}>นายบาหารี  นิเลาะ</option>
                                                <option value="นายรอมลี  อาแวปาโอะ" {{ ($data->BPMec_WashRespon === 'นายรอมลี  อาแวปาโอะ') ? 'selected' : '' }}>นายรอมลี  อาแวปาโอะ</option>
                                                <option value="นายประเสริฐ อาแวปาโอะ" {{ ($data->BPMec_WashRespon === 'นายประเสริฐ อาแวปาโอะ') ? 'selected' : '' }}>นายประเสริฐ อาแวปาโอะ</option>
                                                <option value="นายซัมซัม  วานิ" {{ ($data->BPMec_WashRespon === 'นายซัมซัม  วานิ') ? 'selected' : '' }}>นายซัมซัม  วานิ</option>
                                                <option value="นายมะดารี  สาเยาะ" {{ ($data->BPMec_WashRespon === 'นายมะดารี  สาเยาะ') ? 'selected' : '' }}>นายมะดารี  สาเยาะ</option>
                                                <option value="นายหัสดิน  เจ๊ะโก๊ะ" {{ ($data->BPMec_WashRespon === 'นายหัสดิน  เจ๊ะโก๊ะ') ? 'selected' : '' }}>นายหัสดิน  เจ๊ะโก๊ะ</option>
                                                <option value="นายซาเฟียน  มะแซ" {{ ($data->BPMec_WashRespon === 'นายซาเฟียน  มะแซ') ? 'selected' : '' }}>นายซาเฟียน  มะแซ</option>
                                                <option value="นายพิทยา  เลี้ยงพันธุ์สกุล" {{ ($data->BPMec_WashRespon === 'นายพิทยา  เลี้ยงพันธุ์สกุล') ? 'selected' : '' }}>นายพิทยา  เลี้ยงพันธุ์สกุล</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                                @if($data->BPMec_DeliverDate != null)
                                    <tr>
                                        <td class="text-center">
                                            QC ก่อนส่งมอบ
                                        </td>
                                        <td class="text-center">
                                            {{DateThai($data->BPMec_DeliverDate)}}
                                        </td>
                                        <td class="text-center">
                                            @if($data->BPMec_DeliverDate != null)
                                                @php
                                                    $Cldate = date_create($data->BPMec_DeliverDate);
                                                    $nowCldate = date_create($ifdate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                @endphp
                                                {{$ClDateDiff->format('%a วัน')}}
                                            @else 

                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <select name="BPMecuserdeliver" class="form-control text-sm" {{ ($data->BPMec_Status !== 'QC ก่อนส่งมอบ') ? 'disabled' : '' }}>
                                            <option value="" selected>--- เลือกผู้รับผิดชอบงาน ---</option>
                                                <option value="นายเดวิด  แสงศรี" {{ ($data->BPMec_DeliverRespon === 'นายเดวิด  แสงศรี') ? 'selected' : '' }}>นายเดวิด  แสงศรี</option>
                                                <option value="นายวริศ  นิแม" {{ ($data->BPMec_DeliverRespon === 'นายวริศ  นิแม') ? 'selected' : '' }}>นายวริศ  นิแม</option>
                                                <option value="นายบาหารี  นิเลาะ" {{ ($data->BPMec_DeliverRespon === 'นายบาหารี  นิเลาะ') ? 'selected' : '' }}>นายบาหารี  นิเลาะ</option>
                                                <option value="นายรอมลี  อาแวปาโอะ" {{ ($data->BPMec_DeliverRespon === 'นายรอมลี  อาแวปาโอะ') ? 'selected' : '' }}>นายรอมลี  อาแวปาโอะ</option>
                                                <option value="นายประเสริฐ อาแวปาโอะ" {{ ($data->BPMec_DeliverRespon === 'นายประเสริฐ อาแวปาโอะ') ? 'selected' : '' }}>นายประเสริฐ อาแวปาโอะ</option>
                                                <option value="นายซัมซัม  วานิ" {{ ($data->BPMec_DeliverRespon === 'นายซัมซัม  วานิ') ? 'selected' : '' }}>นายซัมซัม  วานิ</option>
                                                <option value="นายมะดารี  สาเยาะ" {{ ($data->BPMec_DeliverRespon === 'นายมะดารี  สาเยาะ') ? 'selected' : '' }}>นายมะดารี  สาเยาะ</option>
                                                <option value="นายหัสดิน  เจ๊ะโก๊ะ" {{ ($data->BPMec_DeliverRespon === 'นายหัสดิน  เจ๊ะโก๊ะ') ? 'selected' : '' }}>นายหัสดิน  เจ๊ะโก๊ะ</option>
                                                <option value="นายซาเฟียน  มะแซ" {{ ($data->BPMec_DeliverRespon === 'นายซาเฟียน  มะแซ') ? 'selected' : '' }}>นายซาเฟียน  มะแซ</option>
                                                <option value="นายพิทยา  เลี้ยงพันธุ์สกุล" {{ ($data->BPMec_DeliverRespon === 'นายพิทยา  เลี้ยงพันธุ์สกุล') ? 'selected' : '' }}>นายพิทยา  เลี้ยงพันธุ์สกุล</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <input type="hidden" name="Mecid" value="{{$data->Cus_id}}"/>
            <input type="hidden" name="Updatetype" value="3"/>
            <input type="hidden" name="BPMecuser" value="{{ auth::user()->name }}"/>
        </form>
    @elseif($type == 10) {{-- ฟอร์มเพิ่มการซ่อม --}}
        <form name="form2" action="{{ route('MasterBP.store') }}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="modal-header bg-info">
                <div class="col text-center">
                    <h5 class="modal-title">
                        <i class="fas fa-gears"></i> 
                        เพิ่มรายการซ่อม
                    </h5>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row mb-1">
                            <label class="col-sm-4 col-form-label text-right text-sm">วันที่เริ่มซ่อม : </label>
                            <div class="col-sm-7">
                                <input type="date" name="BPmechanicdate" value="{{date('Y-m-d')}}" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">สถานะซ่อม : </label>
                            <div class="col-sm-7">
                                <select name="BPMecstatus" class="form-control" required>
                                    <option value="" selected>--- เลือกสถานะซ่อม ---</option>
                                    <option value="ถอดชิ้นส่วนงาน">ถอดชิ้นส่วนงาน</option>
                                    <option value="ซ่อมตัวถัง">ซ่อมตัวถัง</option>
                                    <option value="เตรียมพื้น">เตรียมพื้น</option>
                                    <option value="พ่นสี">พ่นสี</option>
                                    <option value="ประกอบชิ้นส่วน">ประกอบชิ้นส่วน</option>
                                    <option value="ขัดสี/QC">ขัดสี/QC</option>
                                    <option value="ส่งล้าง">ส่งล้าง</option>
                                    <option value="QC ก่อนส่งมอบ">QC ก่อนส่งมอบ</option>
                                    <option value="ปิดงานซ่อม">ปิดงานซ่อม</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">ผู้รับผิดชอบงาน : </label>
                            <div class="col-sm-7">
                                <select name="BPMecrespon" class="form-control text-sm" required>
                                    <option value="" selected>--- เลือกผู้รับผิดชอบงาน ---</option>
                                    <option value="นายเดวิด  แสงศรี">นายเดวิด  แสงศรี</option>
                                    <option value="นายวริศ  นิแม">นายวริศ  นิแม</option>
                                    <option value="นายบาหารี  นิเลาะ">นายบาหารี  นิเลาะ</option>
                                    <option value="นายรอมลี  อาแวปาโอะ">นายรอมลี  อาแวปาโอะ</option>
                                    <option value="นายซัมซัม  วานิ">นายซัมซัม  วานิ</option>
                                    <option value="นายหัสดิน  เจ๊ะโก๊ะ">นายหัสดิน  เจ๊ะโก๊ะ</option>
                                    <option value="นายซาเฟียน  มะแซ">นายซาเฟียน  มะแซ</option>
                                    <option value="นายพิทยา  เลี้ยงพันธุ์สกุล">นายพิทยา  เลี้ยงพันธุ์สกุล</option>
                                    <option value="นายมูฮำหมัดอาบีดิง มะแซ">นายมูฮำหมัดอาบีดิง มะแซ</option>
                                    <option value="นายมูฮำมัด ซาซู">นายมูฮำมัด ซาซู</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">หมายเหตุการซ่อม : </label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="BPMechanicnote" rows="5" placeholder="ป้อนหมายเหตุ..."></textarea>
                            </div>
                        </div>
                    <hr>
                    </div>
                </div>

                <div style="text-align: center;">
                  <button type="submit" class="btn btn-success text-center">บันทึก</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>

                <input type="hidden" name="Storetype" value="5"/>
                <input type="hidden" name="BPCus_id" value="{{ $Cus_id }}"/>
                <input type="hidden" name="BPMecuser" value="{{ auth::user()->name }}"/>
            </div>
        </form>
    @endif
  </section>

  {{-- image --}}
  <script type="text/javascript">
    $("#image-file,#Account_image,#image_checker_1,#image_checker_2").fileinput({
      uploadUrl:"{{ route('MasterBP.store') }}",
      theme:'fa',
      uploadExtraData:function(){
        return{
          _token:"{{csrf_token()}}",
        }
      },
      allowedFileExtensions:['jpg','png','gif'],
      maxFileSize:10240
    })
  </script>