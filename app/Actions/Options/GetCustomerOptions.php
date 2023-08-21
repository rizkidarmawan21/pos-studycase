<?php

namespace App\Actions\Options;

use App\Models\Customer;

class GetCustomerOptions
{
    public function handle()
    {
        $category = Customer::all();

        $result = [];
        foreach ($category as $item) {
            $result[$item->id] = "$item->name - $item->phone";
        }

        return $result;
    }
}
