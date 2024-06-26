<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $array)
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'localisation'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
