<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PlanRepository;
use App\Models\Plan;
use App\Validators\planValidator;

/**
 * Class planRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class planRepositoryEloquent extends BaseRepository implements PlanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return plan::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function update(array $attributes, $id)
    {
        $attributes['user_id'] = Auth::id();

        return parent::update($attributes, $id);
    }
}
