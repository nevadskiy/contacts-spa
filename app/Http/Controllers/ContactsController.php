<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactsController extends Controller
{
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required'],
            'email' => ['required'],
            'birthday' => ['required'],
            'company' => ['required'],
        ]);

        return response()->json(
            Contact::create($data), Response::HTTP_CREATED
        );
    }
}
