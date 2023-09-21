<?php

namespace App\Http\Controllers;

use App\Models\Idioms;
use App\Http\Resources\IdiomsResource;
use App\Http\Requests\StoreIdiomsRequest;
use App\Http\Requests\UpdateIdiomsRequest;

class IdiomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $transword_id = request('transwordId', 0);
        $transword_slug = request('transwordSlug', null);

        $query = Idioms::orderBy('id', 'desc');

        if ($transword_slug) {
            $query->whereHas('transword', function ($q) use ($transword_slug) {
                $q->where('slug', $transword_slug);
            });
        } elseif ($transword_id) {
            $query->where('transword_id', $transword_id);
        }


        // return IdiomsResource::collection($query->get());
        return response()->json(['transword' => IdiomsResource::collection($query->get()), 'count' => count(IdiomsResource::collection($query->get()))]);


        /**
         *
         * TODO: apply this on the frontend later
         * $keywordId = 1; // replace with the ID of the keyword you want to query for
         * $idioms = Idiom::whereHas('transwords', function ($query) use ($keywordId) {
         * $query->whereHas('keyword', function ($query) use ($keywordId) {
         * $query->where('id', $keywordId);
         *  });
         * })->get();
         */

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
    public function store(StoreIdiomsRequest $request)
    {
        $request['created_by'] = 1; // TODO: this replace by auth user id
        return new IdiomsResource(Idioms::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Idioms $idiom)
    {
        //TODO: authorization for super admin and admin user
        return new IdiomsResource($idiom);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idioms $idiom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdiomsRequest $request, Idioms $idiom)
    {
        //TODO: authorization for super admin and admin user
        $request['updated_by'] = 1; // TODO: this replace by auth user id and before update verify if any field is diffrent from what is in the database
        return $idiom->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idioms $idiom)
    {
        $idiom->delete();

        return response()->noContent();
    }
}
