<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletStoreRequest;
use App\Http\Requests\WalletUpdateRequest;
use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct() {
        $this->authorizeResource(Wallet::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $wallets = $request->user()->wallets()->with(['chain'])->get();

        return WalletResource::collection($wallets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WalletStoreRequest $request
     * @return WalletResource
     */
    public function store(WalletStoreRequest $request)
    {
        $wallet = $request->user()->wallets()->create($request->all());

        return new WalletResource($wallet);
    }

    /**
     * Display the specified resource.
     *
     * @param Wallet $wallet
     * @return WalletResource
     */
    public function show(Wallet $wallet)
    {
        return new WalletResource($wallet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WalletUpdateRequest $request
     * @param Wallet $wallet
     * @return WalletResource
     */
    public function update(WalletUpdateRequest $request, Wallet $wallet)
    {
        $wallet->update($request->all());

        return new WalletResource($wallet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Wallet $wallet
     * @return JsonResponse
     */
    public function destroy(Wallet $wallet)
    {
        $wallet->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
