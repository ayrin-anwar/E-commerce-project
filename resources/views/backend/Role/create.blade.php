@extends('backend.master')
@section('content')



  <!-- Navbar -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-lg-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('role.store')}}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="role_name">Role</label>
                    <input type="text" class="form-control @error('role_name') is-invalid @enderror" id="role_name" placeholder="Enter name"name="role_name">
                    @error('role_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <p>Choose Permissions</p>
                  @foreach($permissions as $permission)

                   
                  <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox1{{$permission->id  }}"name="permissions[]" value="{{ $permission->name }}">
                    <label for="customCheckbox1{{$permission->id  }}" class="custom-control-label">{{$permission->name  }}</label>
                   
                  </div>
                 
                </div>
                @endforeach 
                <!-- /.card-body -->

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- general form elements -->
            
            <!-- /.card -->

            <!-- Input addon -->
            
            <!-- /.card -->
            <!-- Horizontal Form -->
            
    </section><!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection
@section("footer_js")
<script>
  @if (session('success'))
  Command: toastr["success"]("{{ session('success') }}")
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    @endif
    $('#category_name').keyup(function() {
      $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
</script>
@endsection

