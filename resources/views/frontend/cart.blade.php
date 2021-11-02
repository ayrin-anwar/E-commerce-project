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
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalPrice=0;
                               @endphp
                               @forelse($carts as $cart)
                              
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="{{ asset('thumb/'.$cart->Product->created_at->format('Y/m/').$cart->Product->id.'/'.$cart->Product->thumbnail) }}" alt=""></a>
                                    </td>
                                    <td class="product-name"><a href="#">{{$cart->Product->title}}<br> (Color:{{$cart->color->color_name  }},Size:{{$cart->size->size_name}})</a></td>
                                    <td class="product-price-cart"><span class="amount">@php 
                                        $price=App\Models\Attributes::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first();
                                       
                                        @endphp</span> 
                                        @if($price->price>$price->sale_price)
                                        <s>{{ $price->price }}</s>{{ $price->sale_price }}
                                        @else
                                        {{ $price->sale_price }}
                                            
                                        @endif
                                 </td>
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                            value={{ $cart->quantity }} />
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span>@php  $totalPrice+=App\Models\Attributes::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->sale_price*$cart->quantity  @endphp<p>${{ App\Models\Attributes::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->sale_price*$cart->quantity }}</p></span></td>
                                    <td class="product-remove">
                                        <a href="#"><i class="fa fa-pencil"></i></a>
                                        <a href="#"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">There is no product</td>
                                </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="#">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <button>Update Shopping Cart</button>
                                    <a href="#">Clear Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-lm-30px">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>Enter your destination to get a shipping estimate.</p>
                                <div class="tax-select-wrapper">
                                    <div class="tax-select">
                                        <label>
                                            * Country
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Region / State
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select mb-25px">
                                        <label>
                                            * Zip/Postal Code
                                        </label>
                                        <input type="text" />
                                    </div>
                                    <button class="cart-btn-2" type="submit">Get A Quote</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lm-30px">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <form>
                                    <input type="text" required="" name="name" />
                                    <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-md-30px">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <li><span class="pull-left">Subtotal </span>{{'$'.$totalPrice }}</li>
                            <li><span class="pull-left">({{ $discount }}%) </span>{{discount_amount($totalPrice,$discount)}}</li>
                            <li><span class="pull-left"> Total </span>{{'$'.discount_amount1($totalPrice,$discount) }}</li>
                            @php
                                    session()->put('s_total',$totalPrice);
                                    session()->put('s_discount',$discount);
                                    session()->put('s_stotal',discount_amount1($totalPrice,$discount));
                            @endphp
                            <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input type="checkbox" /> Standard <span>$20.00</span></li>
                                    <li><input type="checkbox" /> Express <span>$30.00</span></li>
                                </ul>
                            </div>
                            <h4 class="grand-totall-title">Grand Total <span>$260.00</span></h4>
                            <a href="{{route('checkout')}}">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->
@endsection
@section('footer_js')
   <script>
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
