<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::latest()->filter(request(['keyword']))->paginate(10)->withQueryString();
        
        return view('transaction', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'quantity'          => 'required|numeric',
            'product_id'        => 'required',
        ]);

        $validatedData['price'] = Product::findOrFail($validatedData['product_id'])->price;
        $validatedData['payment_amount'] = $validatedData['price'] * $validatedData['quantity'];

        $request->url('https://sandbox.saebo.id/api/v1/transactions');        
        
        $request->setMethod(Request::METHOD_POST);
        $request->hasHeader('x-api-key', 'DATAUTAMA');
        $request->post(array(
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'payment_amount' => $validatedData['payment_amount']
        ));
        

        try {
            $response = $request->send();
            
            if ($response->getStatus() == 200) {
                echo $response->getBody();
            }
            else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }

            Transaction::create($validatedData);
            return response()->json($response, Response::HTTP_CREATED);
        } catch (BadRequestHttpException $e) {
            return response()->json([
                'message'   => "Failed " . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
