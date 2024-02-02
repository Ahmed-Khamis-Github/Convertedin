@extends('layouts.dashboard')

@section('page-title','Show Task Information')


@section('breadcrumb')
    @parent
     <li class="breadcrumb-item"><a href="{{ route('dashboard.tasks.index') }}">tasks</a></li>
     <li class="breadcrumb-item active">Show</li>
@endsection


@section('content')
<a href="{{ route('dashboard.tasks.index') }}" class="btn  btn-primary  mb-2">Back</a>

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Task Detail</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
          <div class="row">
            <div class="col-12 col-sm-4">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <span class="info-box-text text-center text-muted">Created By</span>
                  <span class="info-box-number text-center text-muted mb-0">{{ $task->admin->name}}</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <span class="info-box-text text-center text-muted">Assigned Name</span>
                  <span class="info-box-number text-center text-muted mb-0">{{  $task->assignedTo->name }}</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <span class="info-box-text text-center text-muted">Created_At</span>
                  <span class="info-box-number text-center text-muted mb-0"> {{ $task->created_at->diffForHumans() }}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <h4>{{$task->title}}</h4>
                <div class="post">
                 
                  <!-- /.user-block -->
                  <p>
                       {{$task->description}}
                   </p>
                  
                  
                </div>

              

            
            </div>
          </div>
        </div>
       
      </div>
    </div>
    <!-- /.card-body -->
  </div>

@endsection