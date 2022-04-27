{{--------------------------------------------------- EMPLOYEE DETAILS --------------------------------------------------}}
<div class="container-fluid pb-4">
{{--------------------------------------------------- EMPLOYEE DETAILS ACCORDING TO THEIR DEPARTMENT --------------------------------------------------}}
<?php $numDep= $department->count() ?>
@foreach ($department as $key => $departments)
  @foreach ($departmentArr as $key => $departmentArrs)
    @foreach ($departmentArrs as $key => $departmentArrss)
      <?php $numOfTeamAll = $departmentArrss->count() ?>
    @endforeach
  @endforeach
@endforeach

<div class="row">
  <div class="col-md-4 pb-3">
    <div class="card bg-gradient-dark text-white text-center py-2">
      <h2 class="text-white">{{$numDep}}</h2>
      <p>Total Departments</p>
    </div>
  </div>

  <div class="col-md-4 pb-3">
    <div class="card bg-gradient-dark text-white text-center py-2">
      <h2 class="text-white">{{ count($unit)}}</h2>
      <p>Total Units</p>
    </div>
  </div>

  <div class="col-md-4 pb-3">
    <div class="card bg-gradient-danger text-white text-center py-2">
      <h2 class="text-white">{{$numOfTeamAll}}</h2>
      <p class="fs-6">Total Employees</p>
    </div>
  </div>
</div>

@foreach ($department as $key1 => $departments)

<div class="row">
  <div class="col-12">
    <div class="card mb-3">

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="text-center text-sm fw-bold opacity-7">
              <tr>
                <th class="col-5">Name</th>
                <th>Position</th>
                <th>ID No</th>
                <th>Unit</th>
                <th></th>
              </tr>
            </thead>
            
            <tbody>
            @foreach ($departmentArr as $key2 => $departmentArrs)
              @foreach ($departmentArrs as $key3 => $departmentArrss)
              @if($departments->name == $departmentArrss->department)

              @if ($loop->last)
                <div class="fs-5 fw-bolder text-dark mb-3">{{$departments->name}} Department <span class="float-end badge bg-success fs-6 text-dark py-2">{{$key3+1}} employees</span></div>
              @endif

              <tr>
                <td class="text-xs fw-bolder text-uppercase">
                      <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">

                  {{$departmentArrss->name}}
                </td>
                {{-- <div class="d-flex flex-column justify-content-center">
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
                </div> --}}
                <td class="text-xs fw-bold text-center">{{$departmentArrss->position}}</td>
                <td class="text-xs fw-bold text-center">{{$departmentArrss->nostaff}}</td>
                <td class="text-xs fw-bold text-center">{{$departmentArrss->unit}}</td>
                <td class="text-xs fw-bold"><a href="{{ url('view-date/'.$departmentArrss->id) }}" class="btn btn-info btn-sm btn-icon my-auto" data-bs-toggle="tooltip" data-bs-original-title="View KPI"><i class="bi bi-list-columns-reverse"></i></a></td>
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
