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
              <form method="post" action="{{ url('update-product')}}"enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="hidden" class="form-control" id="id" value="{{ $product->id }}" placeholder="Product name" name="product_id">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Product name" value="{{ $product->title }}" name="title">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="image_name">Gallery</label>
                    <input type="file" multiple class="form-control @error('image_name') is-invalid @enderror" id="image_name"value="{{ asset('gallery'.$product->title) }}" placeholder="image_name" name="image_name[]">
                   
                    @error('image_name')
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
                  <div class="form-group">
                   
                    @foreach($product->attribute as $item)
                    <div id="dynamic-field-1" class="form-group dynamic-field">
                      <input type="hidden" id="attribute_id" name="attribute_id[]" value="{{ $item->id }}">
                      <div class="row">
                        <div class="col-lg-2">
                     
                      {{-- <label for="field" class="font-weight-bold">Field 1</label>
                      <input type="text" id="field" class="form-control" name="field[]" /> --}}
                      <label for="color_id">Color</label>
                      <select name="color_id[]" id="color_id" class="form-control @error('color_id[]') is-invalid @enderror">
                        <option value>Select</option>
                         @foreach($colors as $color )
                           <option  @if($item->color_id==$color->id)selected @endif value="{{ $color->id }}">{{ $color->color_name }}</option>
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
                           <option  @if($item->size_id==$size->id)selected @endif value="{{ $size->id }}">{{ $size->size_name }}</option>
                         @endforeach
                      </select>
                    </div>
                    <div class="col-lg-2">
                      <label for="quantity">Quantity</label>
                      <input type="text" id="quantity" value="{{ $item->quantity }}"class="form-control" name="quantity[]">
                    </div>
                    <div class="col-lg-2">
                      <label for="price">Price</label>
                      <input type="text" id="price" value="{{ $item->price }}"class="form-control" name="price[]">
                    </div>
                    <div class="col-lg-2">
                      <label for="sale_price">Sale Price</label>
                      <input type="text" id="sale_price"value="{{ $item->sale_price }}" class="form-control" name="sale_price[]">
                    </div>
                    
                    
                    
                    
                  </div>
                
                    {{-- <div class="clearfix mt-4">
                      <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i> Add</button>
                      <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fas fa-minus fa-fw"></i> Remove</button>
                     
                    </div> --}}
               
            
              </div>
              @endforeach
              <div class="clearfix mt-4">
                <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i> Add</button>
                <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1"><i class="fas fa-minus fa-fw"></i> Remove</button>
               
              </div>
            </div>
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