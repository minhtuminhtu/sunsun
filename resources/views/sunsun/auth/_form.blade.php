{!! Form::open(['action' => isset($ms_user) ? ['Sunsun\Auth\MsUserController@update', $ms_user->ms_user_id] : ['Sunsun\Auth\MsUserController@create'], 'method' => 'POST']) !!}
<div class="user-warp">
    <div class="row">
        <div class="col-3">
            {!! Form::label('username', '名称') !!}
        </div>
        <div class="col-9">
            {!! Form::text('username', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            {!! Form::label('email', 'Eメール') !!}
            <p class="text-md-left pt-2"></p>
        </div>
        <div class="col-9">
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    @if($new == 1)
        <div class="row mt-2">
            <div class="col-3">
                {!! Form::label('password', 'パスワード') !!}
            </div>
            <div class="col-9">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>
    @else
        <div class="row mt-2">
            <div class="col-3">
                <p class="text-md-left">パスワード</p>
            </div>
            <div class="col-9">
                <a class="text-md-left" href="/changepassword">Need change password?</a>
            </div>
        </div>
    @endif
    <div class="row mt-2">
        <div class="col-3">
            {!! Form::label('gender', '性別') !!}
        </div>
        <div class="col-9">
            {!! Form::select('gender', ['female' => 'Female', 'male' => 'Male'], 'female', ['class' => "form-control"]) !!}

        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            {!! Form::label('birth_year', '年齢') !!}
        </div>
        <div class="col-9">
            {!! Form::selectRange('birth_year', 1930, 2019, 1986,['class' => "form-control"] ) !!}
        </div>
    </div>
    <div class="row" style="margin-top: 15px">
        @if(isset($ms_user))
            {{ Form::hidden('ms_user_id', auth()->user()->ms_user_id) }}
        @endif
        @if(isset($ms_user))
            <div class="col-6 offset-3">
                <a class="no-effect">
                    <button type="button" class="btn btn-block btn-booking text-white confirm-rules">Update</button>
                </a>
            </div>
        @else
                <div class="col-6 offset-3">
                    <a class="no-effect">
                        {{Form::submit('登録', ['class'=>'btn btn-block btn-booking text-white confirm-rules'])}}
                    </a>
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center">
                    <a href="/login" class="no-effect">ログイン</a>
                </div>
        @endif

    </div>
</div>
{!! Form::close() !!}
