{{--------------------------------------------------- EDIT NILAI (MANAGER) --------------------------------------------------}}
@section('content')
@include('layouts.navbars.auth.nav')
<div>
  @extends('layouts.app')

  <div class="container-fluid pb-4">
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

        <div class="row">
          <div class="col-12">
            <div class="card bg-gradient-dark text-white shadow-blur mb-4">
              <div class="card-body">
                <span class="fw-bolder text-uppercase">{{ $user->name }}</span><br>
                <span class="fst-italic">{{ $user->department }}</span><br>
                <span class="fst-italic" style="font-size:15px">{{ $user->unit }}</span>
              </div>
            </div>
          </div>
        </div>

        {{---------------------------------------------------- manager update nilai -------------------------------------------}}
        <div class="card">
          <form action="{{ url('/manager/update/nilai/'.$user->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post">
            @csrf  
            <div class="card-body">
              <h6>INSERT NILAI TERAS</h6><hr>

              @if(!empty($nilai) && $nilai->count())
                <div class="row">
                  <div class="col-md-12 mx-auto">
                    <div class="table-responsive">

                      <table class="table align-middle fw-bold">
                        <thead class="text-center text-xxs fw-bolder">
                          <tr>
                            <th>NO</th>
                            <th>NILAI TERAS</th>
                            <th>%</th>
                            <th>MEASUREMENT</th>
                            <th>EMPLOYEE SCORE</th>
                            <th class="col-3">MANAGER SCORE</th>
                            <th class="col-1">ACTUAL SCORE</th>
                          </tr>
                        </thead>
      
                        <tbody>
                          @foreach ($nilai as $key => $nilais)
                            <tr>
                              <td class="text-xs text-center">{{ $key + 1 }}</td>
                              <td class="text-xs fw-bold">{{ $nilais -> nilai_teras }}</td>
                              <td class="text-xs fw-bold text-center">{{ '20%' }}</td>
                              <td class="text-xs fw-bold text-center">{{ 'Percentage (%)' }}</td>
                              <td class="text-xs fw-bold text-center">{{ $nilais -> skor_pekerja }}</td>
                              <td class="text-xs fw-bold text-center">
                                <input type="number" min="1" max="4" class="form-control" name="skor_penyelia[]" value="{{ $nilais->skor_penyelia }}" oninput="masterClac();" placeholder="Enter score from 1 to 4 only" required>
                                @error('skor_penyelia') <div class="text-danger">{{ $message }}</div> @enderror
                              </td>
                              <td class="text-xs fw-bold text-center">
                                <input type="number" class="form-control" name="skor_sebenar[]" value="{{ $nilais->skor_sebenar }}" readonly>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>

                <div class="col-12 text-end">
                  <button class="btn bg-gradient-dark btn-sm px-4" type="submit" href="javascript:;">SAVE</button>
                </div>
                
              @else
                <div class="row">
                  <div class="col-md-12 mx-auto">
                    <p class="text-center">There's No Nilai Teras Has Been Added.</p>
                  </div>
                </div>
              @endif
        
            </div>
          </form>  
        </div>

      </div>
    </div>
  </div>  

  {{----------------------------------------------------- REFERENCE NILAI TERAS --------------------------------------------}}
<div class="container-fluid pb-4">
  <div class="row">
    <div class="col-lg-12">

      <div class="row">
        <div class="col-md-12 mb-lg-0">
                
          <div class="card mb-4 bg-gradient-light">  
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
  </div>
</div>
{{------------------------------------------------- End Testing -------------------------------------------------}}
   <!-- Calculation JS -->
  <script src="{{asset('assets/js/nilai.js')}}"></script>

</div>
@endsection
