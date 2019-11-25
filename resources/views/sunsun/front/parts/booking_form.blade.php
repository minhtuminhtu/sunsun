<div class="">
    <form action="{{route('.confirm')}}" method="POST" class="booking">
        <div class="">
            @csrf
            <div class="booking-warp booking" style="background-image: url('{{ asset('sunsun/imgs/bg.png') }}');">
                @if(isset($add_new_user) && $add_new_user == 'on')
                    <div class="data-field-day">
                                  <span>
                                @if (isset($customer['date-view']))
                                          {{$customer['date-view']}}
                                      @else
                                          {{$customer['date-view-from']}} <br>
                                          {{$customer['date-view-to']}}
                                      @endif
                                </span>  &nbsp;  &nbsp;
                        <span>
                        予約追加
                        </span>
                    </div>
                @endif

                <!-- <div class="booking-line font-weight-bold">
                    <div class="booking-line-laber">
                    </div>
                    <hr class="booking-line-line">
                </div> -->

                <div class="booking-block-top">


                    <div class="booking-field">
                        <div class="booking-field-label booking-laber-padding">
                            <p class="text-left pt-2">{{config('booking.repeat_user.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <select name="repeat_user" class="form-control">
                                @foreach($repeat_user as $value)
                                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="booking-field {{(isset($add_new_user) && $add_new_user == 'on')?'hidden':''}}">
                        <div class="booking-field-label booking-laber-padding">
                            <p class="text-left pt-2">{{config('booking.transport.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <select name="transport" id='transport' class="form-control">
                                @foreach($transport as $value)
                                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="booking-field bus" style="display:none;">
                        <div class="booking-field-label booking-laber-padding">
                            <p class="text-left pt-2">{{config('booking.bus_arrive_time_slide.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <input type="hidden" name="bus_arrive_time_slide" id="bus_arrive_time_slide">
                            <div class="dropdown">
                                <button class="btn btn-border dropdown-toggle btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="bus-time">
                                        @php
                                        $first_bus_time = NULL;
                                        foreach ($bus_arrive_time_slide as  $first_bus_time) {
                                            break;
                                        }
                                        @endphp
                                        <div class="text-left">{{ substr($first_bus_time->kubun_value, 0, 8) }}</div>
                                        <div class="text-left node-text">{{ trim(str_replace(substr($first_bus_time->kubun_value, 0, 8), '', $first_bus_time->kubun_value)) }}</div>
                                    </div>
                                    <i class="fas fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu btn-block" aria-labelledby="dropdownMenuButton">
                                    @foreach($bus_arrive_time_slide as $value)
                                    <li class="dropdown-item" value='@json($value)'>
                                        <div class="bus_time_first">{{ substr($value->kubun_value, 0, 8) }}</div>
                                        <div class="bus_time_second node-text">{{ trim(str_replace(substr($value->kubun_value, 0, 8), '', $value->kubun_value)) }}</div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="booking-field bus" style="display:none">
                        <div class="booking-field-label booking-laber-padding">
                            <p class="text-left pt-2">{{config('booking.pick_up.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <select name="pick_up" class="form-control">
                                @foreach($pick_up as $value)
                                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                @endforeach
                            </select>
                            <p class="text-left mt-2 mb-2 node-text">バスの方は洲本ICのバス停に送迎を行います。</p>
                        </div>
                    </div>
                    <div class="booking-field">
                        <div class="booking-field-label booking-laber-padding">
                            <p class="text-left pt-2">{{config('booking.course.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <select name="course" id="course" class="form-control">
                                @foreach($course as $value)
                                    <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="service-warp">

                </div>


            </div>
            <div class="foot-confirm">
                <div class="confirm-button">
                    <div class="button-left">
                        @if(isset($add_new_user) && $add_new_user == 'on')
                            <input type="hidden" name="add_new_user" value="on">
                        @endif
                        <button type="button" class="btn btn-block text-white btn-booking btn-confirm-left add-new-people">予約追加</button>
                    </div>
                    <div class="button-right">
                        <button type="submit" class="btn btn-block text-white btn-booking">予約確認へ</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
