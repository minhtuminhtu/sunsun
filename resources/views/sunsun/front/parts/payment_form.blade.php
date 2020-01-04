<input type="hidden" name="Token" id="Token"value="">
<input type="hidden" name="Amount" id="Amount"value="{{ isset($bill['total'])?$bill['total']:''  }}">
<div class="booking-field">
    <div class="booking-field-label @if(isset($new) && (!$new)) {{ 'booking-laber-padding' }} @endif">
        <p class="text-md-left pt-2">{{config('booking.name.label')}}</p>
    </div>
    @php
        $field_name = isset($data_booking->name)?$data_booking->name:'';
        if($field_name == ''){
            $field_name = ((isset($new) && ($new == 1)) && isset($auth_username) && $auth_username != '')?$auth_username:'';
        }
    @endphp
    <div class="booking-field-content">
        <div>
            <input name="name" id="name" type="text" class="form-control date-book-input" maxlength="255" value="{{ $field_name }}"/>
        </div>
    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label @if(isset($new) && (!$new)) {{ 'booking-laber-padding' }} @endif">
        <p class="text-md-left" style="line-height: 115%;">{{config('booking.phone.label')}}</p>
        <p class="node-text pt-2" style="line-height: 100%;">当日の連絡先</p>
    </div>
    @php
        $field_tel = isset($data_booking->name)?$data_booking->phone:'';
        if($field_tel == ''){
            $field_tel = ((isset($new) && ($new == 1))  && isset($auth_tel) && $auth_tel != '')?$auth_tel:'';
        }
    @endphp
    <div class="booking-field-content">
        <div>
            <input name="phone" id="phone" type="text" class="form-control date-book-input" maxlength="255" value="{{ $field_tel }}"/>
        </div>
    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label @if(isset($new) && (!$new)) {{ 'booking-laber-padding' }} @endif">
        <p class="text-md-left pt-2">{{config('booking.email.label')}}</p>
    </div>
    @php
        $field_email = isset($data_booking->name)?$data_booking->email:'';
        if($field_email == ''){
            $field_email = ((isset($new) && ($new == 1)) && isset($auth_email) && $auth_email != '')?$auth_email:'';
        }
    @endphp
    <div class="booking-field-content">
        <div>
            <input name="email" id="email" type="text" class="form-control date-book-input" maxlength="255" value="{{ $field_email }}"/>
        </div>
    </div>
</div>
