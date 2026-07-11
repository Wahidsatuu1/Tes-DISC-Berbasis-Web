<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InternBiodata extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function discResult()
    {
        return $this->hasOne(DiscResult::class, 'intern_biodata_id');
    }
}
