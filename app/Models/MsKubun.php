<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MsKubun extends Model
{
    protected $attributes;

    protected $fillable;

    // Table Name
    protected $table = 'ms_kubun';

    // Timestamps
    public $timestamps = false;
    public function __construct(array $attributes = [])
    {
        $this->attributes = [];

        $this->fillable = [
            config('const.db.ms_kubun.KUBUN_VALUE'),
            config('const.db.ms_kubun.SORT_NO'),
            config('const.db.ms_kubun.NOTES'),
        ];
        parent::__construct($attributes);
    }
}
