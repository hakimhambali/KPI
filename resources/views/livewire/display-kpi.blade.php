@section('content')
  @extends('layouts.app')

  <style>
  .table-responsive {
    // Other values...
    overflow-x: hidden;
    overflow-y: hidden;
    // Other values...
  }
  .solid {
    border-style: solid;
  }
  .box {
  width: 250px;
  }
  .box2 {
  width: 100px;
  }
  </style>

  <body>


{{------------------------------------------- Start Testing ---------------------------------------}}  
  <div class="container-fluid py-4">
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('message') }}</strong>
    </div>	
    @endif

    @if (session('fail'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('fail') }}</strong>
    </div>	
    @endif

    @if (session('fail2'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('fail2') }}</strong>
    </div>	
    @endif
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>KAD SKOR 2021 - KPI</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center justify-content-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fungsi
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Objektif KPI</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Metrik / Bukti</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">Link Bukti</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">%</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">Ukuran</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-5">KPI Target</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">Skor KPI</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">Skor Sebenar</th>
                  </tr>
                </thead>
                <tbody>
                  @php($i = 1)
                  @foreach ($kadskor as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td>
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                        <td>    
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                        </td>
                      @endif
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                        </td>
                      @if ($key == 0)
                        <td class="align-middle text-center">
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td class="align-middle text-center mt-2">
                          @if ((($kpis->kpimasters->pencapaian)*100) >= 100)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 90)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 80)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 70)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 60)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 50)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 40)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 30)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 20)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) <= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) == 00)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                        <td class="align-middle text-center">
                          <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value=""></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($kewangan as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td>
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                        <td>    
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                        </td>
                      @endif
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                        </td>
                      @if ($key == 0)
                        <td class="align-middle text-center">
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td class="align-middle text-center mt-2">
                          @if ((($kpis->kpimasters->pencapaian)*100) >= 100)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 90)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 80)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 70)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 60)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 50)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 40)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 30)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 20)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) <= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) == 00)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                        <td class="align-middle text-center">
                          <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value=""></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($pelangganI as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td>
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                        <td>    
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                        </td>
                      @endif
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                        </td>
                      @if ($key == 0)
                        <td class="align-middle text-center">
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td class="align-middle text-center mt-2">
                          @if ((($kpis->kpimasters->pencapaian)*100) >= 100)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 90)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 80)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 70)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 60)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 50)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 40)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 30)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 20)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) <= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) == 00)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                        <td class="align-middle text-center">
                          <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value=""></span>
                        </td>  
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($pelangganII as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td>
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                        <td>    
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                        </td>
                      @endif
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                        </td>
                      @if ($key == 0)
                        <td class="align-middle text-center">
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td class="align-middle text-center mt-2">
                          @if ((($kpis->kpimasters->pencapaian)*100) >= 100)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 90)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 80)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 70)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 60)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 50)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 40)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 30)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 20)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) <= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) == 00)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                        <td class="align-middle text-center">
                          <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value=""></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($kecemerlangan as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td>
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}"></p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}"></span>
                        </td>
                      @endif
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                        </td>
                      @if ($key == 0)
                        <td class="align-middle text-center">
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td class="align-middle text-center mt-2">
                          @if ((($kpis->kpimasters->pencapaian)*100) >= 100)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 90)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 80)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 70)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 60)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 50)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 40)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 30)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 20)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) <= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) == 00)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                        <td class="align-middle text-center">
                          <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value=""></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}"></span>
                        </td>  
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}"></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}"></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}"></span>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($training as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td>
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                        <td>    
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                        </td>
                      @endif
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                        </td>
                      @if ($key == 0)
                        <td class="align-middle text-center">
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td class="align-middle text-center mt-2">
                          @if ((($kpis->kpimasters->pencapaian)*100) >= 100)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 90)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 80)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 70)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 60)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 50)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 40)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 30)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 20)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) <= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) == 00)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                        <td class="align-middle text-center">
                          <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value=""></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($ncr as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td>
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                        <td>    
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                        </td>
                      @endif
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                        </td>
                      @if ($key == 0)
                        <td class="align-middle text-center">
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td class="align-middle text-center mt-2">
                          @if ((($kpis->kpimasters->pencapaian)*100) >= 100)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 90)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 80)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 70)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 60)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 50)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 40)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 30)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 20)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) <= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) == 00)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                        <td class="align-middle text-center">
                          <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value=""></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($kolaborasi as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td>
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                        <td>    
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                        </td>
                      @endif
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                        </td>
                      @if ($key == 0)
                        <td class="align-middle text-center">
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td class="align-middle text-center mt-2">
                          @if ((($kpis->kpimasters->pencapaian)*100) >= 100)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 90)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 80)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 70)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 60)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 50)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 40)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 30)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 20)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) >= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) <= 10)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;"></div>
                            </div>
                          @elseif((($kpis->kpimasters->pencapaian)*100) == 00)
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                        <td class="align-middle text-center">
                          <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value=""></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                  <tr>
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
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>KAD SKOR 2021 - Kecekapan Teras</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kecekapan Teras</th>
                    <th class="text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jangkaan Hasil</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-12">&</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Skor Pekerja</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Skor Penyelia</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Skor Sebenar</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kecekapan as $key => $kecekapans)
                    <tr>
                      <td>
                        <div class="d-flex px-3 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <p class="mb-0 text-sm box" value="{{ $kecekapans -> kecekapan_teras }}">{{ $kecekapans->kecekapan_teras }}</p>
                          </div>
                        </div>
                      </td>

                      @if ($kecekapans -> kecekapan_teras == "Kepimpinan Organisasi")
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          Pekerja yang sedar dan menyesuaikan diri dengan strategi organisasi
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi
                          <br>
                          Pengurus yang dapat mengembangkan dan memperkasakan pekerja bawahannya
                          <br>
                          Budaya organisasi yang mencerminkan nilainya
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi
                        </p>
                      </td>
                      @else
                      @endif

                      @if ($kecekapans -> kecekapan_teras == "Keupayaan Inovatif")
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          Pekerja yang berupaya memberi idea dan memberi penyelesaian untuk menyelesaikan masalah
                          <br>
                          Amalan kerja yang dikemas kini lebih sesuai dengan jangkaan masa kini
                          <br>
                          Penerimaan untuk organisasi, dan semua bahagiannya, perlu berubah dan terus meningkat
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi
                        </p>
                      </td>
                      @else
                      @endif

                      @if ($kecekapans -> kecekapan_teras == "Pengurusan Pelanggan")
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          Amalan organisasi yang lebih sesuai dengan keperluan pelanggan moden
                          <br>
                          Pekerja yang memahami dan bertindak mengikut kehendak pelanggan tepat pada masanya
                          <br>
                          Penciptaan produk dan perkhidmatan masa depan yang lebih mencerminkan keperluan pelanggan
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi
                        </p>
                      </td>
                      @else
                      @endif

                      @if ($kecekapans -> kecekapan_teras == "Pengurusan Pemegang Berkepentingan")
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          Pekerja yang lebih empati dengan pihak berkepentingan mereka
                          <br>
                          Pembinaan hubungan positif dengan pihak berkepentingan
                          <br>
                          Pembentukan perkongsian strategik yang membantu mencapai objektif organisasi
                          <br>
                          Pengurus yang mendorong pekerja bawahan mereka membina rangkaian profesional mereka sendiri
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi
                        </p>
                      </td>
                      @else
                      @endif

                      @if ($kecekapans -> kecekapan_teras == "Ketangkasan Dalam Organisasi")
                      <td>
                        <p class="text-xs text-secondary mb-0">
                          Pekerja yang berpengetahuan dan serba boleh
                          <br>
                          Penghargaan dan penerapan budaya bimbingan dalam organisasi
                          <br>
                          Amalan organisasi yang boleh menyesuaikan diri dengan masalah di pasaran
                          <br>
                          Organisasi yang menekankan dan mendorong pembelajaran dan perkembangan berterusan
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi
                        </p>
                      </td>
                      @else
                      @endif

                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold ps-11" value="{{  '20%' }}">{{  '20%' }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold mr-2" value="{{ 'Percentage (%)' }}">{{ 'Percentage (%)' }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kecekapans -> skor_pekerja }}">{{ $kecekapans -> skor_pekerja }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kecekapans -> skor_penyelia }}">{{ $kecekapans -> skor_penyelia }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kecekapans -> skor_sebenar }}">{{ $kecekapans -> skor_sebenar }}</span>
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

    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>KAD SKOR 2021 - Kecekapan Teras</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center justify-content-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kecekapan<br>Teras</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jangkaan<br>Hasil</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">%</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor<br>Pekerja</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor<br>Penyelia</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor<br>Sebenar</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kecekapan as $key => $kecekapans)
                    <tr>
                      <td>
                        <p class="text-xs font-weight-bold mb-0" value="{{ $kecekapans -> kecekapan_teras }}">{{ $kecekapans -> kecekapan_teras }}</p>
                      </td>

                      @if ($kecekapans -> kecekapan_teras == "Kepimpinan Organisasi")
                      <td class="text-xs font-weight-bold mb-0">
                        <span class="text-secondary text-xs font-weight-bold" value="">Pekerja yang sedar dan menyesuaikan diri dengan strategi organisasi
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi
                          <br>
                          Pengurus yang dapat mengembangkan dan memperkasakan pekerja bawahannya
                          <br>
                          Budaya organisasi yang mencerminkan nilainya
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                      </td>
                      @else
                      @endif 

                      @if ($kecekapans -> kecekapan_teras == "Keupayaan Inovatif")
                      <td class="text-xs font-weight-bold mb-0">
                        <span class="text-secondary text-xs font-weight-bold" value="">Pekerja yang berupaya memberi idea dan memberi penyelesaian untuk menyelesaikan masalah
                          <br>
                          Amalan kerja yang dikemas kini lebih sesuai dengan jangkaan masa kini
                          <br>
                          Penerimaan untuk organisasi, dan semua bahagiannya, perlu berubah dan terus meningkat
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                      </td>
                      @else
                      @endif 

                      @if ($kecekapans -> kecekapan_teras == "Pengurusan Pelanggan")
                      <td class="text-xs font-weight-bold mb-0">
                        <span class="text-secondary text-xs font-weight-bold" value="">Amalan organisasi yang lebih sesuai dengan keperluan pelanggan moden
                          <br>
                          Pekerja yang memahami dan bertindak mengikut kehendak pelanggan tepat pada masanya
                          <br>
                          Penciptaan produk dan perkhidmatan masa depan yang lebih mencerminkan keperluan pelanggan
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                      </td>
                      @else
                      @endif 

                      @if ($kecekapans -> kecekapan_teras == "Pengurusan Pemegang Berkepentingan")
                      <td class="text-xs font-weight-bold mb-0">
                        <span class="text-secondary text-xs font-weight-bold" value="">Pekerja yang lebih empati dengan pihak berkepentingan mereka
                          <br>
                          Pembinaan hubungan positif dengan pihak berkepentingan
                          <br>
                          Pembentukan perkongsian strategik yang membantu mencapai objektif organisasi
                          <br>
                          Pengurus yang mendorong pekerja bawahan mereka membina rangkaian profesional mereka sendiri
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                      </td>
                      @else
                      @endif 

                      @if ($kecekapans -> kecekapan_teras == "Ketangkasan Dalam Organisasi")
                      <td class="text-xs font-weight-bold mb-0">
                        <h6 class="text-secondary text-xs font-weight-bold" value="">Pekerja yang berpengetahuan dan serba boleh
                          <br>
                          Penghargaan dan penerapan budaya bimbingan dalam organisasi
                          <br>
                          Amalan organisasi yang boleh menyesuaikan diri dengan masalah di pasaran
                          <br>
                          Organisasi yang menekankan dan mendorong pembelajaran dan perkembangan berterusan
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi</h6>
                      </td>
                      @else
                      @endif 

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{  '20%' }}">{{  '20%' }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ 'Percentage (%)' }}">{{ 'Percentage (%)' }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kecekapans -> skor_pekerja }}">{{ $kecekapans -> skor_pekerja }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kecekapans -> skor_penyelia }}">{{ $kecekapans -> skor_penyelia }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kecekapans -> skor_sebenar }}">{{ $kecekapans -> skor_sebenar }}</span>
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
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>KAD SKOR 2021 - Nilai Teras</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nilai Teras</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jangkaan Hasil</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">%</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Pekerja</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Penyelia</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Sebenar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($nilai as $key => $nilais)
                  <tr>
                    <td>    
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" value="{{ $key + 1  }}">{{ $key + 1  }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0" value="{{ $nilais -> nilai_teras }}">{{ $nilais -> nilai_teras }}</p>
                    </td>
                    @if ($nilais -> nilai_teras == "Kepimpinan")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        1. Kami adalah pemimpin yang bertanggungjawab.
                        <br>
                        2. Kami memberikan contoh yang baik.
                        <br>
                        3. Kami melaksanakan setiap apa yang diperkatakan.
                        <br>
                        4. Kami menjadi inspirasi untuk berubah lebih baik.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Perkembangan")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        1. Kami ambil peduli dengan peningkatan hidup sendiri.
                        <br>
                        2. Kami sentiasa menambah dan meningkatkan ilmu pengetahuan.
                        <br>
                        3. Kami memupuk sikap ingin sentiasa berjaya.
                        <br>
                        4. Kami sentiasa memperbaiki dan memajukan diri di setiap saat.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Keputusan")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        1. Kami membantu menggilap potensi orang lain.
                        <br>
                        2. Kami memastikan pelanggan mencapai keputusan cemerlang.
                        <br>
                        3. Kami komited dengan hasil usaha yang dilakukan.
                        <br>
                        4. Kami berusaha untuk memberikan yang terbaik.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Sumbangan")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        1. Kami menghulurkan bantuan dengan sepenuh semangat dan jiwa kami.
                        <br>
                        2. Kami membantu mengatasi kelemahan dan membina kekuatan pelanggan.
                        <br>
                        3. Kami komited untuk memberi manfaat dan menyebarkan kebaikan.
                        <br>
                        4. Kami bertanggungjawab dengan orang sekeliling dan persekitaran.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Rohani")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        1. Kami adalah hamba Allah.
                        <br>
                        2. Kami membantu orang untuk mendapat kehidupan yang lebih baik.
                        <br>
                        3. Kami bangkit berjaya dengan memajukan orang lain.
                        <br>
                        4. Kami sentiasa beriman dan percaya dengan Qada’ dan Qadar.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Keluarga")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        1. Kami sangat menyayangi keluarga kami.
                        <br>
                        2. Kami berusaha untuk berikan yang terbaik kepada keluarga kami.
                        <br>
                        3. Kami tidak akan mengabaikan keluarga kami.
                        <br>
                        4. Kami percaya kebahagiaan keluarga adalah kebahagiaan kami.</span>
                    </td>
                    @else
                    @endif
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{  '20%' }}">{{  '20%' }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ 'Percentage (%)' }}">{{ 'Percentage (%)' }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $nilais -> skor_pekerja }}">{{ $nilais -> skor_pekerja }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $nilais -> skor_penyelia }}">{{ $nilais -> skor_penyelia }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $nilais -> skor_sebenar }}">{{ $nilais -> skor_sebenar }}</span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    <div class="row">
      <div class="col-md-7">
        <div class="card">
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">Jumlah Markah</h6>
                  <span class="mb-2 text-xs">KPI : 
                  @foreach ($kpiall as $key => $kpialls)
                  <span class="text-dark font-weight-bold ms-sm-2">{{ $kpialls -> total_score_master }}%</span></span>
                  @endforeach
                  <span class="mb-2 text-xs">Skor Akhir:
                  @foreach ($kpiall as $key => $kpialls) 
                  <span class="text-dark ms-sm-2 font-weight-bold">{{ round($kpialls -> total_score_all,2) }}%</span></span>
                  @endforeach
                  <span class="mb-2 text-xs">Kecekapan Teras:
                  @foreach ($kpiall as $key => $kpialls) 
                  <span class="text-dark ms-sm-2 font-weight-bold">{{ $kpialls -> total_score_kecekapan }}%</span></span>
                  @endforeach
                  <span class="mb-2 text-xs">Nilai Teras: 
                  @foreach ($kpiall as $key => $kpialls)  
                  <span class="text-dark ms-sm-2 font-weight-bold">{{ $kpialls -> total_score_nilai }}%</span></span>
                  @endforeach
                  <span class="text-xs">Grade: 
                  @foreach ($kpiall as $key => $kpialls)   
                  <span class="text-dark ms-sm-2 font-weight-bold">{{ $kpialls -> grade_all }}</span></span>
                  @endforeach
                </div>
                <div class="ms-auto text-end">
                  <div class="col-12 text-end">
                    @foreach ($date as $dates)
                      {{-- @if ($dates->status == 'Not Submitted' || $dates->status == 'Submitted') --}}
                      @if ($dates->status == 'Not Submitted')
                        <a class="btn bg-gradient-info mb-0" href="{{ url('employee/changeup/kpi/'.$dates->id) }}" class="btn btn-dark btn-sm"role="button"><i class="fa fa-edit"></i>&nbsp;Sign & Submit</a>
                      @elseif ($dates->status == 'Submitted')
                        <a class="btn bg-gradient-danger mb-0" href="{{ url('employee/changedown/kpi/'.$dates->id) }}" class="btn btn-dark btn-sm"  role="button"><i class="fa fa-edit"></i>&nbsp;Undo Sign & Submit</a>
                      @else
                      @endif
                    @endforeach
                  </div>
                  {{-- <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                  <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a> --}}
                </div>
              </li>
                  {{-- <h6 class="mb-2 text-sm">Jumlah Markah</h6>
                  <span class="text-xs">KPI: 
                  @foreach ($kpiall as $key => $kpialls)
                  <span class="text-dark ms-sm-2 font-weight-bold p-2">{{ $kpialls -> total_score_master }}%</span></span>
                  @endforeach
                  <span class="text-xs">Skor Akhir: 
                  @foreach ($kpiall as $key => $kpialls)
                  <span class="text-dark ms-sm-2 font-weight-bold p-2">{{ round($kpialls -> total_score_all,2) }}%</span></span>
                  @endforeach
                  <span class="text-xs">Kecekapan Teras: 
                  @foreach ($kpiall as $key => $kpialls)  
                  <span class="text-dark ms-sm-2 font-weight-bold p-2">{{ $kpialls -> total_score_kecekapan }}%</span></span>
                  @endforeach
                  <span class="text-xs">Nilai Teras: 
                  @foreach ($kpiall as $key => $kpialls)  
                  <span class="text-dark ms-sm-2 font-weight-bold p-2">{{ $kpialls -> total_score_nilai }}%</span></span>
                  @endforeach
                  <span class="text-xs">Grade: 
                  @foreach ($kpiall as $key => $kpialls)  
                  <span class="text-dark ms-sm-2 font-weight-bold p-2">{{ $kpialls -> grade_all }}</span></span>
                  @endforeach --}}
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>  
  
    {{------------------------------------------- End   Testing ---------------------------------------}}  

      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            @if ($weightage_master > 100) 
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>{{ session('fail2') }}Your Percentage for KPI Master exceed 100%. Please check back.</strong>
            </div>
            @else
            @endif
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6>KAD SKOR 2021 - KPI</h6>
              </div>
              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fungsi</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Objektif KPI</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Metrik/Bukti</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link Bukti</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">%</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Treshold</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Base</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stretch</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pencapaian</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor KPI</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Sebenar</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php($i = 1)
                      @foreach ($kadskor as $key => $kpis)
                        <tr>
                          @if ($key == 0)
                          <td>    
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $i++  }}</h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                          </td>
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                          </td>
                          @else
                          <td>    
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                          </td>
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                          </td>
                          @endif
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                          </td>
                          @if ($key == 0)
                          <td class="align-middle text-center">
                            <a href=" {{ $kpis->kpimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="">30</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="">65</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="">100</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ $kpis->kpimasters -> pencapaian }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                          </td>
                          @else
                          <td class="align-middle text-center">
                            <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value=""></span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                          </td>
                          @endif
                          {{-- <td class="align-middle text-center">
                            <a href="{{ url('employee/edit/kpi/'.$kpis->id) }}" class="btn btn-primary btn-sm" style="font-size: 10px" role="button"><i class="fa fa-edit"></i>&nbsp;Edit Pencapaian</a>
                          </td>
                          <td class="align-middle text-center">
                            <a href="{{ url('employee/delete/kpi/'.$kpis->id) }}" class="btn btn-danger btn-sm"  style="font-size: 10px" role="button"><i class="fa fa-trash"></i></a>
                          </td> --}}
                        </tr>
                      @endforeach
                      @foreach ($kewangan as $key => $kpis)
                      <tr>
                        @if ($key == 0)
                        <td>    
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $i++  }}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                        @else
                        <td>    
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                        </td>
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                        </td>
                        @endif
                        <td class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                        </td>
                        @if ($key == 0)
                        <td class="align-middle text-center">
                          <a href=" {{ $kpis->kpimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">30</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">65</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">100</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ $kpis->kpimasters -> pencapaian }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                        @else
                        <td class="align-middle text-center">
                          <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value=""></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                        </td>
                        @endif
                      </tr>
                    @endforeach
                    @foreach ($pelangganI as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                      <td>    
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $i++  }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                      </td>
                      <td class="text-xs font-weight-bold mb-0">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                      </td>
                      @else
                      <td>    
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                      </td>
                      <td class="text-xs font-weight-bold mb-0">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                      </td>
                      @endif
                      <td class="text-xs font-weight-bold mb-0">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                      </td>
                      @if ($key == 0)
                      <td class="align-middle text-center">
                        <a href=" {{ $kpis->kpimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">30</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">65</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">100</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ $kpis->kpimasters -> pencapaian }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                      </td>
                      @else
                      <td class="align-middle text-center">
                        <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value=""></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                      </td>
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($pelangganII as $key => $kpis)
                  <tr>
                    @if ($key == 0)
                    <td>    
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $i++  }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                    </td>
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                    </td>
                    @else
                    <td>    
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                    </td>
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                    </td>
                    @endif
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                    </td>
                    @if ($key == 0)
                    <td class="align-middle text-center">
                      <a href=" {{ $kpis->kpimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">30</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">65</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">100</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ $kpis->kpimasters -> pencapaian }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                    </td>
                    @else
                    <td class="align-middle text-center">
                      <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value=""></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                    </td>
                    @endif
                  </tr>
                @endforeach
                @foreach ($kecemerlangan as $key => $kpis)
                <tr>
                  @if ($key == 0)
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $i++  }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                  </td>
                  <td class="text-xs font-weight-bold mb-0">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                  </td>
                  @else
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                  </td>
                  <td class="text-xs font-weight-bold mb-0">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                  </td>
                  @endif
                  <td class="text-xs font-weight-bold mb-0">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                  </td>
                  @if ($key == 0)
                  <td class="align-middle text-center">
                    <a href=" {{ $kpis->kpimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="">30</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="">65</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="">100</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ $kpis->kpimasters -> pencapaian }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                  </td>
                  @else
                  <td class="align-middle text-center">
                    <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value=""></span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                  </td>
                  @endif
                </tr>
              @endforeach
              @foreach ($training as $key => $kpis)
              <tr>
                @if ($key == 0)
                <td>    
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $i++  }}</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                </td>
                <td class="text-xs font-weight-bold mb-0">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                </td>
                @else
                <td>    
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
                </td>
                <td class="text-xs font-weight-bold mb-0">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
                </td>
                @endif
                <td class="text-xs font-weight-bold mb-0">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
                </td>
                @if ($key == 0)
                <td class="align-middle text-center">
                  <a href=" {{ $kpis->kpimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="">30</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="">65</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="">100</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ $kpis->kpimasters -> pencapaian }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                </td>
                @else
                <td class="align-middle text-center">
                  <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value=""></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
                </td>
                @endif
              </tr>
            @endforeach
            @foreach ($ncr as $key => $kpis)
            <tr>
              @if ($key == 0)
              <td>    
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $i++  }}</h6>
                  </div>
                </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
              </td>
              <td class="text-xs font-weight-bold mb-0">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
              </td>
              @else
              <td>    
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
              </td>
              <td class="text-xs font-weight-bold mb-0">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
              </td>
              @endif
              <td class="text-xs font-weight-bold mb-0">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
              </td>
              @if ($key == 0)
              <td class="align-middle text-center">
                <a href=" {{ $kpis->kpimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="">30</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="">65</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="">100</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ $kpis->kpimasters -> pencapaian }}</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
              </td>
              @else
              <td class="align-middle text-center">
                <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value=""></span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
              </td>
              @endif
            </tr>
          @endforeach
          @foreach ($kolaborasi as $key => $kpis)
          <tr>
            @if ($key == 0)
            <td>    
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">{{ $i++  }}</h6>
                </div>
              </div>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
            </td>
            <td class="text-xs font-weight-bold mb-0">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
            </td>
            @else
            <td>    
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <p class="mb-0 text-sm" value="{{$key + 1}}">{{NULL}}</p>
                </div>
              </div>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0" value="{{ $kpis -> fungsi }}">{{ NULL }}</p>
            </td>
            <td class="text-xs font-weight-bold mb-0">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{  NULL }}</span>
            </td>
            @endif
            <td class="text-break text-xs font-weight-bold mb-0">
              <span class="text-break text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}}">{{ $kpis -> bukti }}</span>
            </td>
            @if ($key == 0)
            <td class="align-middle text-center">
              <a href=" {{ $kpis->kpimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">Link Bukti</a>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="">30</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="">65</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="">100</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ $kpis->kpimasters -> pencapaian }}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
            </td>
            @else
            <td class="align-middle text-center">
              <a href="" style="color:blue;text-decoration:underline;font-size:13.5px"; ></a>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ NULL }}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value=""></span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="">{{ NULL }}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ NULL }}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ NULL }}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ NULL }}</span>
            </td>
            @endif
          </tr>
          @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6>KAD SKOR 2021 - Kecekapan Teras</h6>
              </div>
              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kecekapan Teras</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jangkaan Hasil</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">%</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Pekerja</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Penyelia</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Sebenar</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($kecekapan as $key => $kecekapans)
                        <tr>
                          <td>    
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm" value="{{ $key + 1  }}">{{ $key + 1  }}</h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0" value="{{ $kecekapans -> kecekapan_teras }}">{{ $kecekapans -> kecekapan_teras }}</p>
                          </td>

                          @if ($kecekapans -> kecekapan_teras == "Kepimpinan Organisasi")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">Pekerja yang sedar dan menyesuaikan diri dengan strategi organisasi
                              <br>
                              Pemimpin yang bertindak selaras dengan strategi organisasi
                              <br>
                              Pengurus yang dapat mengembangkan dan memperkasakan pekerja bawahannya
                              <br>
                              Budaya organisasi yang mencerminkan nilainya
                              <br>
                              Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                          </td>
                          @else
                          @endif 

                          @if ($kecekapans -> kecekapan_teras == "Keupayaan Inovatif")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">Pekerja yang berupaya memberi idea dan memberi penyelesaian untuk menyelesaikan masalah
                              <br>
                              Amalan kerja yang dikemas kini lebih sesuai dengan jangkaan masa kini
                              <br>
                              Penerimaan untuk organisasi, dan semua bahagiannya, perlu berubah dan terus meningkat
                              <br>
                              Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                          </td>
                          @else
                          @endif 

                          @if ($kecekapans -> kecekapan_teras == "Pengurusan Pelanggan")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">Amalan organisasi yang lebih sesuai dengan keperluan pelanggan moden
                              <br>
                              Pekerja yang memahami dan bertindak mengikut kehendak pelanggan tepat pada masanya
                              <br>
                              Penciptaan produk dan perkhidmatan masa depan yang lebih mencerminkan keperluan pelanggan
                              <br>
                              Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                          </td>
                          @else
                          @endif 

                          @if ($kecekapans -> kecekapan_teras == "Pengurusan Pemegang Berkepentingan")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">Pekerja yang lebih empati dengan pihak berkepentingan mereka
                              <br>
                              Pembinaan hubungan positif dengan pihak berkepentingan
                              <br>
                              Pembentukan perkongsian strategik yang membantu mencapai objektif organisasi
                              <br>
                              Pengurus yang mendorong pekerja bawahan mereka membina rangkaian profesional mereka sendiri
                              <br>
                              Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                          </td>
                          @else
                          @endif 

                          @if ($kecekapans -> kecekapan_teras == "Ketangkasan Dalam Organisasi")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">Pekerja yang berpengetahuan dan serba boleh
                              <br>
                              Penghargaan dan penerapan budaya bimbingan dalam organisasi
                              <br>
                              Amalan organisasi yang boleh menyesuaikan diri dengan masalah di pasaran
                              <br>
                              Organisasi yang menekankan dan mendorong pembelajaran dan perkembangan berterusan
                              <br>
                              Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                          </td>
                          @else
                          @endif 

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{  '20%' }}">{{  '20%' }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ 'Percentage (%)' }}">{{ 'Percentage (%)' }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kecekapans -> skor_pekerja }}">{{ $kecekapans -> skor_pekerja }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kecekapans -> skor_penyelia }}">{{ $kecekapans -> skor_penyelia }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $kecekapans -> skor_sebenar }}">{{ $kecekapans -> skor_sebenar }}</span>
                          </td>
                          {{-- <td class="align-middle text-center">
                            <a href="{{ url('employee/edit/kecekapan/'.$kecekapans->id) }}" class="btn btn-primary btn-sm" style="font-size: 10px" role="button"><i class="fa fa-edit"></i>&nbsp;Pencapaian</a>
                          </td>
                          <td class="align-middle text-center">
                            <a href="{{ url('employee/delete/kecekapan/'.$kecekapans->id) }}" class="btn btn-danger btn-sm"  style="font-size: 10px" role="button"><i class="fa fa-trash"></i></a>
                          </td> --}}
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6>KAD SKOR 2021 - Nilai Teras</h6>
              </div>
              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nilai Teras</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jangkaan Hasil</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">%</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Pekerja</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Penyelia</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor Sebenar</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($nilai as $key => $nilais)
                        <tr>
                          <td>    
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm" value="{{ $key + 1  }}">{{ $key + 1  }}</h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0" value="{{ $nilais -> nilai_teras }}">{{ $nilais -> nilai_teras }}</p>
                          </td>
                            
                          {{-- @if ($nilais -> nilai_teras == "Kepimpinan")
                          <td class="text-xs font-weight-bold mb-0">
                            <pre class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami adalah pemimpin yang bertanggungjawab
                              2. Kami memberikan contoh yang baik
                              3. Kami melaksanakan setiap apa yang diperkatakan
                              4. Kami menjadi inspirasi untuk berubah lebih baik</pre>
                          </td>
                          @else
                          @endif  --}}

                          @if ($nilais -> nilai_teras == "Kepimpinan")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami adalah pemimpin yang bertanggungjawab.
                              <br>
                              2. Kami memberikan contoh yang baik.
                              <br>
                              3. Kami melaksanakan setiap apa yang diperkatakan.
                              <br>
                              4. Kami menjadi inspirasi untuk berubah lebih baik.</span>
                          </td>
                          @else
                          @endif

                          @if ($nilais -> nilai_teras == "Perkembangan")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami ambil peduli dengan peningkatan hidup sendiri.
                              <br>
                              2. Kami sentiasa menambah dan meningkatkan ilmu pengetahuan.
                              <br>
                              3. Kami memupuk sikap ingin sentiasa berjaya.
                              <br>
                              4. Kami sentiasa memperbaiki dan memajukan diri di setiap saat.</span>
                          </td>
                          @else
                          @endif

                          @if ($nilais -> nilai_teras == "Keputusan")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami membantu menggilap potensi orang lain.
                              <br>
                              2. Kami memastikan pelanggan mencapai keputusan cemerlang.
                              <br>
                              3. Kami komited dengan hasil usaha yang dilakukan.
                              <br>
                              4. Kami berusaha untuk memberikan yang terbaik.</span>
                          </td>
                          @else
                          @endif

                          @if ($nilais -> nilai_teras == "Sumbangan")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami menghulurkan bantuan dengan sepenuh semangat dan jiwa kami.
                              <br>
                              2. Kami membantu mengatasi kelemahan dan membina kekuatan pelanggan.
                              <br>
                              3. Kami komited untuk memberi manfaat dan menyebarkan kebaikan.
                              <br>
                              4. Kami bertanggungjawab dengan orang sekeliling dan persekitaran.</span>
                          </td>
                          @else
                          @endif

                          @if ($nilais -> nilai_teras == "Rohani")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami adalah hamba Allah.
                              <br>
                              2. Kami membantu orang untuk mendapat kehidupan yang lebih baik.
                              <br>
                              3. Kami bangkit berjaya dengan memajukan orang lain.
                              <br>
                              4. Kami sentiasa beriman dan percaya dengan Qada’ dan Qadar.</span>
                          </td>
                          @else
                          @endif

                          @if ($nilais -> nilai_teras == "Keluarga")
                          <td class="text-xs font-weight-bold mb-0">
                            <span class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami sangat menyayangi keluarga kami.
                              <br>
                              2. Kami berusaha untuk berikan yang terbaik kepada keluarga kami.
                              <br>
                              3. Kami tidak akan mengabaikan keluarga kami.
                              <br>
                              4. Kami percaya kebahagiaan keluarga adalah kebahagiaan kami.</span>
                          </td>
                          @else
                          @endif

                          {{-- @if ($nilais -> nilai_teras == "Perkembangan")
                          <td class="text-xs font-weight-bold mb-0">
                            <pre class="text-secondary text-xs -weight-bold" value="">
                              1. Kami ambil peduli dengan peningkatan hidup sendiri.
                              2. Kami sentiasa menambah dan meningkatkan ilmu pengetahuan.
                              3. Kami memupuk sikap ingin sentiasa berjaya.
                              4. Kami sentiasa memperbaiki dan memajukan diri di setiap saat</pre>
                          </td>
                          @else
                          @endif 

                          @if ($nilais -> nilai_teras == "Keputusan")
                          <td class="text-xs font-weight-bold mb-0">
                            <pre class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami membantu menggilap potensi orang lain.
                              2. Kami memastikan pelanggan mencapai keputusan cemerlang.
                              3. Kami komited dengan hasil usaha yang dilakukan
                              4. Kami berusaha untuk memberikan yang terbaik</pre>
                          </td>
                          @else
                          @endif 

                          @if ($nilais -> nilai_teras == "Sumbangan")
                          <td class="text-xs font-weight-bold mb-0">
                            <pre class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami menghulurkan bantuan dengan sepenuh semangat dan jiwa kami.
                              2. Kami membantu mengatasi kelemahan dan membina kekuatan pelanggan.
                              3. Kami komited untuk memberi manfaat dan menyebarkan kebaikan.
                              4. Kami bertanggungjawab dengan orang sekeliling dan persekitaran</pre>
                          </td>
                          @else
                          @endif 

                          @if ($nilais -> nilai_teras == "Rohani")
                          <td class="text-xs font-weight-bold mb-0">
                            <pre class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami adalah hamba Allah.
                              2. Kami membantu orang untuk mendapat kehidupan yang lebih baik.
                              3. Kami bangkit berjaya dengan memajukan orang lain
                              4. Kami sentiasa beriman dan percaya dengan Qada’ dan Qadar</pre>
                          </td>
                          @else
                          @endif
                          
                          @if ($nilais -> nilai_teras == "Keluarga")
                          <td class="text-xs font-weight-bold mb-0" >
                            <pre class="text-secondary text-xs font-weight-bold" value="">
                              1. Kami sangat menyayangi keluarga kami.
                              2. Kami berusaha untuk berikan yang terbaik kepada keluarga kami.
                              3. Kami tidak akan mengabaikan keluarga kami.
                              4. Kami percaya kebahagiaan keluarga adalah kebahagiaan kami</pre>
                          </td>
                          @else
                          @endif  --}}

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{  '20%' }}">{{  '20%' }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ 'Percentage (%)' }}">{{ 'Percentage (%)' }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $nilais -> skor_pekerja }}">{{ $nilais -> skor_pekerja }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $nilais -> skor_penyelia }}">{{ $nilais -> skor_penyelia }}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold" value="{{ $nilais -> skor_sebenar }}">{{ $nilais -> skor_sebenar }}</span>
                          </td>

                          {{-- <td class="align-middle text-center">
                            <a href="{{ url('employee/edit/nilai/'.$nilais->id) }}" class="btn btn-primary btn-sm" style="font-size: 10px" role="button"><i class="fa fa-edit"></i>&nbsp;Pencapaian</a>
                          </td>
                          <td class="align-middle text-center">
                            <a href="{{ url('employee/delete/nilai/'.$nilais->id) }}" class="btn btn-danger btn-sm"  style="font-size: 10px" role="button"><i class="fa fa-trash"></i></a>
                          </td> --}}
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            {{-- <div class="col-12">
              <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="">KPI</p>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="">20%</p>
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="">KECEKAPAN TERAS :</p>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="">20%</p>
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="">NILAI TERAS :</p>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="">20%</p>
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="">SKOR AKHIR :</p>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="">20%</p>
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> --}}

            {{-- <table style="width:100%">
              <tr>
                <td>KPI</td>
                <td rowspan="3">SKOR AKHIR :</td>
              </tr>
              <tr>
                <td>KECEKAPAN TERAS :</td>
              </tr>
              <tr>
                <td>NILAI TERAS :</td>
              </tr>
            </table> --}}

            <div class="col-12">
              <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table style="width:100%" class="table align-items-center mb-0">
                      <tr>
                        <td>KPI</td>
                        @foreach ($kpiall as $key => $kpialls)
                        <td>{{ $kpialls -> total_score_master }}%</td>
                        @endforeach
                        <td rowspan="2">SKOR AKHIR :</td>
                        @foreach ($kpiall as $key => $kpialls)
                        <td rowspan="2">{{ round($kpialls -> total_score_all,2) }}%</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>KECEKAPAN TERAS :</td>
                        @foreach ($kpiall as $key => $kpialls)
                        <td>{{ $kpialls -> total_score_kecekapan }}%</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>NILAI TERAS :</td>
                        @foreach ($kpiall as $key => $kpialls)
                        <td>{{ $kpialls -> total_score_nilai }}%</td>
                        @endforeach
                        <td rowspan="1">GRADE :</td>
                        @foreach ($kpiall as $key => $kpialls)
                        <td rowspan="1">{{ $kpialls -> grade_all }}</td>
                        @endforeach
                      </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
            @foreach ($date as $dates)
              @if ($dates->status == 'Not Submitted' || $dates->status == 'Submitted')
                <a href="{{ url('employee/changeup/kpi/'.$dates->id) }}" class="btn btn-dark btn-sm" style="font-size: 10px" role="button"><i class="fa fa-edit"></i>&nbsp;Sign & Submit</a>
            {{-- @endforeach --}}
          {{-- {{dd($kpialls->id)}} --}}
                <a href="{{ url('employee/changedown/kpi/'.$dates->id) }}" class="btn btn-dark btn-sm" style="font-size: 10px" role="button"><i class="fa fa-edit"></i>&nbsp;Undo Sign & Submit</a>
              @else
              @endif
            @endforeach
          </div>
        </div>
    </body>
  
   <!-- Master Pencapaian JS -->
  <script src="{{asset('assets/js/master.js')}}"></script>
  <script src="{{asset('assets/js/kecekapan.js')}}"></script>
  <script src="{{asset('assets/js/nilai.js')}}"></script>
  
@endsection