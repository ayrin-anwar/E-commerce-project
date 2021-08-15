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
                      <th>Title</th>
                      <th>Category_id</th>
                      <th>SubCategory_id</th>
                      <th>Color</th>
                      <th>Thumbnail</th>
                      <th>Summary</th>
                      <th>Description</th>
                      <th>Created At</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    @foreach($products as $key=>$product)
                    <tr>
                    
                      <td>
                         {{$products->firstItem() +$key}}
                      </td>
                      <td>{{$product->title}}</td>
                      <td>{{$product->category->category_name}}</td>
                      <td>{{$product->subcategory->subcategory_name}}</td>
                      <td>
                       
                        @php
                           $data=$product->attribute->unique('color_id');
                        @endphp
                        <ul>
                          @foreach($data as $attribute)
                             <li>{{ $attribute->color['color_name'] }}</li>
                          @endforeach
                      </ul>
                      </td>
                      <td><img src="{{asset('thumb/'.$product->thumbnail)}}"></td>
                      <td>{{$product->summary}}</td>
                      <td>{{$product->description}}</td>
                      <td>{{$product->created_at->format('d-M-Y h:i:s a')}}({{$product->created_at->diffForHumans()}})</td>
                      <td>
                      <a class="btn btn-info"href="{{ url('edit-product') }}/{{ $product->slug }}">Edit</a>
                      <a class="btn btn-danger" href="{{ url('delete-product') }}/{{ $product->slug  }}">Delete</a>
                      </td>
                      
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              
              </div>
              {{ $products->render() }}
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
</script>
@endsection