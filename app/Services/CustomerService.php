<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function getData($request)
    {
        $search = $request->search;

        $query = Customer::query();

        $query->when(request('search', false), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        });

        return $query->paginate(10);
    }

    public function createData($request)
    {
        $inputs = $request->only(['name', 'email', 'phone', 'address', 'city', 'zip_code']);
        $customer = Customer::create($inputs);

        return $customer;
    }

    public function updateData($id, $request)
    {
        $inputs = $request->only(['name', 'email', 'phone', 'address', 'city', 'zip_code']);

        $customer = Customer::findOrFail($id);
        $customer->update($inputs);

        return $customer;
    }

    public function deleteData($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return $customer;
    }
}
