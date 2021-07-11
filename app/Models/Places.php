<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Places extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'address', 'place_code'
    ];

    public static function getModel($params, $raw = false)
    {
        $modelQuery = static::query();

        if ( ($filter_name = Arr::get($params, 'name', false)) ) {
            $modelQuery->where('name', 'LIKE', '%' . $filter_name . '%');
        }

        if ( ($filter_place_code = Arr::get($params, 'place_code', false)) ) {
            $modelQuery->where('place_code', 'LIKE', '%' . $filter_place_code . '%');
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
            $this->name = $data['name'];
            $this->address = $data['address'];

            if (!$is_update) {
                $this->place_code = $this->generatePlaceCode();
            }

            return $this->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function generatePlaceCode()
    {
        $prefix = '119';
        $model_count = $this->withTrashed()->count();

        return $prefix . sprintf('%05d', ($model_count++));
    }
}
