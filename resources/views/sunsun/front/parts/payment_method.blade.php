<div class="">
    <div class="">
        <p class="pt-3 @if(isset($new) && (!$new)) booking-laber-padding @else font-weight-bold  @endif">{{config('booking.payment_method.label')}}</p>
    </div>
</div>
<div class="pl-4 mt-2">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input payment-method" id="credit-card" name="payment-method" value="1" 
        {{ 
            isset($data_booking->payment_method)?(($data_booking->payment_method == 1)?'checked':''):'' 
        }}  
        @if(isset($new) && (!$new))
          disabled  
        @else  
          checked  
        @endif
        />
        <label class="custom-control-label" for="credit-card">クレジットカード</label>
    </div>
</div>
<div class="credit-card" @if(isset($new) && (!$new))  style="display:none;"  @endif>
    <div class="credit-card-line">
        <div class="card-img d-flex justify-content-center align-items-center">
            <img src="https://galacticglasses.com/image/bank_def.png" class="img-fluid scale-image" alt="">
        </div>
        <div class="card-number">
            <input type="text" id="card-number" class="form-control" placeholder="Card number" maxlength="22">
        </div>
    </div>
    <div class="credit-card-line2">
        <div class="card-expire">
            <input type="text" id="card-expire" class="form-control" placeholder="MM/YY" maxlength="5">
        </div>
        <div class="card-secret">
            <input type="password" id="card-secret" class="form-control" placeholder="CVC" maxlength="3">
        </div>
    </div>
</div>
<div class="pl-4 mt-2">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input payment-method" name="payment-method" value="2"  id="local-cash" @if(isset($new) && (!$new))  {{ isset($data_booking->payment_method)?(($data_booking->payment_method == 2)?'checked':''):'checked' }}   @endif>
        <label class="custom-control-label" for="local-cash">現地現金</label>
    </div>
</div>
<div class="pl-4 mt-2 @if(isset($new) && (!$new))  booking-field  @endif">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input payment-method" name="payment-method" value="3"  {{ isset($data_booking->payment_method)?(($data_booking->payment_method == 3)?'checked':''):'' }}  id="coupon">
        <label class="custom-control-label" for="coupon">回数券</label>
    </div>
</div>