@extends('backend.master')
@section('subcategoryactive')
active
@endsection
@section('subcategorycl')
menu-is-opening menu-open
@endsection
@section('displayblock')
display:block
@endsection
@section('content')


  <!-- Navbar -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{url('all-subcategory-delete')}}" method="post">
                  @csrf
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Category_id</th>
                      <th>Created At</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                   
                    @foreach($subcats as $key=>$cat)
                    <tr>
                      <td><input type="checkbox" name="delete[]" value="{{ $cat->id }}"></td>
                      <td>
                         {{$subcats->firstItem() +$key}}
                      </td>
                      <td>{{$cat->subcategory_name}}</td>
                      <td>{{$cat->slug}}</td>
                      <td>{{$cat->category['category_name']}}</td>
                      <td>{{$cat->created_at->format('d-M-Y h:i:s a')}}({{$cat->created_at->diffForHumans()}})</td>
                      <td>
                      <a class="btn btn-info"href="{{ url('edit-category') }}/{{ $cat->id }}">Edit</a>
                      <a class="btn btn-danger" href="{{route('deletesubcategory',$cat->id)}}">Delete</a>
                      </td>
                      
                    </tr>
                    @endforeach
                   
                  </tbody>
                
                </table>
                <div class="text-center">
                <input type="submit" value="Submit" class="btn btn-primary">
              </div>
              </form>
              </div>
              {{ $subcats->render() }}
              <!-- /.card-body -->
             
                
                 {{-- <ul class="pagination pagination-sm m-0 float-right"> 
                   <li class="page-item"><a class="page-link" href="#">&laquo;</a>Prev</li> --}}
                  {{-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li> --}}
                   {{-- <li class="page-item"><a class="page-link" href="#">&raquo;</a>Next</li>
                </ul>  --}}
              
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
 
  <!-- /
<!-- ./wrapper -->

<!-- jQuery -->


@endsection
@section('footer_js')
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
    @if (session('error'))
  Command: toastr["error"]("{{ session('error') }}")
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
</script>
@endsection