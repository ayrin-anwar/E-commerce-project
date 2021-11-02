@extends('backend.master')
@section('content')



  <!-- Navbar -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @can('coupon add')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Coupon</h1>
           
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
              <form method="post" action="{{url('post-coupon')}}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="coupon_name">Coupon</label>
                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name" placeholder="Enter name"name="coupon_name">
                    @error('coupon_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="coupon_amount">Amount</label>
                    <input type="number" class="form-control @error('coupon_amount') is-invalid @enderror" id="coupon_amount" placeholder="Enter coupon_amount"name="coupon_amount">
                    @error('coupon_amount')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="coupon_validity">Validity</label>
                    <input type="date" class="form-control @error('coupon_validity') is-invalid @enderror" id="coupon_validity" placeholder="Enter coupon_validity"name="coupon_validity">
                    @error('coupon_validity')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="coupon_limit">Limit</label>
                    <input type="number" class="form-control @error('coupon_limit') is-invalid @enderror" id="coupon_limit" placeholder="Enter coupon_limit"name="coupon_limit">
                    @error('coupon_limit')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
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
            
    </section>
    @else
    <div class="alert alert-danger">
      You don't have the privilege to view this page
    </div>
    
    @endcan
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <!-- /.content -->
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

