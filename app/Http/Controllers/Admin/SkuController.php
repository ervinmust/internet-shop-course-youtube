<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $skus = $product->skus()->paginate(10);
        return view('auth.skus.index', compact('skus', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Product  $product
     * @return void
     */
    public function create(Product $product)
    {
        return view('auth.skus.form', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return void
     */
    public function store(Request $request, Product $product)
    {
        $params = $request->all();
        $params['product_id'] = $product->id;
        $sku = Sku::create($params);
        $sku->propertyOptions()->sync($request->property_option_id);
        return redirect()->route('skus.edit', [$product, $sku]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function show(Sku $sku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product, $skuId)
    {
        $sku = Sku::findOrFail($skuId);
        return view('auth.skus.form', compact('product', 'sku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @param  \App\Models\Sku  $sku
     * @return void
     */
    public function update(Request $request, Product $product, $skuId)
    {
        $sku = Sku::findOrFail($skuId);
        $sku->update($request->all());
        $sku->propertyOptions()->sync($request->property_option_id);
        return redirect()->route('skus.index', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function destroy($skuId)
    {
        $sku = Sku::findOrFail($skuId);
        $sku->delete();
        return redirect()->route('skus.index', $product);
    }
}
