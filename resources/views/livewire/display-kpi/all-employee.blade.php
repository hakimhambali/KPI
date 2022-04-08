@section('content')
  @extends('layouts.app')

  <style>
  .table-responsive {
    overflow-x: hidden;
    overflow-y: hidden;
  }

  td.good{
    border-bottom: hidden;
  }
  thead,
  tbody,
  tfoot,
  tr,
  th {
    border-color: black;
    border-style: solid;
    border-width: 0;
  }
  .solid {
    border-style: solid;
  }

  </style>
  <body>


{{--------------------------------------------------- KPI MASTER EMPLOYEE (EMPLOYEE) --------------------------------------------------}}
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
        @if ($weightage_master > 100) 
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{ session('fail2') }}Your total weightage for KPI Master exceed 100%. Please check back.</strong>
        </div>
        @else
        @endif
        @if ($weightage_master < 100) 
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{ session('fail2') }}Your total weightage for KPI Master is lower than 100%. Please check back.</strong>
        </div>
        @else
        @endif
        <div class="card mb-4">
          <div class="card-header pb-0">
            @if ($weightage_master == NULL) 
            <h6>SCORE CARD - KPI <span style="color:red;">(Current total weightage = 0)</span></h6>
            @else
            <h6>SCORE CARD - KPI <span style="color:red;">(Current total weightage = {{$weightage_master}})</span></h6>
            @endif
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table style="width: 100%" class="a table align-items-center justify-content-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Function</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">KPI Objective</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">Evidence</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">Link File</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">Evidence Link</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">%</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">Measurement</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-5">KPI Target</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">KPI Score</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2 px-2">Actual Score</th>
                  </tr>
                </thead>
                <tbody>
                  @php($i = 1)
                  @foreach ($kadskor as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td rowspan="{{ $kadskorcount }}">
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td rowspan="{{ $kadskorcount }}" class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters->objektif }}">{{ $kpis->kpimasters->objektif }}</span>
                        </td>
                      @else
                      @endif
                      @if ($loop->last)
                        <td class="text-xs font-weight-bold">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @else
                        <td class="text-xs font-weight-bold good">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold good">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @endif
                        
                      @if ($key == 0)
                        <td rowspan="{{ $kadskorcount }}" class="align-middle text-center">
                          @if ($kpis->kpimasters->link == '')
                          -
                          @else
                          <a href="{{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                        <td rowspan="{{ $kadskorcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters->percent_master }}</span>
                        </td>
                        <td rowspan="{{ $kadskorcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td rowspan="{{ $kadskorcount }}" class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                            <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                                </div>
                            </div>
                          </div>
                        </td>
                        <td rowspan="{{ $kadskorcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td rowspan="{{ $kadskorcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($kewangan1 as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td rowspan="{{ $kewangan1count }}">
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td rowspan="{{ $kewangan1count }}" class="text-xs font-weight-bold mb-0 test">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                      @endif
                      @if ($loop->last)
                        <td class="text-xs font-weight-bold">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @else
                        <td class="text-xs font-weight-bold good">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold good">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @endif
                      @if ($key == 0)
                        <td rowspan="{{ $kewangan1count }}" class="align-middle text-center">
                          @if ($kpis->kpimasters->link == '')
                          -
                          @else
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                        <td rowspan="{{ $kewangan1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td rowspan="{{ $kewangan1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td rowspan="{{ $kewangan1count }}" class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                            <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                                </div>
                            </div>
                          </div>
                        </td>
                        <td rowspan="{{ $kewangan1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td rowspan="{{ $kewangan1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($kewangan2 as $key => $kpis)
                  <tr>
                    @if ($key == 0)
                      <td rowspan="{{ $kewangan2count }}">
                        <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                      </td>
                      <td rowspan="{{ $kewangan2count }}" class="text-xs font-weight-bold mb-0 test">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                      </td>
                    @else
                    @endif
                    @if ($loop->last)
                      <td class="text-xs font-weight-bold">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                      </td>
                      <td class="text-xs font-weight-bold">
                        @if ($kpis->bukti_path == '')
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                        @else
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                        @endif
                      </td>
                    @else
                      <td class="text-xs font-weight-bold good">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                      </td>
                      <td class="text-xs font-weight-bold good">
                        @if ($kpis->bukti_path == '')
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                        @else
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                        @endif
                      </td>
                    @endif
                    @if ($key == 0)
                      <td rowspan="{{ $kewangan2count }}" class="align-middle text-center">
                        @if ($kpis->kpimasters->link == '')
                        -
                        @else
                        <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                        @endif
                      </td>
                      <td rowspan="{{ $kewangan2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                      </td>
                      <td rowspan="{{ $kewangan2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                      </td>
                      <td rowspan="{{ $kewangan2count }}" class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                          <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                              </div>
                          </div>
                        </div>
                      </td>
                      <td rowspan="{{ $kewangan2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                      </td>
                      <td rowspan="{{ $kewangan2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                      </td>
                    @else
                    @endif
                  </tr>
                @endforeach
                @foreach ($kewangan3 as $key => $kpis)
                <tr>
                  @if ($key == 0)
                    <td rowspan="{{ $kewangan3count }}">
                      <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                    </td>
                    <td rowspan="{{ $kewangan3count }}" class="text-xs font-weight-bold mb-0 test">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                    </td>
                  @else
                  @endif
                  @if ($loop->last)
                    <td class="text-xs font-weight-bold">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                    </td>
                    <td class="text-xs font-weight-bold">
                      @if ($kpis->bukti_path == '')
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                      @endif
                    </td>
                  @else
                    <td class="text-xs font-weight-bold good">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                    </td>
                    <td class="text-xs font-weight-bold good">
                      @if ($kpis->bukti_path == '')
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                      @endif
                    </td>
                  @endif
                  @if ($key == 0)
                    <td rowspan="{{ $kewangan3count }}" class="align-middle text-center">
                      @if ($kpis->kpimasters->link == '')
                      -
                      @else
                      <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                      @endif
                    </td>
                    <td rowspan="{{ $kewangan3count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                    </td>
                    <td rowspan="{{ $kewangan3count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                    </td>
                    <td rowspan="{{ $kewangan3count }}" class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                        <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                            </div>
                        </div>
                      </div>
                    </td>
                    <td rowspan="{{ $kewangan3count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                    </td>
                    <td rowspan="{{ $kewangan3count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                    </td>
                  @else
                  @endif
                </tr>
              @endforeach
                @foreach ($kewangan4 as $key => $kpis)
                <tr>
                  @if ($key == 0)
                    <td rowspan="{{ $kewangan4count }}">
                      <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                    </td>
                    <td rowspan="{{ $kewangan4count }}" class="text-xs font-weight-bold mb-0 test">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                    </td>
                  @else
                  @endif
                  @if ($loop->last)
                    <td class="text-xs font-weight-bold">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                    </td>
                    <td class="text-xs font-weight-bold">
                      @if ($kpis->bukti_path == '')
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                      @endif
                    </td>
                  @else
                    <td class="text-xs font-weight-bold good">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                    </td>
                    <td class="text-xs font-weight-bold good">
                      @if ($kpis->bukti_path == '')
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                      @endif
                    </td>
                  @endif
                  @if ($key == 0)
                    <td rowspan="{{ $kewangan4count }}" class="align-middle text-center">
                      @if ($kpis->kpimasters->link == '')
                      -
                      @else
                      <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                      @endif
                    </td>
                    <td rowspan="{{ $kewangan4count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                    </td>
                    <td rowspan="{{ $kewangan4count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                    </td>
                    <td rowspan="{{ $kewangan4count }}" class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                        <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                            </div>
                        </div>
                      </div>
                    </td>
                    <td rowspan="{{ $kewangan4count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                    </td>
                    <td rowspan="{{ $kewangan4count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                    </td>
                  @else
                  @endif
                </tr>
              @endforeach
              @foreach ($kewangan5 as $key => $kpis)
              <tr>
                @if ($key == 0)
                  <td rowspan="{{ $kewangan5count }}">
                    <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                  </td>
                  <td rowspan="{{ $kewangan5count }}" class="text-xs font-weight-bold mb-0 test">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                  </td>
                @else
                @endif
                @if ($loop->last)
                  <td class="text-xs font-weight-bold">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                  </td>
                  <td class="text-xs font-weight-bold">
                    @if ($kpis->bukti_path == '')
                    <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                @else
                  <td class="text-xs font-weight-bold good">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                  </td>
                  <td class="text-xs font-weight-bold good">
                    @if ($kpis->bukti_path == '')
                    <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                @endif
                @if ($key == 0)
                  <td rowspan="{{ $kewangan5count }}" class="align-middle text-center">
                    @if ($kpis->kpimasters->link == '')
                    -
                    @else
                    <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td rowspan="{{ $kewangan5count }}" class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                  </td>
                  <td rowspan="{{ $kewangan5count }}" class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                  </td>
                  <td rowspan="{{ $kewangan5count }}" class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td rowspan="{{ $kewangan5count }}" class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                  </td>
                  <td rowspan="{{ $kewangan5count }}" class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                  </td>
                @else
                @endif
              </tr>
            @endforeach
            @foreach ($kewangan6 as $key => $kpis)
            <tr>
              @if ($key == 0)
                <td rowspan="{{ $kewangan6count }}">
                  <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                </td>
                <td rowspan="{{ $kewangan6count }}" class="text-xs font-weight-bold mb-0 test">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                </td>
              @else
              @endif
              @if ($loop->last)
                <td class="text-xs font-weight-bold">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                </td>
                <td class="text-xs font-weight-bold">
                  @if ($kpis->bukti_path == '')
                  <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                  @else
                  <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                  @endif
                </td>
              @else
                <td class="text-xs font-weight-bold good">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                </td>
                <td class="text-xs font-weight-bold good">
                  @if ($kpis->bukti_path == '')
                  <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                  @else
                  <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                  @endif
                </td>
              @endif
              @if ($key == 0)
                <td rowspan="{{ $kewangan6count }}" class="align-middle text-center">
                  @if ($kpis->kpimasters->link == '')
                  -
                  @else
                  <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                  @endif
                </td>
                <td rowspan="{{ $kewangan6count }}" class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                </td>
                <td rowspan="{{ $kewangan6count }}" class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                </td>
                <td rowspan="{{ $kewangan6count }}" class="align-middle text-center">
                  <div class="d-flex align-items-center justify-content-center">
                    <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                    <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                        </div>
                    </div>
                  </div>
                </td>
                <td rowspan="{{ $kewangan6count }}" class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                </td>
                <td rowspan="{{ $kewangan6count }}" class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                </td>
              @else
              @endif
            </tr>
          @endforeach
          @foreach ($kewangan7 as $key => $kpis)
          <tr>
            @if ($key == 0)
              <td rowspan="{{ $kewangan7count }}">
                <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
              </td>
              <td rowspan="{{ $kewangan7count }}" class="text-xs font-weight-bold mb-0 test">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
              </td>
            @else
            @endif
            @if ($loop->last)
              <td class="text-xs font-weight-bold">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
              </td>
              <td class="text-xs font-weight-bold">
                @if ($kpis->bukti_path == '')
                <a href=" {{ $kpis->bukti_path}}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                @else
                <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                @endif
              </td>
            @else
              <td class="text-xs font-weight-bold good">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
              </td>
              <td class="text-xs font-weight-bold good">
                @if ($kpis->bukti_path == '')
                <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                @else
                <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                @endif
              </td>
            @endif
            @if ($key == 0)
              <td rowspan="{{ $kewangan7count }}" class="align-middle text-center">
                @if ($kpis->kpimasters->link == '')
                -
                @else
                <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                @endif
              </td>
              <td rowspan="{{ $kewangan7count }}" class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
              </td>
              <td rowspan="{{ $kewangan7count }}" class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
              </td>
              <td rowspan="{{ $kewangan7count }}" class="align-middle text-center">
                <div class="d-flex align-items-center justify-content-center">
                  <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                  <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                      </div>
                  </div>
                </div>
              </td>
              <td rowspan="{{ $kewangan7count }}" class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
              </td>
              <td rowspan="{{ $kewangan7count }}" class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
              </td>
            @else
            @endif
          </tr>
        @endforeach
        @foreach ($kewangan8 as $key => $kpis)
        <tr>
          @if ($key == 0)
            <td rowspan="{{ $kewangan8count }}">
              <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
            </td>
            <td rowspan="{{ $kewangan8count }}" class="text-xs font-weight-bold mb-0 test">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
            </td>
          @else
          @endif
          @if ($loop->last)
            <td class="text-xs font-weight-bold">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
            </td>
            <td class="text-xs font-weight-bold">
              @if ($kpis->bukti_path == '')
              <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
              @else
              <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
              @endif
            </td>
          @else
            <td class="text-xs font-weight-bold good">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
            </td>
            <td class="text-xs font-weight-bold good">
              @if ($kpis->bukti_path == '')
              <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
              @else
              <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
              @endif
            </td>
          @endif
          @if ($key == 0)
            <td rowspan="{{ $kewangan8count }}" class="align-middle text-center">
              @if ($kpis->kpimasters->link == '')
              -
              @else
              <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
              @endif
            </td>
            <td rowspan="{{ $kewangan8count }}" class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
            </td>
            <td rowspan="{{ $kewangan8count }}" class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
            </td>
            <td rowspan="{{ $kewangan8count }}" class="align-middle text-center">
              <div class="d-flex align-items-center justify-content-center">
                <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                    </div>
                </div>
              </div>
            </td>
            <td rowspan="{{ $kewangan8count }}" class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
            </td>
            <td rowspan="{{ $kewangan8count }}" class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
            </td>
          @else
          @endif
        </tr>
      @endforeach
      @foreach ($kewangan9 as $key => $kpis)
      <tr>
        @if ($key == 0)
          <td rowspan="{{ $kewangan9count }}">
            <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
          </td>
          <td rowspan="{{ $kewangan9count }}" class="text-xs font-weight-bold mb-0 test">
            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
          </td>
        @else
        @endif
        @if ($loop->last)
          <td class="text-xs font-weight-bold">
            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
          </td>
          <td class="text-xs font-weight-bold">
            @if ($kpis->bukti_path == '')
            <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
            @else
            <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
            @endif
          </td>
        @else
          <td class="text-xs font-weight-bold good">
            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
          </td>
          <td class="text-xs font-weight-bold good">
            @if ($kpis->bukti_path == '')
            <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
            @else
            <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
            @endif
          </td>
        @endif
        @if ($key == 0)
          <td rowspan="{{ $kewangan9count }}" class="align-middle text-center">
            @if ($kpis->kpimasters->link == '')
            -
            @else
            <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
            @endif
          </td>
          <td rowspan="{{ $kewangan9count }}" class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
          </td>
          <td rowspan="{{ $kewangan9count }}" class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
          </td>
          <td rowspan="{{ $kewangan9count }}" class="align-middle text-center">
            <div class="d-flex align-items-center justify-content-center">
              <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
              <div>
                  <div class="progress">
                    <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                  </div>
              </div>
            </div>
          </td>
          <td rowspan="{{ $kewangan9count }}" class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
          </td>
          <td rowspan="{{ $kewangan9count }}" class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
          </td>
        @else
        @endif
      </tr>
    @endforeach
    @foreach ($kewangan10 as $key => $kpis)
    <tr>
      @if ($key == 0)
        <td rowspan="{{ $kewangan10count }}">
          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
        </td>
        <td rowspan="{{ $kewangan10count }}" class="text-xs font-weight-bold mb-0 test">
          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
        </td>
      @else
      @endif
      @if ($loop->last)
        <td class="text-xs font-weight-bold">
          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
        </td>
        <td class="text-xs font-weight-bold">
          @if ($kpis->bukti_path == '')
          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
          @else
          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
          @endif
        </td>
      @else
        <td class="text-xs font-weight-bold good">
          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
        </td>
        <td class="text-xs font-weight-bold good">
          @if ($kpis->bukti_path == '')
          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
          @else
          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
          @endif
        </td>
      @endif
      @if ($key == 0)
        <td rowspan="{{ $kewangan10count }}" class="align-middle text-center">
          @if ($kpis->kpimasters->link == '')
          -
          @else
          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
          @endif
        </td>
        <td rowspan="{{ $kewangan10count }}" class="align-middle text-center">
          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
        </td>
        <td rowspan="{{ $kewangan10count }}" class="align-middle text-center">
          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
        </td>
        <td rowspan="{{ $kewangan10count }}" class="align-middle text-center">
          <div class="d-flex align-items-center justify-content-center">
            <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
            <div>
                <div class="progress">
                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                </div>
            </div>
          </div>
        </td>
        <td rowspan="{{ $kewangan10count }}" class="align-middle text-center">
          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
        </td>
        <td rowspan="{{ $kewangan10count }}" class="align-middle text-center">
          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
        </td>
      @else
      @endif
    </tr>
  @endforeach
                  @foreach ($pelangganIn1 as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td rowspan="{{ $pelangganIn1count }}">
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td rowspan="{{ $pelangganIn1count }}" class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                      @endif
                      @if ($loop->last)
                        <td class="text-xs font-weight-bold">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold"> 
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @else
                        <td class="text-xs font-weight-bold good">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold good">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @endif
                      @if ($key == 0)
                        <td rowspan="{{ $pelangganIn1count }}" class="align-middle text-center">
                          @if ($kpis->kpimasters->link == '')
                          -
                          @else
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                        <td rowspan="{{ $pelangganIn1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td rowspan="{{ $pelangganIn1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td rowspan="{{ $pelangganIn1count }}" class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                            <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                                </div>
                            </div>
                          </div>
                        </td>
                        <td rowspan="{{ $pelangganIn1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td rowspan="{{ $pelangganIn1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($pelangganEx1 as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td rowspan="{{ $pelangganEx1count }}">
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td rowspan="{{ $pelangganEx1count }}" class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                      @endif
                      @if ($loop->last)
                        <td class="text-xs font-weight-bold">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @else
                        <td class="text-xs font-weight-bold good">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold good">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @endif
                      @if ($key == 0)
                        <td rowspan="{{ $pelangganEx1count }}" class="align-middle text-center">
                          @if ($kpis->kpimasters->link == '')
                          -
                          @else
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                        <td rowspan="{{ $pelangganEx1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td rowspan="{{ $pelangganEx1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td rowspan="{{ $pelangganEx1count }}" class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                            <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                                </div>
                            </div>
                          </div>
                        </td>
                        <td rowspan="{{ $pelangganEx1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td rowspan="{{ $pelangganEx1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($pelangganEx2 as $key => $kpis)
                  <tr>
                    @if ($key == 0)
                      <td rowspan="{{ $pelangganEx2count }}">
                        <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                      </td>
                      <td rowspan="{{ $pelangganEx2count }}" class="text-xs font-weight-bold mb-0">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                      </td>
                    @else
                    @endif
                    @if ($loop->last)
                      <td class="text-xs font-weight-bold">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                      </td>
                      <td class="text-xs font-weight-bold">
                        @if ($kpis->bukti_path == '')
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                        @else
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                        @endif
                      </td>
                    @else
                      <td class="text-xs font-weight-bold good">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                      </td>
                      <td class="text-xs font-weight-bold good">
                        @if ($kpis->bukti_path == '')
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                        @else
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                        @endif
                      </td>
                    @endif
                    @if ($key == 0)
                      <td rowspan="{{ $pelangganEx2count }}" class="align-middle text-center">
                        @if ($kpis->kpimasters->link == '')
                        -
                        @else
                        <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                        @endif
                      </td>
                      <td rowspan="{{ $pelangganEx2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                      </td>
                      <td rowspan="{{ $pelangganEx2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                      </td>
                      <td rowspan="{{ $pelangganEx2count }}" class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                          <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                              </div>
                          </div>
                        </div>
                      </td>
                      <td rowspan="{{ $pelangganEx2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                      </td>
                      <td rowspan="{{ $pelangganEx2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                      </td>
                    @else
                    @endif
                  </tr>
                @endforeach
                  @foreach ($kecemerlangan1 as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td rowspan="{{ $kecemerlangan1count }}">
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td rowspan="{{ $kecemerlangan1count }}" class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                      @endif
                      @if ($loop->last)
                        <td class="text-xs font-weight-bold">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @else
                        <td class="text-xs font-weight-bold good">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold good">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @endif
                      @if ($key == 0)
                        <td rowspan="{{ $kecemerlangan1count }}" class="align-middle text-center">
                          @if ($kpis->kpimasters->link == '')
                          -
                          @else
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                        <td rowspan="{{ $kecemerlangan1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td rowspan="{{ $kecemerlangan1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td rowspan="{{ $kecemerlangan1count }}" class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                            <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                                </div>
                            </div>
                          </div>
                        </td>
                        <td rowspan="{{ $kecemerlangan1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td rowspan="{{ $kecemerlangan1count }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($kecemerlangan2 as $key => $kpis)
                  <tr>
                    @if ($key == 0)
                      <td rowspan="{{ $kecemerlangan2count }}">
                        <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                      </td>
                      <td rowspan="{{ $kecemerlangan2count }}" class="text-xs font-weight-bold mb-0">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                      </td>
                    @else
                    @endif
                    @if ($loop->last)
                      <td class="text-xs font-weight-bold">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                      </td>
                      <td class="text-xs font-weight-bold">
                        @if ($kpis->bukti_path == '')
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                        @else
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                        @endif
                      </td>
                    @else
                      <td class="text-xs font-weight-bold good">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                      </td>
                      <td class="text-xs font-weight-bold good">
                        @if ($kpis->bukti_path == '')
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                        @else
                        <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                        @endif
                      </td>
                    @endif
                    @if ($key == 0)
                      <td rowspan="{{ $kecemerlangan2count }}" class="align-middle text-center">
                        @if ($kpis->kpimasters->link == '')
                        -
                        @else
                        <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                        @endif
                      </td>
                      <td rowspan="{{ $kecemerlangan2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                      </td>
                      <td rowspan="{{ $kecemerlangan2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                      </td>
                      <td rowspan="{{ $kecemerlangan2count }}" class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                          <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                              </div>
                          </div>
                        </div>
                      </td>
                      <td rowspan="{{ $kecemerlangan2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                      </td>
                      <td rowspan="{{ $kecemerlangan2count }}" class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                      </td>
                    @else
                    @endif
                  </tr>
                @endforeach
                @foreach ($kecemerlangan3 as $key => $kpis)
                <tr>
                  @if ($key == 0)
                    <td rowspan="{{ $kecemerlangan3count }}">
                      <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                    </td>
                    <td rowspan="{{ $kecemerlangan3count }}" class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                    </td>
                  @else
                  @endif
                  @if ($loop->last)
                    <td class="text-xs font-weight-bold">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                    </td>
                    <td class="text-xs font-weight-bold">
                      @if ($kpis->bukti_path == '')
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                      @endif
                    </td>
                  @else
                    <td class="text-xs font-weight-bold good">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                    </td>
                    <td class="text-xs font-weight-bold good">
                      @if ($kpis->bukti_path == '')
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                      @endif
                    </td>
                  @endif
                  @if ($key == 0)
                    <td rowspan="{{ $kecemerlangan3count }}" class="align-middle text-center">
                      @if ($kpis->kpimasters->link == '')
                      -
                      @else
                      <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                      @endif
                    </td>
                    <td rowspan="{{ $kecemerlangan3count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                    </td>
                    <td rowspan="{{ $kecemerlangan3count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                    </td>
                    <td rowspan="{{ $kecemerlangan3count }}" class="align-middle text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                        <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                            </div>
                        </div>
                      </div>
                    </td>
                    <td rowspan="{{ $kecemerlangan3count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                    </td>
                    <td rowspan="{{ $kecemerlangan3count }}" class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                    </td>
                  @else
                  @endif
                </tr>
              @endforeach
              @foreach ($kecemerlangan4 as $key => $kpis)
              <tr>
                @if ($key == 0)
                  <td rowspan="{{ $kecemerlangan4count }}">
                    <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                  </td>
                  <td rowspan="{{ $kecemerlangan4count }}" class="text-xs font-weight-bold mb-0">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                  </td>
                @else
                @endif
                @if ($loop->last)
                  <td class="text-xs font-weight-bold">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                  </td>
                  <td class="text-xs font-weight-bold">
                    @if ($kpis->bukti_path == '')
                    <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                @else
                  <td class="text-xs font-weight-bold good">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                  </td>
                  <td class="text-xs font-weight-bold good">
                    @if ($kpis->bukti_path == '')
                    <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                @endif
                @if ($key == 0)
                  <td rowspan="{{ $kecemerlangan4count }}" class="align-middle text-center">
                    @if ($kpis->kpimasters->link == '')
                    -
                    @else
                    <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td rowspan="{{ $kecemerlangan4count }}" class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                  </td>
                  <td rowspan="{{ $kecemerlangan4count }}" class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                  </td>
                  <td rowspan="{{ $kecemerlangan4count }}" class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td rowspan="{{ $kecemerlangan4count }}" class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                  </td>
                  <td rowspan="{{ $kecemerlangan4count }}" class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                  </td>
                @else
                @endif
              </tr>
            @endforeach
            @foreach ($kecemerlangan5 as $key => $kpis)
            <tr>
              @if ($key == 0)
                <td rowspan="{{ $kecemerlangan5count }}">
                  <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                </td>
                <td rowspan="{{ $kecemerlangan5count }}" class="text-xs font-weight-bold mb-0">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                </td>
              @else
              @endif
              @if ($loop->last)
                <td class="text-xs font-weight-bold">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                </td>
                <td class="text-xs font-weight-bold">
                  @if ($kpis->bukti_path == '')
                  <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                  @else
                  <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                  @endif
                </td>
              @else
                <td class="text-xs font-weight-bold good">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                </td>
                <td class="text-xs font-weight-bold good">
                  @if ($kpis->bukti_path == '')
                  <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                  @else
                  <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                  @endif
                </td>
              @endif
              @if ($key == 0)
                <td rowspan="{{ $kecemerlangan5count }}" class="align-middle text-center">
                  @if ($kpis->kpimasters->link == '')
                  -
                  @else
                  <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                  @endif
                </td>
                <td rowspan="{{ $kecemerlangan5count }}" class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                </td>
                <td rowspan="{{ $kecemerlangan5count }}" class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                </td>
                <td rowspan="{{ $kecemerlangan5count }}" class="align-middle text-center">
                  <div class="d-flex align-items-center justify-content-center">
                    <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                    <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                        </div>
                    </div>
                  </div>
                </td>
                <td rowspan="{{ $kecemerlangan5count }}" class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                </td>
                <td rowspan="{{ $kecemerlangan5count }}" class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                </td>
              @else
              @endif
            </tr>
          @endforeach
                  @foreach ($training as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td rowspan="{{ $trainingcount }}">
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td rowspan="{{ $trainingcount }}" class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                      @endif
                      @if ($loop->last)
                        <td class="text-xs font-weight-bold">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @else
                        <td class="text-xs font-weight-bold good">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold good">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @endif
                      @if ($key == 0)
                        <td rowspan="{{ $trainingcount }}" class="align-middle text-center">
                          @if ($kpis->kpimasters->link == '')
                          -
                          @else
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                        <td rowspan="{{ $trainingcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td rowspan="{{ $trainingcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td rowspan="{{ $trainingcount }}" class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                            <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                                </div>
                            </div>
                          </div>
                        </td>
                        <td rowspan="{{ $trainingcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td rowspan="{{ $trainingcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($ncr as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td rowspan="{{ $ncrcount }}">
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td rowspan="{{ $ncrcount }}" class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                      @endif
                      @if ($loop->last)
                        <td class="text-xs font-weight-bold">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @else
                        <td class="text-xs font-weight-bold good">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold good">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @endif
                      @if ($key == 0)
                        <td rowspan="{{ $ncrcount }}" class="align-middle text-center">
                          @if ($kpis->kpimasters->link == '')
                          -
                          @else
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                        <td rowspan="{{ $ncrcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td rowspan="{{ $ncrcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td rowspan="{{ $ncrcount }}" class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                            <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                                </div>
                            </div>
                          </div>
                        </td>
                        <td rowspan="{{ $ncrcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td rowspan="{{ $ncrcount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
                      @endif
                    </tr>
                  @endforeach
                  @foreach ($kolaborasi as $key => $kpis)
                    <tr>
                      @if ($key == 0)
                        <td rowspan="{{ $kolaborasicount }}">
                          <p class="text-xs font-weight-bold mb-0 px-3" value="{{ $kpis -> fungsi }}">{{ $kpis -> fungsi }}</p>
                        </td>
                        <td rowspan="{{ $kolaborasicount }}" class="text-xs font-weight-bold mb-0">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> objektif }}">{{ $kpis->kpimasters -> objektif }}</span>
                        </td>
                      @else
                      @endif
                      @if ($loop->last)
                        <td class="text-xs font-weight-bold">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @else
                        <td class="text-xs font-weight-bold good">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis -> bukti }}">{{ $kpis -> bukti }}</span>
                        </td>
                        <td class="text-xs font-weight-bold good">
                          @if ($kpis->bukti_path == '')
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                          @else
                          <a href=" {{ $kpis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                      @endif
                      @if ($key == 0)
                        <td rowspan="{{ $kolaborasicount }}" class="align-middle text-center">
                          @if ($kpis->kpimasters->link == '')
                          -
                          @else
                          <a href=" {{ $kpis->kpimasters->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                          @endif
                        </td>
                        <td rowspan="{{ $kolaborasicount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> percent_master }}">{{ $kpis->kpimasters -> percent_master }}</span>
                        </td>
                        <td rowspan="{{ $kolaborasicount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="">Percentage (%)</span>
                        </td>
                        <td rowspan="{{ $kolaborasicount }}" class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold" value="{{ $kpis->kpimasters -> pencapaian }}">{{ number_format( (integer)($kpis->kpimasters->skor_KPI)) }}%</span>
                            <div>
                                <div class="progress">
                                  <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpis->kpimasters->skor_KPI }}%;"></div>
                                </div>
                            </div>
                          </div>
                        </td>
                        <td rowspan="{{ $kolaborasicount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ $kpis->kpimasters -> skor_KPI }}">{{ $kpis->kpimasters -> skor_KPI }}</span>
                        </td>
                        <td rowspan="{{ $kolaborasicount }}" class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold" value="{{ round($kpis->kpimasters -> skor_sebenar,2) }}">{{ round($kpis->kpimasters -> skor_sebenar,2) }} %</span>
                        </td>
                      @else
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
    @if ($kecekapan_master < 100) 
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('fail2') }}Your total weightage for Kecekapan Master is lower than 100%. Please check back.</strong>
    </div>
    @else
    @endif
    @if ($kecekapan_master > 100) 
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('fail2') }}Your total weightage for Kecekapan Master exceed 100%. Please check back.</strong>
    </div>
    @else
    @endif
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>SCORE CARD - Kecekapan Teras <span style="color:red;">(Current total weightage = {{$kecekapan_master}})</span></h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center justify-content-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kecekapan Teras</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expected Result</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">%</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Measurement</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee<br>Score</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Manager<br>Score</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actual<br>Score</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kecekapan as $key => $kecekapans)
                    <tr>
                      <td>

                        <div class="d-flex px-3 py-1">
                          <div class="d-flex flex-column justify-content-center"> 
                            <p class="text-xs font-weight-bold mb-0" value="{{ $kecekapans -> kecekapan_teras }}">{{ $kecekapans -> kecekapan_teras }}</p>
                          </div>
                        </div> 
                      </td>

                      @if ($kecekapans -> kecekapan_teras == "Kepimpinan Organisasi")
                      <td class="text-xs font-weight-bold mb-0">
                        <h6 class="text-secondary text-xs font-weight-bold boxes" value="">
                          Pekerja yang sedar dan menyesuaikan diri dengan strategi organisasi
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi
                          <br>
                          Pengurus yang dapat mengembangkan dan memperkasakan pekerja bawahannya
                          <br>
                          Budaya organisasi yang mencerminkan nilainya
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi</h6>
                      </td>
                      @else
                      @endif 

                      @if ($kecekapans -> kecekapan_teras == "Keupayaan Inovatif")
                      <td class="text-xs font-weight-bold mb-0">
                        <h6 class="text-secondary text-xs font-weight-bold boxes" value="">
                          Pekerja yang berupaya memberi idea dan memberi penyelesaian untuk menyelesaikan masalah
                          <br>
                          Amalan kerja yang dikemas kini lebih sesuai dengan jangkaan masa kini
                          <br>
                          Penerimaan untuk organisasi, dan semua bahagiannya, perlu berubah dan terus meningkat
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi</h6>
                      </td>
                      @else
                      @endif 

                      @if ($kecekapans -> kecekapan_teras == "Pengurusan Pelanggan")
                      <td class="text-xs font-weight-bold mb-0">
                        <h6 class="text-secondary text-xs font-weight-bold boxes" value="">
                          Amalan organisasi yang lebih sesuai dengan keperluan pelanggan moden
                          <br>
                          Pekerja yang memahami dan bertindak mengikut kehendak pelanggan tepat pada masanya
                          <br>
                          Penciptaan produk dan perkhidmatan masa depan yang lebih mencerminkan keperluan pelanggan
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi</h6>
                      </td>
                      @else
                      @endif 

                      @if ($kecekapans -> kecekapan_teras == "Pengurusan Pemegang Berkepentingan")
                      <td class="text-xs font-weight-bold mb-0">
                        <h6 class="text-secondary text-xs font-weight-bold boxes" value="">
                          Pekerja yang lebih empati dengan pihak berkepentingan mereka
                          <br>
                          Pembinaan hubungan positif dengan pihak berkepentingan
                          <br>
                          Pembentukan perkongsian strategik yang membantu mencapai objektif organisasi
                          <br>
                          Pengurus yang mendorong pekerja bawahan mereka membina rangkaian profesional mereka sendiri
                          <br>
                          Pemimpin yang bertindak selaras dengan strategi organisasi</h6>
                      </td>
                      @else
                      @endif 

                      @if ($kecekapans -> kecekapan_teras == "Ketangkasan Dalam Organisasi")
                      <td class="text-xs font-weight-bold mb-0">
                        <h6 class="text-secondary text-xs font-weight-bold boxes" value="">
                          Pekerja yang berpengetahuan dan serba boleh
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
    @if ($nilai_master > 120) 
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('fail2') }}Your total weightage for Nilai Master exceed 120%. Please check back.</strong>
    </div>
    @else
    @endif
    @if ($nilai_master < 120) 
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('fail2') }}Your total weightage for Nilai Master is lower than 120%. Please check back.</strong>
    </div>
    @else
    @endif
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>SCORE CARD - Nilai Teras <span style="color:red;">(Current total weightage = {{$nilai_master}})</span></h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table id="data" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai Teras</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expected Result</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">%</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee Score</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Manager Score</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actual Score</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($nilai as $key => $nilais)
                  <tr>
                    <td>   
                      <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center"> 
                          <p class="text-xs font-weight-bold mb-0" value="{{ $nilais -> nilai_teras }}">{{ $nilais -> nilai_teras }}</p>
                        </div>
                      </div>  
                    </td>

                    @if ($nilais -> nilai_teras == "Kepimpinan")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        Kami adalah pemimpin yang bertanggungjawab.
                        <br>
                        Kami memberikan contoh yang baik.
                        <br>
                        Kami melaksanakan setiap apa yang diperkatakan.
                        <br>
                        Kami menjadi inspirasi untuk berubah lebih baik.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Perkembangan")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        Kami ambil peduli dengan peningkatan hidup sendiri.
                        <br>
                        Kami sentiasa menambah dan meningkatkan ilmu pengetahuan.
                        <br>
                        Kami memupuk sikap ingin sentiasa berjaya.
                        <br>
                        Kami sentiasa memperbaiki dan memajukan diri di setiap saat.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Keputusan")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        Kami membantu menggilap potensi orang lain.
                        <br>
                        Kami memastikan pelanggan mencapai keputusan cemerlang.
                        <br>
                        Kami komited dengan hasil usaha yang dilakukan.
                        <br>
                        Kami berusaha untuk memberikan yang terbaik.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Sumbangan")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        Kami menghulurkan bantuan dengan sepenuh semangat dan jiwa kami.
                        <br>
                        Kami membantu mengatasi kelemahan dan membina kekuatan pelanggan.
                        <br>
                        Kami komited untuk memberi manfaat dan menyebarkan kebaikan.
                        <br>
                        Kami bertanggungjawab dengan orang sekeliling dan persekitaran.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Rohani")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        Kami adalah hamba Allah.
                        <br>
                        Kami membantu orang untuk mendapat kehidupan yang lebih baik.
                        <br>
                        Kami bangkit berjaya dengan memajukan orang lain.
                        <br>
                        Kami sentiasa beriman dan percaya dengan Qada’ dan Qadar.</span>
                    </td>
                    @else
                    @endif

                    @if ($nilais -> nilai_teras == "Keluarga")
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">
                        Kami sangat menyayangi keluarga kami.
                        <br>
                        Kami berusaha untuk berikan yang terbaik kepada keluarga kami.
                        <br>
                        Kami tidak akan mengabaikan keluarga kami.
                        <br>
                        Kami percaya kebahagiaan keluarga adalah kebahagiaan kami.</span>
                    </td>
                    @else
                    @endif
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{  '20%' }}">{{  '20%' }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ 'Percentage (%)' }}">{{ 'Percentage (%)' }}</span>
                    </td>
                    <td class="align-middle text-center" style="max-width: 10px">
                      <span class="text-secondary text-xs font-weight-bold" value="{{ $nilais -> skor_pekerja }}">{{ $nilais -> skor_pekerja }}</span>
                    </td>
                    <td class="align-middle text-center" style="max-width: 10px">
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

  <div class="col-12">    
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  @if (!$kpiall->isEmpty())
                    <h6 class="mb-3 text-sm">Jumlah Markah</h6>
                    <span class="mb-2 text-xs">KPI : 
                    @foreach ($kpiall as $key => $kpialls)
                    <span class="text-dark font-weight-bold ms-sm-2">{{ $kpialls -> total_score_master }}%</span></span>
                    @endforeach
                    <span class="mb-2 text-xs">Score Akhir: 
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
                  @else
                    <h6 class="mb-3 text-sm">Jumlah Markah</h6>
                    <span class="mb-2 text-xs">KPI : <br>
                    <span class="mb-2 text-xs">Score Akhir: <br>
                    <span class="mb-2 text-xs">Kecekapan Teras: <br>
                    <span class="mb-2 text-xs">Nilai Teras: <br>
                    <span class="text-xs">Grade: <br>
                  @endif
                  
                </div>
                <div class="ms-auto text-end">
                  <div class="col-12 text-end ">
                    @foreach ($date as $dates)
                      @if ($dates->status == 'Not Submitted')
                        <a class="btn bg-gradient-info mb-0" href="{{ url('employee/changeup/kpi/'.$dates->id) }}" class="btn btn-dark btn-sm"role="button"><i class="fa fa-edit"></i>&nbsp;Sign & Submit</a>
                      @elseif ($dates->status == 'Submitted')
                        <a class="btn bg-gradient-danger mb-0" href="{{ url('employee/changedown/kpi/'.$dates->id) }}" class="btn btn-dark btn-sm"  role="button"><i class="fa fa-edit"></i>&nbsp;Undo Sign & Undo Submit</a>
                      @else
                      @endif
                    @endforeach
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      @if ($dates->message_manager == '')
    @else
    <div class="col-3">
      <div class="card p-0 shadow-lg">
        <div class="card card-plain">
            <div class="card-body pb-2">
              <div class="form-group mb-2 mt-md-0 mt-4">
                <label>Manager message to you</label><br>
                <pre class="align-center" style="color: red;" value="{{ $dates -> message_manager }}">{{ $dates -> message_manager }}</pre>  
              </div>
            </div>      
        </div>
      </div>
    </div> 
    @endif

    @if ($dates->message_hr == '')
    @else
    <div class="col-3">
      <div class="card p-0 shadow-lg">
        <div class="card card-plain">
            <div class="card-body pb-2">
              <div class="form-group mb-2 mt-md-0 mt-4">
                <label>HR message to you</label><br>
                <pre class="align-center" style="color: blue;" value="{{ $dates -> message_hr }}">{{ $dates -> message_hr }}</pre>  
              </div>
            </div>      
        </div>
      </div>
    </div>
    @endif
    </div>
  </div>  
</div>
</body>
<br>
<div class="col-12">    
  <div class="row">
<div class="col-6">
  <div class="card">
    <div class="card-body pt-4 p-3">
      <ul class="list-group">
        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
          <div class="d-flex flex-column">
              <h6 class="mb-3 text-sm">Grade (Reference Only)</h6>
              <span class="mb-2 text-xs">Platinum : <span class="text-dark font-weight-bold ms-sm-2">100%-80%</span></span>
              <span class="mb-2 text-xs">High Gold: <span class="text-dark font-weight-bold ms-sm-2">75%-79.9%</span></span>
              <span class="mb-2 text-xs">Mid Gold: <span class="text-dark font-weight-bold ms-sm-2">70%-74.9%</span></span>
              <span class="mb-2 text-xs">Low Gold: <span class="text-dark font-weight-bold ms-sm-2">65%-69.9%</span></span>
              <span class="mb-2 text-xs">High Silver: <span class="text-dark font-weight-bold ms-sm-2">60%-64.9%</span></span>
              <span class="mb-2 text-xs">Low Silver: <span class="text-dark font-weight-bold ms-sm-2">50%-59.9%</span></span>
              <span class="text-xs">Bronze: <span class="text-dark font-weight-bold ms-sm-2">0%-49.9%</span></span> 
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
</div>
</div>
  
  <!-- Master Pencapaian JS -->
  <script src="{{asset('assets/js/master.js')}}"></script>
  <script src="{{asset('assets/js/kecekapan.js')}}"></script>
  <script src="{{asset('assets/js/nilai.js')}}"></script>
  
@endsection