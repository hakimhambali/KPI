@section('content')
@include('layouts.navbars.auth.nav')
  @extends('layouts.app')

  <div class="container-fluid pb-4">

    <div class="row">
      <div class="col-12">
        <div class="card bg-gradient-dark text-white shadow-blur mb-4">
          <div class="card-body">
            @foreach ($user as $data)
              <span class="fw-bolder text-uppercase">{{ $data->name }}</span><br>
              <span class="fst-italic">{{ $data->department }}</span><br>
              <span class="fst-italic" style="font-size:15px">{{ $data->unit }}</span>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
    
    {{---------------------------- View All Date (HR & MANAGER) ---------------------------------}}
    <div class="card">
      <div class="card-body">
        <h6 class="mb-3">KPI HISTORY</h6>

        @if(!empty($date) && $date->count())
          <div class="table-responsive">
            <table class="table table-hover table-sm align-middle">
              <thead class="text-center text-xxs fw-bold">
                <tr>
                  <th>YEAR</th>
                  <th>MONTH</th>
                  <th>VIEW</th>
                  <th>STATUS</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($date as $key => $dates)
                  <tr>
                    <td class="text-sm fw-bold text-center"><i class="bi bi-calendar-week-fill"></i> {{ $dates -> year }}</td>
                    <td class="text-sm fw-bold text-center">{{ $dates -> month }}</td>
                    <td class="text-xs fw-bold text-center">
                      <a href="{{ url('manager-hr/view/kpi/'.$user_id.'/'.$dates->id.'/'.$user_id.'/'.$dates->year.'/'.$dates->month) }}" type="button" class="btn bg-gradient-success btn-sm px-5 my-auto">KPI Master</a>
                    </td>
                    <td class="text-xs fw-bold text-center">
                      @if ($dates->status == "Not Submitted")
                        <span class="badge bg-gradient-secondary px-4">{{ $dates->status }}</span>
                      @elseif ($dates->status == "Submitted")
                        <span class="badge bg-gradient-info px-4">{{ $dates->status }}</span>
                      @elseif ($dates->status == "Signed By Manager")
                        <span class="badge bg-gradient-dark px-4">{{ $dates->status }}</span>
                      @elseif ($dates->status == "Completed")
                        <span class="badge bg-gradient-success px-4">{{ $dates->status }}</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        @else
          <p class="text-center">There's No KPI Has Been Added.</p>
        @endif

      </div>
    </div>

  </div>
@endsection