<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\OrdersRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    protected $orderRepo;
    protected $uploadManager;

    public function __construct(OrdersRepository $orders)
    {
        $this->orderRepo = $orders;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepo->paginate(10);

        return view('backend.order.index', compact('orders'));
    }
}
