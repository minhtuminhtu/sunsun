<div class="">
    <form  @if(isset($data_booking)) action="{{route('admin.update_booking')}}" @else action="{{route('.confirm')}}" @endif method="POST" class="booking">
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

                    @if(isset($new) && (!$new))
                    @include('sunsun.front.parts.payment_form', ['new' => '0', 'data_booking' => $data_booking])
                    @include('sunsun.front.parts.payment_method', ['new' => '0', 'data_booking' => $data_booking])
                    @endif

                    <div class="booking-field">
                        <div class="booking-field-label booking-laber-padding">
                            <p class="text-left pt-2">{{config('booking.repeat_user.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <select name="repeat_user" class="form-control">
                                @foreach($repeat_user as $value)
                                    @if(isset($data_booking->repeat_user) && ($value->kubun_id == $data_booking->repeat_user))
                                        <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                                    @else
                                        <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                    @endif
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
                                    @if(isset($data_booking->transport) && ($value->kubun_id == $data_booking->transport))
                                        <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                                    @else
                                        <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="booking-field bus" @if(!isset($data_booking->transport) || ($data_booking->transport != '02')) style="display:none;"@endif>
                        <div class="booking-field-label booking-laber-padding">
                            <p class="text-left pt-2">{{config('booking.bus_arrive_time_slide.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            
                            <div class="dropdown">
                                <button class="btn btn-border dropdown-toggle btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="bus-time">
                                        <div class="bus-time-data">
                                            @php
                                            $first_bus_time = NULL;
                                            if(isset($data_booking->bus_arrive_time_slide)){
                                                foreach ($bus_arrive_time_slide as  $bus_time) {
                                                    if($bus_time->kubun_id == $data_booking->bus_arrive_time_slide){
                                                        $first_bus_time = $bus_time;
                                                        break;
                                                    }
                                                }
                                            }else{
                                                foreach ($bus_arrive_time_slide as  $first_bus_time) {
                                                    break;
                                                }
                                            }
                                            @endphp
                                            <input type="hidden" name="bus_arrive_time_slide" id="bus_arrive_time_slide" value='@json($first_bus_time)'>
                                            <div class="text-left" id="bus_time_first">{{ substr($first_bus_time->kubun_value, 0, 8) }}</div>
                                            <div class="text-left node-text" id="bus_time_second">{{ trim(str_replace(substr($first_bus_time->kubun_value, 0, 8), '', $first_bus_time->kubun_value)) }}</div>
                                        </div>
                                        <div class="bus-time-icon">
                                            <i class="fas fa-long-arrow-alt-down"></i>
                                        </div>
                                    </div>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @php
                                    $i = false;
                                    @endphp
                                    @foreach($bus_arrive_time_slide as $value)
                                        @if(isset($data_booking->bus_arrive_time_slide))
                                            @if($value->kubun_id == $data_booking->bus_arrive_time_slide)
                                                <li class="dropdown-item @if($i) {{ 'body-content' }} @endif active">
                                                    <input type="hidden" class="bus_arrive_time_slide" value='@json($value)'>
                                                    <div class="bus_time_first">{{ substr($value->kubun_value, 0, 8) }}</div>
                                                    <div class="bus_time_second node-text">{{ trim(str_replace(substr($value->kubun_value, 0, 8), '', $value->kubun_value)) }}</div>
                                                </li>
                                            @else
                                                <li class="dropdown-item @if($i) body-content @endif ">
                                                    <input type="hidden" class="bus_arrive_time_slide" value='@json($value)'>
                                                    <div class="bus_time_first">{{ substr($value->kubun_value, 0, 8) }}</div>
                                                    <div class="bus_time_second node-text">{{ trim(str_replace(substr($value->kubun_value, 0, 8), '', $value->kubun_value)) }}</div>
                                                </li>
                                            @endif
                                        @else
                                            <li class="dropdown-item @if($i) body-content @else active @endif ">
                                                <input type="hidden" class="bus_arrive_time_slide" value='@json($value)'>
                                                <div class="bus_time_first">{{ substr($value->kubun_value, 0, 8) }}</div>
                                                <div class="bus_time_second node-text">{{ trim(str_replace(substr($value->kubun_value, 0, 8), '', $value->kubun_value)) }}</div>
                                            </li>
                                        @endif   
                                        @php
                                        $i = true;
                                        @endphp
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="booking-field bus" @if(!isset($data_booking->transport) || ($data_booking->transport != '02')) style="display:none;"@endif>
                        <div class="booking-field-label booking-laber-padding">
                            <p class="text-left pt-2">{{config('booking.pick_up.label')}}</p>
                        </div>
                        <div class="booking-field-content">
                            <select name="pick_up" class="form-control">
                                @foreach($pick_up as $value)
                                    @if(isset($data_booking->pick_up) && ($value->kubun_id == $data_booking->pick_up))
                                        <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                                    @else
                                        <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                    @endif
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
                                    @if(isset($data_booking->course) && ($value->kubun_id == $data_booking->course))
                                        <option selected value='@json($value)'>{{ $value->kubun_value }}</option>
                                    @else
                                        <option value='@json($value)'>{{ $value->kubun_value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @php
                $picked_course = '';
                if(isset($data_booking->course)){
                    foreach($course as $value){
                        if($value->kubun_id == $data_booking->course){
                            $picked_course = $value;
                            break;
                        }
                    }
                }else{
                    foreach ($bus_arrive_time_slide as  $picked_course) {
                        break;
                    }
                }
                @endphp
                <input type="hidden" id="pick_course" value='@json($picked_course)'>
                <input type="hidden" id="course_data" value='{{ isset($data_booking)?json_encode($data_booking):"" }}'>
                <input type="hidden" id="course_time" value='{{ isset($data_time)?json_encode($data_time):"" }}'>
                <div class="service-warp">

                </div>


            </div>
            <div class="foot-confirm">
                @if(isset($data_booking))
                <div class="">
                    <div class="booking-history">
                        <div class="booking-history-label booking-laber-padding">
                            <p class="text-left pt-2">History</p>
                        </div>
                        <div class="booking-history-content">
                            <select name="course" id="course" class="form-control">
                                <option value='@json($value)'>12:30 2019/12/29</option>
                                <option value='@json($value)'>12:30 2019/12/29</option>
                                <option value='@json($value)'>12:30 2019/12/29</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="confirm-button">
                    <div class="button-left">
                        <button type="button" class="btn btn-block text-white btn-update btn-update-left">Cancel</button>
                    </div>
                    <div class="button-right">
                        <button type="submit" class="btn btn-block text-white btn-update">Update</button>
                    </div>
                </div>
                @else
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
                @endif
            </div>
        </div>
    </form>
</div>
