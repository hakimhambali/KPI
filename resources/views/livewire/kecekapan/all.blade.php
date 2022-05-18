@include('layouts.navbars.auth.nav')
<div>
{{------------------------------------- KECEKAPAN (ALL USER) ----------------------------------------}}
  <div class="container-fluid pb-4">
    <div class="row">
      <div class="col-lg-12">

        <div class="row">
          <div class="col-md-12 mb-lg-0">
                  
            <div class="card mb-4 bg-gradient-light">  
              <div class="card-body">
                <h6>List Kecekapan Teras (For Reference Only)</h6><hr>

                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-sm align-middle fw-bold">
                      <thead class="text-center text-xxs fw-bolder">
                        <tr>
                          <th class="col-1">NO</th>
                          <th>KECEKAPAN TERAS</th>
                          <th class="col-8">EXPECTED RESULT</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td class="text-xs text-center">1</td>
                          <td class="text-xs text-center">Kepimpinan Organisasi</td>
                          <td class="text-xs"><br>
                            <i class="bi bi-layers-fill"></i> Pekerja yang sedar dan menyesuaikan diri dengan strategi organisasi.<br>
                            <i class="bi bi-layers-fill"></i> Pemimpin yang bertindak selaras dengan strategi organisasi.<br>
                            <i class="bi bi-layers-fill"></i> Pengurus yang dapat mengembangkan dan memperkasakan pekerja bawahannya.<br>
                            <i class="bi bi-layers-fill"></i> Budaya organisasi yang mencerminkan nilainya.<br>
                            <i class="bi bi-layers-fill"></i> Pemimpin yang bertindak selaras dengan strategi organisasi.<br><br>
                          </td>
                        </tr>

                        <tr>
                          <td class="text-xs text-center">2</td>
                          <td class="text-xs text-center">Keupayaan Inovatif</td>
                          <td class="text-xs"><br>
                            <i class="bi bi-layers-fill"></i> Pekerja yang berupaya memberi idea dan memberi penyelesaian untuk menyelesaikan masalah.<br>
                            <i class="bi bi-layers-fill"></i> Amalan kerja yang dikemas kini lebih sesuai dengan jangkaan masa kini.<br>
                            <i class="bi bi-layers-fill"></i> Penerimaan untuk organisasi, dan semua bahagiannya, perlu berubah dan terus meningkat.<br>
                            <i class="bi bi-layers-fill"></i> Pemimpin yang bertindak selaras dengan strategi organisasi.<br><br>
                          </td>
                        </tr>

                        <tr>
                          <td class="text-xs text-center">3</td>
                          <td class="text-xs text-center">Pengurusan Pelanggan</td>
                          <td class="text-xs"><br>
                            <i class="bi bi-layers-fill"></i> Amalan organisasi yang lebih sesuai dengan keperluan pelanggan moden.<br>
                            <i class="bi bi-layers-fill"></i> Pekerja yang memahami dan bertindak mengikut kehendak pelanggan tepat pada masanya.<br>
                            <i class="bi bi-layers-fill"></i> Penciptaan produk dan perkhidmatan masa depan yang lebih mencerminkan keperluan pelanggan.<br>
                            <i class="bi bi-layers-fill"></i> Pemimpin yang bertindak selaras dengan strategi organisasi.<br><br>
                          </td>
                        </tr>

                        <tr>
                          <td class="text-xs text-center">4</td>
                          <td class="text-xs text-center">Pengurusan Pemegang Berkepentingan</td>
                          <td class="text-xs"><br>
                            <i class="bi bi-layers-fill"></i> Pekerja yang lebih empati dengan pihak berkepentingan mereka.<br>
                            <i class="bi bi-layers-fill"></i> Pembinaan hubungan positif dengan pihak berkepentingan.<br>
                            <i class="bi bi-layers-fill"></i> Pembentukan perkongsian strategik yang membantu mencapai objektif organisasi.<br>
                            <i class="bi bi-layers-fill"></i> Pengurus yang mendorong pekerja bawahan mereka membina rangkaian profesional mereka sendiri.<br>
                            <i class="bi bi-layers-fill"></i> Pemimpin yang bertindak selaras dengan strategi organisasi.<br><br>
                          </td>
                        </tr>

                        <tr>
                          <td class="text-xs text-center">5</td>
                          <td class="text-xs text-center">Ketangkasan Dalam Organisasi</td>
                          <td class="text-xs"><br>
                            <i class="bi bi-layers-fill"></i> Pekerja yang berpengetahuan dan serba boleh.<br>
                            <i class="bi bi-layers-fill"></i>  Penghargaan dan penerapan budaya bimbingan dalam organisasi.<br>
                            <i class="bi bi-layers-fill"></i>  Amalan organisasi yang boleh menyesuaikan diri dengan masalah di pasaran.<br>
                            <i class="bi bi-layers-fill"></i>  Organisasi yang menekankan dan mendorong pembelajaran dan perkembangan berterusan.<br>
                            <i class="bi bi-layers-fill"></i>  Pemimpin yang bertindak selaras dengan strategi organisasi.
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

      </div>
    </div>
  </div>

