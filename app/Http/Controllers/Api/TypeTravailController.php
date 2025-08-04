<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TypeTravailResource;
use App\Models\TypeTravail;

class TypeTravailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TypeTravailResource::collection(TypeTravail::all());
    }
}
