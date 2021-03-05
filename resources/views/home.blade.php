@extends('layouts.master')
@section('title','Home')
@section('content')

<style>
  i:hover {
    color: blue;
  }
</style>

  <div class="content-header">
    <div class="row justify-content-center">
      <div class="col-md-12 table-responsive">
        <div class="card">
      
          <div class="card-header">
            <div class="form-inline">
              <div class="col-sm-4">
                <h4 class="m-0 text-dark">ศูนย์บริการซ่อมตัวถังและสี</h4>
              </div>
              <div class="col-sm-8">
                @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก จัดไฟแนนท์" or auth::user()->type == "แผนก รถบ้าน")
                  <form method="get" action="{{ route('HomeBP.show',0) }}">
                    <div class="float-right">
                      <small class="badge" style="font-size: 14px;">
                        <i class="fas fa-sign"></i> วันที่ :
                        <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: '' }}" class="form-control pr-3" />
                        ถึงวันที่ :
                        <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: '' }}" class="form-control" />&nbsp;
                        <button type="submit" class="btn btn-info" title="ค้นหา">
                          <span class="fas fa-search"></span> ค้นหา
                        </button>
                      </small>
                    </div>
                  </form>
                @endif
              </div>
            </div>
          </div>

            <div class="card-body">

              <div class="row mb-0">
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">งานเคลม ({{$countData + $countDataDone}})</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    @if($countData != 0)
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="chart-responsive">
                            <div id="piechart_3d_Claim" style="width: 100%;height: 410px;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    <div class="card-footer bg-light p-0">
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            งานเคลมทั้งหมด
                            <span class="float-right">
                              {{$countData + $countDataDone}} คัน
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> มาเคลมใหม่
                            <span class="float-right text-red">
                              {{$countNewclaim}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ประกันอนุมัติ
                            <span class="float-right">
                              {{$countAnumat}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> อะไหล่ครบ
                            <span class="float-right">
                              {{$countAlai}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ซ่อมตัวถัง/พื้น
                            <span class="float-right">
                              {{$countTank}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> พ่นสี
                            <span class="float-right">
                              {{$countPaint}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ขัดสี QC ก่อนส่งมอบ
                            <span class="float-right">
                              {{$countpolishQC}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ส่งมอบแล้ว
                            <span class="float-right text-success">
                              {{$countDataDone}}
                            </span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">รถระหว่างซ่อม ({{$countdataMechanic}})</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    @if($countdataMechanic != 0)
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="chart-responsive">
                            <div id="piechart_3d_Mechanic" style="width: 100%;height: 410px;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    <div class="card-footer bg-light p-0">
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            รถระหว่างซ่อมทั้งหมด
                            <span class="float-right">
                              {{$countdataMechanic}} คัน
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ถอดชิ้นส่วนงาน
                            <span class="float-right">
                              {{$countRemoveParts}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ซ่อมตัวถัง
                            <span class="float-right">
                              {{$countRepairTank}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> เตรียมพื้น
                            <span class="float-right">
                              {{$countPrepareBG}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> พ่นสี
                            <span class="float-right">
                              {{$countPaintColor}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ประกอบชิ้นส่วนงาน
                            <span class="float-right">
                              {{$countAssembleParts}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ขัดสี/QC
                            <span class="float-right">
                              {{$countPolishColor}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ส่งล้าง
                            <span class="float-right">
                              {{$countWash}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> QC ก่อนส่งมอบ
                            <span class="float-right">
                              {{$countQCbeforeSend}}
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right text-xs"></i> ปิดงานซ่อม
                            <span class="float-right">
                              {{$countRepairDone}}
                            </span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <!-- /.footer -->
                  </div>
                </div>
                <!-- <div class="col-sm-3">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">รถส่งมอบ</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="chart-responsive">
                            <div id="piechart_3d_Done" style="width: 100%;height: 350px;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer bg-light p-0">
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            รถทั้งหมด
                            <span class="float-right text-danger">
                              <i class="fas fa-arrow-down text-sm"></i>
                              12%</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            ส่งมอบแล้ว
                            <span class="float-right text-success">
                              <i class="fas fa-arrow-up text-sm"></i> 4%
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            กำลังดำเนินการ
                            <span class="float-right text-warning">
                              <i class="fas fa-arrow-left text-sm"></i> 0%
                            </span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div> -->
              </div>

            </div>

        </div>
      </div>
    </div>
  </div>


  <script>
      function blinker() {
      $('.prem').fadeOut(1500);
      $('.prem').fadeIn(1500);
      }
      setInterval(blinker, 1500);
  </script>

  <script>
    function addCommas(nStr){
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 4 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
      return x1 + x2;
    }
    function addcomma(){
      var num11 = document.getElementById('topcar').value;
      var num1 = num11.replace(",","");
      document.form2.topcar.value = addCommas(num1);
    }
  </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['มาเคลมใหม่',{{$countNewclaim}}],
      ['ประกันอนุมัติ',{{$countAnumat}}],
      ['อะไหล่ครบ',{{$countAlai}}],
      ['ซ่อมตัวถัง/พื้น',{{$countTank}}],
      ['พ่นสี', {{$countPaint}}],
      ['ขัดสี QC ก่อนส่งมอบ',{{$countpolishQC}}],
      ['ส่งมอบแล้ว',{{$countDataDone}}],
    ]);

    var options = {
      // title: 'My Daily Activities',
      is3D : true,
      legend :'none',
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_Claim'));
    chart.draw(data, options);
  }
</script>
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ['ถอดชิ้นส่วนงาน',{{$countRemoveParts}},"#b87333"],
        ['ซ่อมตัวถัง',{{$countRepairTank}}, "#b87344"],
        ['เตรียมพื้น',{{$countPrepareBG}}, "#b87355"],
        ['พ่นสี', {{$countPaintColor}}, "#b87366"],
        ['ประกอบชิ้นส่วน',{{$countAssembleParts}}, "#b87377"],
        ['ขัดสี/QC',{{$countPolishColor}}, "#b87388"],
        ['ส่งล้าง',{{$countWash}}, "#b87399"],
        ['QC ก่อนส่งมอบ',{{$countQCbeforeSend}}, "#b87333"],
        ['ปิดงานซ่อม',{{$countRepairDone}}, "#b87333"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        // title: "Density of Precious Metals, in g/cm^3",
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
        is3D : true,
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("piechart_3d_Mechanic"));
      chart.draw(view, options);
  }
  </script>
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['ส่งมอบแล้ว', 11],
      ['กำลังดำเนินการ', 2],
    ]);

    var options = {
      // title: 'My Daily Activities',
      is3D : true,
      legend :'none',
      pieHole: 4,
      slices: {
            0: { color: 'green' },
            1: { color: 'red' }
          }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_Done'));
    chart.draw(data, options);
  }
</script>

@endsection
