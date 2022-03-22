{{------------------------------------- KECEKAPAN (ALL USER) ----------------------------------------}}
<div>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header pb-0">
          <h6>List Kecekapan Teras (For Reference Only)</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kecekapan Teras</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expected Result</th>
                </tr>
              </thead>
              <tbody>
                @php($i = 1)

                  <tr>
                    <td>    
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="mb-0 text-sm" value="">1</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0" value="Kepimpinan Organisasi">Kepimpinan Organisasi</p>
                    </td>
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
                  </tr>

                  <tr>
                    <td>    
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="mb-0 text-sm" value="">2</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0" value="Keupayaan Inovatif">Keupayaan Inovatif</p>
                    </td>
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">Pekerja yang berupaya memberi idea dan memberi penyelesaian untuk menyelesaikan masalah
                        <br>
                        Amalan kerja yang dikemas kini lebih sesuai dengan jangkaan masa kini
                        <br>
                        Penerimaan untuk organisasi, dan semua bahagiannya, perlu berubah dan terus meningkat
                        <br>
                        Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                    </td>
                  </tr>

                <tr>
                  <td> 
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="mb-0 text-sm" value="">3</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0" value="Pengurusan Pelanggan">Pengurusan Pelanggan</p>
                  </td>
                    <td class="text-xs font-weight-bold mb-0">
                      <span class="text-secondary text-xs font-weight-bold" value="">Amalan organisasi yang lebih sesuai dengan keperluan pelanggan moden
                        <br>
                        Pekerja yang memahami dan bertindak mengikut kehendak pelanggan tepat pada masanya
                        <br>
                        Penciptaan produk dan perkhidmatan masa depan yang lebih mencerminkan keperluan pelanggan
                        <br>
                        Pemimpin yang bertindak selaras dengan strategi organisasi</span>
                    </td>
                  </tr>

                  <tr>
                    <td> 
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="mb-0 text-sm" value="">4</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0" value="Pengurusan Pemegang Berkepentingan">Pengurusan Pemegang Berkepentingan</p>
                    </td>
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
                  </tr>

                  <tr>
                    <td> 
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <p class="mb-0 text-sm" value="">5</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0" value="Ketangkasan Dalam Organisasi">Ketangkasan Dalam Organisasi</p>
                    </td>
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
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
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

      @if ($status == 'Submitted' || $status == 'Signed By Manager' || $status == 'Completed') 
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning ! If you want to add, edit or delete any Kecekapan Teras, status of this KPI will set to default (Not Submitted)</strong>
      </div>
      @else
      @endif

      <div class="card mt-">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-12 text-end">
              <form action="{{ url('employee/save/kecekapan/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post">
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-md-6 mb-md-0 mb-4">
              @csrf 
              <div class="col-md-12">
                <div class="mb-4" class="@error('kecekapan_teras') border border-danger rounded-3 @enderror">
                  <td style="word-break: break-all;" class="border-dark">
                    <select class="form-select card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" name="kecekapan_teras" id="kecekapan_teras">
                      <label class="font-weight-bold" >Kecekapan Teras</label><br>
                      <option selected value="">-- Please Choose --</option>
                      <option value="Kepimpinan Organisasi" >Kepimpinan Organisasi</option>
                      <option value="Keupayaan Inovatif" >Keupayaan Inovatif</option> 
                      <option value="Pengurusan Pelanggan" >Pengurusan Pelanggan</option> 
                      <option value="Pengurusan Pemegang Berkepentingan" >Pengurusan Pemegang Berkepentingan</option>
                      <option value="Ketangkasan Dalam Organisasi" >Ketangkasan Dalam Organisasi</option>
                    </select>
                  </td>
                </select>
                @error('kecekapan_teras') <div class="text-danger">{{ $message }}</div> @enderror
                </div> 
              </div>
            </div>
          </div>
          
          <div class="row m-auto">
            <div>
              <table class="text-center" style="width: 100%;">
                <thead class="thead-dark">
                  <tr>
                    <th rowspan="2">(%)</th>
                    <th rowspan="2">Measurement</th>
                    {{-- @if ((Auth::user()->role == "employee") || (Auth::user()->role == "pro") || (Auth::user()->role == "dc") || (Auth::user()->role == "admin")) --}}
                    <th rowspan="2">Employee Score (Enter score from 1 to 4 only)</th>
                    {{-- @else
                    @endif --}}

                    {{-- @if ((Auth::user()->role == "manager") || (Auth::user()->role == "admin") || (Auth::user()->role == "hr"))
                    <th rowspan="2">Manager Score (Enter score from 1 to 4 only)</th>
                    @else
                    @endif --}}
                    <th rowspan="2">Actual Score</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="font-weight-bold border-dark">
                      <input type="text"  class="form-control" id="peratus" name="peratus" value="20" onkeyup="masterClac();" min="0" selected readonly>
                    </td>

                    <td class="font-weight-bold border-dark">
                      <input type="text"  class="form-control" id="ukuran" name="ukuran" value="Percentage" selected readonly>
                    </td>

                    {{-- @if ((Auth::user()->role == "employee") || (Auth::user()->role == "pro") || (Auth::user()->role == "dc") || (Auth::user()->role == "admin")) --}}
                    <td style="word-break: break-all;" class="border-dark" class="@error('skor_pekerja') border border-danger rounded-3 @enderror">
                      <input type="text" pattern="[1-4]+" maxlength="1"  class="form-control" id="skor_pekerja" name="skor_pekerja" onkeyup="masterClac();" min="0" >
                      @error('skor_pekerja') <div class="text-danger">{{ $message }}</div> @enderror
                    </td>
                    {{-- @else
                    @endif --}}

                    {{-- @if ((Auth::user()->role == "manager") || (Auth::user()->role == "admin") || (Auth::user()->role == "hr"))
                    <td style="word-break: break-all;" class="border-dark" class="@error('skor_penyelia') border border-danger rounded-3 @enderror">
                      <input type="text" pattern="[1-4]+" maxlength="1"  class="form-control" id="skor_penyelia" name="skor_penyelia" onkeyup="masterClac();" min="0" >
                      @error('skor_penyelia') <div class="text-danger">{{ $message }}</div> @enderror
                    </td>
                    @else
                    @endif --}}

                    <td class="font-weight-bold border-dark">
                      <input type="text"  class="form-control"  id="skor_sebenar" name="skor_sebenar" value="0" readonly>
                    </td>

                  </tr>
                </tbody>
              </table>
              <div class="col-12 text-end mt-2">
                <button type="submit" class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Save</button>
              </div>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
