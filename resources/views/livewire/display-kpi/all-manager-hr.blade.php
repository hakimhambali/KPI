{{--------------------------------------------------- KPI (MANAGER) --------------------------------------------------}}
<div>
  <style>
  td.good{
    border-bottom: hidden;
  }

  </style>
  
  <body>

    <div class="container-fluid pb-4">
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

      @if (session('fail2'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{ session('fail2') }}</strong>
        </div>	
      @endif

      <div class="row">
        <div class="col-12">
          <div class="card bg-gradient-dark text-white shadow-blur mb-4">
            <div class="card-body">
              @foreach ($user as $data)
                <span class="fw-bolder text-uppercase">{{ $data->name }}</span><br>
                <span class="fst-italic">{{ $data->unit }}</span>
              @endforeach  
            </div>
          </div>
        </div>
      </div>
      {{--- TEAM KPI MASTER DISPLAY --------------------------------------------------------------------------------------------------}}
      <div class="row">
        <div class="col-12">
          @if ($weightage_master > 100) 
            <div class="alert alert-warning alert-dismissible p-2 fade show" role="alert">
              <strong>{{ session('fail2') }}Employee total weightage for KPI Master exceed 100%. Please check back.</strong>
            </div>
          @else
          @endif

          @if ($weightage_master < 100) 
            <div class="alert alert-warning alert-dismissible p-2 fade show" role="alert">
              <strong>{{ session('fail2') }}Employee total weightage for KPI Master is lower than 100%. Please check back.</strong>
            </div>
          @else
          @endif
          
          <div class="card mb-4">
            <div class="card-body">
              @if ($weightage_master == 0 || $weightage_master == NULL) 
                <h6>SCORE CARD - KPI <span style="color:red;">(Current total weightage = 0)</span></h6><hr>
              @else
                <h6>SCORE CARD - KPI <span style="color:red;">(Current total weightage = {{$weightage_master}})</span></h6><hr>
              @endif

              <div class="row">
                <div class="table-responsive">
                  <table class="table table-sm align-middle fw-bold">
                    <thead class="text-center text-xxs fw-bolder">
                      <tr>
                        <th>FUNCTION</th>
                        <th>KPI OBJECTIVE</th>
                        <th>EVIDENCE</th>
                        <th class="col-1">FILE</th>
                        <th>EVIDENCE LINK</th>
                        <th class="col-1">%</th>
                        <th>MEASUREMENT</th>
                        <th>KPI TARGET</th>
                        <th class="col-1">KPI SCORE</th>
                        <th class="col-1">ACTUAL SCORE</th>
                      </tr>
                    </thead>

                    <tbody>
                      @php($i = 1)

                      @foreach ($kpiMasterArr as $key1 => $kpiMasterArrs)
                        @foreach ($kpiMasterArrs as $key2 => $kpiMasterArrss)

                          @foreach ($kpiArr as $key3 => $kpiArrs)
                            @foreach ($kpiArrs as $key4 => $kpiArrss)
                              @foreach ($function as $key5 => $functions)
                                @if($kpiMasterArrss->fungsi == $functions->name)
                        
                                  @if($kpiArrss->fungsi == $functions->name)
                                    <tr>
                                      @if ($key4 == 0)
                                        <td rowspan="{{ $kpiArrs->count() }}" class="text-xs fw-bold text-center">{{ $kpiArrss->fungsi }}</td>
                                        <td rowspan="{{ $kpiArrs->count() }}" class="text-xs fw-bold">{{ $kpiArrss->kpimasters->objektif }}</td>
                                      @else
                                      @endif
                                      @if ($loop->parent->last)
                                        <td class="text-xs fw-bold">{{ $kpiArrss->bukti }}</td>
                                        <td class="text-xs fw-bold text-center">
                                          @if ($kpiArrss->bukti_path == '') -
                                          @else
                                          <a href="{{ $kpiArrss->bukti_path }}" class="btn btn-icon btn-sm btn-info" target="_blank"><i class="bi bi-folder-symlink"></i></a>
                                          @endif
                                        </td>
                                      @else
                                        <td class="text-xs fw-bold good">{{ $kpiArrss->bukti }}</td>
                                        <td class="text-xs fw-bold text-center good">
                                          @if ($kpiArrss->bukti_path == '') -
                                          @else
                                          <a href="{{ $kpiArrss->bukti_path }}" class="btn btn-sm btn-info my-auto" target="_blank"><i class="bi bi-folder-symlink"></i></a>
                                          @endif
                                        </td>
                                      @endif
                                        
                                      @if ($key4 == 0)
                                        <td rowspan="{{ $kpiArrs->count() }}" class="text-xs fw-bold text-center">
                                          @if ($kpiArrss->kpimasters->link == '') -
                                          @else
                                          <a href="{{ $kpiArrss->kpimasters->link }}" class="btn btn-sm btn-info my-auto" target="_blank"><i class="bi bi-box-arrow-up-right"></i></a>
                                          @endif
                                        </td>
                                        <td rowspan="{{ $kpiArrs->count() }}" class="text-xs fw-bold text-center">{{ $kpiArrss->kpimasters->percent_master }}</td>
                                        <td rowspan="{{ $kpiArrs->count() }}" class="text-xs fw-bold text-center">Percentage (%)</td>
                                        <td rowspan="{{ $kpiArrs->count() }}" class="mx-auto">
                                          <span class="me-2 text-xs fw-bolder" value="{{ $kpiArrss -> pencapaian }}">{{ number_format( (integer)($kpiArrss->kpimasters->skor_KPI)) }}%</span>
                                          <div class="progress">
                                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpiArrss->kpimasters->skor_KPI }}%;"></div>
                                          </div>
                                        </td>
                                        <td rowspan="{{ $kpiArrs->count() }}" class="text-xs fw-bold text-center">{{ $kpiArrss->kpimasters->skor_KPI }}</td>
                                        <td rowspan="{{ $kpiArrs->count() }}" class="text-xs fw-bold text-center">{{ round($kpiArrss->kpimasters->skor_sebenar,2) }} %</td>
                                      @else
                                      @endif
                                    </tr>
                                  @endif

                                @endif
                              @endforeach
                            @endforeach
                          @endforeach

                        @endforeach
                      @endforeach
                    </tbody>  

                  </table>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

      {{-- TEAM KECEKAPAN TERAS --------------------------------------------------------------------------------------------------------------}}
      @if ($kecekapan_master < 100) 
        <div class="alert alert-warning alert-dismissible p-2 fade show" role="alert">
          <strong>{{ session('fail2') }}Employee total weightage for Kecekapan Master is lower than 100%. Please check back.</strong>
        </div>
      @else
      @endif

      @if ($kecekapan_master > 100) 
        <div class="alert alert-warning alert-dismissible p-2 fade show" role="alert">
          <strong>{{ session('fail2') }}Employee total weightage for Kecekapan Master exceed 100%. Please check back.</strong>
        </div>
      @else
      @endif

      <div class="row">
        <div class="col-md-12 mb-4">
                    
          <div class="card"> 
            <div class="card-body">
              <h6>SCORE CARD - Kecekapan Teras <span class="text-danger">(Current total weightage = {{$kecekapan_master}})</h6><hr>

              @if(!empty($kecekapan) && $kecekapan->count())
                <div class="table-responsive">
                  <table class="table table-sm align-middle fw-bold">
                    <thead class="text-center text-xxs fw-bolder">
                      <tr>
                        <th>KECEKAPAN TERAS</th>
                        <th>EXPECTED RESULT</th>
                        <th>%</th>
                        <th>MEASUREMENT</th>
                        <th class="col-1">EMPLOYEE SCORE</th>
                        <th class="col-1">MANAGER SCORE</th>
                        <th class="col-1">ACTUAL SCORE</th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($kecekapan as $key => $kecekapans)
                        <tr>
                          <td class="text-xs fw-bold text-center">{{ $kecekapans -> kecekapan_teras }}</td>

                          @if ($kecekapans -> kecekapan_teras == "Kepimpinan Organisasi")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Pekerja yang sedar dan menyesuaikan diri dengan strategi organisasi.</li>
                              <li>Pemimpin yang bertindak selaras dengan strategi organisasi.</li>
                              <li>Pengurus yang dapat mengembangkan dan memperkasakan pekerja bawahannya.</li>
                              <li>Budaya organisasi yang mencerminkan nilainya.</li>
                              <li>Pemimpin yang bertindak selaras dengan strategi organisasi.</li>
                            </ol>
                          </td>
                          @else
                          @endif

                          @if ($kecekapans -> kecekapan_teras == "Keupayaan Inovatif")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li> Pekerja yang berupaya memberi idea dan memberi penyelesaian untuk menyelesaikan masalah.</li>
                              <li> Amalan kerja yang dikemas kini lebih sesuai dengan jangkaan masa kini.</li>
                              <li> Penerimaan untuk organisasi, dan semua bahagiannya, perlu berubah dan terus meningkat.</li>
                              <li> Pemimpin yang bertindak selaras dengan strategi organisasi.</li>
                            </ol>
                          </td>
                          @else
                          @endif 

                          @if ($kecekapans -> kecekapan_teras == "Pengurusan Pelanggan")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Amalan organisasi yang lebih sesuai dengan keperluan pelanggan moden.</li>
                              <li>Pekerja yang memahami dan bertindak mengikut kehendak pelanggan tepat pada masanya.</li>
                              <li>Penciptaan produk dan perkhidmatan masa depan yang lebih mencerminkan keperluan pelanggan.</li>
                              <li>Pemimpin yang bertindak selaras dengan strategi organisasi.</li>
                            </ol>
                          </td>
                          @else
                          @endif 

                          @if ($kecekapans -> kecekapan_teras == "Pengurusan Pemegang Berkepentingan")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Pekerja yang lebih empati dengan pihak berkepentingan mereka.</li>
                              <li>Pembinaan hubungan positif dengan pihak berkepentingan.</li>
                              <li>Pembentukan perkongsian strategik yang membantu mencapai objektif organisasi.</li>
                              <li>Pengurus yang mendorong pekerja bawahan mereka membina rangkaian profesional mereka sendiri.</li>
                              <li>Pemimpin yang bertindak selaras dengan strategi organisasi.</li>
                            </ol>
                          </td>
                          @else
                          @endif 

                          @if ($kecekapans -> kecekapan_teras == "Ketangkasan Dalam Organisasi")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Pekerja yang berpengetahuan dan serba boleh.</li>
                              <li>Penghargaan dan penerapan budaya bimbingan dalam organisasi.</li>
                              <li>Amalan organisasi yang boleh menyesuaikan diri dengan masalah di pasaran.</li>
                              <li>Organisasi yang menekankan dan mendorong pembelajaran dan perkembangan berterusan.</li>
                              <li>Pemimpin yang bertindak selaras dengan strategi organisasi.</li>
                            </ol>
                          </td>
                          @else
                          @endif 

                          <td class="text-xs fw-bold text-center">{{ '20%' }}</td>
                          <td class="text-xs fw-bold text-center">{{ 'Percentage (%)' }}</td>
                          <td class="text-xs fw-bold text-center">{{ $kecekapans -> skor_pekerja }}</td>
                          <td class="text-xs fw-bold text-center">{{ $kecekapans -> skor_penyelia }}</td>
                          <td class="text-xs fw-bold text-center">{{ $kecekapans -> skor_sebenar }}</td>
                          <td><a href="{{ url('manager/edit/kecekapan/'.$user_id.'/'.$kecekapans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-dark btn-sm btn-icon my-auto" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <p class="text-center">There's No Kecekapan Teras Has Been Added.</p>
              @endif
            </div>
          </div>

        </div>
      </div>

      {{-- TEAM NILAI TERAS ---------------------------------------------------------------------------------------------------- --}}
      @if ($nilai_master > 120) 
      <div class="alert alert-warning alert-dismissible p-2 fade show" role="alert">
        <strong>{{ session('fail2') }}Employee total weightage for Nilai Master exceed 120%. Please check back.</strong>
      </div>
      @else
      @endif
      @if ($nilai_master < 120) 
      <div class="alert alert-warning alert-dismissible p-2 fade show" role="alert">
        <strong>{{ session('fail2') }}Employee total weightage for Nilai Master is lower than 120%. Please check back.</strong>
      </div>
      @else
      @endif

      <div class="row">
        <div class="col-md-12 mb-4">
                    
          <div class="card"> 
            <div class="card-body">
              <h6>SCORE CARD - Nilai Teras <span class="text-danger">(Current total weightage = {{$nilai_master}})</h6><hr>

              @if(!empty($nilai) && $nilai->count())
                <div class="table-responsive">
                  <table class="table table-sm align-middle fw-bold">
                    <thead class="text-center text-xxs fw-bolder">
                      <tr>
                        <th>NILAI TERAS</th>
                        <th>EXPECTED RESULT</th>
                        <th class="col-1">%</th>
                        <th>MEASUREMENT</th>
                        <th class="col-1">EMPLOYEE SCORE</th>
                        <th class="col-1">MANAGER SCORE</th>
                        <th class="col-1">ACTUAL SCORE</th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($nilai as $key => $nilais)
                        <tr>
                          <td class="text-xs fw-bold text-center">{{ $nilais -> nilai_teras }}</td>
                          
                          @if ($nilais -> nilai_teras == "Kepimpinan")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Kami adalah pemimpin yang bertanggungjawab.</li>
                              <li>Kami memberikan contoh yang baik.</li>
                              <li>Kami melaksanakan setiap apa yang diperkatakan.</li>
                              <li>Kami menjadi inspirasi untuk berubah lebih baik.</li>
                            </ol>
                          </td>
                          @else
                          @endif
      
                          @if ($nilais -> nilai_teras == "Perkembangan")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Kami ambil peduli dengan peningkatan hidup sendiri.</li>
                              <li>Kami sentiasa menambah dan meningkatkan ilmu pengetahuan.</li>
                              <li>Kami memupuk sikap ingin sentiasa berjaya.</li>
                              <li>Kami sentiasa memperbaiki dan memajukan diri di setiap saat.</li>
                            </ol>
                          </td>
                          @else
                          @endif
      
                          @if ($nilais -> nilai_teras == "Keputusan")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Kami membantu menggilap potensi orang lain.</li>
                              <li>Kami memastikan pelanggan mencapai keputusan cemerlang.</li>
                              <li>Kami komited dengan hasil usaha yang dilakukan.</li>
                              <li>Kami berusaha untuk memberikan yang terbaik.</li>
                            </ol>
                          </td>
                          @else
                          @endif
      
                          @if ($nilais -> nilai_teras == "Sumbangan")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Kami menghulurkan bantuan dengan sepenuh semangat dan jiwa kami.</li>
                              <li>Kami membantu mengatasi kelemahan dan membina kekuatan pelanggan.</li>
                              <li>Kami komited untuk memberi manfaat dan menyebarkan kebaikan.</li>
                              <li>Kami bertanggungjawab dengan orang sekeliling dan persekitaran.</li>
                            </ol>
                          </td>
                          @else
                          @endif
      
                          @if ($nilais -> nilai_teras == "Rohani")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Kami adalah hamba Allah.</li>
                              <li>Kami membantu orang untuk mendapat kehidupan yang lebih baik.</li>
                              <li>Kami bangkit berjaya dengan memajukan orang lain.</li>
                              <li>Kami sentiasa beriman dan percaya dengan Qada’ dan Qadar.</li>
                            </ol>
                          </td>
                          @else
                          @endif
      
                          @if ($nilais -> nilai_teras == "Keluarga")
                          <td class="text-xs fw-bold"><br>
                            <ol>
                              <li>Kami sangat menyayangi keluarga kami.</li>
                              <li>Kami berusaha untuk berikan yang terbaik kepada keluarga kami.</li>
                              <li>Kami tidak akan mengabaikan keluarga kami.</li>
                              <li>Kami percaya kebahagiaan keluarga adalah kebahagiaan kami.</li>
                            </ol>
                          </td>
                          @else
                          @endif

                          <td class="text-xs fw-bold text-center">{{  '20%' }}</td>
                          <td class="text-xs fw-bold text-center">{{ 'Percentage (%)' }}</td>
                          <td class="text-xs fw-bold text-center">{{ $nilais -> skor_pekerja }}</td>
                          <td class="text-xs fw-bold text-center">{{ $nilais -> skor_penyelia }}</td>
                          <td class="text-xs fw-bold text-center">{{ $nilais -> skor_sebenar }}</td>
                          <td><a href="{{ url('manager/edit/nilai/'.$user_id.'/'.$nilais->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-dark btn-sm btn-icon my-auto" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                <p class="text-center">There's No Nilai Teras Has Been Added.</p>
              @endif
            </div>
          </div>

        </div>
      </div>

      <div class="row">
        {{-- JUMLAH MARKAH -------------------------------------------------------------------------------------------------}}
        <div class="col-md-6 mb-4">
          <div class="card bg-gray-300 border">
            <div class="card-body">
              <h6>Total Marks</h6><hr>

              <div class="row">
                <div class="col-md-6 mb-4">
                  @if (!$kpiall->isEmpty())
                    <div class="table-responsive">
                      <table class="table-sm text-xs align-middle mx-auto">
                        <tr>
                          <td>KPI</td>
                          <td>
                            @foreach ($kpiall as $key => $kpialls)
                              <span class="fw-bolder">: {{ $kpialls -> total_score_master }} %</span></span>
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                          <td>Final Score</td>
                          <td>
                            @foreach ($kpiall as $key => $kpialls)
                              <span class="fw-bolder">: {{ round($kpialls -> total_score_all,2) }} %</span></span>
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                          <td>Kecekapan Teras</td>
                          <td>
                            @foreach ($kpiall as $key => $kpialls)
                              <span class="fw-bolder">: {{ $kpialls -> total_score_kecekapan }} %</span></span>
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                          <td>Nilai Teras</td>
                          <td>
                            @foreach ($kpiall as $key => $kpialls)
                              <span class="fw-bolder">: {{ $kpialls -> total_score_nilai }} %</span></span>
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                          <td>Grade</td>
                          <td>
                            @foreach ($kpiall as $key => $kpialls)
                              <span class="fw-bolder">: {{ $kpialls -> grade_all }}</span></span>
                            @endforeach
                          </td>
                        </tr>
                      </table>
                    </div> 
                  @else
                    <div class="table-responsive">
                      <table class="table-sm text-xs align-middle mx-auto">
                        <tr><td>KPI</td><td class="fw-bolder">:</td></tr>
                        <tr><td>Final Score</td><td class="fw-bolder">:</td></tr>
                        <tr><td>Kecekapan Teras</td><td class="fw-bolder">:</td></tr>
                        <tr><td>Nilai Teras</td><td class="fw-bolder">:</td></tr>
                        <tr><td>Grade</td><td class="fw-bolder">:</td></tr>
                      </table>
                    </div>
                  @endif
                </div>

                <div class="col-md-6 text-end my-auto">
                  @if (Auth::user()->role == "manager")
                    @foreach ($date as $dates)
                      @if ($dates->status == 'Submitted')
                        <a class="btn bg-gradient-info mb-0" href="{{ url('manager/changeup/kpi/'. $date_id) }}" class="btn btn-dark btn-sm"role="button"><i class="fa fa-edit"></i>&nbsp;Sign & Appraise</a>
                      @elseif ($dates->status == 'Signed By Manager')
                        <a class="btn bg-gradient-danger mb-0" href="{{ url('manager/changedown/kpi/'. $date_id) }}" class="btn btn-dark btn-sm"  role="button"><i class="fa fa-edit"></i>&nbsp;Undo Sign & Undo Appraise</a>
                      @else
                      @endif
                    @endforeach
                  @else
                  @endif

                  @if (Auth::user()->role == "hr")
                    @foreach ($date as $dates)
                      @if ($dates->status == 'Signed By Manager')
                        <a class="btn bg-gradient-info mb-0" href="{{ url('hr/changeup/kpi/'. $date_id) }}" class="btn btn-dark btn-sm"role="button"><i class="fa fa-edit"></i>&nbsp;Sign & Complete</a>
                      @elseif ($dates->status == 'Completed')
                        <a class="btn bg-gradient-danger mb-0" href="{{ url('hr/changedown/kpi/'. $date_id) }}" class="btn btn-dark btn-sm"  role="button"><i class="fa fa-edit"></i>&nbsp;Undo Sign & Undo Complete</a>
                      @else
                      @endif
                    @endforeach
                  @else
                  @endif
                </div>
              </div>
              
            </div>
          </div>
        </div>

        {{-- MANAGER'S COMMENT -------------------------------------------------------------------------------------------------}}
        <div class="col-md-3 mb-2">
          <div class="card border">
            <div class="card-body">

              @foreach ($date as $dates)
                @if (Auth::user()->role == "manager")
                  <form action="{{ url('manager/messageup/kpi/'. $date_id) }}" method="post">
                    @csrf
                    @if ($dates->message_manager == '' || $dates->message_manager == NULL)
                      <p class="text-xs fw-bold">Write Your Message To Team (Optional)</p>
                      <textarea class="form-control text-danger bg-white mb-2" name="message_manager" id="message_manager" rows="5" placeholder="Type your message here..."></textarea>

                      <div class="col-md-12 text-center mb-0">
                        <button class="btn bg-gradient-primary btn-sm mx-auto" type="submit" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Submit Message</button>
                      </div>
                    @else
                      <p class="text-xs fw-bold">Your Message to Team</p>
                      <textarea class="form-control text-danger bg-white mb-2" rows="5" disabled>{{ $dates -> message_manager }}</textarea>

                      <div class="col-md-12 text-center">
                        <a wire:click="selectItem({{$dates->id}}, 'delete' )" class="data-delete" data-form="{{$dates->id}}">
                          <i class="fa fa-trash text-secondary text-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                        </a>
                      </div>
                    @endif
                  </form>
                @else
                  <p class="text-xs fw-bold">Comment From Manager</p>
                  <textarea class="form-control text-danger bg-white mb-2" rows="6" disabled>{{ $dates -> message_manager }}</textarea>
                @endif
              @endforeach

            </div>
          </div>
        </div>

        {{-- HR'S COMMENT -------------------------------------------------------------------------------------------------}}
        <div class="col-md-3 mb-2">
          <div class="card border">
            <div class="card-body">

              @foreach ($date as $dates)
                @if (Auth::user()->role == "hr")
                  <form action="{{ url('hr/messageup/kpi/'. $date_id) }}" method="post">
                    @csrf
                    @if ($dates->message_hr == '')
                      <p class="text-xs fw-bold">Write Your Message To Team (Optional)</p>
                      <textarea class="form-control text-dark bg-white mb-2" name="message_hr" id="message_hr" rows="5" placeholder="Type your message here..."></textarea>

                      <div class="col-md-12 text-center mb-0">
                        <button class="btn bg-gradient-primary btn-sm mx-auto" type="submit" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Submit Message</button>
                      </div>
                    @else
                      <p class="text-xs fw-bold">Your Message to Team</p>
                      <textarea class="form-control text-dark bg-white mb-2" rows="5" disabled>{{ $dates -> message_hr }}</textarea>

                      <div class="col-md-12 text-center">
                        <a wire:click="selectItem({{$dates->id}}, 'delete' )" class="data-delete" data-form="{{$dates->id}}">
                          <i class="fa fa-trash text-secondary text-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                        </a>
                      </div>
                    @endif
                  </form>
                @else
                  <p class="text-xs fw-bold">Comment From HR</p>
                  <textarea class="form-control text-dark bg-white mb-2" rows="6" disabled>{{ $dates -> message_hr }}</textarea>
                @endif
              @endforeach

            </div>
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="col-12 mb-4">
          <div class="card border">
            <div class="card-body">
              <h6>Grade <span class="text-danger">(Reference Only)</span></h6><hr>

              <div class="table-responsive">
                <table class="table-sm text-xxs fw-bold text-center">
                  <tr>
                    <td class="col-6">Bronze 0%-49.9%</td>
                    <td class="col-1">Low Silver 50%-59.9%</td>
                    <td class="col-1">High Silver 60%-64.9%</td>
                    <td class="col-1">Low Gold 65%-69.9%</td>
                    <td class="col-1">Mid Gold 70%-74.9%</td>
                    <td class="col-1">High Gold 75%-79.9%</td>
                    <td class="col-2">Platinum 80%-100%</td>
                  </tr>
                </table>
              </div>
              <div class="progress" style="height:20px">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar" role="progressbar" style="width: 10%; background-color: orange" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar" role="progressbar" style="width: 5%; background-color: yellow" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar" role="progressbar" style="width: 5%; background-color: brown" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar" role="progressbar" style="width: 5%; background-color: #A5885D" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar" role="progressbar" style="width: 5%; background-color: rgb(0, 255, 0)" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar" role="progressbar" style="width: 20%; background-color: darkgreen" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>

    {{--  --}}
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
            
  <!-- Master Pencapaian JS -->
  <script src="{{asset('assets/js/master.js')}}"></script>
  <script src="{{asset('assets/js/kecekapan.js')}}"></script>
  <script src="{{asset('assets/js/nilai.js')}}"></script>
  
  {{-- @endsection --}}
</div>