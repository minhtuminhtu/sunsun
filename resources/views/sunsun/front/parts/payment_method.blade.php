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
    <input type="hidden" id="Token"value="">
    <div class="credit-card-line">
        <div class="card-number floatinglabel">
            <span>Card Number</span>
            <input type="text" id="card-number" class="form-control typing-none" value="4111111111111111" placeholder="Card Number" maxlength="23">
        </div>
        <div class="card-img d-flex justify-content-center align-items-center">
            <img src="https://galacticglasses.com/image/bank_def.png" class="img-fluid scale-image" alt="">
        </div>
    </div>
    <div class="credit-card-line2">
        <div class="card-expire floatinglabel">
            <span>MM/YY</span>
            <input type="text" id="card-expire" class="form-control typing-none" value="1501" placeholder="MM/YY" maxlength="5">
        </div>
        <laber class="card-secret floatinglabel">
            <span>CVV</span>
            <input type="password" id="card-secret" class="form-control typing-none" value="111" placeholder="CVC" maxlength="3">
        </laber>
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
