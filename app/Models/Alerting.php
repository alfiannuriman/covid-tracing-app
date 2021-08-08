<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Alerting extends Model
{
    use SoftDeletes;

    const TRACING_DAYS_BEFORE_SYMPTOMS = 2;
    const TRACING_DAYS_AFTER_SYMPTOMS = 14;

    protected $fillable = [
        'user_id', 'case_number', 'is_have_symptoms', 'symptoms_appear_date',
        'description', 'is_active'
    ];

    public static function getModel($params, $raw = false)
    {
        $modelQuery = static::query();

        if ( ($filter_case_number = Arr::get($params, 'case_number', false)) ) {
            $modelQuery->where('case_number', 'LIKE', '%' . $filter_case_number . '%');
        }

        if ( ($filter_user = Arr::get($params, 'user_id', false)) ) {
            $modelQuery->where('user_id', $filter_user);
        }

        if (!$raw) {
            $item_per_page = Arr::get($params, 'limit', 10);
            $modelQuery = $modelQuery->paginate($item_per_page)->withQueryString();
        }

        return $modelQuery;
    }

    public function saveModel(array $data, $is_update = false)
    {
        try {

            $this->user_id = isset($data['user_id']) ? $data['user_id'] : auth()->user()->id;
            $this->is_have_symptoms = $data['is_have_symptoms'];
            $this->symptoms_appear_date = date('Y-m-d', strtotime($data['symptoms_appear_date']));
            $this->description = $data['description'];

            if (!$is_update) {
                $this->case_number = $this->generateCaseNumber();
            }

            if (isset($data['is_active'])) {
                $this->is_active = $data['is_active'];
            }

            return $this->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function generateCaseNumber()
    {
        $prefix = '119';
        $model_count = $this->withTrashed()->count();

        return $prefix . sprintf('%05d', ($model_count++));
    }

    public function findRelatedPlaceRegistration()
    {
        $suspect_start_date = \Carbon\Carbon::parse($this->symptoms_appear_date)->subDays(self::TRACING_DAYS_BEFORE_SYMPTOMS);
        $suspect_end_date = \Carbon\Carbon::parse($this->symptoms_appear_date)->addDays(self::TRACING_DAYS_AFTER_SYMPTOMS);

        $related_subjects = \App\Models\PlaceRegistration::where('user_id', $this->user_id)
            ->whereBetween('created_at', [$suspect_start_date, $suspect_end_date]);
    }
}
