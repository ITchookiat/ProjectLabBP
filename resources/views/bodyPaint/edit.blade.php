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
    date_default_timezone_set('Asia/Bangkok');
    $ifdate = date('Y-m-d');
  @endphp

  <link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

  <script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
  
  <style>
    #todo-list{
    width:100%;
    margin:0 auto 50px auto;
    padding:5px;
    background:white;
    position:relative;
    /*box-shadow*/
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
    -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
          box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
    /*border-radius*/
    -webkit-border-radius:5px;
    -moz-border-radius:5px;
          border-radius:5px;}
    #todo-list:before{
    content:"";
    position:absolute;
    z-index:-1;
    /*box-shadow*/
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.4);
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
          box-shadow:0 0 20px rgba(0,0,0,0.4);
    top:50%;
    bottom:0;
    left:10px;
    right:10px;
    /*border-radius*/
    -webkit-border-radius:100px / 10px;
    -moz-border-radius:100px / 10px;
          border-radius:100px / 10px;
    }
    .todo-wrap{
    display:block;
    position:relative;
    padding-left:35px;
    /*box-shadow*/
    -webkit-box-shadow:0 2px 0 -1px #ebebeb;
    -moz-box-shadow:0 2px 0 -1px #ebebeb;
          box-shadow:0 2px 0 -1px #ebebeb;
    }
    .todo-wrap:last-of-type{
    /*box-shadow*/
    -webkit-box-shadow:none;
    -moz-box-shadow:none;
          box-shadow:none;
    }
    input[type="checkbox"]{
    position:absolute;
    height:0;
    width:0;
    opacity:0;
    /* top:-600px; */
    }
    .todo{
    display:inline-block;
    font-weight:200;
    padding:10px 5px;
    height:37px;
    position:relative;
    }
    .todo:before{
    content:'';
    display:block;
    position:absolute;
    top:calc(50% + 10px);
    left:0;
    width:0%;
    height:1px;
    background:#cd4400;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
      -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    }
    .todo:after{
    content:'';
    display:block;
    position:absolute;
    z-index:0;
    height:18px;
    width:18px;
    top:9px;
    left:-25px;
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #d8d8d8;
    -moz-box-shadow:inset 0 0 0 2px #d8d8d8;
          box-shadow:inset 0 0 0 2px #d8d8d8;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
      -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    /*border-radius*/
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
          border-radius:4px;
    }
    .todo:hover:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #949494;
    -moz-box-shadow:inset 0 0 0 2px #949494;
          box-shadow:inset 0 0 0 2px #949494;
    }
    .todo .fa-check{
    position:absolute;
    z-index:1;
    left:-31px;
    top:0;
    font-size:1px;
    line-height:36px;
    width:36px;
    height:36px;
    text-align:center;
    color:transparent;
    text-shadow:1px 1px 0 white, -1px -1px 0 white;
    }
    :checked + .todo{
    color:#717171;
    }
    :checked + .todo:before{
    width:100%;
    }
    :checked + .todo:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #0eb0b7;
    -moz-box-shadow:inset 0 0 0 2px #0eb0b7;
          box-shadow:inset 0 0 0 2px #0eb0b7;
    }
    :checked + .todo .fa-check{
    font-size:20px;
    line-height:35px;
    color:#0eb0b7;
    }
    /* Delete Items */

    .delete-item{
    display:block;
    position:absolute;
    height:36px;
    width:36px;
    line-height:36px;
    right:0;
    top:0;
    text-align:center;
    color:#d8d8d8;
    opacity:0;
    }
    .todo-wrap:hover .delete-item{
    opacity:1;
    }
    .delete-item:hover{
    color:#cd4400;
    }
  </style>

  <style>
    #myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
      width: 150px;
      height: 200px;
    }
    #myImg:hover {opacity: 0.7;}
  </style>

  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <form name="form1" method="post" action="{{ route('MasterBP.update',[$data->BPCus_id]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="form-inline">
                        @if($type == 1)
                          <h5><i class="fas fa-edit"></i> แก้ไขข้อมูล</h5>
                        @endif
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="card-tools d-inline float-right">
                        @if($type == 1)
                          <button type="submit" class="delete-modal btn btn-success btn-sm">
                              <i class="fas fa-save"></i> อัพเดท
                          </button>
                          <a class="delete-modal btn btn-danger btn-sm text-white" href="{{ route('MasterBP.index') }}?type={{1}}">
                              <i class="far fa-window-close"></i> ยกเลิก
                          </a>
                        @elseif($type == 2)
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-mechanic" title="เพิ่มการซ่อม"
                              data-backdrop="static" data-keyboard="false"
                              data-link="{{ route('MasterBP.create')}}?type={{10}}&id={{$data->BPCus_id}}">
                              <i class="fas fa-wrench"></i> เพิ่มการซ่อม
                          </button>
                          <a class="delete-modal btn btn-danger btn-sm text-white" href="{{ route('MasterBP.index') }}?type={{2}}">
                              <i class="far fa-window-close"></i> ยกเลิก
                          </a>
                        @elseif($type == 4)
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-parts" title="เพิ่มอะไหล่"
                              data-backdrop="static" data-keyboard="false"
                              data-link="{{ route('MasterBP.store',[$data->BPCus_id]) }}?type={{3}}">
                              <i class="fas fa-wrench"></i> เพิ่มอะไหล่
                          </button>
                          <a class="delete-modal btn btn-danger btn-sm text-white" href="{{ route('MasterBP.index') }}?type={{4}}">
                              <i class="far fa-window-close"></i> ยกเลิก
                          </a>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body text-sm">
                  
                  <input type="hidden" name="Updatetype" value="1"/>
                  <input type="hidden" name="UserUpdate" value="{{auth::user()->name}}"/>
                  @if($type == 1)
                  <div class="row">
                    <div class="col-12 mb-2">
                      <ol class="breadcrumb float-sm-right text-sm">
                          @if($data->BPCar_carRepair != null)
                            @if($data->BPCar_carFinished == null)
                              <div class="float-right form-inline pr-2 prem">
                                <i class="far fa-clock text-lg pr-1" title="วันที่ซ่อมจริง : {{DateThai($data->BPCar_carRepair)}}"></i>
                                  <label class="text-danger">
                                      {{-- DateThai($data->BPCar_carRepair) --}}
                                        @php
                                            date_default_timezone_set('Asia/Bangkok');
                                            $ifdate = date('Y-m-d');
                                        @endphp
                                        @if($ifdate < $data->BPCar_carRepair)
                                          @php
                                            $Cldate = date_create($data->BPCar_carRepair);
                                            $nowCldate = date_create($ifdate);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                          @endphp
                                          เหลือ {{$ClDateDiff->format('%a วัน')}}
                                        @else
                                          เลยเวลาซ่อมแล้ว
                                        @endif
                                  </label>
                              </div>
                            @endif
                          @endif
                          {{-- ผู้จัดการ --}}
                          <div class="float-right form-inline pr-1">
                            <i class="fas fa-grip-vertical"></i>
                            <span class="todo-wrap">
                              <input type="checkbox" class="checkbox" name="carRepair" id="1" value="{{ date('Y-m-d') }}" {{ ($data->BPCar_carRepair !== NULL) ? 'checked' : '' }}>
                              <label for="1" class="todo">
                                <i class="fa fa-check"></i>
                                <font color="red">ซ่อมจริง</font>
                              </label>
                            </span> 
                          </div>

                          {{-- ผู้จัดการ --}}
                          <div class="float-right form-inline pr-1">
                            <i class="fas fa-grip-vertical"></i>
                            <span class="todo-wrap">
                              <input type="checkbox" class="checkbox" name="carDeliver" id="2" value="{{ date('Y-m-d') }}" {{ ($data->BPCar_carDelivered !== NULL) ? 'checked' : '' }}>
                              <label for="2" class="todo">
                                <i class="fa fa-check"></i>
                                <font color="red">ส่งมอบรถ</font>
                              </label>
                            </span> 
                          </div>

                        {{-- audit --}}
                        <!-- <div class="float-right form-inline">
                          <i class="fas fa-grip-vertical"></i>
                          <span class="todo-wrap">
                              <input type="checkbox" name="AUDIT" id="3" value="{{ auth::user()->name }}"/>
                              <label for="3" class="todo">
                              <i class="fa fa-check"></i>
                              <font color="red">ส่งมอบรถ &nbsp;&nbsp;</font>
                            </label>
                          </span>
                        </div> -->
                        <div class="info-box-content">
                          <div class="form-inline float-right">
                            <small class="badge badge-warning">
                              <i class="fas fa-sign"></i> สถานะ :
                              <select name="BPstatus" class="form-control text-sm">
                                <option value="" selected>--- เลือกสถานะ ---</option>
                                <option value="มาเคลมใหม่" {{ ($data->BPCus_status === 'มาเคลมใหม่') ? 'selected' : '' }}>มาเคลมใหม่</option>
                                <option value="ประกันอนุมัติ" {{ ($data->BPCus_status === 'ประกันอนุมัติ') ? 'selected' : '' }}>ประกันอนุมัติ</option>
                                <option value="อะไหล่ครบ" {{ ($data->BPCus_status === 'อะไหล่ครบ') ? 'selected' : '' }}>อะไหล่ครบ</option>
                                <option value="ซ่อมตัวถัง/พื้น" {{ ($data->BPCus_status === 'ซ่อมตัวถัง/พื้น') ? 'selected' : '' }}>ซ่อมตัวถัง/พื้น</option>
                                <option value="พ่นสี" {{ ($data->BPCus_status === 'พ่นสี') ? 'selected' : '' }}>พ่นสี</option>
                                <option value="ขัดสี QC ก่อนส่งมอบ" {{ ($data->BPCus_status === 'ขัดสี QC ก่อนส่งมอบ') ? 'selected' : '' }}>ขัดสี QC ก่อนส่งมอบ</option>
                              </select>
                            </small>
                          </div>
                        </div>
                      </ol>
                    </div>
                  </div>
                  @endif
                  <div class="card card-blue card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link {{ (request()->is($tab === '6')) ? 'active' : '' }}" href="{{ route('MasterBP.edit',[$data->BPCus_id]) }}?type={{$type}}&tab={{6}}">
                            <i class="fas fa-toggle-on"></i> ข้อมูลหลัก
                          </a>
                        </li>
                        @if($type == 1)
                          <li class="nav-item">
                          <a class="nav-link {{ (request()->is($tab === '1')) ? 'active' : '' }}" href="{{ route('MasterBP.edit',[$data->BPCus_id]) }}?type={{$type}}&tab={{1}}">
                              <i class="fas fa-toggle-on"></i> ประกันอนุมัติ
                            </a>
                          </li>
                          <li class="nav-item">
                          <a class="nav-link {{ (request()->is($tab === '2')) ? 'active' : '' }}" href="{{ route('MasterBP.edit',[$data->BPCus_id]) }}?type={{$type}}&tab={{2}}">
                              <i class="fas fa-toggle-on"></i> อะไหล่ครบ
                            </a>
                          </li>
                          <li class="nav-item">
                          <a class="nav-link {{ (request()->is($tab === '3')) ? 'active' : '' }}" href="{{ route('MasterBP.edit',[$data->BPCus_id]) }}?type={{$type}}&tab={{3}}">
                              <i class="fas fa-toggle-on"></i> ซ่อมตัวถัง/พื้น
                            </a>
                          </li>
                          <li class="nav-item">
                          <a class="nav-link {{ (request()->is($tab === '4')) ? 'active' : '' }}" href="{{ route('MasterBP.edit',[$data->BPCus_id]) }}?type={{$type}}&tab={{4}}">
                              <i class="fas fa-toggle-on"></i> พ่นสี
                            </a>
                          </li>
                          <li class="nav-item">
                          <a class="nav-link {{ (request()->is($tab === '5')) ? 'active' : '' }}" href="{{ route('MasterBP.edit',[$data->BPCus_id]) }}?type={{$type}}&tab={{5}}">
                              <i class="fas fa-toggle-on"></i> ขัดสี QC ก่อนส่งมอบ
                            </a>
                          </li>
                        @endif
                        @if($type == 2)
                          <li class="nav-item">
                            <a class="nav-link {{ (request()->is($tab === '8')) ? 'active' : '' }}" href="{{ route('MasterBP.edit',[$data->BPCus_id]) }}?type={{$type}}&tab={{8}}">
                              <i class="fas fa-gear"></i> รายการซ่อม
                            </a>
                          </li>
                        @endif
                        @if($type == 4)
                          <li class="nav-item">
                            <a class="nav-link {{ (request()->is($tab === '7')) ? 'active' : '' }}" href="{{ route('MasterBP.edit',[$data->BPCus_id]) }}?type={{$type}}&tab={{7}}">
                              <i class="fas fa-wrench"></i> รายการอะไหล่
                            </a>
                          </li>
                        @endif
                      </ul>
                    </div>

                    {{-- เนื้อหา --}}
                    <div class="card-body">
                      <div class="tab-content">
                        {{-- เเท็บ 6 ข้อมูลหลัก --}}
                        <div class="tab-pane fade {{ (request()->is($tab === '6')) ? 'show active' : '' }}" id="Sub-tab6" role="tabpanel" aria-labelledby="Sub-custom-tab6">
                          <div class="row">
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
                                  <label class="col-sm-4 col-form-label text-right"> เลขที่เคลม :</label>
                                  <div class="col-sm-6 mb-1">
                                    <input type="text" name="BPCusclaimNo" class="form-control" placeholder="ป้อนเลขเคลมประกัน" value="{{$data->BPCus_claimNumber}}"/>
                                  </div>
                                  <!-- <a href="#"><i class="fas fa-globe pr-1 fa-1x" style="margin-top:12px;"></i></a> -->
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
                                  <label class="col-sm-3 col-form-label text-right"> สีรถ :</label>
                                  <div class="col-sm-7 mb-1">
                                    <input type="text" name="BPCuscarcolor" class="form-control" placeholder="ป้อนสีรถ" value="{{$data->BPCar_carColor}}"/>
                                  </div>
                                  <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                                  <div class="col-sm-7 mb-1">
                                    <textarea class="form-control" name="BPnote" rows="3" placeholder="ป้อนหมายเหตุ...">{{$data->BPCus_note}}</textarea>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <input type="hidden" class="form-control" name="dateUpdate" value="{{$data->BPCus_dateUpdated}}"/>
        </form>
                          <div class="row">
                            <div class="col-12">
                              <div class="card">
                                  <div class="card-header">
                                    <h5 class="text-center">รูปภาพประกอบ
                                    @if($data->BPCar_regisCar != null and $data->BPCar_carBrand != null and $type == 1)
                                      <button type="button" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#modal-image" title="เพิ่มรูปภาพ"
                                          data-backdrop="static" data-keyboard="false"
                                          data-link="{{ route('MasterBP.create')}}?type={{7}}&id={{$data->BPCus_id}}">
                                          <i class="fas fa-image"></i> เพิ่มรูป
                                      </button>
                                    @endif
                                    </h5>
                                  </div>
                                  <div class="card-body">
                                      <div class="form-inline">
                                      @foreach($dataImage as $images)
                                        <div class="col-sm-3">
                                        @if($type == 1)
                                          <form method="post" class="delete_form float-right" action="{{ route('MasterBP.destroy',[$images->BPImage_id]) }}?deltype={{4}}" style="display:inline;">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <input type="hidden" name="Imagepath" value="{{$data->BPCar_carBrand}}/{{$data->BPCar_regisCar}}/{{$images->BPImage_filename}}" />
                                            <button type="submit" data-name="" class="delete-modal btn btn-danger btn-xs AlertForm " title="ลบรายการ"> 
                                                <i class="fa fa-trash"></i>
                                            </button>
                                          </form>
                                        @endif
                                          <a href="{{ asset('storage/BP-images/'.$data->BPCar_carBrand.'/'.$data->BPCar_regisCar.'/'.$images->BPImage_filename) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true">
                                            <img id="myImg" src="{{ asset('storage/BP-images/'.$data->BPCar_carBrand.'/'.$data->BPCar_regisCar.'/'.$images->BPImage_filename) }}">
                                            <!-- <img id="myImg" src="/public/storage/BP-images/{{$data->BPCar_carBrand}}/{{$data->BPCar_regisCar}}/{{ Session::get('image_new_name') }}"> -->
                                          </a>
                                        </div>
                                      @endforeach
                                      </div>
                                  </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        {{-- เเท็บ 1 --}}
                        <div class="tab-pane fade {{ (request()->is($tab === '1')) ? 'show active' : '' }}" id="Sub-tab1" role="tabpanel" aria-labelledby="Sub-custom-tab1">
                          <div class="row">
                            {{--<div class="col-md-2">
                              <div class="card">
                                <!-- <div class="card-header">
                                  <h3 class="card-title">ประกันอนุมัติ</h3>
                                </div> -->
                                <div class="card-body p-0">
                                  <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                      <a class="nav-link active" id="vert-tabs-01-tab" data-toggle="pill" href="#vert-tabs-01" role="tab" aria-controls="vert-tabs-01" aria-selected="true">
                                        <i class="fas fa-phone"></i> งานโทรแจ้ง
                                          @if($countDataCallClaim != 0)
                                            <span class="badge bg-primary float-right">{{$countDataCallClaim}}</span>
                                          @endif
                                      </a>
                                  </div>
                                </div>
                              </div>
                            </div>--}}
                            <div class="col-md-12">
                              <div class="card card-secondary card-outline">
                                <div class="card-body p-0 text-sm">
                                  <div class="row">
                                    <div class="col-12 col-sm-12">
                                      <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade active show" id="vert-tabs-01" role="tabpanel" aria-labelledby="vert-tabs-01-tab">
                                          <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-grip-vertical"></i> งานโทรแจ้งประกันอนุมัติ</h3>
                                            @if($data->BPCus_status == 'ประกันอนุมัติ')
                                            <button type="button" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#modal-claimphone" title="เพิ่มรายการโทร"
                                                data-backdrop="static" data-keyboard="false"
                                                data-link="{{ route('MasterBP.create')}}?type={{1}}&id={{$data->BPCus_id}}">
                                                <i class="fas fa-phone-square-alt"></i> เพิ่มการโทร
                                            </button>
                                            @endif
                                          </div>
                                          <div class="col-12">
                                            <table class="table table-striped table-valign-middle" id="table1">
                                              <thead>
                                                <tr>
                                                    <th class="text-center">ครั้งที่</th>
                                                    <th class="text-center">วันที่โทร</th>
                                                    <th class="text-center">ผลการโทร</th>
                                                    <th class="text-center">ผู้โทรแจ้ง</th>
                                                    <th class="text-center">หมายเหตุ</th>
                                                    <th class="text-center" style="width:10px">#</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($dataCallClaim as $key => $row)
                                                    <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{DateThai($row->BPCall_date)}}</td>
                                                    <td class="text-center">{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</td>
                                                    <td class="text-center">{{($row->BPCall_usercall != null)?$row->BPCall_usercall:'-'}}</td>
                                                    <td class="text-left">{{($row->BPCall_note != null)?$row->BPCall_note:'-'}}</td>
                                                    <td class="text-center">
                                                        <form method="post" class="delete_form" action="{{ route('MasterBP.destroy',[$row->BPCall_id]) }}?deltype={{2}}&tab={{1}}&calltype={{$row->BPCall_type}}" style="display:inline;">
                                                          {{csrf_field()}}
                                                          <input type="hidden" name="_method" value="DELETE" />
                                                          <button type="submit" data-name="" class="delete-modal btn btn-danger btn-xs AlertForm" title="ลบรายการ">
                                                              <i class="fa fa-trash"></i>
                                                          </button>
                                                        </form>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>     
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- เเท็บ 2 --}}
                        <div class="tab-pane fade {{ (request()->is($tab === '2')) ? 'show active' : '' }}" id="Sub-tab2" role="tabpanel" aria-labelledby="Sub-custom-tab2">
                          <div class="row">
                            {{--<div class="col-md-2">
                              <div class="card">
                                <!-- <div class="card-header">
                                  <h3 class="card-title">ประกันอนุมัติ</h3>
                                </div> -->
                                <div class="card-body p-0">
                                  <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                      <a class="nav-link active" id="vert-tabs-01-tab" data-toggle="pill" href="#vert-tabs-01" role="tab" aria-controls="vert-tabs-01" aria-selected="true">
                                        <i class="fas fa-phone"></i> งานโทรแจ้ง
                                          @if($countDataCallClaim2 != 0)
                                            <span class="badge bg-primary float-right">{{$countDataCallClaim2}}</span>
                                          @endif
                                      </a>
                                  </div>
                                </div>
                              </div>
                            </div>--}}
                            <div class="col-md-12">
                              <div class="card card-secondary card-outline">
                                <div class="card-body p-0 text-sm">
                                  <div class="row">
                                    <div class="col-12 col-sm-12">
                                      <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade active show" id="vert-tabs-01" role="tabpanel" aria-labelledby="vert-tabs-01-tab">
                                          <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-grip-vertical"></i> งานโทรแจ้งอะไหล่ครบ</h3>
                                            @if($data->BPCus_status == 'อะไหล่ครบ')
                                            <button type="button" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#modal-claimphone" title="เพิ่มรายการโทร"
                                                data-backdrop="static" data-keyboard="false"
                                                data-link="{{ route('MasterBP.create')}}?type={{2}}&id={{$data->BPCus_id}}">
                                                <i class="fas fa-phone-square-alt"></i> เพิ่มการโทร
                                            </button>
                                            @endif
                                          </div>
                                          <div class="col-12">
                                            <table class="table table-striped table-valign-middle" id="table1">
                                              <thead>
                                                <tr>
                                                    <th class="text-center">ครั้งที่</th>
                                                    <th class="text-center">วันที่โทร</th>
                                                    <th class="text-center">ผลการโทร</th>
                                                    <th class="text-center">ผู้โทรแจ้ง</th>
                                                    <th class="text-center">หมายเหตุ</th>
                                                    <th class="text-center" style="width:10px">#</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($dataCallClaim2 as $key => $row)
                                                    <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{DateThai($row->BPCall_date)}}</td>
                                                    <td class="text-center">{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</td>
                                                    <td class="text-center">{{($row->BPCall_usercall != null)?$row->BPCall_usercall:'-'}}</td>
                                                    <td class="text-left">{{($row->BPCall_note != null)?$row->BPCall_note:'-'}}</td>
                                                    <td class="text-center">
                                                        <form method="post" class="delete_form" action="{{ route('MasterBP.destroy',[$row->BPCall_id]) }}?deltype={{2}}&tab={{2}}&calltype={{$row->BPCall_type}}" style="display:inline;">
                                                          {{csrf_field()}}
                                                          <input type="hidden" name="_method" value="DELETE" />
                                                          <button type="submit" data-name="" class="delete-modal btn btn-danger btn-xs AlertForm" title="ลบรายการ">
                                                              <i class="fa fa-trash"></i>
                                                          </button>
                                                        </form>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>     
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- เเท็บ 3 --}}
                        <div class="tab-pane fade {{ (request()->is($tab === '3')) ? 'show active' : '' }}" id="Sub-tab3" role="tabpanel" aria-labelledby="Sub-custom-tab3">
                          <div class="row">
                            {{--<div class="col-md-2">
                              <div class="card">
                                <!-- <div class="card-header">
                                  <h3 class="card-title">ประกันอนุมัติ</h3>
                                </div> -->
                                <div class="card-body p-0">
                                  <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                      <a class="nav-link active" id="vert-tabs-01-tab" data-toggle="pill" href="#vert-tabs-01" role="tab" aria-controls="vert-tabs-01" aria-selected="true">
                                        <i class="fas fa-phone"></i> งานโทรแจ้ง
                                          @if($countDataCallClaim3 != 0)
                                            <span class="badge bg-primary float-right">{{$countDataCallClaim3}}</span>
                                          @endif
                                      </a>
                                  </div>
                                </div>
                              </div>
                            </div>--}}
                            <div class="col-md-12">
                              <div class="card card-secondary card-outline">
                                <div class="card-body p-0 text-sm">
                                  <div class="row">
                                    <div class="col-12 col-sm-12">
                                      <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade active show" id="vert-tabs-01" role="tabpanel" aria-labelledby="vert-tabs-01-tab">
                                          <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-grip-vertical"></i> งานโทรแจ้งซ่อมตัวถัง/พื้น</h3>
                                            @if($data->BPCus_status == 'ซ่อมตัวถัง/พื้น')
                                            <button type="button" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#modal-claimphone" title="เพิ่มรายการโทร"
                                                data-backdrop="static" data-keyboard="false"
                                                data-link="{{ route('MasterBP.create')}}?type={{3}}&id={{$data->BPCus_id}}">
                                                <i class="fas fa-phone-square-alt"></i> เพิ่มการโทร
                                            </button>
                                            @endif
                                          </div>
                                          <div class="col-12">
                                            <table class="table table-striped table-valign-middle" id="table1">
                                              <thead>
                                                <tr>
                                                    <th class="text-center">ครั้งที่</th>
                                                    <th class="text-center">วันที่โทร</th>
                                                    <th class="text-center">ผลการโทร</th>
                                                    <!-- <th class="text-center">ผู้โทรแจ้ง</th> -->
                                                    <th class="text-center">หมายเหตุ</th>
                                                    <th class="text-center" style="width:10px">#</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($dataCallClaim3 as $key => $row)
                                                    <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{DateThai($row->BPCall_date)}}</td>
                                                    <td class="text-center">{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</td>
                                                    <!-- <td class="text-center">{{($row->BPCall_usercall != null)?$row->BPCall_usercall:'-'}}</td> -->
                                                    <td class="text-left">{{($row->BPCall_note != null)?$row->BPCall_note:'-'}}</td>
                                                    <td class="text-center">
                                                        <form method="post" class="delete_form" action="{{ route('MasterBP.destroy',[$row->BPCall_id]) }}?deltype={{2}}&tab={{3}}&calltype={{$row->BPCall_type}}" style="display:inline;">
                                                          {{csrf_field()}}
                                                          <input type="hidden" name="_method" value="DELETE" />
                                                          <button type="submit" data-name="" class="delete-modal btn btn-danger btn-xs AlertForm" title="ลบรายการ">
                                                              <i class="fa fa-trash"></i>
                                                          </button>
                                                        </form>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>     
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- เเท็บ 4 --}}
                        <div class="tab-pane fade {{ (request()->is($tab === '4')) ? 'show active' : '' }}" id="Sub-tab4" role="tabpanel" aria-labelledby="Sub-custom-tab4">
                          <div class="row">
                            {{--<div class="col-md-2">
                              <div class="card">
                                <!-- <div class="card-header">
                                  <h3 class="card-title">ประกันอนุมัติ</h3>
                                </div> -->
                                <div class="card-body p-0">
                                  <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                      <a class="nav-link active" id="vert-tabs-01-tab" data-toggle="pill" href="#vert-tabs-01" role="tab" aria-controls="vert-tabs-01" aria-selected="true">
                                        <i class="fas fa-phone"></i> งานโทรแจ้ง
                                          @if($countDataCallClaim4 != 0)
                                            <span class="badge bg-primary float-right">{{$countDataCallClaim4}}</span>
                                          @endif
                                      </a>
                                  </div>
                                </div>
                              </div>
                            </div>--}}
                            <div class="col-md-12">
                              <div class="card card-secondary card-outline">
                                <div class="card-body p-0 text-sm">
                                  <div class="row">
                                    <div class="col-12 col-sm-12">
                                      <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade active show" id="vert-tabs-01" role="tabpanel" aria-labelledby="vert-tabs-01-tab">
                                          <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-grip-vertical"></i> งานโทรแจ้งพ่นสี</h3>
                                            @if($data->BPCus_status == 'พ่นสี')
                                            <button type="button" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#modal-claimphone" title="เพิ่มรายการโทร"
                                                data-backdrop="static" data-keyboard="false"
                                                data-link="{{ route('MasterBP.create')}}?type={{4}}&id={{$data->BPCus_id}}">
                                                <i class="fas fa-phone-square-alt"></i> เพิ่มการโทร
                                            </button>
                                            @endif
                                          </div>
                                          <div class="col-12">
                                            <table class="table table-striped table-valign-middle" id="table1">
                                              <thead>
                                                <tr>
                                                    <th class="text-center">ครั้งที่</th>
                                                    <th class="text-center">วันที่โทร</th>
                                                    <th class="text-center">ผลการโทร</th>
                                                    <!-- <th class="text-center">ผู้โทรแจ้ง</th> -->
                                                    <th class="text-center">หมายเหตุ</th>
                                                    <th class="text-center" style="width:10px">#</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($dataCallClaim4 as $key => $row)
                                                    <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{DateThai($row->BPCall_date)}}</td>
                                                    <td class="text-center">{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</td>
                                                    <!-- <td class="text-center">{{($row->BPCall_usercall != null)?$row->BPCall_usercall:'-'}}</td> -->
                                                    <td class="text-left">{{($row->BPCall_note != null)?$row->BPCall_note:'-'}}</td>
                                                    <td class="text-center">
                                                        <form method="post" class="delete_form" action="{{ route('MasterBP.destroy',[$row->BPCall_id]) }}?deltype={{2}}&tab={{4}}&calltype={{$row->BPCall_type}}" style="display:inline;">
                                                          {{csrf_field()}}
                                                          <input type="hidden" name="_method" value="DELETE" />
                                                          <button type="submit" data-name="" class="delete-modal btn btn-danger btn-xs AlertForm" title="ลบรายการ">
                                                              <i class="fa fa-trash"></i>
                                                          </button>
                                                        </form>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>     
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- เเท็บ 5 --}}
                        <div class="tab-pane fade {{ (request()->is($tab === '5')) ? 'show active' : '' }}" id="Sub-tab5" role="tabpanel" aria-labelledby="Sub-custom-tab5">
                          <div class="row">
                            {{--<div class="col-md-2">
                              <div class="card">
                                <!-- <div class="card-header">
                                  <h3 class="card-title">ประกันอนุมัติ</h3>
                                </div> -->
                                <div class="card-body p-0">
                                  <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                      <a class="nav-link active" id="vert-tabs-01-tab" data-toggle="pill" href="#vert-tabs-01" role="tab" aria-controls="vert-tabs-01" aria-selected="true">
                                        <i class="fas fa-phone"></i> งานโทรแจ้ง
                                          @if($countDataCallClaim5 != 0)
                                            <span class="badge bg-primary float-right">{{$countDataCallClaim5}}</span>
                                          @endif
                                      </a>
                                  </div>
                                </div>
                              </div>
                            </div>--}}
                            <div class="col-md-12">
                              <div class="card card-secondary card-outline">
                                <div class="card-body p-0 text-sm">
                                  <div class="row">
                                    <div class="col-12 col-sm-12">
                                      <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade active show" id="vert-tabs-01" role="tabpanel" aria-labelledby="vert-tabs-01-tab">
                                          <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-grip-vertical"></i> งานโทรแจ้งขัดสี QC ก่อนส่งมอบ</h3>
                                            @if($data->BPCus_status == 'ขัดสี QC ก่อนส่งมอบ')
                                            <button type="button" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#modal-claimphone" title="เพิ่มรายการโทร"
                                                data-backdrop="static" data-keyboard="false"
                                                data-link="{{ route('MasterBP.create')}}?type={{5}}&id={{$data->BPCus_id}}">
                                                <i class="fas fa-phone-square-alt"></i> เพิ่มการโทร
                                            </button>
                                            @endif
                                          </div>
                                          <div class="col-12">
                                            <table class="table table-striped table-valign-middle" id="table1">
                                              <thead>
                                                <tr>
                                                    <th class="text-center">ครั้งที่</th>
                                                    <th class="text-center">วันที่โทร</th>
                                                    <th class="text-center">ผลการโทร</th>
                                                    <!-- <th class="text-center">ผู้โทรแจ้ง</th> -->
                                                    <th class="text-center">หมายเหตุ</th>
                                                    <th class="text-center" style="width:10px">#</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($dataCallClaim5 as $key => $row)
                                                    <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{DateThai($row->BPCall_date)}}</td>
                                                    <td class="text-center">{{($row->BPCall_result != null)?$row->BPCall_result:'-'}}</td>
                                                    <!-- <td class="text-center">{{($row->BPCall_usercall != null)?$row->BPCall_usercall:'-'}}</td> -->
                                                    <td class="text-left">{{($row->BPCall_note != null)?$row->BPCall_note:'-'}}</td>
                                                    <td class="text-center">
                                                        <form method="post" class="delete_form" action="{{ route('MasterBP.destroy',[$row->BPCall_id]) }}?deltype={{2}}&tab={{5}}&calltype={{$row->BPCall_type}}" style="display:inline;">
                                                          {{csrf_field()}}
                                                          <input type="hidden" name="_method" value="DELETE" />
                                                          <button type="submit" data-name="" class="delete-modal btn btn-danger btn-xs AlertForm" title="ลบรายการ">
                                                              <i class="fa fa-trash"></i>
                                                          </button>
                                                        </form>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>     
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- แท็บ 7 --}}
                        <div class="tab-pane fade {{ (request()->is($tab === '7')) ? 'show active' : '' }}" id="Sub-tab7" role="tabpanel" aria-labelledby="Sub-custom-tab7">
                          <div class="row">
                              <div class="col-12">
                                <table class="table table-striped table-valign-middle" id="table2">
                                  <thead style="background-color:#BF989E">
                                  <tr>
                                      <th class="text-center">ลำดับ</th>
                                      <th class="text-center">วันที่</th>
                                      <th class="text-center">เลขที่ใบประเมิณ</th>
                                      <th class="text-center">จำนวน</th>
                                      <th class="text-center">สถานะ</th>
                                      <th class="text-center" style="width:250px">หมายเหตุ</th>
                                      <th class="text-center">ผู้เพิ่มอะไหล่</th>
                                      <th class="text-center" style="width:50px"></th>
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
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit" title="แก้ไขรายการ"
                                              data-backdrop="static" data-keyboard="false"
                                              data-link="{{ route('MasterBP.edit',[$row->BPPart_id]) }}?type={{5}}">
                                              <i class="far fa-edit"></i>
                                            </button>
                                            @if(auth::user()->position == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "SA")
                                            <form method="post" class="delete_form" action="{{ route('MasterBP.destroy',[$row->BPPart_id]) }}?deltype={{3}}" style="display:inline;">
                                              {{csrf_field()}}
                                              <input type="hidden" name="_method" value="DELETE" />
                                              <button type="submit" data-name="" class="delete-modal btn btn-danger btn-xs AlertForm" title="ลบรายการ">
                                                  <i class="fa fa-trash"></i>
                                              </button>
                                            </form>
                                            @endif
                                        </td>
                                        </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                          </div>
                        </div>
                        {{-- แท็บ 8 --}}
                        <div class="tab-pane fade {{ (request()->is($tab === '8')) ? 'show active' : '' }}" id="Sub-tab8" role="tabpanel" aria-labelledby="Sub-custom-tab8">
                          <div class="row">
                              <div class="col-12">
                                  <table class="table table-striped table-valign-middle" id="table3">
                                    <thead style="background-color:#BF989E">
                                        <tr>
                                            <th class="text-center">ลำดับ</th>
                                            <th class="text-center">สถานะซ่อม</th>
                                            <th class="text-center">วันที่เริ่มซ่อม</th>
                                            <th class="text-center">วันที่สิ้นสุดซ่อม</th>
                                            <th class="text-center">ระยะเวลา</th>
                                            <th class="text-center" style="width:250px">หมายเหตุ</th>
                                            <th class="text-center">ผู้รับผิดชอบงาน</th>
                                            <th class="text-center"></th>
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
                                            </td>
                                            <td class="text-left">{{($row->BPMec_Note != null)?$row->BPMec_Note:'-'}}</td>
                                            <td class="text-left"> {{$row->BPMec_UserRespon}}</td>
                                            <td class="text-center">
                                              <form method="post" class="delete_form" action="{{ route('MasterBP.destroy',[$row->BPMec_id]) }}?deltype={{5}}" style="display:inline;">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <button type="submit" data-name="" class="delete-modal btn btn-danger btn-xs AlertForm" title="ลบรายการ">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                              </form>
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <input type="hidden" name="_method" value="PATCH"/>

                  </div>
                </div>
              </div>
            </div>
          </div>

      </section>
    </div>
  </section>

  <!-- pop up เพิ่มอะไหล่ -->
  <form name="form2" action="{{ route('MasterBP.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal fade" id="modal-parts" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <div class="col text-center">
                  <h5 class="modal-title"><i class="fas fa-wrench"></i> เพิ่มรายการอะไหล่</h5>
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
                          <input type="date" name="BPpartdate" class="form-control" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">เลขที่ใบประเมิณ : </label>
                        <div class="col-sm-7">
                          <input type="text" name="BPpartassessment" class="form-control" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">จำนวน : </label>
                        <div class="col-sm-7">
                          <input type="number" name="BPpartquantity" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">ใบอนุมัติประกัน : </label>
                        <div class="col-sm-7">
                          <input type="text" name="BPpartassessmentclaim" class="form-control" />
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
                          <input type="date" name="BPpartdatecome" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">เลขรับโอนอะไหล่ : </label>
                        <div class="col-sm-7">
                        <input type="text" name="BPpartassessmentcome" class="form-control" />
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
                            <option value="อะไหล่มาสด้า">อะไหล่มาสด้า</option>
                            <option value="อะไหล่ฟอร์ด">อะไหล่ฟอร์ด</option>
                          </select>
                        </div>
                        <label class="col-sm-4 col-form-label text-right text-sm">สถานะไหล่ : </label>
                        <div class="col-sm-7">
                          <input type="text" name="BPpartstatus" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label text-right text-sm">หมายเหตุ : </label>
                        <div class="col-sm-7">
                          <textarea class="form-control" name="BPpartnote" rows="3" placeholder="ป้อนหมายเหตุ..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="Storetype" value="3"/>
                  <input type="hidden" name="BPCus_id" value="{{ $data->BPCus_id }}"/>
                  <input type="hidden" name="BPpartuser" value="{{ auth::user()->name }}"/>
                  <hr>
              </div>

              <div style="text-align: center;">
                  <button type="submit" class="btn btn-success text-center">บันทึก</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
              </div>
              <br>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
  </form>

  <!-- pop up โทรแจ้งประกันอนุมัติ -->
    <div class="modal fade" id="modal-claimphone">
      <div class="modal-dialog">
        <div class="modal-content">
          
        </div>
      </div>
    </div>


  <!-- Pop up แก้ไขอะไหล่ -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
      </div>
    </div>
  </div>

  <!-- Pop up เพิ่มรูปภาพ -->
  <div class="modal fade" id="modal-image">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
      </div>
    </div>
  </div>

  <!-- Pop up เพิ่มการซ่อม -->
  <div class="modal fade" id="modal-mechanic">
    <div class="modal-dialog">
      <div class="modal-content">
        
      </div>
    </div>
  </div>

  <script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
    })
  </script>

  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
  </script>

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

  <script>
    $(function () {
      $("#table1,#table2,#table3,#table4,#table5,#table6,#table7,#table08,#table09,#table12,#table33").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "searching" : false,
        "lengthChange": false,
        "order": [[ 0, "asc" ]],
        "pageLength": 5,
      });
    });
  </script>

  <script>
    $(function () {
      $("#modal-claimphone").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-claimphone .modal-content").load(link, function(){
        });
      });
      $("#modal-edit").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-edit .modal-content").load(link, function(){
        });
      });
      $("#modal-image").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-image .modal-content").load(link, function(){
        });
      });
      $("#modal-mechanic").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-mechanic .modal-content").load(link, function(){
        });
      });
    });
  </script>

  <script>
    $('#BPclaimtype').change(function(){
      var valuetype = document.getElementById('BPclaimtype').value;
        if(valuetype == ''){
          $('#BPclaimcompany').hide();
          $('#BPclaimcompanyother').hide();
        }
        else{
          $('#BPclaimcompany').show();
          $('#BPclaimcompanyother').hide();
        }
    });
    $('#BPclaimcompany').change(function(){
      var valuecompany = document.getElementById('BPclaimcompany').value;
        if(valuecompany == 'อื่นๆ'){
          $('#BPclaimcompany').show();
          $('#BPclaimcompanyother').show();
        }else{
          $('#BPclaimcompany').show();
          $('#BPclaimcompanyother').hide();
        }
    });
  </script>

  <script>
    function blinker() {
    $('.prem').fadeOut(2000);
    $('.prem').fadeIn(2000);
    }
    setInterval(blinker, 2000);
  </script>

@endsection
