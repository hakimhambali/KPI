@section('content')
@extends('layouts.app')

{{-------------------------------------------- Start Testing ------------------------------------------}}

<div class="container-fluid py-4">
  <div class="row">
      <form action="{{ url('employee/update/kpimaster/'.$kpimasters->id.'/'.$fungsi.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post">   
      @csrf 
      <div class="col-12">
          @if (session('message'))
          <div class="alert alert-success alert-dismissible">
              <strong>{{ session('message') }}</strong>
          </div>	
          @endif 
          <div class="col-md-12 mb-lg-0 mb-4">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Performance Form</h6>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-md-6 mb-md-0">
                      <p>Percentage KPI Master</p>  
                      <div class="card card-plain border-radius-lg align-items-center">
                        <input type="text" class="form-control" id="percent_master" name="percent_master" value="{{ $kpimasters->percent_master }}" >
                        @error('percent_master') <div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                    </div>
                    <div class="col-md-6 mb-md-0">
                      <div class="row">
                        <p>Link Bukti (Leave blank if does not have any bukti)</p> 
                        <div class="card card-plain border-radius-lg align-items-center">
                          <input type="text" class="form-control" id="link" name="link" value="{{ $kpimasters->link }}" >
                          @error('link') <div class="text-danger">{{ $message }}</div> @enderror                        
                        </div>
                      </div>  
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-md-12 mb-md-0">
                      <p>Objektif KPI</p>  
                      <div class="card card-plain border-radius-lg align-items-center">
                          <input class="form-control form-control-lg" type="text" name="position" value="{{ $kpimasters->objektif }}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 text-end p-3">
                  <button class="btn bg-gradient-dark mb-0" type="submit" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Save</button>
                </div>
              </div>
            </div>
      </div>
      </form>  
  </div>
</div>

{{-------------------------------------------- End Testing --------------------------------------------}}

@endsection