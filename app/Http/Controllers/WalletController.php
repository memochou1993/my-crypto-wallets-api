<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletStoreRequest;
use App\Http\Requests\WalletUpdateRequest;
use App\Http\Resources\WalletResource;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        // FIXME
        $wallets = User::query()->first()->wallets()->with(['chain'])->get();

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
        // FIXME
        $wallet = User::query()->first()->wallets()->create($request->all());

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
        // FIXME
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
        // FIXME
        $wallet->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
