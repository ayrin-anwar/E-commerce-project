@extends('frontend.master')
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->


<!-- checkout area start -->
<div class="checkout-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Billing Details</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label> Name</label>
                                <input type="text" value="{{ Auth::user()->name}}" name="billing_name" />
                            </div>
                        </div>
                       
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <p>Email Address *</p>
                                <input type="email" value="{{ Auth::user()->email}}"name="billing_email">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <p>Phone No. *</p>
                                <input type="text" name="billing_phone_number">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-select mb-4">
                                <label>Country</label>
                                <option value="">--select--</option>
                                <select id="country_dropdown" name="country" >
                                    
                                    @foreach($countries as $country)
                                     <p>{{ $country->name }}</p>
                                     <option value="{{ $country->code}}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <p>Town/City *</p>
                                <select id="city_dropdown" name="city" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <p>Your Address *</p>
                                <input type="text" name="billing_address">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <p>Postcode/ZIP</p>
                                <input type="text" name="billing_postcode" >
                            </div>
                        </div>
                       
                    </div>
                    
                    <div class="additional-info-wrap">
                        <h4>Additional information</h4>
                        <div class="additional-info">
                            <p>Order Notes </p>
                            <textarea name="order_note" placeholder="Notes about Your Order, e.g.Special Note for Delivery" ></textarea>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                <div class="your-order-area">
                    <h3>Your order</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-top">
                                <ul>
                                    <li>Product</li>
                                    <li>Total</li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    <li><span class="order-middle-left">Product Name X 1</span> <span
                                            class="order-price">$100 </span></li>
                                    <li><span class="order-middle-left">Product Name X 1</span> <span
                                            class="order-price">$100 </span></li>
                                </ul>
                            </div>
                            <div class="your-order-bottom">
                                <ul>
                                    <li class="your-order-shipping">Subtotal</li>
                                    <li><span class="pull-right"><strong>{{ session()->get('s_total') }}</strong></span></li>
                                </ul>
                                <ul>
                                    <li class="your-order-shipping">Total</li>
                                    <li><span class="pull-right" id="total">{{ session()->get('s_stotal') }}</span></li>
                                </ul>
                            </div>
                            <div class="your-order-total">
                                <ul>
                                    <li>Subtotal <span class="pull-right"><strong>{{ session()->get('s_total') }}</strong></span></li>
                                    <li>Discount<span class="pull-right">{{ session()->get('s_discount') }}</span></li>
                                    <li>Shipping<span class="pull-right"><strong id="shipping"></strong></span></li>
                                    <li>Total<span class="pull-right" id="total">{{ session()->get('s_stotal') }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion element-mrg">
                                <div id="faq" class="panel-group">
                                    <div class="panel panel-default single-my-account m-0">
                                        <div class="panel-heading my-account-title">
                                            <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                    href="#my-account-1" class="collapsed"
                                                    aria-expanded="true">Direct bank transfer</a>
                                            </h4>
                                        </div>
                                        <div id="my-account-1" class="panel-collapse collapse show"
                                            data-bs-parent="#faq">

                                            <div class="panel-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town,
                                                    Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default single-my-account m-0">
                                        <div class="panel-heading my-account-title">
                                            <input id="card" type="radio" name="payment_method" value="credit card">
                                         <label for="card">Credit Card</label>
                                                            
                                        </div>
                                        <div id="my-account-2" class="panel-collapse collapse"
                                            data-bs-parent="#faq">

                                            <div class="panel-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town,
                                                    Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default single-my-account m-0">
                                        <div class="panel-heading my-account-title">
                                            <input id="delivery" type="radio" name="payment_method" value="cash on delivery">
                                            <label for="delivery">Cash on Delivery</label>
                                        </div>
                                        <div id="my-account-3" class="panel-collapse collapse"
                                            data-bs-parent="#faq">

                                            <div class="panel-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town,
                                                    Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Place-order mt-25">
                        <a class="btn-hover" href="#">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_js')
<script>
    // alert('hi');
    $(document).ready(function() {
    //   $('#country_dropdown').select2();
    //   $('#city_dropdown').select2();
       $('#country_dropdown').change(function(){
         var country_code=$(this).val();
        //  alert(country_code);
         var session_total="{{session()->get('s_stotal')}}";
         if(country_code=='bd')
         {
             @php
                 session()->put('s_shipping',120);
             @endphp
             alert(120);
             $('#shipping').html(120);
             $('#s_stotal').html(120+parseInt(session_total-shipping));
         }
         else{
            @php
                 session()->put('s_shipping',500);
            @endphp
           
            $('#s_stotal').html(500+session_total);
         }
        //  $.ajaxSetup({
        //      //ajax setup
        //      headers:{
        //          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        //      }
        //  });
         $.ajax({
             type:'GET',
             url:'get/city/list/'+country_code,
            //data: {country_code: country_code},
             success:function(res)
             {
                //console.log(res);
                  $('#city_dropdown').html(res);

             }
         });
     

     });
    });
    $(document).ready(
        function()
        {
           $('#applycouponbutton').click(function(){
              var coupon_name=$('#applycouponinput').val();
              var redirected_link="{{url('/carts')}}/"+coupon_name;
             alert(redirected_link);
              window.location.href=redirected_link;
           });
        }
    );
    $('.color_id').change(function(){
       var colorId=$(this).val();
       var productId=$(this).attr('data-product');
       //alert(colorId);
       $.ajax({
           type:"GET",
           url:"{{ url('get/color/size') }}/"+colorId+'/'+productId,
           success:function(res)
           {
               //console.log(res);
               if(res)
               {
                   $('.sizeadd').html(res);

                   $('.sizecheck').change(function(){
                      var price=$(this).attr('data-price');
                      var quantity=$(this).attr('data-quantity');
                      $('.price').html('$'+price);
                      $('.availability').html('$'+quantity);
                   });
                   
               }
           }
       });
    })
</script>
@endsection
