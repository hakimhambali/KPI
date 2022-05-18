{{--------------------------------------------------- EDIT KECEKAPAN (MANAGER) --------------------------------------------------}}
@section('content')
@include('layouts.navbars.auth.nav')
<div>
  @extends('layouts.app')
<body>

<div class="container-fluid">
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

      {{------------------------------------------------- Update Kecekapan Form ------------------------------------------------}}
      <div class="card mb-3">
        <form action="{{ url('/manager/update/kecekapan/'.$user->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post">
        @csrf  
          <div class="card-body">
            <h6>INSERT KECEKAPAN TERAS</h6><hr>

            @if(!empty($kecekapan) && $kecekapan->count())
              <div class="row">
                <div class="col-md-12 mx-auto">
                  <div class="table-responsive">

                    <table class="table align-middle fw-bold">
                      <thead class="text-center text-xxs fw-bolder">
                        <tr>
                          <th>NO</th>
                          <th>KECEKAPAN TERAS</th>
                          <th>%</th>
                          <th>MEASUREMENT</th>
                          <th>EMPLOYEE SCORE</th>
                          <th class="col-3">MANAGER SCORE</th>
                          <th class="col-1">ACTUAL SCORE</th>
                        </tr>
                      </thead>
    
                      <tbody>
                        @foreach ($kecekapan as $key => $kecekapans)
                          <tr>
                            <td class="text-xs text-center">{{ $key + 1 }}</td>
                            <td class="text-xs fw-bold">{{ $kecekapans -> kecekapan_teras }}</td>
                            <td class="text-xs fw-bold text-center">{{ '20%' }}</td>
                            <td class="text-xs fw-bold text-center">{{ 'Percentage (%)' }}</td>
                            <td class="text-xs fw-bold text-center">{{ $kecekapans -> skor_pekerja }}</td>
                            <td class="text-xs fw-bold text-center">
                              <input type="number" min="1" max="4" class="form-control" name="skor_penyelia[]" value="{{ $kecekapans->skor_penyelia }}" oninput="masterClac();" placeholder="Enter score from 1 to 4 only" required>
                              @error('skor_penyelia') <div class="text-danger">{{ $message }}</div> @enderror
                            </td>
                            <td class="text-xs fw-bold text-center">
                              <input type="number" class="form-control" name="skor_sebenar[]" value="{{ $kecekapans->skor_sebenar }}" readonly>
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
                  <p class="text-center">There's No Kecekapan Teras Has Been Added.</p>
                </div>
              </div>
            @endif
            
          </div>
        </form>  
      </div>
      
    </div>
  </div>
</div>

{{----------------------------------------------------- REFERENCE KECEKAPAN TERAS --------------------------------------------}}
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
<!-- Calculation JS -->
<script src="{{asset('assets/js/kecekapan.js')}}"></script>

  </body>
  @endsection
</div>