<!----------------------------------INSERT KECEKAPAN FORM------------------------------------------------------------------------------------------>

  <div class="container-fluid pb-4">
    <div class="row">
      <div class="col-lg-12">
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

        <div class="card">
          <form action="{{ url('employee/save/kecekapan/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post">
          @csrf  
            <div class="card-body">
              <h6>INSERT KECEKAPAN TERAS</h6><hr>
                
              <div class="col-md-12 mb-3">
                <select class="form-select" name="kecekapan_teras" id="kecekapan_teras" autofocus required>
                  <option value="">-- Please Choose --</option>
                  <option value="Kepimpinan Organisasi" >Kepimpinan Organisasi</option>
                  <option value="Keupayaan Inovatif" >Keupayaan Inovatif</option> 
                  <option value="Pengurusan Pelanggan" >Pengurusan Pelanggan</option> 
                  <option value="Pengurusan Pemegang Berkepentingan" >Pengurusan Pemegang Berkepentingan</option>
                  <option value="Ketangkasan Dalam Organisasi" >Ketangkasan Dalam Organisasi</option>
                </select>  
                @error('kecekapan_teras') <div class="text-danger">{{ $message }}</div> @enderror
              </div>

              <div class="row mb-3">
                <div class="col-md-12 mx-auto">

                  <div class="table-responsive">
                    <table class="text-center text-sm" style="width: 100%">
                      <thead>
                        <tr>
                          <th class="col-2">(%)</th>
                          <th>Measurement</th>
                          <th class="col-md-3">Employee Score <span class="text-danger">*</span></th>
                          <th>Actual Score</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td><input type="text" class="form-control" id="peratus" name="peratus" value="20" onkeyup="masterClac();" readonly></td>
                          <td><input type="text"  class="form-control" id="ukuran" name="ukuran" value="Percentage" readonly></td>
                          <td>
                            <input type="number" class="form-control" id="skor_pekerja" name="skor_pekerja" placeholder="Enter score from 1 to 4 only" onkeyup="masterClac();" min="1" max="4" required>
                            @error('skor_pekerja') <div class="text-danger">{{ $message }}</div> @enderror
                          </td>
                          <td><input type="text"  class="form-control"  id="skor_sebenar" name="skor_sebenar" value="0" readonly></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

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

<!---------------------------------- INSERTED KECEKAPAN ------------------------------------------------------------------------------------------>
  @if(!empty($kecekapan) && $kecekapan->count())
    <div class="container-fluid pb-4">
      <div class="row">
        <div class="col-md-12">
          
          <div class="card">
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead class="text-center text-xxs fw-bold">
                    <tr>
                      <th>NO</th>
                      <th>KECEKAPAN TERAS</th>
                      <th>%</th>
                      <th>MEASUREMENT</th>
                      <th>EMPLOYEE SCORE</th>
                      <th>MANAGER SCORE</th>
                      <th>ACTUAL SCORE</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    @php($i = 1)
                    @foreach ($kecekapan as $key => $kecekapans)
                      <tr>
                        <td class="text-sm fw-bold text-center">{{$key + 1}}</td>
                        <td class="text-xs fw-bold">{{ $kecekapans -> kecekapan_teras }}</td>
                        <td class="text-xs fw-bold text-center">20</td>
                        <td class="text-xs fw-bold text-center">Percentage (%)</td>
                        <td class="text-xs fw-bold text-center">{{ $kecekapans -> skor_pekerja }}</td>
                        <td class="text-xs fw-bold text-center">{{ $kecekapans -> skor_penyelia }}</td>
                        <td class="text-xs fw-bold text-center">{{ $kecekapans -> skor_sebenar }}</td>
                        <td class="text-center">
                          <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu">
                            <a href="{{ url('employee/edit/kecekapan/'.$kecekapans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item text-dark fw-bold">EDIT</a>
                            <button type="button" wire:click="selectItem({{$kecekapans->id}})" class="dropdown-item text-danger fw-bold data-delete" data-form="{{$kecekapans->id}}">DELETE</a>
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
  @endif

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

</div>