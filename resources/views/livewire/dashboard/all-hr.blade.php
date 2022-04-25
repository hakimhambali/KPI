{{--------------------------------------------------- EMPLOYEE DETAILS --------------------------------------------------}}
<div class="container-fluid py-4">
{{--------------------------------------------------- EMPLOYEE DETAILS ACCORDING TO THEIR DEPARTMENT --------------------------------------------------}}
@foreach ($department as $key => $departments)
  @foreach ($departmentArr as $key => $departmentArrs)
    @foreach ($departmentArrs as $key => $departmentArrss)
      <?php $numOfTeamAll = $departmentArrss->count() ?>
    @endforeach
  @endforeach
@endforeach

@foreach ($department as $key1 => $departments)
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
        @if ($loop->first)
        <div class="card-header pb-0">
          <p><strong>{{$numOfTeamAll}} employees</strong> in Momentum Internet Sdn Bhd</p>
        </div>
        @endif

      <div class="card-body px-0 pt-0 pb-2">
        <div class="p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-6">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 col-2">Position</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">ID No</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2">Unit</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($departmentArr as $key2 => $departmentArrs)
              @foreach ($departmentArrs as $key3 => $departmentArrss)
              @if($departments->name == $departmentArrss->department)

              @if ($loop->last)
              <div class="card-header pb-0">
                <p><strong>{{$key3+1}} employees</strong> in {{$departments->name}} department</p>
              </div>
              @endif

              <tr>
                <td>    
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                    </div>
                    
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm" value="{{$departmentArrss->id}}">{{$departmentArrss->name}}</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0" value="{{$departmentArrss->id}}">{{$departmentArrss->position}}</p>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{$departmentArrss->id}}">{{$departmentArrss->nostaff}}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold" value="{{$departmentArrss->id}}">{{$departmentArrss->unit}}</span>
                </td>
                <div class="d-flex flex-column justify-content-center">
                </div>
                <div class="d-flex flex-column justify-content-center">
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('view-date/'.$departmentArrss->id) }}" class="dropdown-item border-radius-md" role="button">View KPI</a></li>
                          <li><a href="{{ url('/hr/view/training-coaching/'.$departmentArrss->id) }}" class="dropdown-item border-radius-md" role="button">View Training & Coaching</a></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </div>
              </tr>
                @endif
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

</div>

<!--   Core JS Files   -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script src="../assets/js/plugins/Chart.extension.js"></script>
<script>
  var ctx = document.getElementById("chart-bars").getContext("2d");

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Sales",
        tension: 0.4,
        borderWidth: 0,
        pointRadius: 0,
        backgroundColor: "#fff",
        data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
        maxBarThickness: 6
      }, ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false,
      },
      tooltips: {
        enabled: true,
        mode: "index",
        intersect: false,
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: false,
          },
          ticks: {
            suggestedMin: 0,
            suggestedMax: 500,
            beginAtZero: true,
            padding: 0,
            fontSize: 14,
            lineHeight: 3,
            fontColor: "#fff",
            fontStyle: 'normal',
            fontFamily: "Open Sans",
          },
        }, ],
        xAxes: [{
          gridLines: {
            display: false,
          },
          ticks: {
            display: false,
            padding: 20,
          },
        }, ],
      },
    },
  });

  var ctx2 = document.getElementById("chart-line").getContext("2d");

  var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

  gradientStroke1.addColorStop(1, 'rgba(253,235,173,0.4)');
  gradientStroke1.addColorStop(0.2, 'rgba(245,57,57,0.0)');
  gradientStroke1.addColorStop(0, 'rgba(255,214,61,0)'); //purple colors

  var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

  gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.4)');
  gradientStroke2.addColorStop(0.2, 'rgba(245,57,57,0.0)');
  gradientStroke2.addColorStop(0, 'rgba(255,214,61,0)'); //purple colors


  new Chart(ctx2, {
    type: "line",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#fbcf33",
          borderWidth: 3,
          backgroundColor: gradientStroke1,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        },
        {
          label: "Websites",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#f53939",
          borderWidth: 3,
          backgroundColor: gradientStroke2,
          data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
          maxBarThickness: 6

        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false,
      },
      tooltips: {
        enabled: true,
        mode: "index",
        intersect: false,
      },
      scales: {
        yAxes: [{
          gridLines: {
            borderDash: [2],
            borderDashOffset: [2],
            color: '#dee2e6',
            zeroLineColor: '#dee2e6',
            zeroLineWidth: 1,
            zeroLineBorderDash: [2],
            drawBorder: false,
          },
          ticks: {
            suggestedMin: 0,
            suggestedMax: 500,
            beginAtZero: true,
            padding: 10,
            fontSize: 11,
            fontColor: '#adb5bd',
            lineHeight: 3,
            fontStyle: 'normal',
            fontFamily: "Open Sans",
          },
        }, ],
        xAxes: [{
          gridLines: {
            zeroLineColor: 'rgba(0,0,0,0)',
            display: false,
          },
          ticks: {
            padding: 10,
            fontSize: 11,
            fontColor: '#adb5bd',
            lineHeight: 3,
            fontStyle: 'normal',
            fontFamily: "Open Sans",
          },
        }, ],
      },
    },
  });
</script>
