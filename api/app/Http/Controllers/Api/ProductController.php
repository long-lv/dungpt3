<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductValidatedRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->paginate(15);
        return ProductResource::collection($products);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidatedRequest $request)
    {
        $request->validated();
        $newProduct = new Product();
        $newProduct->name=$request->get('name');
        $newProduct->price=$request->get('price');
        $newProduct->minPrice=$request->get('min_price');
        $newProduct->maxPrice=$request->get('max_price');
        $newProduct->discount=$request->get('discount');
        $newProduct->status=$request->get('status');
        $newProduct->desc=$request->get('desc');
        $newProduct->cate_id=$request->get('cate_id');
        if($request->file('img')){
            $generatedImg = 'image'.time().'.'.$request->file('img')->extension();
            $request->file('img')->move(public_path('img'),$generatedImg);
            $newProduct->img= $generatedImg;
        }
        $newProduct->save();
        return response()->json($newProduct,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'No products were found corresponding to the provided ID.',
            ], 404);
        }
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductValidatedRequest $request, $id)
    {
        $updateProduct = Product::find($id);
        $request->validated();
        if ($updateProduct){
            $updateProduct->name=$request->get('name');
            $updateProduct->price=$request->get('price');
            $updateProduct->minPrice=$request->get('min_price');
            $updateProduct->maxPrice=$request->get('max_price');
            $updateProduct->discount=$request->get('discount');
            $updateProduct->status=$request->get('status');
            $updateProduct->desc=$request->get('desc');
            $updateProduct->cate_id=$request->get('cate_id');
            if($request->file('thumbnail')){
                $generatedImg = 'image'.time().'.'.$request->file('thumbnail')->extension();
                $request->file('thumbnail')->move(public_path('img'),$generatedImg);
                $updateProduct->thumbnail= $generatedImg;
            }
            $updateProduct->save();
        }
        return response()->json($updateProduct,200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        {
            $product = Product::find($id);
            if ($product) {
                $product->delete();
                return response()->json('delete success',200);
            }else{
                return response()->json([
                    'message' => 'No products were found corresponding to the provided ID.',
                ], 404);
            }
        }
    }
}
