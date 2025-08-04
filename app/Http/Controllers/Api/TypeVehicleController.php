<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TypeVehicleResource;
use App\Models\TypeVehicle;

class TypeVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TypeVehicleResource::collection(TypeVehicle::all());
    }
}
