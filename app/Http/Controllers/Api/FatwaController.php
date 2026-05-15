<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fatwa;
use App\Http\Resources\FatwaResource;
use App\Services\Fatwa\FatwaService;
use Illuminate\Http\Request;

class FatwaController extends Controller
{
    protected $service;

    public function __construct(FatwaService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the fatwas.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'type']);
        $fatwas = $this->service->getPublishedFatwas($filters, $request->get('per_page', 10));

        return FatwaResource::collection($fatwas);
    }

    /**
     * Display the specified fatwa.
     */
    public function show(Fatwa $fatwa)
    {
        if (!$fatwa->is_published) {
            return response()->json(['message' => 'Fatwa not found or not published'], 404);
        }

        return new FatwaResource($fatwa);
    }
}
