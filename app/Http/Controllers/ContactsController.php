<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
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
        return ContactResource::collection(
            $request->user()->contacts
        );
    }

    public function store(ContactStoreRequest $request)
    {
        return new ContactResource(
            $request->user()->contacts()->create(
                $request->validated()
            )
        );
    }

    public function show(Request $request, Contact $contact)
    {
        return new ContactResource($contact);
    }

    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return new ContactResource($contact);
    }

    public function destroy( Contact $contact)
    {
        $contact->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
