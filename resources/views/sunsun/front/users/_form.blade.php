<div class="booking-warp">
    <div class="row">
        <div class="col-3">
            <p class="text-md-left pt-2">Name</p>
        </div>
        <div class="col-9">
            <input name="name" type="text" id="name" class="form-control" value="{{ $name }}">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            <p class="text-md-left pt-2">Email</p>
        </div>
        <div class="col-9">
            <input name="email" type="text" id="email" class="form-control" @if($new == 0) disabled @endif value="{{ $email }}">
        </div>
    </div>
    @if($new == 1)
        <div class="row mt-2">
            <div class="col-3">
                <p class="text-md-left pt-2">Password</p>
            </div>
            <div class="col-9">
                <input name="password" type="password" id="password" class="form-control">
            </div>
        </div>
    @else
        <div class="row mt-2">
            <div class="col-3">
                <p class="text-md-left">Password</p>
            </div>
            <div class="col-9">
                <a class="text-md-left" href="/changepassword">Need change password?</a>
            </div>
        </div>
    @endif
    <div class="row mt-2">
        <div class="col-3">
            <p class="text-md-left pt-2">Gender</p>
        </div>
        <div class="col-9">
            <select name="used" class="form-control">
                <option value="female">Female</option>
                <option value="male">Male</option>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            <p class="text-md-left pt-2">Year of Birth</p>
        </div>
        <div class="col-9">
            <select name="used" class="form-control">
                @for ($i = 1950; $i < 2020; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            <p class="text-md-left pt-2">Address</p>
        </div>
        <div class="col-9">
            <input name="address" type="text" id="address" class="form-control" value="{{ $address }}">
        </div>
    </div>
</div>