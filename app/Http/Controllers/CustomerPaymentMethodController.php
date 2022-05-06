<?php

namespace App\Http\Controllers;

use App\CustomerPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerPaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $request->all();

        $customerPaymentMethod = CustomerPaymentMethod::select();

        if ($request['CustomerPaymentMethodId']) {
            $customerPaymentMethod = $customerPaymentMethod->where('id', $request['CustomerPaymentMethodId']);
        }

        if ($request['CustomerPaymentMethodName']) {
            $customerPaymentMethod = $customerPaymentMethod->where('name', 'like', '%' . $request['CustomerPaymentMethodName'] . '%');
        }

        if ($request['orderByFieldName']) {
            $customerPaymentMethod = $customerPaymentMethod->orderBy($request['orderByFieldName'], $request['orderByMethod']);
        }

        return response()->json(compact('customerPaymentMethod'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|integer|min:1',
            'payment_method_id' => 'required|integer|min:1',
            'creditCardNumber' => 'required|string|min:13|max:16',
            'details' => 'nullable|string|min:1|max:1000',
        ]);

        CustomerPaymentMethod::create($request->only([
            'customer_id',
            'payment_method_id',
            'creditCardNumber',
            'details',
        ]));

        return response()->json(['message' => 'Deu tudo boa'], Response::HTTP_OK);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:250|min:4', 
            'description' => 'nullable|max:1000|min:4', 
            'icon' => 'nullable|max:250|min:4', 
            'image' => 'nullabe|mimes:.jpg,.jpeg,.png,.bmp'
        ]);

        $costumerPaymentId = $request->post('id');
        CustomerPaymentMethod::where('id', $costumerPaymentId)->update($request);

        return response()->json(['message' => 'Deu tudo boa'], Response::HTTP_OK);
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $customerPaymentMethodId = $request->post('id');
        customerPaymentMethod::where('id', $customerPaymentMethodId)->delete();

        return response()->json(['message' => 'Requisição Completada com Sucesso'], Response::HTTP_OK);
    }
}
