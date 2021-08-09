<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use App\Models\AlertingDetail;
use Illuminate\Support\Facades\DB;

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

            DB::beginTransaction();

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

            if ($this->save()) {
                $this->createAlertingDetail();
                DB::commit();
            }

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function generateCaseNumber()
    {
        $prefix = '119';
        $model_count = $this->withTrashed()->count();

        return $prefix . sprintf('%06d', ($model_count++));
    }
    
    /**
     * Get related place registration data when user do an alerting
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findRelatedPlaceRegistration()
    {
        try {
            $suspect_start_date = \Carbon\Carbon::parse($this->symptoms_appear_date)->subDays(self::TRACING_DAYS_BEFORE_SYMPTOMS);
            $suspect_end_date = \Carbon\Carbon::parse($this->symptoms_appear_date)->addDays(self::TRACING_DAYS_AFTER_SYMPTOMS);

            return \App\Models\PlaceRegistration::where('user_id', $this->user_id)
                ->whereBetween('created_at', [$suspect_start_date, $suspect_end_date]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function createAlertingDetail()
    {
        try {
            $subjects = $this->findRelatedPlaceRegistration();

            foreach ($subjects->get() as $subject) {

                $alerting_id = $this->id;
                $subject_id = $subject->id;

                $subject->getRelated()->each(function ($item, $key) use ($alerting_id, $subject_id) {
                    $is_updated = true;

                    $alerting_detail_data = [
                        'alerting_id' => $alerting_id,
                        'place_registration_subject_id' => $subject_id,
                        'place_registration_object_id' => $item->id
                    ];

                    $alerting_detail = AlertingDetail::where($alerting_detail_data)->first();

                    if (is_null($alerting_detail)) {
                        $alerting_detail = new AlertingDetail;
                        $is_updated = false;
                    }

                    $alerting_detail->saveModel($alerting_detail_data, $is_updated);
                });
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function setModelResolved()
    {
        return $this->update([
            'is_active' => 0,
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
