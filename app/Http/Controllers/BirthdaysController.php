<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;

class BirthdaysController extends Controller
{
    public function index(Request $request)
    {
        return ContactResource::collection(
            $request->user()->contacts()->birthdays()->get()
        );
    }
}
