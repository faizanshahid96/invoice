<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response('hello');
        // return CustomerResource::collection(Customer::query()->orderBy('id', 'desc'));
        $userId = auth()->user()->id; // Get the user's ID from the authenticated user

        $customers = Customer::where('user_id', $userId)->get();
        // return new CustomerResource($customers);
        // return response($customers);
        return response()->json(['data' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'companyName' => 'required',
            'companyAddress' => 'required',
            'companyZipCode' => 'required',
            'companyCountry' => 'required',
            'companyCity' => 'required',
        ]);

        $customer = new Customer();
        $customer->user_id = auth()->user()->id;
        $customer->name = $validatedData['name'];
        $customer->company_name = $validatedData['companyName'];
        $customer->company_address = $validatedData['companyAddress'];
        $customer->company_zipcode = $validatedData['companyZipCode'];
        $customer->company_country = $validatedData['companyCountry'];
        $customer->company_city = $validatedData['companyCity'];
        $customer->save();

        return response()->json(['message' => 'Customer added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
