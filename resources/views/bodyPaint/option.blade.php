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
                        <select id="BPcallresult" name="BPcallresult" class="form-control">
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
                    <div class="form-group row mb-5">
                        <label class="col-sm-4 col-form-label text-right"> ชื่อ-สกุล :</label>
                        <div class="col-sm-6 mb-1">
                        <input type="text" name="BPCusname" class="form-control" placeholder="ป้อนชื่อสกุล" value="{{$data->BPCus_name}}"/>
                        </div>
                        <label class="col-sm-4 col-form-label text-right"> เบอร์ติดต่อ :</label>
                        <div class="col-sm-6 mb-1">
                        <input type="text" name="BPCusphone" class="form-control" placeholder="ป้อนเบอร์ติดต่อ" value="{{$data->BPCus_phone}}"/>
                        </div>
                        <label class="col-sm-4 col-form-label text-right">ชนิดงาน : </label>
                        <div class="col-sm-6 mb-1">
                        <select id="BPclaimlevel" name="BPclaimlevel" class="form-control">
                            <option value="" selected>--- เลือกชนิดงาน ---</option>
                            <option value="เบา" {{ ($data->BPCus_claimLevel === 'เบา') ? 'selected' : '' }}>เบา</option>
                            <option value="กลาง" {{ ($data->BPCus_claimLevel === 'กลาง') ? 'selected' : '' }}>กลาง</option>
                            <option value="หนัก" {{ ($data->BPCus_claimLevel === 'หนัก') ? 'selected' : '' }}>หนัก</option>
                        </select>
                        </div>
                        <label class="col-sm-4 col-form-label text-right">ประเภทประกัน :</label>
                        <div class="col-sm-6 mb-1">
                        <select id="BPclaimtype" name="BPclaimtype" class="form-control">
                            <option value="" selected>--- เลือกประเภทประกัน ---</option>
                            <option value="MPI" {{ ($data->BPCus_claimType === 'MPI') ? 'selected' : '' }}>MPI</option>
                            <option value="Non MPI" {{ ($data->BPCus_claimType === 'Non MPI') ? 'selected' : '' }}>Non MPI</option>
                        </select>
                        </div>
                        <label class="col-sm-4 col-form-label text-right">บริษัทประกัน :</label>
                        <div class="col-sm-6 mb-1">
                        <select id="BPclaimcompany" name="BPclaimcompany" class="form-control">
                            <option value="" selected>--- เลือกบริษัทประกัน ---</option>
                            <option value="วิริยะประกันภัย" {{ ($data->BPCus_claimCompany === 'วิริยะประกันภัย') ? 'selected' : '' }}>วิริยะประกันภัย</option>
                            <option value="ธนชาตประกันภัย" {{ ($data->BPCus_claimCompany === 'ธนชาตประกันภัย') ? 'selected' : '' }}>ธนชาตประกันภัย</option>
                            <option value="กรุงเทพประกันภัย" {{ ($data->BPCus_claimCompany === 'กรุงเทพประกันภัย') ? 'selected' : '' }}>กรุงเทพประกันภัย</option>
                            <option value="เมืองไทยประกันภัย" {{ ($data->BPCus_claimCompany === 'เมืองไทยประกันภัย') ? 'selected' : '' }}>เมืองไทยประกันภัย</option>
                            <option value="สินมั่นคงประกันภัย" {{ ($data->BPCus_claimCompany === 'สินมั่นคงประกันภัย') ? 'selected' : '' }}>สินมั่นคงประกันภัย</option>
                            <option value="ทิพยประกันภัย" {{ ($data->BPCus_claimCompany === 'ทิพยประกันภัย') ? 'selected' : '' }}>ทิพยประกันภัย</option>
                            <option value="ประกันภัยไทยวิวัฒน์" {{ ($data->BPCus_claimCompany === 'ประกันภัยไทยวิวัฒน์') ? 'selected' : '' }}>ประกันภัยไทยวิวัฒน์</option>
                            <option value="มิตซุย สุมิโตโม อินชัวรันซ์" {{ ($data->BPCus_claimCompany === 'มิตซุย สุมิโตโม อินชัวรันซ์') ? 'selected' : '' }}>มิตซุย สุมิโตโม อินชัวรันซ์</option>
                            <option value="ไทยศรีประกันภัย" {{ ($data->BPCus_claimCompany === 'ไทยศรีประกันภัย') ? 'selected' : '' }}>ไทยศรีประกันภัย</option>
                            <option value="สินทรัพย์ประกันภัย" {{ ($data->BPCus_claimCompany === 'สินทรัพย์ประกันภัย') ? 'selected' : '' }}>สินทรัพย์ประกันภัย</option>
                            <option value="อาคเนย์ประกันภัย" {{ ($data->BPCus_claimCompany === 'อาคเนย์ประกันภัย') ? 'selected' : '' }}>อาคเนย์ประกันภัย</option>
                            <option value="แอลเอ็มจีประกันภัย" {{ ($data->BPCus_claimCompany === 'แอลเอ็มจีประกันภัย') ? 'selected' : '' }}>แอลเอ็มจีประกันภัย</option>
                            <option value="คุ้มภัยโตเกียวมารีนประกันภัย" {{ ($data->BPCus_claimCompany === 'คุ้มภัยโตเกียวมารีนประกันภัย') ? 'selected' : '' }}>คุ้มภัยโตเกียวมารีนประกันภัย</option>
                            <option value="มิตรแท้ประกันภัย" {{ ($data->BPCus_claimCompany === 'มิตรแท้ประกันภัย') ? 'selected' : '' }}>มิตรแท้ประกันภัย</option>
                            <option value="เอเชียประกันภัย" {{ ($data->BPCus_claimCompany === 'เอเชียประกันภัย') ? 'selected' : '' }}>เอเชียประกันภัย</option>
                            <option value="เทเวศประกันภัย" {{ ($data->BPCus_claimCompany === 'เทเวศประกันภัย') ? 'selected' : '' }}>เทเวศประกันภัย</option>
                            <option value="อื่นๆ" {{ ($data->BPCus_claimCompany === 'อื่นๆ') ? 'selected' : '' }}>อื่นๆ</option>
                        </select>
                        @if($data->BPCus_claimCompany === 'อื่นๆ')
                            <input type="text" id="BPclaimcompanyother" name="BPclaimcompanyother" class="form-control" placeholder="ป้อนบริษัทประกัน" value="{{$data->BPCus_claimCompanyother}}"/>
                        @else
                            <input type="text" id="BPclaimcompanyother" name="BPclaimcompanyother" class="form-control" placeholder="ป้อนบริษัทประกัน" value="{{$data->BPCus_claimCompanyother}}" style="display:none"/>
                        @endif
                        </div>
                        <label class="col-sm-4 col-form-label text-right"> เลขเคลมประกัน :</label>
                        <div class="col-sm-6 mb-1">
                        <input type="text" name="BPCusclaimNo" class="form-control" placeholder="ป้อนเลขเคลมประกัน" value="{{$data->BPCus_claimNumber}}"/>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">ป้ายทะเบียน : </label>
                        <div class="col-sm-7 mb-1">
                        <input type="text" name="BPCusregiscar" class="form-control" placeholder="ป้อนป้ายทะเบียน" value="{{$data->BPCar_regisCar}}"/>
                        </div>
                        <label class="col-sm-3 col-form-label text-right"> ยี่ห้อรถ :</label>
                        <div class="col-sm-7 mb-1">
                        <input type="text" name="BPCuscarbrand" class="form-control" placeholder="ป้อนยี่ห้อรถ" value="{{$data->BPCar_carBrand}}"/>
                        </div>
                        <label class="col-sm-3 col-form-label text-right"> รุ่นรถ :</label>
                        <div class="col-sm-7 mb-1">
                        <input type="text" name="BPCuscarmodel" class="form-control" placeholder="ป้อนรุ่นรถ" value="{{$data->BPCar_carModel}}"/>
                        </div>
                        <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                        <div class="col-sm-7 mb-1">
                        <textarea class="form-control" name="BPnote" rows="3" placeholder="ป้อนหมายเหตุ...">{{$data->BPCus_note}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h5 class="text-center"><i class="fas fa-phone-square-alt"></i> รายการโทรแจ้ง
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-inline">
                                <table class="table table-bordered table-hover" id="table">
                                    <thead class="bg-gray-light" >
                                        <tr>
                                            <th class="text-center">ประกันอนุมัติ</th>
                                            <th class="text-center">อะไหล่ครบ</th>
                                            <th class="text-center">ซ่อมตัวถัง/พื้น</th>
                                            <th class="text-center">พ่นสี</th>
                                            <th class="text-center">ขัดสี QC ก่อนส่งมอบ</th>
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
        </div>
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