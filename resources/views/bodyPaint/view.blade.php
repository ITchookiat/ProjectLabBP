@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
  function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    //return "$strDay-$strMonthThai-$strYear";
  }
@endphp

@php
  date_default_timezone_set('Asia/Bangkok');
  $date = date('Y-m-d', strtotime('-1 days'));
@endphp

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $m = date('m');
  $d = date('d');
  $time = date('H:i');
  $date2 = $Y.'-'.$m.'-'.$d;
@endphp

  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <div class="row justify-content-center">
          <div class="col-12 table-responsive">
            <div class="card card-warning">
              <div class="card-header">
                <div class="row">
                    <div class="col-6">
                      <div class="form-inline">
                        <h4>
                          @if($type == 1)
                              <i class="fas fa-gears"></i> รายการลูกค้าเปิด
                          @elseif($type == 2)
                              <i class="fas fa-gears"></i> รายการรถซ่อมจริง
                          @elseif($type == 3)
                              <i class="fas fa-gears"></i> รายการรถส่งมอบ
                          @elseif($type == 4)
                              <i class="fas fa-gears"></i> รายการอะไหล่
                          @endif
                        </h4>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="card-tools d-inline float-right">
                      @if($type == 1)
                        <a class="btn btn-success text-white" data-toggle="modal" data-target="#modal-newcar" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-plus-circle"></i> เพิ่ม
                        </a>
                      @endif
                        <a target="_blank" class="btn bg-primary">
                            <i class="fas fa-file-excel"></i> รายงาน
                        </a>
                      </div>
                    </div>
                </div>
              </div>

              <div class="card-body text-sm">
                @if($type == 1 or $type == 4)
                  <div class="row">
                    <div class="col-md-12">
                      <form method="get" action="{{ route('MasterBP.index') }}">
                        <input type="hidden" name="type" value="1" />                      
                        <div class="info-box-content">
                          <div class="form-inline float-right">
                            <small class="badge badge-warning" style="font-size: 14px;">
                              <i class="fas fa-sign"></i>&nbsp; วันที่ :
                              <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />
                              &nbsp; ถึงวันที่ :
                              <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />&nbsp;
                              <button type="submit" class="btn bg-white" title="ค้นหา">
                                <span class="fas fa-search"></span>
                              </button>
                            </small>
                          </div>
                        </div>
                      </form>
                      <br><br><hr>
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead class="bg-gray-light" >
                              <tr>
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center">ชื่อ-สกุล</th>
                                <th class="text-center">เบอร์ติดต่อ</th>
                                <th class="text-center">ป้ายทะเบียน</th>
                                <th class="text-center">ชนิดงาน</th>
                                <!-- <th class="text-center">บริษัทประกัน</th> -->
                                <th class="text-center">หมายเหตุ</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center" width="100px">การจัดการ</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                <tr>
                                  <td class="text-center"> 
                                    {{ $key + 1 }} 
                                    @if($row->BPMec_Status != null)
                                      @if($row->BPMec_Status != 'QC ก่อนส่งมอบ')
                                        <i class="fas fa-wrench text-xs text-red pr-1 prem"></i>
                                      @endif
                                    @endif
                                  </td>
                                  <td class="text-left"> {{ $row->BPCus_name}} </td>
                                  <td class="text-center"> {{ $row->BPCus_phone}} </td>
                                  <td class="text-center"> {{ $row->BPCar_regisCar}} </td>
                                  <td class="text-center"> {{ $row->BPCus_claimLevel}} </td>
                                  <!-- <td class="text-center">
                                   @if($row->BPCus_claimCompany == 'อื่นๆ') 
                                    {{ $row->BPCus_claimCompanyother}}
                                   @else
                                    {{ $row->BPCus_claimCompany}}
                                   @endif 
                                  </td> -->
                                  <td class="text-left">{{($row->BPCus_note != null)?$row->BPCus_note:'-'}}</td>
                                  <td class="text-center">
                                    @if($row->BPCar_carDelivered == null)
                                      <span class="btn btn-xs bg-navy text-xs">{{ $row->BPCus_status}}</span>
                                    @else
                                      <span class="btn btn-xs bg-success text-xs">ส่งมอบรถ</span>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    @if($type == 1)
                                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-view" title="ดูรายการ"
                                        data-backdrop="static" data-keyboard="false"
                                        data-link="{{ route('MasterBP.show',[$row->Cus_id]) }}?type={{1}}">
                                        <i class="far fa-eye"></i>
                                      </button>
                                      @if(auth::user()->position == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "SA")
                                        <a href="{{ route('MasterBP.edit',[$row->Cus_id]) }}?type={{1}}&tab={{6}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                        <form method="post" class="delete_form" action="{{ route('MasterBP.destroy',[$row->Cus_id]) }}?deltype={{1}}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->BPCar_regisCar }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @elseif($type == 4)
                                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-view" title="ดูรายการ"
                                        data-backdrop="static" data-keyboard="false"
                                        data-link="{{ route('MasterBP.show',[$row->Cus_id]) }}?type={{4}}">
                                        <i class="far fa-eye"></i>
                                      </button>
                                      @if(auth::user()->position == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "STAFF")
                                        <a href="{{ route('MasterBP.edit',[$row->Cus_id]) }}?type={{4}}&tab={{6}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                @elseif($type == 2) {{-- รายการซ่อมจริง --}}
                  <div class="row">
                    <div class="col-md-12">
                        <form method="get" action="{{ route('MasterBP.index') }}">
                          <input type="hidden" name="type" value="1" />                      
                          <div class="info-box-content">
                            <div class="form-inline float-right">
                              <small class="badge badge-warning" style="font-size: 14px;">
                                <i class="fas fa-sign"></i>&nbsp; วันที่ :
                                <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />
                                &nbsp; ถึงวันที่ :
                                <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />&nbsp;
                                <button type="submit" class="btn bg-white" title="ค้นหา">
                                  <span class="fas fa-search"></span>
                                </button>
                              </small>
                            </div>
                          </div>
                        </form>
                        <br><br><hr>
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead class="bg-gray-light" >
                              <tr>
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center">แจ้งเตือน</th>
                                <th class="text-center">ชื่อ-สกุล</th>
                                <th class="text-center">ป้ายทะเบียน</th>
                                <th class="text-center">ชนิดงาน</th>
                                <th class="text-center">หมายเหตุ</th>
                                <th class="text-center">สถานะเคลม</th>
                                <th class="text-center">สถานะซ่อม</th>
                                <th class="text-center" width="30px">#</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                <tr>
                                  <td class="text-center"> {{ $key + 1 }} </td>
                                  <td class="text-center">
                                    @if($row->BPCar_carRepair != null)
                                      <div class="form-inline pr-2">
                                        <i class="far fa-clock text-lg pr-1" title="วันที่ซ่อมจริง : {{DateThai($row->BPCar_carRepair)}}"></i>
                                          <label class="text-danger">
                                            @if($row->BPCar_carFinished != null)
                                              {{-- DateThai($row->BPCar_carRepair) --}}
                                                @php
                                                    date_default_timezone_set('Asia/Bangkok');
                                                    $ifdate = date('Y-m-d');
                                                @endphp
                                                @if($ifdate < $row->BPCar_carFinished)
                                                  @php
                                                    $Cldate = date_create($row->BPCar_carFinished);
                                                    $nowCldate = date_create($ifdate);
                                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                                  @endphp
                                                  เหลือ {{$ClDateDiff->format('%a วัน')}}
                                                @else
                                                  เลยเวลาซ่อมแล้ว
                                                @endif
                                            @endif
                                          </label>
                                      </div>
                                    @endif
                                  </td>
                                  <td class="text-left"> {{ $row->BPCus_name}} </td>
                                  <td class="text-center"> {{ $row->BPCar_regisCar}} </td>
                                  <td class="text-center"> {{ $row->BPCus_claimLevel}} </td>
                                  <td class="text-left">{{($row->BPCus_note != null)?$row->BPCus_note:'-'}}</td>
                                  <td class="text-center">
                                    @if($row->BPCar_carDelivered == null)
                                      <span class="btn btn-xs bg-navy text-xs">{{ $row->BPCus_status}}</span>
                                    @else
                                      <span class="btn btn-xs bg-success text-xs">ส่งมอบรถ</span>
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    <span class="btn btn-xs bg-danger text-xs">{{($row->BPMec_Status != null)?$row->BPMec_Status:'-'}}</span>
                                  </div>
                                  <td class="text-right">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit" title="แก้ไขรายการ"
                                      data-backdrop="static" data-keyboard="false"
                                      data-link="{{ route('MasterBP.show',[$row->Cus_id]) }}?type={{2}}">
                                      <i class="far fa-edit"></i>
                                    </button>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                @elseif($type == 3) {{-- รายการส่งมอบ --}}
                  <div class="row">
                    <div class="col-md-12">
                      <form method="get" action="{{ route('MasterBP.index') }}">
                        <input type="hidden" name="type" value="1" />                      
                        <div class="info-box-content">
                          <div class="form-inline float-right">
                            <small class="badge badge-warning" style="font-size: 14px;">
                              <i class="fas fa-sign"></i>&nbsp; วันที่ :
                              <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />
                              &nbsp; ถึงวันที่ :
                              <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />&nbsp;
                              <button type="submit" class="btn bg-white" title="ค้นหา">
                                <span class="fas fa-search"></span>
                              </button>
                            </small>
                          </div>
                        </div>
                      </form>
                      <br><br><hr>
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead class="bg-gray-light" >
                              <tr>
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center">วันที่ส่งมอบ</th>
                                <th class="text-center">ชื่อ-สกุล</th>
                                <th class="text-center">ป้ายทะเบียน</th>
                                <th class="text-center">ชนิดงาน</th>
                                <th class="text-center">หมายเหตุ</th>
                                <th class="text-center">สถานะ</th>
                                <!-- <th class="text-center" width="30px">#</th> -->
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                <tr>
                                  <td class="text-center"> {{ $key + 1 }} </td>
                                  <td class="text-center text-success"> {{ DateThai($row->BPCar_carDelivered) }} </td>
                                  <td class="text-left"> {{ $row->BPCus_name}} </td>
                                  <td class="text-center"> {{ $row->BPCar_regisCar}} </td>
                                  <td class="text-center"> {{ $row->BPCus_claimLevel}} </td>
                                  <td class="text-left">{{($row->BPCus_note != null)?$row->BPCus_note:'-'}}</td>
                                  <td class="text-center">
                                    @if($row->BPCar_carDelivered == null)
                                      <span class="btn btn-xs bg-navy text-xs">{{ $row->BPCus_status}}</span>
                                    @else
                                      <span class="btn btn-xs bg-success text-xs">ส่งมอบรถ</span>
                                    @endif
                                  </td>
                                  <!-- <td class="text-right">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit" title="แก้ไขรายการ"
                                      data-backdrop="static" data-keyboard="false"
                                      data-link="{{ route('MasterBP.show',[$row->Cus_id]) }}?type={{2}}">
                                      <i class="far fa-edit"></i>
                                    </button>
                                  </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                @endif
                <a id="button"></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table,#table1').DataTable( {
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "lengthChange": true,
        "order": [[ 0, "asc" ]]
      });
    });
  </script>

  {{-- button-to-top --}}
  <script>
    var btn = $('#button');

    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
  </script>
  
  <script type="text/javascript">
    $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
    $(".alert").alert('close');
    });
  </script>

  <script>
    $(function () {
      $("#modal-view").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-view .modal-content").load(link, function(){
        });
      });
      $("#modal-edit").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-edit .modal-content").load(link, function(){
        });
      });
    });
  </script>

  <!-- Add new list -->
  <form name="form2" action="{{ route('MasterBP.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="type" value="1"/>
      <div class="modal fade" id="modal-newcar" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-success">
                <div class="col text-center">
                  <h5 class="modal-title"><i class="fas fa-plus"></i> เพิ่มรายการใหม่</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label text-right"><font color="red">* ชื่อ-สกุล :</font> </label>
                        <div class="col-sm-7">
                          <input type="text" name="BPCusname" class="form-control" placeholder="ป้อนชื่อสกุล" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right"><font color="red">** เบอร์ติดต่อ :</font> </label>
                        <div class="col-sm-7">
                          <input type="text" name="BPCusphone" class="form-control" placeholder="ป้อนเบอร์ติดต่อ" required/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-5 col-form-label text-right">ป้ายทะเบียน : </label>
                        <div class="col-sm-7">
                          <input type="text" name="BPCusregiscar" class="form-control" placeholder="ป้อนป้ายทะเบียน" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">ชนิดงาน : </label>
                        <div class="col-sm-7">
                          <select id="BPclaimlevel" name="BPclaimlevel" class="form-control">
                            <option value="" selected>--- เลือกชนิดงาน ---</option>
                            <option value="เบา">เบา</option>
                            <option value="กลาง">กลาง</option>
                            <option value="หนัก">หนัก</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-5 col-form-label text-right">ประเภทประกัน :</label>
                        <div class="col-sm-7">
                          <select id="BPclaimtype" name="BPclaimtype" class="form-control">
                            <option value="" selected>--- เลือกประเภทประกัน ---</option>
                            <option value="MPI">MPI</option>
                            <option value="Non MPI">Non MPI</option>
                            <!-- <option value="3">3</option> -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">บริษัทประกัน :</label>
                        <div class="col-sm-7">
                          <input type="text" id="BPclaimcompanyshow" class="form-control" placeholder="บริษัทประกัน" readonly/>
                          <select id="BPclaimcompany" name="BPclaimcompany" class="form-control">
                            <option value="" selected>--- เลือกบริษัทประกัน ---</option>
                            <option value="วิริยะประกันภัย">วิริยะประกันภัย</option>
                            <option value="ธนชาตประกันภัย">ธนชาตประกันภัย</option>
                            <option value="กรุงเทพประกันภัย">กรุงเทพประกันภัย</option>
                            <option value="เมืองไทยประกันภัย">เมืองไทยประกันภัย</option>
                            <option value="สินมั่นคงประกันภัย">สินมั่นคงประกันภัย</option>
                            <option value="ทิพยประกันภัย">ทิพยประกันภัย</option>
                            <option value="ประกันภัยไทยวิวัฒน์">ประกันภัยไทยวิวัฒน์</option>
                            <option value="มิตซุย สุมิโตโม อินชัวรันซ์">มิตซุย สุมิโตโม อินชัวรันซ์</option>
                            <option value="ไทยศรีประกันภัย">ไทยศรีประกันภัย</option>
                            <option value="สินทรัพย์ประกันภัย">สินทรัพย์ประกันภัย</option>
                            <option value="อาคเนย์ประกันภัย">อาคเนย์ประกันภัย</option>
                            <option value="แอลเอ็มจีประกันภัย">แอลเอ็มจีประกันภัย</option>
                            <option value="คุ้มภัยโตเกียวมารีนประกันภัย">คุ้มภัยโตเกียวมารีนประกันภัย</option>
                            <option value="มิตรแท้ประกันภัย">มิตรแท้ประกันภัย</option>
                            <option value="เอเชียประกันภัย">เอเชียประกันภัย</option>
                            <option value="เทเวศประกันภัย">เทเวศประกันภัย</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                          </select>
                          <input type="text" id="BPclaimcompanyother" name="BPclaimcompanyother" class="form-control" placeholder="ป้อนบริษัทประกัน"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-10">
                      <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" name="BPnote" rows="5" placeholder="ป้อนหมายเหตุ..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="Storetype" value="1"/>
                  <input type="hidden" name="BPuser" value="{{auth::user()->name}}"/>
                  <hr>
              </div>

              <script>
                $('#BPclaimcompany').hide();
                $('#BPclaimcompanyother').hide();
                $('#BPclaimtype').change(function(){
                  var valuetype = document.getElementById('BPclaimtype').value;
                    if(valuetype == ''){
                      $('#BPclaimcompanyshow').show();
                      $('#BPclaimcompany').hide();
                      $('#BPclaimcompanyother').hide();
                    }
                    else{
                      $('#BPclaimcompanyshow').hide();
                      $('#BPclaimcompany').show();
                      $('#BPclaimcompanyother').hide();
                    }
                });
                $('#BPclaimcompany').change(function(){
                  var valuecompany = document.getElementById('BPclaimcompany').value;
                      if(valuecompany == 'อื่นๆ'){
                        $('#BPclaimcompanyshow').hide();
                        $('#BPclaimcompany').show();
                        $('#BPclaimcompanyother').show();
                      }else{
                        $('#BPclaimcompanyshow').hide();
                        $('#BPclaimcompany').show();
                        $('#BPclaimcompanyother').hide();
                      }
                });
              </script>

              <div style="text-align: center;">
                  <button type="submit" class="btn btn-success text-center"><i class="fas fa-save"></i> บันทึก</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> ยกเลิก</button>
              </div>
              <br>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
  </form>

   <!-- Pop up รายละเอียด -->
   <div class="modal fade" id="modal-view">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        
      </div>
    </div>
  </div>

  <!-- Pop up รายการส่วนของช่าง -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        
      </div>
    </div>
  </div>
@endsection
