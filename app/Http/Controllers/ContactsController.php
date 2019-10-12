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
            'email' => ['required', 'email'],
            'birthday' => ['required', 'date'],
            'company' => ['required'],
        ]);

        return response()->json(
            Contact::create($data), Response::HTTP_CREATED
        );
    }

    public function show(Contact $contact)
    {
        return response()->json([
            'data' => [
                'id' => $contact->id,
                'name' => $contact->name,
                'birthday' => $contact->birthday->format('m/d/Y'),
                'company' => $contact->company,
                'last_updated' => $contact->updated_at->diffForHumans(),
            ]
        ]);
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

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
