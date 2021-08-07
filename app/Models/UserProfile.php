<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    protected $table = 'user_profile';
    protected $guarded = ['id'];

    public static function getModel($params, $raw = false)
    {
        $modelQuery = static::query();

        if ( ($filter_phone = Arr::get($params, 'phone', false)) ) {
            $modelQuery->where('name', 'LIKE', '%' . $filter_phone . '%');
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
            $this->gender_id = $data['gender_id'];
            $this->birth_date = $data['birth_date'];
            $this->address = $data['address'];
            $this->phone = $data['phone'];
            $this->about = $data['about'];

            return $this->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public static function getUserProfile()
    {
        return static::where('user_id', auth()->user()->id)->first();
    }

    public function getAgeAttribute()
    {
        return !is_null($this->birth_date) ? \Carbon\Carbon::parse($this->birth_date)->diff(\Carbon\Carbon::now())->format('%y') : '';
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
}
