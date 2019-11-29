<div class="booking-field">
    <div class="booking-field-label @if(isset($new) && (!$new)) {{ 'booking-laber-padding' }} @endif">
        <p class="text-md-left pt-2">{{config('booking.name.label')}}</p>
    </div>
    <div class="booking-field-content">
        <input name="name" type="text" class="form-control date-book-input" maxlength="255" value="{{ isset($data_booking->name)?$data_booking->name:'' }}" required/>
        <!-- <p class="node-text text-red">Name is required!</p> -->
    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label @if(isset($new) && (!$new)) {{ 'booking-laber-padding' }} @endif">
        <p class="text-md-left" style="line-height: 115%;">{{config('booking.phone.label')}}</p>
        <p class="node-text pt-2" style="line-height: 100%;">当日の連絡先</p>
    </div>
    <div class="booking-field-content">
        <input name="phone" type="text" class="form-control date-book-input" maxlength="255" value="{{ isset($data_booking->name)?$data_booking->phone:'' }}" required/>
        <!-- <p class="node-text text-red">Phone is required!</p> -->
    </div>
</div>
<div class="booking-field">
    <div class="booking-field-label @if(isset($new) && (!$new)) {{ 'booking-laber-padding' }} @endif">
        <p class="text-md-left pt-2">{{config('booking.email.label')}}</p>
    </div>
    <div class="booking-field-content">
        <input name="email" type="text" class="form-control date-book-input" maxlength="255" value="{{ isset($data_booking->name)?$data_booking->email:'' }}" required/>
        <!-- <p class="node-text text-red">Email is required!</p> -->
    </div>
</div>