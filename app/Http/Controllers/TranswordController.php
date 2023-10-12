<?php

namespace App\Http\Controllers;

use App\Models\Transword;
use App\Http\Resources\TransWordResource;
use App\Http\Requests\StoreTranswordRequest;
use App\Http\Requests\UpdateTranswordRequest;

class TranswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyword_id = request('keywordId', 0);
        $keyword_slug = request('keywordSlug', null);
        $keyword_user_id = request('userId', null);
        $paginateNumber = request('paginateNumber', 10);

        /* *
         * TODO: add verification for authorization
         * auth()->id = created_by(on the keywords table )  or auth()->role = superadmin
         */

        $query = Transword::orderBy('id', 'desc');

        if ($keyword_slug) {
            $query->whereHas('keyword', function ($q) use ($keyword_slug) {
                $q->where('slug', $keyword_slug);
            });
        } elseif ($keyword_id) {
            $query->where('keyword_id', $keyword_id);
        }
        if ($keyword_user_id) {
            $query->whereHas('keyword', function ($q) use ($keyword_user_id) {
                $q->where('created_by', $keyword_user_id);
            });
        }

        // return response()->json(['transword' => TransWordResource::collection($query->get()), 'count' => count(TransWordResource::collection($query->get()))]);
        // return TransWordResource::collection($query->paginate($paginateNumber)->withQueryString());
        return TransWordResource::collection($query->get());
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
    public function store(StoreTranswordRequest $request)
    {
        $request['created_by'] = 1; // TODO: this replace by auth user id
        // TODO: add audio file upload
        return new TransWordResource(Transword::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transword $transword)
    {
        //TODO: authorization for super admin and admin user
        return new TranswordResource($transword);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transword $transword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTranswordRequest $request, Transword $transword)
    {
        //TODO: authorization for super admin and admin user
        $request['updated_by'] = 1; // TODO: this replace by auth user id and before update verify if any field is diffrent from what is in the database
        // TODO: add audio file upload
        return $transword->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transword $transword)
    {
        //TODO: authorization for super admin and admin user

        $transword->delete();

        return response()->noContent();
    }
}