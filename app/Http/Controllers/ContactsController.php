<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Contact::class, 'contact');
    }

    public function index(Request $request)
    {
        return ContactResource::collection($request->user()->contacts);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'birthday' => ['required', 'date'],
            'company' => ['required'],
        ]);

        $contact = $request->user()->contacts()->create($data);

        return response()->json($contact, Response::HTTP_CREATED);
    }

    public function show(Request $request, Contact $contact)
    {
        return new ContactResource($contact);
    }

    public function update(Request $request, Contact $contact)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'birthday' => ['required', 'date'],
            'company' => ['required'],
        ]);

        $contact->update($request->all());

        return response()->json([], Response::HTTP_OK);
    }

    public function destroy(Request $request, Contact $contact)
    {
        $contact->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
