
<?php $id_announcement=1 ?>
<div>
  <style>
    ul.timeline {
    list-style-type: none;
    position: relative;
    padding-left: 2rem;
}

 /* Timeline vertical line */
ul.timeline:before {
    content: ' ';
    background: #fff;
    display: inline-block;
    position: absolute;
    left: 7px;
    width: 4px;
    height: 100%;
    z-index: 400;
    border-radius: 1rem;
}

li.timeline-item {
    margin: 20px 0;
}

/* Timeline item arrow */
.timeline-arrow {
    border-top: 0.5rem solid transparent;
    border-right: 0.5rem solid #fff;
    border-bottom: 0.5rem solid transparent;
    display: block;
    position: absolute;
    left: 1.5rem;
}

/* Timeline item circle marker */
li.timeline-item::before {
    content: ' ';
    background: #ddd;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #fff;
    left: 1px;
    width: 14px;
    height: 14px;
    z-index: 400;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}
  </style>
<main>  
    <div class="container-fluid py-4">
      <div class="row">
        {{-- VISION ----------------------------------------------------------------------------------------------------------}}
        <div class="card-group">
          <div class="col-md-6 px-1">
            <div class="card text-center mb-3 overflow-hidden position-relative border-radius-md shadow" style="background-color: #fe7a7a;">
              <div class="card-body text-dark">
                <h6 class="card-title fw-bolder">__VISION__<i class="bi bi-pen-fill text-dark text-end"></i></h6><hr>

                <p class="card-text py-3"><b>"</b>Blink <b>Your Business</b> To The <b>World"</b></p>
              </div>
            </div>
          </div>
          {{-- MISSION -------------------------------------------------------------------------------------------------------}}
          <div class="col-md-6 px-1">
            <div class="card text-center mb-3 overflow-hidden position-relative border-radius-md shadow" style="background-color: #fe7a7a;">
              <div class="card-body text-dark">
                <h6 class="card-title fw-bolder">__MISSION__<i class="bi bi-pen-fill"></i></h6><hr>

                <p class="card-text pt-1"><b>"Empowering</b> Entrepreneurs To Get More <b>Customer</b> Using The Latest <b>Technologies</b> To Fullfil Their <b>Dreams"</b></p>
              </div>
            </div>
          </div>
        </div>

      {{-- CAROUSEL ---------------------------------------------------------------------------------------------------}}
      <div class="row mx-auto px-1 mb-4">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            @foreach ($test->data as $item)
              <div class="carousel-item active" data-bs-interval="2000">
                <img src="{{ $item->img_path}}" class="d-block w-100" alt="{{ $item->program_name}}" sizes="width: 100%">
              </div>
            @endforeach
            
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <div class="row">
        {{-- LATEST MEMO ------------------------------------------------------------------------------------------}}
        <div class="col-md-8 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                  <h6><i class="bi bi-chat-right-text"></i> Latest Memo</h6>
              </div>
              
              <div class="row">
                <div class="table-responsive">
                  <table class="table align-middle table-sm">
                    <thead class="text-center text-sm fw-bolder">
                      <tr>
                        <th>MEMO</th>
                        <th>DESCRIPTION</th>
                        <th>VIEW</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($memo as $memos)
                        <tr>
                          <td class="text-xs fw-bold">{{ $memos->title }}</td>
                          <td class="text-xs fw-bold">{{  $memos->description }}</pre>
                          </td>
                          <td class="fs-4 text-center">
                            <a href="{{ $memos->memo_path }}" data-bs-toggle="tooltip" data-bs-original-title="View Memo" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger"></i></a>
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
        {{--------------------------------------------------- HR ANNOUNCEMENT --------------------------------------------------}}
        <div class="col-md-4">
          <div class="card bg-gradient-secondary">
            <div class="card-body" style="height: 340px;">
              <div class="row">
                <h6><i class="bi bi-bell-fill"></i> Announcement!</h6>
              </div>
              
              <form action="{{ url('hr/announcementuphr/'. $id_announcement) }}" method="post">
                @csrf
                @foreach($announcement as $announcements)
                  @if($announcements->created_at != NULL)
                    <div class="row mx-auto">
                      <ul class="timeline timeline-one-side">
                        <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                          <div class="timeline-arrow"></div>
                          <p class="text-xs fw-bold">{{ $announcements->announcement }}</p>
                          <div class="text-xxs text-end">{{ date('d/m/Y', strtotime($announcements->created_at)) }}</div>
                          @if(Auth::user()->role == "hr")
                            <a wire:click="selectItem({{$id_announcement}}, 'delete' )" class="data-delete" data-form="{{$id_announcement}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                              <i class="fa fa-trash text-sm text-danger"></i>
                            </a>
                          @endif
                        </li>
                      </ul>
                    </div>

                  @else
                    <div class="row align-middle">
                      <div class="col-10 bg-light mx-auto my-2">
                        <p class="text-center fw-bold text-xs mt-3">There's No Announcement by HR.</p>
                      </div>
                    </div>
                  @endif

                  @if(Auth::user()->role == "hr")
                    @if($announcements->announcement == '')
                      <div class="row mx-auto text-center">
                        <p class="text-xs fw-bolder mt-3">Write Your Announcement (Optional)</p>
                        <textarea class="form-control" name="announcement" id="announcement" rows="3" placeholder="Type your announcement here..."></textarea>

                        <button class="btn bg-gradient-primary mt-2 btn-sm" type="submit" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Submit</button>
                      </div>
                    @endif
                  @endif
                @endforeach
              </form>
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
