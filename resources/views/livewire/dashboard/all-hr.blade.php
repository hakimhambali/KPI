{{--------------------------------------------------- EMPLOYEE DETAILS --------------------------------------------------}}
<div class="container-fluid py-4">
{{--------------------------------------------------- SENIOR LEADERSHIP TEAM (SLT) DEPARTMENT EMPLOYEE --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Employee Details</h6>
          <p><strong>{{$userscount}} employees</strong> in this company</p>
          <p><strong>{{$sltempcount}} employees</strong> in Senior Leadership Team (SLT) department</p>
        </div>
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
                @foreach ($sltemp as $sltemps)
                <tr>
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm" value="{{$sltemps->id}}">{{$sltemps->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{$sltemps->id}}">{{$sltemps->position}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$sltemps->id}}">{{$sltemps->nostaff}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$sltemps->id}}">{{$sltemps->unit}}</span>
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
                            <li><a href="{{ url('view-date/'.$sltemps->id) }}" class="dropdown-item border-radius-md" role="button">View</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{{--------------------------------------------------- CEO OFFICE DEPARTMENT EMPLOYEE --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <p><strong>{{$ceoempcount}} employees</strong> in CEO Office department</p>
        </div>
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
                @foreach ($ceoemp as $ceoemps)
                <tr>
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm" value="{{$ceoemps->id}}">{{$ceoemps->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{$ceoemps->id}}">{{$ceoemps->position}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$ceoemps->id}}">{{$ceoemps->nostaff}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$ceoemps->id}}">{{$ceoemps->unit}}</span>
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
                            <li><a href="{{ url('view-date/'.$ceoemps->id) }}" class="dropdown-item border-radius-md" role="button">View</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{{--------------------------------------------------- HUMAN RESOURCE (HR) & ADMINISTRATION DEPARTMENT EMPLOYEE --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <p><strong>{{$hrempcount}} employees</strong> in Human Resource (HR) & Administration department</p>
        </div>
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
                @foreach ($hremp as $hremps)
                <tr>
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm" value="{{$hremps->id}}">{{$hremps->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{$hremps->id}}">{{$hremps->position}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$hremps->id}}">{{$hremps->nostaff}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$hremps->id}}">{{$hremps->unit}}</span>
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
                            <li><a href="{{ url('view-date/'.$hremps->id) }}" class="dropdown-item border-radius-md" role="button">View</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{{--------------------------------------------------- ACCOUNT & FINANCE (A&F) DEPARTMENT EMPLOYEE --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <p><strong>{{$afempcount}} employees</strong> in Account & Finance (A&F) department</p>
        </div>
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
                @foreach ($afemp as $afemps)
                <tr>
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm" value="{{$afemps->id}}">{{$afemps->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{$afemps->id}}">{{$afemps->position}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$afemps->id}}">{{$afemps->nostaff}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$afemps->id}}">{{$afemps->unit}}</span>
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
                            <li><a href="{{ url('view-date/'.$afemps->id) }}" class="dropdown-item border-radius-md" role="button">View</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{{--------------------------------------------------- SALES DEPARTMENT EMPLOYEE --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <p><strong>{{$salesempcount}} employees</strong> in Sales department</p>
        </div>
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
                @foreach ($salesemp as $salesemps)
                <tr>
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm" value="{{$salesemps->id}}">{{$salesemps->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{$salesemps->id}}">{{$salesemps->position}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$salesemps->id}}">{{$salesemps->nostaff}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$salesemps->id}}">{{$salesemps->unit}}</span>
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
                            <li><a href="{{ url('view-date/'.$salesemps->id) }}" class="dropdown-item border-radius-md" role="button">View</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{{--------------------------------------------------- MARKETING DEPARTMENT EMPLOYEE --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <p><strong>{{$marketingempcount}} employees</strong> in Marketing department</p>
        </div>
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
                @foreach ($marketingemp as $marketingemps)
                <tr>
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm" value="{{$marketingemps->id}}">{{$marketingemps->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{$marketingemps->id}}">{{$marketingemps->position}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$marketingemps->id}}">{{$marketingemps->nostaff}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$marketingemps->id}}">{{$marketingemps->unit}}</span>
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
                            <li><a href="{{ url('view-date/'.$marketingemps->id) }}" class="dropdown-item border-radius-md" role="button">View</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{{--------------------------------------------------- OPERATION DEPARTMENT EMPLOYEE --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <p><strong>{{$operationempcount}} employees</strong> in Operation department</p>
        </div>
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
                @foreach ($operationemp as $operationemps)
                <tr>
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm" value="{{$operationemps->id}}">{{$operationemps->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{$operationemps->id}}">{{$operationemps->position}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$operationemps->id}}">{{$operationemps->nostaff}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$operationemps->id}}">{{$operationemps->unit}}</span>
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
                            <li><a href="{{ url('view-date/'.$operationemps->id) }}" class="dropdown-item border-radius-md" role="button">View</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{{--------------------------------------------------- HIGH NETWORK CLIENT (HNC) DEPARTMENT EMPLOYEE --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <p><strong>{{$hncempcount}} employees</strong> in High Network Client (HNC) department</p>
        </div>
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
                @foreach ($hncemp as $hncemps)
                <tr>
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm" value="{{$hncemps->id}}">{{$hncemps->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{$hncemps->id}}">{{$hncemps->position}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$hncemps->id}}">{{$hncemps->nostaff}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$hncemps->id}}">{{$hncemps->unit}}</span>
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
                            <li><a href="{{ url('view-date/'.$hncemps->id) }}" class="dropdown-item border-radius-md" role="button">View</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
{{--------------------------------------------------- RESEARCH & DEVELOPMENT (R&D) DEPARTMENT EMPLOYEE --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <p><strong>{{$rndempcount}} employees</strong> in R&D department</p>
        </div>
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
                @foreach ($rndemp as $rndemps)
                <tr>
                  <td>    
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm" value="{{$rndemps->id}}">{{$rndemps->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="{{$rndemps->id}}">{{$rndemps->position}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$rndemps->id}}">{{$rndemps->nostaff}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" value="{{$rndemps->id}}">{{$rndemps->unit}}</span>
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
                          <li><a href="{{ url('view-date/'.$rndemps->id) }}" class="dropdown-item border-radius-md" role="button">View</a></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                  </div>
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
