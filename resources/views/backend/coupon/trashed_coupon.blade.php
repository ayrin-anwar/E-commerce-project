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
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Created At</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($coupons as $key=>$coupon)
                    <tr>
                      <td>
                         {{$coupons->firstItem() +$key}}
                      </td>
                      <td>{{$coupon->coupon_name}}</td>
                      <td>{{$coupon->coupon_amount}}</td>
                      <td>{{$coupon->coupon_validity}}</td>
                      <td>{{$coupon->coupon_limit}}</td>
                      <td>{{$coupon->created_at->format('d-M-Y h:i:s a')}}({{$coupon->created_at->diffForHumans()}})</td>
                      <td>
                      <a class="btn btn-info"href="{{ url('restore-coupon') }}/{{ $coupon->id }}">Restore</a>
                      <a class="btn btn-danger"href="{{ url('permanentdelete-coupon')}}/{{ $coupon->id }}">PermanentDelete</a>
                      </td>
                      
                    </tr>
                    {{-- @empty data-id="{{ $cat->id }}" data-toggle="modal" data-target="#modal-default"--}}
                    {{-- <td colspan="10" class="text-center">No data available</td> --}}
                    @endforeach
                  </tbody>
                </table>
              </div>
              @if(!session('key'))
              <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Are you sure?Enter password</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <form action="{{ url('permanentdelete-category') }}" method="post">
                      @csrf
                    <div class="modal-body">
                      <input type="password" name="password" class="form-control">
                    </div>
                    <input type="hidden"name="cat_id" class="cat_id">
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              @endif
             
              {{ $coupons->render() }}
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
    $(.Deletecat).click(functon(){
      var cat_id=$(this).attr("data-id");
      $('cat_id').val(cat_id);
    })
</script>
@endsection