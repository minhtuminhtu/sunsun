<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Lock extends Model
{
    protected $fillable;

    // Table Name
    protected $table = 'tr_lock';

    protected $primaryKey = 'tr_lock_id';
    // Timestamps
    public $timestamps = false;
    public function __construct(array $attributes = [])
    {
        $this->fillable = [
            'tr_yoyaku',
            'tr_yoyaku_danjiki_jikan'
        ];
        parent::__construct($attributes);
    }

}
