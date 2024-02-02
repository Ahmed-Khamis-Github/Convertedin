@extends('layouts.dashboard')

@section('page-title', 'Create A New Task')



@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.tasks.index') }}">Tasks</a></li>
    <li class="breadcrumb-item active">create</li>
@endsection

@section('content')


    <form action="{{ route('dashboard.tasks.store') }}" method="POST">
        @csrf
        <div class="card-body">


            <div class="form-group">
                <label for="Admin_Name">Select Admin Name </label>

                <select class="form-control" id="nameid" name="admin_id">
                    <option></option>
                    @foreach ($admins as $admin)
                        <option value="{{ $admin->id }}" {{ old('admin_id') == $admin->id ? 'selected' : '' }}>
                            {{ $admin->name }}
                    @endforeach
                </select>
                @error('admin_id')
                <div style="color: red; font-weight: bold"> {{ $message }}</div>
            @enderror
            </div>



            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="title"
                    value="{{ old('title') }}">
                @error('title')
                    <div style="color: red; font-weight: bold"> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" placeholder="Enter The Description"
                    rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div style="color: red; font-weight: bold"> {{ $message }}</div>
                @enderror
            </div>





            <div class="form-group">
                <label for="User_Name">Select Assigned User </label>

                <select class="form-control" id="userid" name="assigned_to_id">
                    <option></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                    @endforeach
                </select>
                @error('assigned_to_id')
                <div style="color: red; font-weight: bold"> {{ $message }}</div>
            @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Create</button>



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
