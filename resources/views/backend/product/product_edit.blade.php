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
              <form method="post" action="{{ url('update-product') }}"enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Product name" value="{{ $product->title }}" name="title">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                  </div>
                 
                  <div class="form-group">
                    <label for="thumbnail">Product Thumbnail </label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" value="{{ asset('thumb'.$product->title) }}"id="thumbnailid" placeholder="thumbnail" name="thumbnail">
                    @error('thumbnail')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="category"> Category</label>
                      <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                        
                        <option value="">Select</option>
                        @foreach ($cats as $cat)

                        <option @if ($product->category_id == $cat->id) selected @endif value="{{ $cat->id }}">{{ $cat->category_name }}</option>    
                        @endforeach                       
                       
                      </select>
                      @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    
                    <div class="form-group col-6">
                      <label for="subcategory_id"> Subcategory</label>
                      <select class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" id="subcategory_id">
                        <option value="">Select</option>
                        @foreach ($subcats as $subcat)
                        <option @if ($product->subcategory_id == $subcat->id) selected @endif value="{{ $subcat->id }}">{{ $subcat->subcategory_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('subcategory_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="summary"> Summery </label>
                    <input type="text" class="form-control @error('summary') is-invalid @enderror" value="{{ $product->summary }}" id="summary" placeholder="Summary"name="summary">
                    @error('summary')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  

                  <div class="form-group">
                    <label for="slug"> Description </label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Description">{{ $product->description }}</textarea>
                  </div>
                  @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  {{-- <div class="form-group">
                    <label for="slug"> Slug </label>
                    <input type="text" class="form-control" id="slug" placeholder="Slug"name="slug">
                  </div> --}}
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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
@section("toastr_js")
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
    $('#title').keyup(function() {
      $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
    $('#category_id').change(function(){
      var category_id = $(this).val();
      if (category_id) {
        $.ajax({
          type:"Get",
          url:"{{ ('api/get-subcat-list') }}/"+category_id,
          success:function(res){
            if (res) {
              $("#subcategory_id").empty();
              $("#subcategory_id").append('<option>Select</option>');
              $.each(res,function(key,value){
                $("#subcategory_id").append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
              });
              
              
            }else{
              $("#subcategory_id").empty();
            }
          }
        });
        
      }else{
      }
    });
   
</script>
@endsection