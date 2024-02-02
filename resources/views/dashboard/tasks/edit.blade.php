@extends('layouts.dashboard')

@section('page-title', 'Update Task')



@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.tasks.index') }}">Tasks</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')


    <form action="{{ route('dashboard.tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('put')

        <div class="card-body">


            <div class="form-group">
                <label for="Admin_Name">Select Admin Name </label>

                <select class="form-control" id="nameid" name="admin_id">
                    <option></option>
                    @foreach ($admins as $admin)
                        <option value="{{ $admin->id }}" @selected(@old('admin_id', $task->admin_id) == $admin->id)>{{ $admin->name }}
                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="title"
                    value="{{ old('title', $task->title) }}" ">
        @error('title')
        <div style="color: red; font-weight: bold"> {{ $message }}</div>
    @enderror
       </div>

       <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" placeholder="Enter The Description"
            rows="3">{{ old('description', $task->description) }}</textarea>
        @error('description')
        <div style="color: red; font-weight: bold"> {{ $message }}</div>
    @enderror
       </div>

               
       <div class="form-group">
        <label for="User_Name">Select Assigned User	</label>
      
        <select class="form-control" id="userid" name="assigned_to_id">
        <option></option>
        @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(@old('assigned_to_id', $task->assigned_to_id) == $user->id)>{{ $user->name }}
                    @endforeach
                    </select>
            </div>





            <button type="submit" class="btn btn-primary mt-2">Update</button>



        </div>
        <!-- /.card-body -->

    </form>

    <script type="text/javascript">
        $("#nameid").select2({
            placeholder: "Select an admin",
            allowClear: true
        });
    </script>

    <script type="text/javascript">
        $("#userid").select2({
            placeholder: "Select a user",
            allowClear: true
        });
    </script>



@endsection
