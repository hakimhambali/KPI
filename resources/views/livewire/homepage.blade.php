<?php $id_announcement=1 ?>
<div>
<main>  
    <div class="container-fluid py-4">
      <div class="row">
      {{--------------------------------------------------- VISION --------------------------------------------------}}
      <div class="card-group">
        <div class="col-md-6 px-1">
          <div class="card text-center mb-3 overflow-hidden position-relative border-radius-md shadow" style="background-color: #fe7a7a;">
          <span class="mask"></span>
            <div class="card-body text-dark">
              <h6 class="card-title fw-bolder">__VISION__<i class="bi bi-pen-fill text-dark text-end"></i></h6>
              <hr>
              <p class="card-text py-3"><b>"</b>Blink <b>Your Business</b> To The <b>World"</b></p>
            </div>
          </div>
        </div>
        {{--------------------------------------------------- MISSION --------------------------------------------------}}
        <div class="col-md-6 px-1">
          <div class="card text-center mb-3 overflow-hidden position-relative border-radius-md shadow" style="background-color: #fe7a7a;">
            <div class="card-body text-dark">
              <h6 class="card-title fw-bolder">__MISSION__<i class="bi bi-pen-fill"></i></h6>
              <hr>
              <p class="card-text pt-1"><b>"Empowering</b> Entrepreneurs To Get More <b>Customer</b> Using The Latest <b>Technologies</b> To Fullfil Their <b>Dreams"</b></p>
            </div>
          </div>
        </div>
</div>
      {{--------------------------------------------------------------------------------------------------------------}}

{{--------------------------------------------------- CAROUSEL --------------------------------------------------}}
      <div class="row">
        <div class="col-lg-12 p-1">
          <div class="h-100 p-1">
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner align-center">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="assets/img/rpmcomebackposter.jpg" height="500px" width="128px" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="../assets/img/poster-arb.jpg" height="500px" width="128px" class="d-block w-100" alt="...">
          </div>
          {{-- <div class="carousel-item">
            <img src="../assets/img/rpmcomebackposter.jpg" height="500px" width="128px" class="d-block w-100" alt="...">
          </div>
        </div> --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      </div>
    </div>
    </div>
{{--------------------------------------------------- LATEST MEMO --------------------------------------------------}}
      <div class="col-lg-12 p-1">
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6><i class="bi bi-calendar-check"></i> Latest Memo</h6>
                  <p class="text-sm mb-0">
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead class="text-center text-uppercase text-secondary text-sm font-weight-bolder">
                    <tr>
                      <th>Memo</th>
                      <th>Description</th>
                      <th>View</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($memo as $memos)
                    <tr>
                      <td class="text-xs font-weight-bold mb-0">{{ $memos->title }}</td>
                      <td class="text-xs font-weight-bold mb-0">{{  $memos->description }}</pre>
                      </td>
                      <td class="fs-4 text-center">
                        <a href="{{ $memos->memo_path }}" style="color:red;" data-bs-toggle="tooltip" data-bs-original-title="View Memo" target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
{{--------------------------------------------------- HR ANNOUNCEMENT --------------------------------------------------}}
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Announcement !</h6>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-bell-55 text-success text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    @foreach ($announcement as $announcements)
                    <pre class="text-dark text-sm font-weight-bold mb-0">{{ $announcements->announcement }}</pre>
                    @endforeach
                    @if (Auth::user()->role == "hr")
                    <form action="{{ url('hr/announcementuphr/'. $id_announcement) }}" method="post">
                      @csrf
                      @foreach ($announcement as $announcements)
                      @if ($announcements->announcement == '')
                        <label>Write Your Announcement (Optional)</label>
                        <textarea class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" name="announcement" id="announcement" cols="60" rows="3" placeholder="Type your announcement here..."></textarea>
                      @else
                        <label>This is your Announcement</label>
                        <pre class="align-center" style="color: blue;" value="{{ $announcements->announcement }}">{{ $announcements->announcement }}</pre>
                      @endif 

                  <div class="ms-auto text-end">
                    <div class="col-12 text-center ">
                        @if ($announcements->announcement == '')
                          <button class="btn bg-gradient-primary mt-2 mb-0" type="submit" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Submit Announcement</button>
                        @else
                        <a style="color: red;" wire:click="selectItem({{$id_announcement}}, 'delete' )" class="data-delete" data-form="{{$id_announcement}}">
                          <i class="fa fa-trash text-secondary text-sm"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                        </a>
                        @endif
                      @endforeach
                    </div>
                  </div>
                    </form> 
                    @endif 
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>   
    </div>
  </div>
  </div>  
</div>
      </div>
    </div>
  </main>

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
</div>
