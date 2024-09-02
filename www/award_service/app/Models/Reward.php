<?php

namespace App\Models;

use Database\Factories\RewardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;


    protected $fillable = [
        'reward_description',
        'reward_amount'
    ];

    protected static function newFactory()
    {
        return new RewardFactory();
    }
}
