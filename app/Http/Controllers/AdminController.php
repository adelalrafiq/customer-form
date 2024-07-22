<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class AdminController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers', compact('customers'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $customer->update($request->only(['name', 'email']));
        return redirect()->route('admin.customers')->with('success', 'Customer updated successfully');
    }
}
