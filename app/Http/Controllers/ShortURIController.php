<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortURI;
use App\Http\Resources\ShortURIResource;
use App\Models\ShortURI;


class ShortURIController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShortURI $request)
    {
        $request->validated();
        $link = ShortURI::findByOriginalLink($request->link);
        if($link){
            return new ShortURIResource($link);
        }
        $link = ShortURI::createRecord($request->link);

        return new ShortURIResource($link);
    }

    /**
     * Display the specified resource.
     */
    public function show($shortURI)
    {
        $link = ShortURI::findByShortURI($shortURI);

        return $link ? redirect($link->originalLink) : abort(404);
    }


}
