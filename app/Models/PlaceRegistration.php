<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class PlaceRegistration extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'place_id', 'user_id', 'is_session_active', 'check_in_date', 'check_out_date'
    ];

    public static function getModel($params, $raw = false)
    {
        $modelQuery = static::query();

        if ( ($filter_place = Arr::get($params, 'place_id', false)) ) {
            $modelQuery->where('place_id', $filter_place);
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
            $this->check_in_date = \Carbon\Carbon::now();

            $place_model = \App\Models\Places::getByPlaceCode($data['place_id']);

            if (!is_null($place_model)) {
                $this->place_id = $place_model->id;
            }

            return $this->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function setModelCheckout()
    {
        return $this->update([
            'is_session_active' => 0,
            'check_out_date' => \Carbon\Carbon::now()
        ]);
    }

    public function place()
    {
        return $this->belongsTo(Places::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
