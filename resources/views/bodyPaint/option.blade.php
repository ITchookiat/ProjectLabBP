@php
    function DateThai($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
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