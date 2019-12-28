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
            'NAME' => 'name',
            'PHONE' => 'phone',
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
            'STAY_CHECKOUT_DATE' => 'stay_checkout_date',
            'PAYMENT_METHOD' => 'payment_method'
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
            '010' => 'ペット預かり',
            '011' => '宿泊(部屋ﾀｲﾌﾟ',
            '012' => '宿泊人数',
            '013' => 'Time Slide',
            '014' => 'Time Slide for whole room',
            '015' => '人数',
            '016' => 'ペット数',
            '017' => 'bed_male',
            '018' => 'bed_female',
            '019' => 'bed_pet',
            '020' => 'Time Slide Pet',
            '021' => 'Time Slide Whitening',
            '022' => 'Breakfast',
            '023' => 'Number lunch book',

            '024' => 'Price 酵素浴',
            '025' => 'Price 1 day refresh',
            '026' => 'Price 貸切',
            '027' => 'Price 断食コース',
            '028' => 'Price Pet',
            '029' => 'Price options',
        ],

        'kubun_type_value' => [
            'repeat_user' => '001',
            'transport' => '002',
            'pick_up' => '003',
            'course' => '005',
            'gender' => '006',
            'TIME' => '013',
            'TIME_BOOK_ROOM' => '014',
            'bed_male' => '017',
            'bed_female' => '018',
            'bed_pet' => '019',
            'TIME_PET' => '020',
            'TIME_WHITENING' => '021'

        ],

        'kubun_id_value' => [
            'repeat_user' => [
                'NEW' => '01',
                'OLD' => '02'
            ],
            'transport' => [
                'PRIVATE_VEHICLE' => '01',
                'BUS' => '02',
            ],
            'pick_up' => [
                'OFF' => '01',
                'ON' => '02'
            ],
            'course' => [
                'NORMAL' => '01',
                '1_DAY_REFRESH' => '02',
                'BOTH_ALL_ROOM'=> '03',
                'FASTING_PLAN' => '04',
                'PET' => '05'
            ],
            'gender' => [
                'MALE' => '01',
                'FEMALE' => '02'
            ],
        ],
        'time_validate' => [
            'transport' => [
                'bus' => [
                    'NEW' => 45,
                    'OLD' => 30
                ],
            ],
            'whitening' => [
                'bus' => [
                    'NEW' => 30,
                    'OLD' => 15
                ],
            ]
        ],

        'tr_yoyaku_danjiki_jikan' => [
            'BOOKING_ID' => 'booking_id',
            'SERVICE_DATE' => 'service_date',
            'SERVICE_TIME_1' => 'service_time_1',
            'SERVICE_TIME_2' => 'service_time_2',
            'NOTES' => 'notes'

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
            '0' => '',
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
    ],
    'time_admin' => [
        '0' =>  [
            'time' => '',
            'time_value' => '0930',
            'time_range' => '9:30～',
            'pet_time_type' => 1,
            'pet_time' => '9:30～10:30',
            'pet_time_value' => '0930-1030',
            'wt_time_value' => NULL,
            'begin_time' => '朝',
            'not_wt' => 1,
            'begin_new_user' => 1
        ],
        '1' =>  [
            'time' => '9:45',
            'time_value' => '0945',
            'time_range' => '10:00～',
            'pet_time_type' => 2,
            'pet_time' => '9:30～10:30',
            'pet_time_value' => '0930-1030',
            'wt_time_value' => '1000-1030',
            'wt_new_user' => 1
        ],
        '2' =>  [
            'time' => '10:15',
            'time_value' => '1015',
            'time_range' => '10:30～',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => '1030-1100',
            'pet_begin' => 1,
            'begin_new_user' => 1
        ],
        '3' =>  [
            'time' => '10:45',
            'time_value' => '1045',
            'time_range' => '11:00～',
            'pet_time_type' => 1,
            'pet_time' => '11:00～12:00',
            'pet_time_value' => '1100-1200',
            'wt_time_value' => '1100-1130',
            'begin_free' => '1',
            'wt_new_user' => 1,
            'week_bottom' => 1
        ],
        '4' =>  [
            'time' => '',
            'time_value' => '1200',
            'time_range' => '12:00～',
            'pet_time_type' => 2,
            'pet_time' => '11:00～12:00',
            'pet_time_value' => '1100-1200',
            'wt_time_value' => '1200-1230',
            'first_free' => '1',
            'end_new_user' => 1,
            'body_free' => 1
        ],
        '5' =>  [
            'time' => '',
            'time_value' => '1230',
            'time_range' => '12:30～',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => '1230-1300',
            'begin_time' => '昼',
            'body_free' => 1
        ],
        '6' =>  [
            'time' => '',
            'time_value' => '1300',
            'time_range' => '13:00～',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => '1300-1330',
            'week_bottom' => 2
        ],
        '7' =>  [
            'time' => '13:15',
            'time_value' => '1315',
            'time_range' => '13:30～',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => '1330-1400',
            'pet_begin' => 1,
            'begin_new_user' => 1,
        ],
        '8' =>  [
            'time' => '13:45',
            'time_value' => '1345',
            'time_range' => '14:00～',
            'pet_time_type' => 1,
            'pet_time' => '14:00～15:00',
            'pet_time_value' => '1400-1500',
            'wt_time_value' => '1400-1430',
            'wt_new_user' => 1
        ],
        '9' =>  [
            'time' => '14:15',
            'time_value' => '1415',
            'time_range' => '14:30～',
            'pet_time_type' => 2,
            'pet_time' => '14:00～15:00',
            'pet_time_value' => '1400-1500',
            'wt_time_value' => NULL,
            'begin_free' => '1',
            'not_wt' => 1,
            'week_bottom' => 2
        ],
        '10' =>  [
            'time' => '',
            'time_value' => '1500',
            'time_range' => '15:00～',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => '1500-1530',
            'pet_begin' => 1,
            'begin_time' => 'メンテナンス',
            'first_free' => '1',
            'begin_new_user' => 1
        ],
        '11' =>  [
            'time' => '15:15',
            'time_value' => '1515',
            'time_range' => '15:30～',
            'pet_time_type' => 1,
            'pet_time' => '15:30～16:30',
            'pet_time_value' => '1530-1630',
            'wt_time_value' => '1530-1600',
            'wt_new_user' => 1
        ],
        '12' =>  [
            'time' => '15:45',
            'time_value' => '1545',
            'time_range' => '16:00～',
            'pet_time_type' => 2,
            'pet_time' => '15:30～16:30',
            'pet_time_value' => '1530-1630',
            'wt_time_value' => NULL,
            'not_wt' => 1,
        ],
        '13' =>  [
            'time' => '16:15',
            'time_value' => '1615',
            'time_range' => '16:30～',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => '1630-1700',
            'begin_free' => '1',
            'week_bottom' => 2
        ],
        '14' =>  [
            'time' => '',
            'time_value' => '',
            'time_range' => '',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => NULL,
            'begin_time' => '夜',
            'first_free' => '1',
            'not_wt' => 1,
        ],
        '15' =>  [
            'time' => '17:45',
            'time_value' => '1745',
            'time_range' => '18:00～',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => NULL,
            'not_wt' => 1,
        ],
        '16' =>  [
            'time' => '18:15',
            'time_value' => '1815',
            'time_range' => '18:30～',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => NULL,
            'not_wt' => 1,
        ],
        '17' =>  [
            'time' => '18:45',
            'time_value' => '1845',
            'time_range' => '19:00～',
            'pet_time_type' => NULL,
            'pet_time' => NULL,
            'pet_time_value' => NULL,
            'wt_time_value' => NULL,
            'not_wt' => 1,
        ],
    ]


];
