<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\OrdersRepository;
use App\Models\Order;
use App\Validators\OrdersValidator;

/**
 * Class OrdersRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class OrdersRepositoryEloquent extends BaseRepository implements OrdersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function genOrderNo()
    {
        return date('YmdHis' . rand(10000,99999));
    }

}
