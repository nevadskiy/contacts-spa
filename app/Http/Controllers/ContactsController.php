<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactsController extends Controller
{
    public function store(Request $request)
    {
        return response()->json(
            Contact::create($request->all()), Response::HTTP_CREATED
        );
    }
}
