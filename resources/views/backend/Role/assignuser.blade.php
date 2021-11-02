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
              <form method="post"name="myform" action="{{route('assign.user.store')}}" enctype="multipart/form-data" onsubmit="return formsubmit()">
              @csrf
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="name">Role Name</label>
                    <select name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                      <option value="">--Select--</option>
                      @foreach ($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                  </select>
                   </div>
                    @error('role_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  
                  <div class="form-group">
                    <label for="id">User name</label>
                    <select name="id" class="form-control @error('id') is-invalid @enderror" id="id">
                        <option value="">--Select--</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                   
                  </div>
                  @error('user_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  
                  
                 
               
                <!-- /.card-body -->

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <div class="card card-primary">
               <table class="table table-bordered">
                   <thead>
                       <tr>
                          
                           <th>User</th>
                           <th>Role</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach($users as $user)
                       <tr>
                           <td>{{ $user->name }}</td>
                           
                           <td>
                               @forelse($user->roles as $role)
                               {{ $role->name }}
                               @foreach($role->permissions as $permission)
                                  <li>{{$permission->name  }}</li> 
                               @endforeach
                               @empty


                               @endforelse

                           </td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>
                <!-- /.card-header -->
                <!-- form start -->
                
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
  function formsubmit() {
      var img=document.forms['myform']['image_name[]'].value;
      if(img=="")
      {
         alert('image_required');
         return false;
      }
   }
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