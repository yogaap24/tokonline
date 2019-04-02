<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\ProductsResource;
use Response;
use App\Models\Product;
use App\Models\ImagesProduct;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function products(Request $request)
    {
        $singeleImage = DB::raw( "(select coalesce(image,null) from image_product 
        where products.id = image_product.product_id order by image_product.id
        desc limit 1 ) as image " );

        $query = Product::select('*',$singeleImage);

        if( $request->search != null ){
            $query->where('product','like','%'.$request->search.'%');
        }

        $query->orderBy('product');

        $products = $query->paginate(15);

        if( $products->isEmpty() ){
            return Response::json([
                'status' => [
                    'code' => 404,
                    'description' => 'Data Not Found!',
                ]
                ],404);
        }else{
            // return $products;
            return ProductsResource::collection($products)
                ->additional([
                    'status' => [
                        'code' => 200,
                        'description' => 'OK',
                    ]
                ])
                ->response()
                ->setStatusCode(200);
        }
    }

    public function product($id)
    {
        $product = Product::with('imageRelation')->select('*')->where('id',$id)->first();

        if ( $product == null ){
            return Response::json([
                'status' => [
                    'code' => 404,
                    'description' => 'Data Not Found!',
                ]
            ],404);
        }else{
            return (new ProductsResource($product))
                ->additional([
                    'status' => [
                        'code' => 200,
                        'description' => 'OK'
                    ]
                ])
                ->response()
                ->setStatusCode(200);
        }
    }
}
