<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DiscQuestion extends Model
{
    public function options()
    {
        return $this->hasMany(DiscOption::class);
    }
}
