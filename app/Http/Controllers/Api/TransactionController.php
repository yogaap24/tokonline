<?php

namespace App\Http\Controllers\Api;

use DB;
use Response;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;


class TransactionController extends Controller
{

    public function store(Request $request)
    {
            DB::beginTransaction();

            try {
                //insert-transaksi
                $code = Transaction::GetCode();

                $tr = new Transaction;
                $tr->transaction_code = $code;
                $tr->user_id = $request->user_id;
                $tr->destination = $request->destination;
                $tr->ongkir = $request->ongkir;
                $tr->grandtotal = $request->grandtotal;
                $tr->save();


                foreach ($request->detail as $value)
                {
                    $product = Product::where('id',$value['product_id'])->first();

                    if( $product->stock <= $value['qty']) {
                        DB::rollback();

                        //response-error
                        return Response::json([
                            'status' => [
                                'code' => 400,
                                'description' => "product $product->product melebihi stock!",               
                            ]
                        ],400);
                    }

                    //insert-detail
                    DetailTransaction::create([
                        'transaction_id' => $tr->id,
                        'product_id' => $product->id,
                        'product' => $product->id,
                        'qty'   => $value['qty'],
                        'price'   => $value['price'],
                        'total'   => $value['total'],
                    ]);


                    //update-stock
                    $product->decrement('stock',$value['qty']);
                }

                DB::commit();

                return Response::json([
                    'status' => [
                        'code' => 201,
                        'description' => 'Transaction Created',               
                    ]
                ],201);
            } catch (\Exception $e) {
                DB::rollback();
                dd($e);
                return Response::json([
                    'status' => [
                        'code' => 500,
                        'description' => 'Internal server error!',               
                    ]
                ],500);
            }
    }

    public function userTransaction($userId, $status = null)
    {
        // return Response::json($userId);

        $query = Transaction::with('userRelation')
            ->orderBy('id','desc')
            ->where('user_id',$userId);
            if( $status != null ){
                $query->where('status_payment',$status);
            }

        $tra = $query->paginate(10);
  
        if( $tra->isEmpty()){

            return Response::json([
                'status' => [
                    "code" => 404,
                    "description" => 'Data Not Found!'
                ]
            ], 404);

        }else{

            return TransactionResource::collection($tra)
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

    public function byCode($code)
    {
        $tra = Transaction::with('userRelation','detailRelation')
            ->where('transaction_code', $code)
            ->first();

        if( empty($tra)){
            return Response::json([
                "status" => [
                    'code' => 404,
                    'description' => "Data Not Found!"
                ]
            ],404);
        }else{
            return (new TransactionResource($tra))
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

    public function upload(Request $request, $code)
    {
        $tra = Transaction::where('transaction_code',$code)->first();

        if(empty($tra)) {
            return Response::json([
                'status' => [
                    'code' => 404,
                    'description' => 'Data Not Found',
                ]
            ],404);
        }

        if($request->hasFile('foto'))
    {
        $path = $request->foto->store('bukti');

        $tra->update([
            'prof_of_payment' => $path,
        ]);

        return Response::json([
            'status' => [
                'code' => 202,
                'description' => 'Updated Accepted',
            ]
        ],202);
    }else{
        return Response::json([
            'status' => [
                'code' => 404,
                'description' => 'Data Not Found',
            ]
        ],404);
    }
 }

}

