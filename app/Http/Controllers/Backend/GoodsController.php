<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\GoodsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    protected $goodsRepo;

    /**
     * GoodsController constructor.
     * @param GoodsRepository $goodsRepository
     */
    public function __construct(GoodsRepository $goodsRepository)
    {
        $this->goodsRepo = $goodsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goodsList = $this->goodsRepo->paginate(15);

        return view('backend.goods.index', compact('goodsList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.goods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->goodsRepo->create($request->all())) {
            return redirect()->route('admin.goods.index');
        }

        return redirect()->back()->withInput()->withErrors('保存失败！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goods = $this->goodsRepo->find($id);

        return view('backend.goods.edit', compact('goods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->goodsRepo->update($request->all(), $id)) {
            return redirect()->route('admin.goods.index');
        }
        return Redirect::back()->withInput()->withErrors('保存失败！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
