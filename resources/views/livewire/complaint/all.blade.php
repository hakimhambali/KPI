@include('layouts.navbars.auth.nav')
<div>
    <div>
        <style>
            .solid {border-style: solid;}
            input[type=file]::file-selector-button {
            border: 2px solid #ffffff;
            padding: .2em .4em;
            border-radius: .7em;
            background-color: #252f40;
            border-color: #252f40;
            color: white;
            transition: 1s;
            }
      
            input[type=file]::file-selector-button:hover {
            background-color: #000000;
            border: 2px solid #000000;
            }
        </style>  
        <body>
          <div class="container-fluid py-4">
            <div class="row">
              <div class="col-lg-12">
                    
                <div class="row">
                  <div class="col-md-12 mb-lg-0 mb-4">
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>{{ session('message') }}</strong></div>	
                    @endif
                    @if (session('fail'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>{{ session('fail') }}</strong></div>
                    @endif

                    <div class="card">
                      <form action="{{ url('/pro/create/complaint') }}" method="post" enctype="multipart/form-data">
                      @csrf  
                        <div class="card-body">
                          <h6>COMPLAINT FORM</h6><hr>

                          <div class="row">
                            <div class="col-md-6 mb-3 mt-2">
                              <label class="form-label">Location of Damage<span class="text-danger">*</span></label>
                              <select class="form-select" id="location" name="location">
                                <option value="Kluang">Kluang</option>
                                <option value="Shah Alam">Shah Alam</option>
                              </select>

                              <label class="form-label">*If located at Kluang, please select office building</label><br>
                              <input type="checkbox" id="office" name="office[]" value="Office 1"><label for="office">Office 1</label><br>
                              <input type="checkbox" id="office" name="office[]" value="Office 2"><label for="office">Office 2</label><br>
                            </div>

                            <div class="col-md-6 mb-3 mt-2">
                              <label class="form-label">State Office Floor<span class="text-danger">*</span></label>
                              <input class="form-control" type="text" name="level" value="{{ old('level') }}" placeholder="Eg: Tingkat 1" required>

                              <label class="form-label">Damage Categories<span class="text-danger">*</span></label><br>
                              <input type="checkbox" id="category" name="category[]" value="Kebocoran Tangki / Saluran Tersumbat"><label for="category">Kebocoran Tangki / Saluran Tersumbat</label><br>
                              <input type="checkbox" id="category" name="category[]" value="Paip rosak"><label for="category">Paip rosak</label><br>
                              <input type="checkbox" id="category" name="category[]" value="Penghawa Dingin"><label for="category">Penghawa Dingin</label><br>
                              <input type="checkbox" id="category" name="category[]" value="Gangguan elektrik"><label for="category">Gangguan elektrik</label><br>
                              <input type="checkbox" id="category" name="category[]" value="Telefon / talian terputus"><label for="category">Telefon / talian terputus</label><br>
                              <input type="checkbox" id="category" name="category[]" value="Kerosakan pintu , tangga, ceiling"><label for="category">Kerosakan pintu , tangga, ceiling</label><br>
                              <input type="checkbox" id="category" name="category[]" value="Lain-lain kerosakan"><label for="category">Lain-lain kerosakan</label><br>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12 mb-3">
                              <label class="form-label">Description<span class="text-danger">*</span></label>
                              <textarea class="form-control" name="description" id="description" rows="5" placeholder="Please insert the damage's description here..." required></textarea>
                            </div>
                          </div>
                          
                          <div class="col-12 text-end">
                            <button class="btn bg-gradient-dark btn-sm px-4" type="submit" href="javascript:;">SAVE</button>
                          </div>

                        </div>
                      </form>     
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
    
          @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'pro')
            <div class="container-fluid py-4">
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card">
                    <div class="card-body">
                      <h6 class="mb-3">ALL COMPLAINTS</h6>

                      <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle">
                          <thead class="text-center text-xxs fw-bold opacity-7">
                            <tr>
                              <th>NO</th>
                              <th>NAME</th>
                              <th>DEPARTMENT</th>
                              <th>DATE</th>
                              <th>LOCATION</th>
                              <th>CATEGORY</th>
                              <th>DESCRIPTION</th>
                              <th>STATUS</th>
                              @if (auth()->user()->role == 'admin' || auth()->user()->role == 'pro')
                                <th>ACTION</th>
                              @endif
                            </tr>
                          </thead>

                          <tbody>
                            @php($i = 1)
                            @foreach ($complaint as $key => $complaints)
                              <tr>
                                <td class="text-sm text-center">{{$key + 1}}</td>
                                <td class="text-xs">
                                  <b>{{ $complaints->user->name }}</b><br>
                                  {{ $complaints->user->position }}
                                </td>
                                <td class="text-xs fw-bold">{{ $complaints->user->department }}</td>
                                <td class="text-xs fw-bold">{{ date('d/m/Y', strtotime($complaints->updated_at)) }}</td>
                                <td class="text-xs fw-bold">
                                  {{ $complaints->location }}<br>
                                  @if($complaints->office != NULL)
                                    <?php $offices = json_decode($complaints->office); ?>
                                    ( @foreach ($offices as $officess)
                                      {{ $officess }}
                                    @endforeach
                                    ) <br>
                                  @endif
                                  - {{ $complaints->level }}
                                </td>
                                <td class="text-xs fw-bold">
                                  <?php $categorys = json_decode($complaints->category); ?>
                                  @foreach ($categorys as $categoryss)
                                  <i class="bi bi-diamond-fill "></i> {{ $categoryss }} <br>
                                  @endforeach
                                  </ul>
                                </td>
                                <td class="text-xs fw-bold">{{ $complaints->description }}</td>
                                <td class="text-center text-xs">
                                  @if($complaints->status == "Complete")
                                    <span class="badge bg-success badge-sm">{{ $complaints->status }}</span>
                                  @else
                                    <span class="badge bg-danger">{{ $complaints->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                  <form action="{{ route('complaint/update', $complaints->id)}}" method="post">
                                    @csrf
                                    @if($complaints->status == "Incomplete")
                                      <button type="submit" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Update Status"><i class="bi bi-pencil-square"></i></button>
                                    @endif
                                    <button type="button" wire:click="selectItem({{$complaints->id}})" class="btn btn-danger btn-sm btn-icon data-delete" data-form="{{$complaints->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
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
            @endif
    
          @push('scripts')
          <script>
            document.addEventListener('livewire:load', function () {
              $(document).on("click", ".data-delete", function (e) 
                  {
                      e.preventDefault();
                      swal({
                      title: "Are you sure?",
                      text: "Once deleted, you will not be able to recover!",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                      })
                      .then((willDelete) => {
                      if (willDelete) {
                          e.preventDefault();
                          Livewire.emit('delete')
                      } 
                      });
                  });
            })
          </script>
          @endpush
    
        </body>
    </div>
    </div>
    
    
    