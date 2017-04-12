<?php

namespace App\Http\Controllers;

use App\Models\CostPrice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CostPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return CostPrice::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return CostPrice
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => [
                'required',
                Rule::in(['gas', 'electricity'])
            ],
            'price' => [
                'required',
                'numeric'
            ]
        ]);

        $costPrice = CostPrice::create($request->only(['type', 'price']));

        return $costPrice;
    }

    /**
     * Display the specified resource.
     *
     * @param $type
     * @return \Illuminate\Http\Response
     */
    public function last($type)
    {
        return CostPrice::where('type', $type)
            ->orderBy('created_at', 'DESC')
            ->first();
    }
}
