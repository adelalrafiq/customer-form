<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        // Validatie regels
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            //'ticket' => 'required|file|mimes:png,jpg,pdf|max:2048',
            'ticket_path' => 'required|string', // Validating the ticket path instead of the file directly
        ]);

        // Opslaan van het ticket met een unieke bestandsnaam
     //   $ticketPath = $request->file('ticket')->store('tickets', 'public');

        // Nieuwe klant opslaan in de database
        Customer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            //'ticket_path' => $ticketPath,
            'ticket_path' => $validated['ticket_path'],
        ]);

         // Terugsturen van een succesbericht
       return back()->with('success', 'Ticket uploaded successfully!');
        //return response()->json(['success' => 'Ticket uploaded successfully!']);
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,pdf|max:2048',
        ]);

        $filePath = $request->file('file')->store('tickets', 'public');

        return response()->json(['filePath' => $filePath]);
    }
}