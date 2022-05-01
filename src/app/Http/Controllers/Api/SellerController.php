<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Validator;


class SellerController extends Controller
{

    private $seller;

    private $storeRules = [
        'name' => [
            'required',
            'min:3',
            'max:255'
        ],
        "email" => [
            'required',
            'email',
            'unique:sellers'
        ]
    ];

    public function __construct(Seller $seller)
    {   
        $this->seller = $seller;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $sellers = $this->seller->getAll();

            if ($sellers)
            {
                return response()->json([
                    'status'  => 'GET',
                    'data' => $sellers,
                ], 200);
            } else {
                return response()->json([
                    'status'  => 'GET',
                    'message' => 'Sellers empty',
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

        // Add Seller
        try {
            $seller = $this->seller->create(
                $data
            );
            if ($seller)
            {
                return response()->json([
                    'status'  => 'Created',
                    'data' => [
                        'id'        => $seller->id,
                        'name'      => $seller->name,
                        'email'     => $seller->email
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
}
