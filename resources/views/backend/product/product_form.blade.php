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
              <form method="post" action="{{url('post-product')}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Product Name</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title"name="title">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="category_id">Category Name</label>
                    <select name="category_id" class="form-control" @error('category_id') is-invalid @enderror" id="category_id">
                      <option value="">--Select--</option>
                      @foreach ($cats as $cat)
                          <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                      @endforeach
                  </select>
                   </div>
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  
                  <div class="form-group">
                    <label for="subcategory_id">Sub Category</label>
                    <select name="subcategory_id" class="form-control" @error('subcategory_id') is-invalid @enderror" id="subcategory_id">
                        <option value="">--Select--</option>
                        @foreach ($subcats as $subcat)
                            <option value="{{ $subcat->id }}">{{ $subcat->subcategory_name }}</option>
                        @endforeach
                    </select>
                   
                  </div>
                  @error('subcategory_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" placeholder="thumbnail" name="thumbnail">
                   
                    @error('thumbnail')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="image_name">Gallery</label>
                    <input type="file" multiple class="form-control @error('image_name') is-invalid @enderror" id="image_name" placeholder="image_name" name="image_name[]">
                   
                    @error('image_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="summary">Summary</label>
                    <input type="text" class="form-control @error('summary') is-invalid @enderror" id="summary" placeholder="Enter summary"name="summary">
                    @error('summary')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter description"name="description">
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                        <div id="dynamic-field-1" class="form-group dynamic-field">
                          <div class="row">
                            <div class="col-lg-2">
                         
                          {{-- <label for="field" class="font-weight-bold">Field 1</label>
                          <input type="text" id="field" class="form-control" name="field[]" /> --}}
                          <label for="color_id">Color</label>
                          <select name="color_id[]" id="color_id" class="form-control @error('color_id[]') is-invalid @enderror">
                            <option value>Select</option>
                             @foreach($colors as $color )
                               <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                             @endforeach
                          </select>
                          @error('color_id[]')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                         <div class="col-lg-2">
                          <label for="size_id[]">Size</label>
                          <select name="size_id[]" id="size_id" class="form-control">
                            <option value>Select</option>
                             @foreach($sizes as $size)
                               <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                             @endforeach
                          </select>
                        </div>
                        <div class="col-lg-2">
                          <label for="quantity">Quantity</label>
                          <input type="text" id="quantity" class="form-control" name="quantity[]">
                        </div>
                        <div class="col-lg-2">
                          <label for="price">Price</label>
                          <input type="text" id="price" class="form-control" name="price[]">
                        </div>
                        <div class="col-lg-2">
                          <label for="sale_price">Sale Price</label>
                          <input type="text" id="sale_price" class="form-control" name="sale_price[]">
                        </div>
                        
                        
                        
                        
                      </div>     
                        <div class="clearfix mt-4">
                          <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i> Add</button>
                          <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fas fa-minus fa-fw"></i> Remove</button>
                         
                        </div>
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
$(document).ready(function() {
  var buttonAdd = $("#add-button");
  var buttonRemove = $("#remove-button");
  var className = ".dynamic-field";
  var count = 0;
  var field = "";
  var maxFields = 5;
  
  function totalFields() {
    return $(className).length;
  }

  
  function addNewField() {
    
    count = totalFields() + 1;
    field = $("#dynamic-field-1").clone();
    field.attr("id", "dynamic-field-" + count);
    field.children("label").text("Field " + count);
    field.find("input").val("");
    $(className + ":last").after($(field));
  }

  function removeLastField() {
    if (totalFields() > 1) {
      $(className + ":last").remove();
    }
  }

  function enableButtonRemove() {
    if (totalFields() === 2) {
      buttonRemove.removeAttr("disabled");
      buttonRemove.addClass("shadow-sm");
    }
  }

  function disableButtonRemove() {
    if (totalFields() === 1) {
      buttonRemove.attr("disabled", "disabled");
      buttonRemove.removeClass("shadow-sm");
    }
  }

  function disableButtonAdd() {
    if (totalFields() === maxFields) {
      buttonAdd.attr("disabled", "disabled");
      buttonAdd.removeClass("shadow-sm");
    }
  }

  function enableButtonAdd() {
    if (totalFields() === (maxFields - 1)) {
      buttonAdd.removeAttr("disabled");
      buttonAdd.addClass("shadow-sm");
    }
  }

  buttonAdd.click(function() {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
  });

  buttonRemove.click(function() {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
  });
 }); 
</script>
@endsection