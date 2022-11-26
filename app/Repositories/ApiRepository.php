<?php

namespace App\Repositories;

use App\Traits\ApiResponser;
use App\Interfaces\ApiInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiRepository implements ApiInterface
{
    use ApiResponser;

    public function all(Collection $collection, $code = 200)
    {
        $collection = $this->filterData($collection);
        $collection = $this->sortData($collection);
        $collection = $this->paginate($collection);
        $collection = $this->cacheResponse($collection);

        return $this->successResponse(['data' => $collection], $code);
    }
    
    public function find(Model $model, $code = 200)
    {
        return $this->successResponse(['data' => $model], $code);
    }

	protected function filterData(Collection $collection)
	{
		foreach (request()->query() as $attribute => $value) {
			if (isset($attribute, $value)) {
				$collection = $collection->where($attribute, $value);
			}
		}
		return $collection;
	}

	protected function sortData(Collection $collection)
	{
		if (request()->has('sort_by')) {
			$attribute = request('sort_by');
			$collection = $collection->sortBy->{$attribute};
		}
		return $collection;
	}

	protected function paginate(Collection $collection)
	{
		$rules = [
			'per_page' => 'integer|min:2|max:50',
		];
		Validator::validate(request()->only('per_page'), $rules);
        $page = LengthAwarePaginator::resolveCurrentPage();
		$perPage = (int) (request('per_page') ?? 15);
		$results = $collection->slice(($page - 1) * $perPage, $perPage)->values();
		$paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
			'path' => LengthAwarePaginator::resolveCurrentPath(),
		]);
		$paginated->appends(request()->only('per_page'));
		return $paginated;
	}

	protected function cacheResponse($collection)
	{
		$url = request()->url();
		$queryParams = request()->query();
		ksort($queryParams);
		$queryString = http_build_query($queryParams);
		$fullUrl = "{$url}?{$queryString}";

		return Cache::remember($fullUrl, 60, function() use($collection) {
			return $collection;
		});	
	}

}
