<?php
return [
    'db' => [
        'ms_user' => [
            'MS_USER_ID' => 'ms_user_id',
            'USERNAME' => 'username',
            'TEL' => 'tel',
            'EMAIL' => 'email',
            'GENDER' => 'gender',
            'BIRTH_YEAR' => 'birth_year',
            'PASSWORD' => 'password',
            'USER_TYPE' => 'user_type',
            'CREATED_AT'    => 'created_at',
            'UPDATED_AT'    => 'updated_at',
        ],
        'ms_kubun' => [
            'KUBUN_TYPE' => 'kubun_type',
            'KUBUN_ID' => 'kubun_id',
            'KUBUN_VALUE' => 'kubun_value',
            'SORT_NO' => 'sort_no',
            'NOTES' => 'notes'
        ],
        'tr_yoyaku' => [
            'BOOKING_ID' => 'booking_id',
            'REF_BOOKING_ID' => 'ref_booking_id',
            'EMAIL' => 'email',
            'REPEAT_USER' => 'repeat_user',
            'TRANSPORT' => 'transport',
            'BUS_ARRIVE_TIME_SLIDE' => 'bus_arrive_time_slide',
            'BUS_TIME_VALUE' => 'bus_arrive_time_value',
            'PICK_UP' => 'pick_up',
            'COURSE' => 'course',
            'GENDER' => 'gender',
            'AGE_TYPE' => 'age_type',
            'AGE_VALUE' => 'age_value',
            'SERVICE_DATE_START' => 'service_date_start',
            'SERVICE_DATE_END' => 'service_date_end',
            'SERVICE_TIME_1' => 'service_time_1',
            'SERVICE_TIME_2' => 'service_time_2',
            'SERVICE_GUEST_NUM' => 'service_guest_num',
            'SERVICE_PET_NUM' => 'service_pet_num',
            'LUNCH' => 'lunch',
            'LUNCH_GUEST_NUM' => 'lunch_guest_num',
            'WHITENING' => 'whitening',
            'PET_KEEPING' => 'pet_keeping',
            'STAY_ROOM_TYPE' => 'stay_room_type',
            'STAY_GUEST_NUM' => 'stay_guest_num',
            'STAY_CHECKIN_DATE' => 'stay_checkin_date',
            'STAY_CHECKOUT_DATE' => 'stay_checkout_date'
        ],
        'kubun_type' => [
            '001' => 'ご利用',
            '002' => '交通手段',
            '003' => '洲本IC着',
            '004' => '送迎',
            '005' => 'コース',
            '006' => '性別',
            '007' => '年齢',
            '008' => 'ランチ',
            '009' => 'ﾎﾜｲﾄﾆﾝｸﾞ',
            '010' => 'ﾍﾟｯﾄ預かり',
            '011' => '宿泊(部屋ﾀｲﾌﾟ',
            '012' => '宿泊人数',
            '013' => 'Time Slide',
            '014' => 'Time Slide for whole room',
            '015' => '人数',
            '016' => 'ペット数',
            '017' => 'bed_male',
            '018' => 'bed_female',
            '019' => 'bed_pet'
        ],
        
    ],

    'auth' => [
        'permission' => [
            'USER' => 'user',
            'ADMIN' => 'admin',
            'SUPER_ADMIN' => 'super_admin'
        ]
        ],
    'laber' => [
        'bed' => [
            '0' => '⓪ ⑪ ⑫ ⑬ ⑭ ⑮ ⑯ ⑰ ⑱ ⑲ ⑳',
            '1' => '①',
            '2' => '②',
            '3' => '③',
            '4' => '④',
            '5' => '⑤',
            '6' => '⑥',
            '7' => '⑦',
            '8' => '⑧',
            '9' => '⑨',
            '10' => '⑩',
        ]
    ]
];
