<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\User;
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
            $this->searchContacts($request->user(), $data['query'])
        );
    }

    private function searchContacts(User $user, string $query): Collection
    {
        return $user->contacts()
            ->where(DB::raw('LOWER(name)'), 'like', '%' . Str::lower($query) .'%')
            ->get();
    }
}
