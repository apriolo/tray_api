<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Support\Facades\Validator;


class SaleController extends Controller
{

    private $sale;

    private $storeRules = [
        'value' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0|not_in:0',
        'seller_id' => 'required|regex:/^\d+(\.\d{1,2})?$/'
    ];

    public function __construct(Sale $sale)
    {   
        $this->sale = $sale;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // If validation error return
        $validator = Validator::make($data, $this->storeRules);
        if ($validator->fails()) {
            $fails = $validator->errors()->all();
            return response()->json([
                'status'  => 'Bad Request',
                'message' => 'Invalid parameters',
                'fails'   => $fails
            ], 400);
        }


        // If haven't a seller with id passed return
        if (!$seller = Seller::find($data['seller_id']))
        {
            return response()->json([
                'status'  => 'Not Found',
                'message' => 'Seller not found',
            ], 404);
        }

        // The controller need to calculate comission
        $data['comission'] = $data['value'] * (8.5 / 100);

        // Createa function on model to insert sale
        try {
            $sale = $this->sale->create(
                $data
            );
            if ($sale)
            {
                return response()->json([
                    'status'  => 'Created',
                    'data' => [
                        'id'        => $sale->id,
                        'name'      => $seller->name,
                        'email'     => $seller->email,
                        'comission' => $sale->comission,
                        'value'     => $sale->value,
                        'data'      => $sale->created_at->format('Y-m-d H:i:s')
                    ],
                ], 201);
            } else {
                return response()->json([
                    'status'  => 'Not Acceptable',
                    'message' => 'Data not available',
                    'data' => $data
                ], 406);
            }
        } catch(\Exception $e) {
            return response()->json([
                'status'  => 'Bad Request',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function salesBySeller($id)
    {

        $rules = [
            'id' => 'required|int|regex:/^\d+(\.\d{1,2})?$/'
        ];

        // If validation error return
        $validator = Validator::make(['id' => $id], $rules);
        if ($validator->fails()) {
            $fails = $validator->errors()->all();
            return response()->json([
                'status'  => 'Bad Request',
                'message' => 'Invalid parameters',
                'fails'   => $fails
            ], 400);
        }

        // If haven't a seller with id passed return
        if (!$seller = Seller::find($id))
        {
            return response()->json([
                'status'  => 'Not Found',
                'message' => 'Seller not found',
            ], 404);
        }

        // Get the sales of a seller
        try 
        {
            $sales = $this->sale->getSalesBySeller($id);

            if ($sales)
            {
                return response()->json([
                    'status'  => 'GET',
                    'data' => [
                        'seller' => [
                            'name' => $seller->name,
                            'email' => $seller->email
                        ],
                        'sales' => $sales
                    ],
                ], 200);
            } else {
                return response()->json([
                    'status'  => 'GET',
                    'message' => 'Sales empty',
                    'data' => []
                ], 200);
            }
        } catch(\Exception $e) {
            return response()->json([
                'status'  => 'Bad Request',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
