<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use DB;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaction = Transaction::all();
        return view('Transaction.index', compact('transaction'));
    }

    public function transaction()
    {
        //
        $transaction = Transaction::all();
        return response()->json($transaction);
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
        //
        
        DB::beginTransaction();
        try{
            $data = Transaction::where('id',$request['id'])->count();
            
            if ($data > 0) {
                $data = Transaction::where('id',$request['id'])->first();   
            }else{
                $data = new Transaction();
            }
            $data->product = $request['product'];
            $data->description = $request['description'];
            $data->image = $request['file'];
            $data->qty = $request['quantity'];
            $data->price = $request['price'];
            $diskon = ($data->price*((float)($request['discount'])/100));
            $data->discount = $diskon;
            $data->save();
            $message = 1;
        }catch(Exception $e){
            $message = 0;
        }

        if ($message == 1) {
            DB::commit();
            $result = array(
                'status' => 201,
                'message' => 'Berhasil!',
            );
        }else{
            DB::rollBack();
            $result = array(
                'status' => 501,
                'message' => 'Gagal!',
            );
        }

        return response()->json($result);
    }

    public function api(Request $request)
    {
        $transaction = Product::all();
        $datatables = datatables()->of($transaction)->addIndexColumn();

        return $datatables->make(true);
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
    public function destroy(Request $request)
    {
        //
        DB::beginTransaction();
        try{
            $data = Transaction::where('id',$request['id'])
            ->delete();
            $message = 1;
        }catch(Exception $e){
            $message = 0;
        }

        if ($message == 1) {
            DB::commit();
            $result = array(
                'status' => 201,
                'message' => 'Berhasil!',
            );
        }else{
            DB::rollBack();
            $result = array(
                'status' => 501,
                'message' => 'Gagal!',
            );
        }

        return response()->json($result);

    }
}
