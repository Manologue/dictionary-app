<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Http\Resources\KeyWordResource;
use App\Http\Requests\StoreKeywordRequest;
use App\Http\Requests\UpdateKeywordRequest;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $userOnly = request('userOnly', false);
        $search = request('search', false);
        $active = request('active', false);
        $notActive = request('notActive', false);
        $paginateNumber = request('paginateNumber', 10);
        $alphabeticalOrder = request('alphabeticalOrder', false);
        $letter = request('letter', 'all');

        $withTranswords = request('withTranswords', false);
        $withNoTranswords = request('withNoTranswords', false);

        // Initialize
        if (!$alphabeticalOrder) {
            $query = Keyword::orderBy('id', 'desc');
        } else {
            $query = Keyword::orderBy('word');
        }

        // Add optional query conditions

        if ($active && !$notActive) {
            $query->where('active', $active);
        } elseif (!$active && $notActive) {
            $query->where('active', !$notActive);
        }
        if ($userOnly) {
            $query->where('created_by', auth()->user()->id);
        }
        /* *
         * * when searching or selecting a letter set alphabeticalOrder = true for the display to be more organized
         * * so it will always start like this
         * * http://localhost:8000/api/keyword?alphabeticalOrder=1&letter=b&etc.....
         * *  http://localhost:8000/api/keyword?alphabeticalOrder=1&search=bdfff&etc.....
         */

        if ($search) {
            $query->where('word', 'like', "%{$search}%");
        } elseif ($letter && $letter !== 'all') {
            $query->where('word', 'like', $letter . '%');
        }
        /* *
         * * on the front end if any one these one is true the other becomes false
         * * on the front end on table keywords include the column active and Transwords (both indicate true or false)
         */

        if ($withTranswords && !$withNoTranswords) {
            $query->whereHas('transwords');
        } elseif (!$withTranswords && $withNoTranswords) {
            $query->whereDoesntHave('transwords');
        }

        return KeyWordResource::collection($query->paginate($paginateNumber)->withQueryString());

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeywordRequest $request)
    {

        $request['created_by'] = 1; // TODO: this replace by auth user id
        return new KeyWordResource(Keyword::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Keyword $keyword)
    {
        //TODO: authorization for super admin and admin user
        return new KeywordResource($keyword);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keyword $keyword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeywordRequest $request, Keyword $keyword)
    {
        //TODO: authorization for super admin and admin user
        $request['updated_by'] = 1; // TODO: this replace by auth user id and before update verify if any field is diffrent from what is in the database

        return $keyword->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keyword $keyword)
    {
        //TODO: authorization for super admin and admin user

        $keyword->delete();

        return response()->noContent();
    }
}
