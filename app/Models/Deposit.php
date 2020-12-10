<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    const PERCENT = 20;
    const DURATION = 10;

    protected $primaryKey = 'deposit_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'wallet_id',
        'invested',
        'percent',
        'active',
        'duration',
        'accrue_times'
    ];
}
