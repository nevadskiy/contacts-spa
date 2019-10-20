<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Resources\ContactResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->validate($request, [
            'query' => 'required',
        ]);

        return ContactResource::collection(
            $this->searchContacts($data['query'])
        );
    }

    private function searchContacts(string $query): Collection
    {
        return Contact::query()
            ->where(DB::raw('LOWER(name)'), 'like', '%' . Str::lower($query) .'%')
            ->get();
    }
}