</div>  
</div>

    {{-- @if (Auth::user()->role == "employee" || Auth::user()->role == "dc" || Auth::user()->role == "pro") --}}
        <div class="container-fluid py-4">
          <div class="row">
            <div class="col-md-12">
              <div class="card ">
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kecekapan Teras</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">%</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Measurement</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee Score</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Manager Score</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actual Score</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach ($kecekapan as $key => $kecekapans)
                          <tr>
                            <td>    
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <p class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="{{ $kecekapans -> kecekapan_teras }}">{{ $kecekapans -> kecekapan_teras }}</p>
                            </td>

                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold" value="{{ '20%' }}">{{ '20%' }}</span>
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
                            <td class="align-middle">
                              <div class="col-lg-6 col-5 my-auto text-middle">
                                <div class="dropdown float-lg-start pe-4">
                                  <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                  </a>
                                  <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a href="{{ url('employee/edit/kecekapan/'.$kecekapans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                                    <li><button type="button" wire:click="selectItem({{$kecekapans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kecekapans->id}}">Delete</button></li>
                                  </ul>
                                </div>
                              </div>
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
        {{-- @else
        @endif  --}}

        {{-- @if (Auth::user()->role == "manager" || (Auth::user()->role == "hr")) 
        <div class="container-fluid py-4">
          <div class="row">
            <div class="col-12">
              <div class="card ">
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kecekapan Teras</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">%</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Measurement</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee Score</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Manager Score</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actual Score</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach ($users as $key => $userss)
                          <tr>
                            <td>    
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <p class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="{{ $userss -> kecekapan_teras }}">{{ $userss -> kecekapan_teras }}</p>
                            </td>

                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold" value="{{ '20%' }}">{{ '20%' }}</span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold" value="{{ 'Percentage (%)' }}">{{ 'Percentage (%)' }}</span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold" value="{{ $userss -> skor_pekerja }}}">{{ $userss -> skor_pekerja }}</span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold" value="{{ $userss -> skor_penyelia }}">{{ $userss -> skor_penyelia }}</span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold" value="{{ $userss -> skor_sebenar }}">{{ $userss -> skor_sebenar }}</span>
                            </td>
                            <td class="align-middle">
                              <div class="col-lg-6 col-5 my-auto text-middle">
                                <div class="dropdown float-lg-start pe-4">
                                  <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                  </a>
                                  <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a href="{{ url('employee/edit/kecekapan/'.$userss->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                                    <li><button type="button" wire:click="selectItem({{$userss->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$userss->id}}">Delete</button></li>
                                  </ul>
                                </div>
                              </div>
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
        @else
        @endif  --}}
  </div>

  @push('scripts')
    
  {{-- START SECTION - SCRIPT FOR DELETE BUTTON  --}}
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
  {{-- END SECTION - SCRIPT FOR DELETE BUTTON  --}}
  @endpush
 <!-- Master Pencapaian JS -->
<script src="{{asset('assets/js/kecekapan.js')}}"></script>

</body>
</div>