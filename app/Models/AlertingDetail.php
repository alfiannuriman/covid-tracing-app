<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AlertingDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'case_number', 'is_have_symptoms', 'symptoms_appear_date',
        'description', 'is_active'
    ];

    public static function getModel($params, $raw = false)
    {
        $modelQuery = static::query();

        if (!$raw) {
            $item_per_page = Arr::get($params, 'limit', 10);
            $modelQuery = $modelQuery->paginate($item_per_page)->withQueryString();
        }

        return $modelQuery;
    }

    public function saveModel(array $data, $is_update = false)
    {
        try {

            $this->alerting_id = $data['alerting_id'];
            $this->place_registration_subject_id = $data['place_registration_subject_id'];
            $this->place_registration_object_id = $data['place_registration_object_id'];
            
            return $this->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
