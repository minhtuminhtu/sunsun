<div class="booking-warp">
    <div class="row">
        <div class="col-3">
            <p class="text-md-left pt-2">Name</p>
        </div>
        <div class="col-9">
            <input name="name" type="text" id="name" class="form-control">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            <p class="text-md-left pt-2">Email</p>
        </div>
        <div class="col-9">
            <input name="email" type="text" id="email" class="form-control">
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
            <input name="year" type="number" id="year" class="form-control" value="1970">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            <p class="text-md-left pt-2">Address</p>
        </div>
        <div class="col-9">
            <input name="address" type="text" id="address" class="form-control">
        </div>
    </div>
</div>