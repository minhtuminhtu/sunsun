<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Yoyaku extends Model
{
    protected $fillable;

    // Table Name
    protected $table = 'tr_yoyaku';

    // Timestamps
    public $timestamps = true;
    public function __construct(array $attributes = [])
    {
        $this->fillable = [
            config('const.db.tr_yoyaku.BOOKING_ID'),
            config('const.db.tr_yoyaku.REF_BOOKING_ID'),
            config('const.db.tr_yoyaku.EMAIL'),
            config('const.db.tr_yoyaku.REPEAT_USER'),
            config('const.db.tr_yoyaku.TRANSPORT'),
            config('const.db.tr_yoyaku.BUS_ARRIVE_TIME_SLIDE'),
            config('const.db.tr_yoyaku.REPEAT_USER'),
            config('const.db.tr_yoyaku.TRANSPORT'),
            config('const.db.tr_yoyaku.BUS_ARRIVE_TIME_SLIDE'),
            config('const.db.tr_yoyaku.BUS_TIME_VALUE'),
            config('const.db.tr_yoyaku.PICK_UP'),
            config('const.db.tr_yoyaku.COURSE'),
            config('const.db.tr_yoyaku.GENDER'),
            config('const.db.tr_yoyaku.AGE_TYPE'),
            config('const.db.tr_yoyaku.AGE_VALUE'),
            config('const.db.tr_yoyaku.SERVICE_DATE_START'),
            config('const.db.tr_yoyaku.SERVICE_DATE_END'),
            config('const.db.tr_yoyaku.SERVICE_TIME_1'),
            config('const.db.tr_yoyaku.SERVICE_TIME_2'),
            config('const.db.tr_yoyaku.SERVICE_GUEST_NUM'),
            config('const.db.tr_yoyaku.SERVICE_PET_NUM'),
            config('const.db.tr_yoyaku.LUNCH'),
            config('const.db.tr_yoyaku.LUNCH_GUEST_NUM'),
            config('const.db.tr_yoyaku.WHITENING'),
            config('const.db.tr_yoyaku.PET_KEEPING'),
            config('const.db.tr_yoyaku.STAY_ROOM_TYPE'),
            config('const.db.tr_yoyaku.STAY_GUEST_NUM'),
            config('const.db.tr_yoyaku.STAY_CHECKIN_DATE'),
            config('const.db.tr_yoyaku.STAY_CHECKOUT_DATE')
        ];
        parent::__construct($attributes);
    }
}
