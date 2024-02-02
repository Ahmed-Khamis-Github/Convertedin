@extends('layouts.dashboard')

@section('page-title')
    Statistics
@endsection



@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Statistics</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Tasks</span>
                    <span class="info-box-number">
                        {{ $totalTasks }}
                        <small></small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Admins</span>
                    <span class="info-box-number"> {{ $totalAdmins }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>


        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Users</span>
                    <span class="info-box-number">{{ $totalUsers }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title"><strong>Top 10 Users With Highest Tasks Count</strong></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Tasks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topUsers as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->user->name }}</td>
                                <td style="">
                                    <span
                                        style="display: inline-block; background-color: #6c757d; color: #fff; padding: 5px 10px; border-radius: 5px;">
                                        {{ $user->task_count }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->

        <!-- /.card-footer -->
    </div>
@endsection
