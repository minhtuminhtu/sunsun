<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MsKubun extends Model
{
    protected $fillable;

    // Table Name
    protected $table = 'ms_kubun';

    protected $primaryKey = 'tr_yoyaku_id';
    // Timestamps
    public $timestamps = false;
    public function __construct(array $attributes = [])
    {
        $this->fillable = [
            config('const.db.ms_kubun.KUBUN_TYPE'),
            config('const.db.ms_kubun.KUBUN_ID'),
            config('const.db.ms_kubun.KUBUN_VALUE'),
            config('const.db.ms_kubun.SORT_NO'),
            config('const.db.ms_kubun.NOTES'),
            config('const.db.ms_kubun.TIME_HOLIDAY'),
        ];
        parent::__construct($attributes);
    }

}
