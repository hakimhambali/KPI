@include('layouts.navbars.auth.nav')
<div>
  {{--------------------------------------------------- NILAI (ALL USER) --------------------------------------------------}}
  <div class="container-fluid my-3">
    <div class="row">
      <div class="col-md-12 ">
                  
        <div class="card bg-gradient-light">  
          <div class="card-body">
            <h6>List Nilai Teras (For Reference Only)</h6><hr>

            <div class="row">
              <div class="table-responsive">
                <table class="table table-sm align-middle fw-bold">
                  <thead class="text-center text-xxs fw-bolder">
                    <tr>
                      <th class="col-1">NO</th>
                      <th>NILAI TERAS</th>
                      <th class="col-8">EXPECTED RESULT</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td class="text-xs text-center">1</td>
                      <td class="text-xs text-center">Kepimpinan</td>
                      <td class="text-xs"><br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami adalah pemimpin yang bertanggungjawab.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami memberikan contoh yang baik.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami melaksanakan setiap apa yang diperkatakan.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami menjadi inspirasi untuk berubah lebih baik.<br><br>
                      </td>
                    </tr>

                    <tr>
                      <td class="text-xs text-center">2</td>
                      <td class="text-xs text-center">Perkembangan</td>
                      <td class="text-xs"><br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami ambil peduli dengan peningkatan hidup sendiri.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami sentiasa menambah dan meningkatkan ilmu pengetahuan.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami memupuk sikap ingin sentiasa berjaya.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami sentiasa memperbaiki dan memajukan diri di setiap saat.<br><br>
                      </td>
                    </tr>

                    <tr>
                      <td class="text-xs text-center">3</td>
                      <td class="text-xs text-center">Keputusan</td>
                      <td class="text-xs"><br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami membantu menggilap potensi orang lain.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami memastikan pelanggan mencapai keputusan cemerlang.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami komited dengan hasil usaha yang dilakukan.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami berusaha untuk memberikan yang terbaik.<br><br>
                      </td>
                    </tr>

                    <tr>
                      <td class="text-xs text-center">4</td>
                      <td class="text-xs text-center">Sumbangan</td>
                      <td class="text-xs"><br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami menghulurkan bantuan dengan sepenuh semangat dan jiwa kami.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami membantu mengatasi kelemahan dan membina kekuatan pelanggan.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami komited untuk memberi manfaat dan menyebarkan kebaikan.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami bertanggungjawab dengan orang sekeliling dan persekitaran.<br><br>
                      </td>
                    </tr>

                    <tr>
                      <td class="text-xs text-center">5</td>
                      <td class="text-xs text-center">Rohani</td>
                      <td class="text-xs"><br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami adalah hamba Allah.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami membantu orang untuk mendapat kehidupan yang lebih baik.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami bangkit berjaya dengan memajukan orang lain.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami sentiasa beriman dan percaya dengan Qada’ dan Qadar.<br><br>
                      </td>
                    </tr>

                    <tr>
                      <td class="text-xs text-center">6</td>
                      <td class="text-xs text-center">Keluarga</td>
                      <td class="text-xs"><br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami sangat menyayangi keluarga kami.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami berusaha untuk berikan yang terbaik kepada keluarga kami.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami tidak akan mengabaikan keluarga kami.<br>
                        <i class="bi bi-heart-pulse-fill"></i> Kami percaya kebahagiaan keluarga adalah kebahagiaan kami.
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
  
  <!---------------------------------- NILAI FORM ------------------------------------------------------------------------------------------>
  <div class="container-fluid pb-3">
    <div class="row">
      <div class="col-md-12">
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
            <strong>Warning ! If you want to add, edit or delete any Nilai Teras, status of this KPI will set to default (Not Submitted)</strong>
          </div>
        @else
        @endif

        <div class="card">
          <form action="{{ url('employee/save/nilai/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post">
          @csrf  
            <div class="card-body">
              <h6>INSERT NILAI TERAS</h6><hr>
                
              <div class="col-md-12 mb-3">
                <select class="form-select" name="nilai_teras" id="nilai_teras" autofocus required>
                  <option value="">-- Please Choose --</option>
                  <option value="Kepimpinan" >Kepimpinan </option>
                  <option value="Perkembangan" >Perkembangan</option> 
                  <option value="Keputusan" >Keputusan</option> 
                  <option value="Sumbangan" >Sumbangan</option>
                  <option value="Rohani" >Rohani</option>
                  <option value="Keluarga" >Keluarga</option>
                </select>
                @error('nilai_teras') <div class="text-danger">{{ $message }}</div> @enderror
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
                          <td><input type="text" class="form-control" id="ukuran" name="ukuran" value="Percentage" readonly></td>
                          <td>
                            <input type="number" min="1" max="4" class="form-control" id="skor_pekerja" name="skor_pekerja" placeholder="Enter score from 1 to 4 only" onkeyup="masterClac();" required>
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

  {{--------------------------------- Inserted Nilai Teras ---------------------------------------------------------------}}
  @if(!empty($nilai) && $nilai->count())
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
                      <th>NILAI TERAS</th>
                      <th>%</th>
                      <th>MEASUREMENT</th>
                      <th>EMPLOYEE SCORE</th>
                      <th>MANAGER SCORE</th>
                      <th>ACTUAL SCORE</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>

                  <tbody>
                    @php($i = 1)
                    @foreach ($nilai as $key => $nilais)
                      <tr>
                        <td class="text-sm fw-bold text-center">{{$key + 1}}</td>
                        <td class="text-xs fw-bold">{{ $nilais -> nilai_teras }}</td>
                        <td class="text-xs fw-bold text-center">20</td>
                        <td class="text-xs fw-bold text-center">Percentage (%)</td>
                        <td class="text-xs fw-bold text-center">{{ $nilais -> skor_pekerja }}</td>
                        <td class="text-xs fw-bold text-center">{{ $nilais -> skor_penyelia }}</td>
                        <td class="text-xs fw-bold text-center">{{ $nilais -> skor_sebenar }}</td>
                        <td class="text-center">
                          <a href="{{ url('employee/edit/nilai/'.$nilais->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-dark btn-sm btn-icon my-auto" data-bs-toggle="tooltip" data-bs-original-title="Edit Nilai"><i class="bi bi-pencil-square"></i></a>
                          <button type="button" wire:click="selectItem({{$nilais->id}})" class="btn btn-danger btn-sm btn-icon my-auto data-delete" data-form="{{$nilais->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete Nilai"><i class="bi bi-trash3-fill"></i></button>
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

  {{-- START SECTION - SCRIPT FOR DELETE BUTTON  --}}
  @push('scripts') 
    <script>
      document.addEventListener('livewire:load', function () {
        $(document).on("click", ".data-delete", function (e) {
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
  <!-- Master Pencapaian JS -->
  <script src="{{asset('assets/js/nilai.js')}}"></script>
</div>