@extends('layouts.dashboard')

@section('page-title')
Tasks    

@endsection



@section('breadcrumb')
    @parent
     <li class="breadcrumb-item active">Tasks</li>
@endsection


@section('content')

<div class="container"> 
@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
   

<a href="{{ route('dashboard.tasks.create') }}" class="btn  btn-primary  mb-2">create</a>


<table class="table table-striped projects">

  <thead>
      <tr>
          <th style="width: 5%">
            #
          </th>
          <th style="width:10%">
            Title
          </th>
          <th style="width: 20%">
            Description
          </th>
          <th style="width: 20%">
            Assigned Name
          </th>
          <th style="width: 20%">
            Admin Name
          </th>
          
          <th style="width: 12%">
              Created At
          </th>
          <th style="width: 30% ; text-align:center">
              Action
          </th>

      </tr>
  </thead>
  <tbody>
      @foreach ($tasks as $task)
          <tr>
            <td>
              {{ $loop->iteration }}
            </td>
              <td><a href={{ route('dashboard.tasks.show',$task->id) }} >{{  $task->title }}</a></td>


              <td>
                  <a> {{ Str::limit($task->description, 20, '...') }}
                </a>
              </td>
              <td> {{  $task->assignedTo->name }}  </td>
              <td> {{   $task->admin->name }}  </td>
              
              <td>
               {{ $task->created_at->diffForHumans() }}

            </td>

              <td class="project-actions text-center  p-0">

                  <a class="btn btn-info btn-sm" href="{{ route('dashboard.tasks.edit', $task->id) }}">
                      <i class="fas fa-pencil-alt mr-1">
                      </i>
                      Edit
                  </a>

                  

                  <form method="post" action="{{ route('dashboard.tasks.destroy', $task->id) }}"
                      style="display: inline-block ; margin:0">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm"
                      onclick="confirmDelete('{{ route('dashboard.tasks.destroy', $task->id) }}')">
                          <i class="fas fa-trash mr-1">
                          </i>Delete</button>
                  </form>

                  

              </td>
          </tr>

          </td>
          </tr>
      @endforeach
  </tbody>
</table>

</div>
  {{ $tasks->links() }}
<script>
  function confirmDelete(deleteUrl) {
      if (window.confirm('Are you sure you want to delete this Category?')) {
          var form = document.createElement('form');
          form.setAttribute('method', 'POST');
          form.setAttribute('action', deleteUrl);
          var csrfField = document.createElement('input');
          csrfField.setAttribute('type', 'hidden');
          csrfField.setAttribute('name', '_token');
          csrfField.setAttribute('value', '{{ csrf_token() }}');
          var methodField = document.createElement('input');
          methodField.setAttribute('type', 'hidden');
          methodField.setAttribute('name', '_method');
          methodField.setAttribute('value', 'DELETE');
          form.appendChild(csrfField);
          form.appendChild(methodField);
          document.body.appendChild(form);
          form.submit();
      }
  }
</script>
    
@endsection