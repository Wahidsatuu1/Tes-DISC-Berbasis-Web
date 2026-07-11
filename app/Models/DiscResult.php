<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DiscResult extends Model
{
    protected $guarded = [];

    public function biodata()
    {
        return $this->belongsTo(InternBiodata::class, 'intern_biodata_id');
    }

    public function getDominantProfile()
    {
        $scores = [
            'D' => $this->score_d_change,
            'I' => $this->score_i_change,
            'S' => $this->score_s_change,
            'C' => $this->score_c_change,
        ];
        arsort($scores);
        return key($scores);
    }

    public function getPersonalityDetails($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $dominant = $this->getDominantProfile();

        $details = [
            'D' => [
                'name_key' => 'messages.dominance_name',
                'desc_key' => 'messages.dominance_desc',
                'badge' => 'bg-danger',
                'color' => '#dc3545'
            ],
            'I' => [
                'name_key' => 'messages.influence_name',
                'desc_key' => 'messages.influence_desc',
                'badge' => 'bg-warning text-dark',
                'color' => '#ffc107'
            ],
            'S' => [
                'name_key' => 'messages.steadiness_name',
                'desc_key' => 'messages.steadiness_desc',
                'badge' => 'bg-success',
                'color' => '#198754'
            ],
            'C' => [
                'name_key' => 'messages.compliance_name',
                'desc_key' => 'messages.compliance_desc',
                'badge' => 'bg-info text-dark',
                'color' => '#0dcaf0'
            ]
        ];

        $info = $details[$dominant];
        return [
            'code' => $dominant,
            'name' => __($info['name_key'], [], $locale),
            'description' => __($info['desc_key'], [], $locale),
            'badge' => $info['badge'],
            'color' => $info['color']
        ];
    }
}
