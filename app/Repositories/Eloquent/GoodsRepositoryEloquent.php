<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\GoodsRepository;
use App\Models\Goods;
use App\Validators\GoodsValidator;

/**
 * Class GoodsRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class GoodsRepositoryEloquent extends BaseRepository implements GoodsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Goods::class;
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
